<?php
require_once __DIR__ . '/../src/bootstrap.php';

class LoginController 
{
    private string $error = '';

    /**
     * Spustí proces spracovania prihlásenia
     */
    public function handleRequest(): void 
    {
        Auth::start();

        // Ak už je používateľ prihlásený ako admin, presmerujeme ho
        if (Auth::isAdmin()) {
            $this->redirect('dashboard.php');
        }

        // Spracovanie POST požiadavky (odoslanie formulára)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLogin();
        }
    }

    /**
     * Logika overenia prihlasovacích údajov
     */
    private function processLogin(): void 
    {
        $user = $_POST['username'] ?? '';
        $pass = $_POST['password'] ?? '';

        if (Auth::login($user, $pass)) {
            $this->redirect('dashboard.php');
        } else {
            $this->error = 'Neplatné používateľské meno alebo heslo';
        }
    }

    /**
     * Pomocná metóda na vrátenie chybovej správy do HTML
     */
    public function getError(): string 
    {
        return $this->error;
    }

    /**
     * Pomocná metóda na bezpečné presmerovanie
     */
    private function redirect(string $url): void 
    {
        header("Location: $url");
        exit;
    }
}

// Inicializácia a spustenie kontrolera prihlásenia
$controller = new LoginController();
$controller->handleRequest();
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
                
                <?php if ($controller->getError()): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($controller->getError()); ?></div>
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