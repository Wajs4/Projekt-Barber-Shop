<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../src/bootstrap.php';

Auth::start();
Auth::requireAdmin();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;
    if ($serviceId <= 0) {
        $msg = 'Vyber službu.';
    } elseif (!isset($_FILES['service_image']) || $_FILES['service_image']['error'] !== UPLOAD_ERR_OK) {
        $msg = 'Nebol nahratý platný súbor.';
    } else {
        $f = $_FILES['service_image'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $f['tmp_name']);
        finfo_close($finfo);
        $ext = '';
        switch ($mime) {
            case 'image/png': $ext = 'png'; break;
            case 'image/gif': $ext = 'gif'; break;
            case 'image/webp': $ext = 'webp'; break;
            default: $ext = 'jpg'; break;
        }

        $targetDir = __DIR__ . '/../images/services';
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $filename = 'service_' . $serviceId . '.' . $ext;
        $targetPath = $targetDir . '/' . $filename;

        if (move_uploaded_file($f['tmp_name'], $targetPath)) {
            // update data/services.json
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
                $msg = 'Obrázok uložený a služba aktualizovaná.';
            } else {
                $msg = 'Nepodarilo sa nájsť službu v services.json.';
            }
        } else {
            $msg = 'Nepodarilo sa uložiť súbor na server.';
        }
    }
}

$servicesPath = __DIR__ . '/../data/services.json';
$servicesData = @file_get_contents($servicesPath);
$services = json_decode($servicesData, true) ?: [];
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
        <?php if ($msg): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Služba</label>
                <select name="service_id" class="form-select" required>
                    <option value="">-- Vyber --</option>
                    <?php foreach ($services as $s): ?>
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
