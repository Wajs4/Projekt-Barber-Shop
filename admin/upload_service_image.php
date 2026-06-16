<?php
require_once __DIR__ . '/../src/bootstrap.php';

class UploadServiceImageController 
{
    private string $message = '';
    private array $services = [];

    /**
     * Hlavný bod vstupu pre riadenie požiadavky
     */
    public function handleRequest(): void 
    {
        // Spustenie relácie a kontrola práv administrátora
        Auth::start();
        Auth::requireAdmin();

        // Spracovanie POST požiadavky (odoslanie formulára s obrázkom)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processUpload();
        }

        // Načítanie zoznamu služieb pre výberové pole (select)
        $this->loadServices();
    }

    /**
     * Logika spracovania a validácie nahratého obrázka
     */
    private function processUpload(): void 
    {
        $serviceId = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;

        if ($serviceId <= 0) {
            $this->message = 'Vyber službu.';
            return;
        } 
        
        if (!isset($_FILES['service_image']) || $_FILES['service_image']['error'] !== UPLOAD_ERR_OK) {
            $this->message = 'Nebol nahratý platný súbor.';
            return;
        }

        $file = $_FILES['service_image'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $ext = match ($mime) {
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
            default      => 'jpg',
        };

        $targetDir = __DIR__ . '/../images/services';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = 'service_' . $serviceId . '.' . $ext;
        $targetPath = $targetDir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $this->updateServiceJson($serviceId, $filename);
        } else {
            $this->message = 'Nepodarilo sa uložiť súbor na server.';
        }
    }

    /**
     * Pomocná metóda na aktualizáciu cesty k obrázku v JSON databáze
     */
    private function updateServiceJson(int $serviceId, string $filename): void 
    {
        $jsonPath = __DIR__ . '/../data/services.json';
        $data = @file_get_contents($jsonPath);
        $arr = json_decode($data, true) ?: [];
        $changed = false;

        foreach ($arr as &$s) {
            if ((int)($s['id'] ?? 0) === $serviceId) {
                $s['image'] = 'images/services/' . $filename;
                $changed = true;
                break;
            }
        }

        if ($changed) {
            file_put_contents($jsonPath, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->message = 'Obrázok uložený a služba aktualizovaná.';
        } else {
            $this->message = 'Nepodarilo sa nájsť službu v services.json.';
        }
    }

    /**
     * Načítanie služieb z JSON súboru
     */
    private function loadServices(): void 
    {
        $servicesPath = __DIR__ . '/../data/services.json';
        $servicesData = @file_get_contents($servicesPath);
        $this->services = json_decode($servicesData, true) ?: [];
    }

    // Gettery pre bezpečný prístup z HTML kódu
    public function getMessage(): string 
    {
        return $this->message;
    }

    public function getServices(): array 
    {
        return $this->services;
    }
}

// Inicializácia a spustenie kontrolera
$controller = new UploadServiceImageController();
$controller->handleRequest();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="/barber/css/bootstrap.min.css" rel="stylesheet">
    <title>Nahratie obrázka služby</title>
</head>
<body class="p-4">
    <div class="container" style="max-width:720px">
        <h3>Aktualizovať obrázok služby</h3>
        
        <?php if ($controller->getMessage()): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($controller->getMessage()); ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Služba</label>
                <select name="service_id" class="form-select" required>
                    <option value="">-- Vyber --</option>
                    <?php foreach ($controller->getServices() as $s): ?>
                        <option value="<?php echo (int)$s['id']; ?>"><?php echo htmlspecialchars($s['title']); ?> (ID <?php echo (int)$s['id']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Vyber obrázok (jpg/png/webp/gif)</label>
                <input type="file" name="service_image" accept="image/*" class="form-control" required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Nahráť a aktualizovať</button>
                <a class="btn btn-secondary" href="dashboard.php">Späť</a>
            </div>
        </form>

    </div>
</body>
</html>