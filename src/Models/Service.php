<?php
namespace App\Models;

class Service {
    private $id;
    private $title;
    private $price;
    private $image;

    public function __construct($id, $title, $price, $image) {
        $this->id = (int)$id;
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
    }

    public static function fromArray(array $data) {
        return new self($data['id'] ?? 0, $data['title'] ?? '', $data['price'] ?? '', $data['image'] ?? '');
    }

    public function toArray() {
        return ['id' => $this->id, 'title' => $this->title, 'price' => $this->price, 'image' => $this->image];
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getPrice() { return $this->price; }
    public function getImage() { return $this->image; }

    public function setTitle($t) { $this->title = $t; }
    public function setPrice($p) { $this->price = $p; }
    public function setImage($i) { $this->image = $i; }
}

// Backwards-compatibility alias
if (!class_exists('Service')) {
    class_alias(__NAMESPACE__ . '\\Service', 'Service');
}
