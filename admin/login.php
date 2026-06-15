<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../src/bootstrap.php';

Auth::start();

if (Auth::isAdmin()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if (Auth::login($user, $pass)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Neplatné používateľské meno alebo heslo';
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
    <title>Admin Login</title>
</head>
<body>
<div class="admin-overlay">
    <div class="admin-panel">
        <div class="admin-card">
            <div class="container" style="max-width:420px">
                <h3 class="mb-3">Prihlásenie administrátora</h3>
                <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="post">
                        <div class="mb-3">
                                <label class="form-label">Používateľ</label>
                                <input name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Heslo</label>
                                <input name="password" type="password" class="form-control" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" type="submit">Prihlásiť sa</button>
                            <a class="btn btn-secondary" href="../index.php">Späť</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
