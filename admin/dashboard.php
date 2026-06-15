<?php
require_once __DIR__ . '/auth.php';
require_admin();
require_once __DIR__ . '/../src/bootstrap.php';

$repo = new ServiceRepository(__DIR__ . '/../data/services.json');
$servicesObjs = $repo->getAll();
$services = array_map(function($s){ return $s->toArray(); }, $servicesObjs);

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $service = new Service(0, $title, $price, $image);
        $repo->add($service);
        header('Location: dashboard.php'); exit;
    }

    if ($action === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $service = new Service($id, $title, $price, $image);
        $repo->update($service);
        header('Location: dashboard.php'); exit;
    }

    if ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        $repo->deleteById($id);
        header('Location: dashboard.php'); exit;
    }
}

$editItem = null;
if (isset($_GET['edit'])) {
    $eid = intval($_GET['edit']);
    foreach ($repo->getAll() as $s) {
        if ($s->getId() === $eid) { $editItem = $s->toArray(); break; }
    }
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/barber/css/bootstrap.min.css" rel="stylesheet">
    <link href="/barber/admin/css/admin.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="admin-overlay">
  <div class="admin-panel">
    <div class="admin-card">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Správa služieb</h3>
            <div>
                <a class="btn btn-sm btn-secondary" href="../index.php">Zobraziť stránku</a>
                <a class="btn btn-sm btn-danger" href="logout.php">Odhlásiť sa</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5><?php echo $editItem ? 'Upraviť službu' : 'Pridať službu'; ?></h5>
                <form method="post">
                    <?php if ($editItem): ?>
                        <input type="hidden" name="id" value="<?php echo $editItem['id']; ?>">
                    <?php endif; ?>
                    <input type="hidden" name="action" value="<?php echo $editItem ? 'edit' : 'add'; ?>">
                    <div class="mb-3">
                        <label class="form-label">Názov</label>
                        <input name="title" class="form-control" required value="<?php echo $editItem ? htmlspecialchars($editItem['title']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cena (napr. €36.00)</label>
                        <input name="price" class="form-control" required value="<?php echo $editItem ? htmlspecialchars($editItem['price']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cesta k obrázku (relatívne k root stránky)</label>
                        <input name="image" class="form-control" required value="<?php echo $editItem ? htmlspecialchars($editItem['image']) : ''; ?>">
                    </div>
                    <div class="d-flex gap-2">
                      <button class="btn btn-primary" type="submit"><?php echo $editItem ? 'Uložiť' : 'Pridať'; ?></button>
                      <?php if ($editItem): ?>
                        <a class="btn btn-secondary" href="dashboard.php">Zrušiť</a>
                      <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <h5>Existujúce služby</h5>
                <table class="table table-sm">
                    <thead><tr><th>ID</th><th>Title</th><th>Price</th><th></th></tr></thead>
                    <tbody>
                    <?php foreach ($services as $s): ?>
                        <tr>
                            <td><?php echo $s['id']; ?></td>
                            <td><?php echo htmlspecialchars($s['title']); ?></td>
                            <td><?php echo htmlspecialchars($s['price']); ?></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="dashboard.php?edit=<?php echo $s['id']; ?>">Upraviť</a>
                                <form method="post" style="display:inline-block" onsubmit="return confirm('Vymazať túto službu?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Vymazať</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
