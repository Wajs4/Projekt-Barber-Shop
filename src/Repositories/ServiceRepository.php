<?php
namespace App\Repositories;

require_once __DIR__ . '/../Models/Service.php';

use App\Models\Service;

class ServiceRepository {
    private $file;

    public function __construct($file) {
        $this->file = $file;
        if (!file_exists(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }
        if (!file_exists($file)) {
            file_put_contents($file, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    public function getAll() {
        $data = @file_get_contents($this->file);
        $arr = json_decode($data, true) ?: [];
        $out = [];
        foreach ($arr as $item) {
            $out[] = Service::fromArray($item);
        }
        return $out;
    }

    public function saveAll(array $services) {
        $arr = [];
        foreach ($services as $s) {
            if ($s instanceof Service) $arr[] = $s->toArray();
        }
        file_put_contents($this->file, json_encode(array_values($arr), JSON_PRETTY_PRINT));
    }

    public function add(Service $service) {
        $services = $this->getAll();
        $serviceId = $this->nextId($services);
        $reflection = new \ReflectionClass($service);
        $prop = $reflection->getProperty('id');
        $prop->setAccessible(true);
        $prop->setValue($service, $serviceId);
        $services[] = $service;
        $this->saveAll($services);
        return $serviceId;
    }

    public function update(Service $service) {
        $services = $this->getAll();
        foreach ($services as $i => $s) {
            if ($s->getId() === $service->getId()) {
                $services[$i] = $service;
                $this->saveAll($services);
                return true;
            }
        }
        return false;
    }

    public function deleteById($id) {
        $services = $this->getAll();
        $services = array_filter($services, function($s) use ($id) { return $s->getId() !== (int)$id; });
        $this->saveAll(array_values($services));
        return true;
    }

    private function nextId(array $services) {
        $max = 0;
        foreach ($services as $s) {
            if ($s->getId() > $max) $max = $s->getId();
        }
        return $max + 1;
    }
}

// Backwards-compatibility alias
if (!class_exists('ServiceRepository')) {
    class_alias(__NAMESPACE__ . '\\ServiceRepository', 'ServiceRepository');
}
