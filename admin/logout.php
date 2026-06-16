<?php
require_once __DIR__ . '/../src/bootstrap.php';

class LogoutController 
{
    /**
     * Spustí proces odhlásenia používateľa
     */
    public function handleRequest(): void 
    {
        // Spustenie relácie cez objektový prístup
        Auth::start();

        // Samotné odhlásenie
        Auth::logout();

        // Presmerovanie na prihlasovaciu stránku
        $this->redirect('login.php');
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

// Inicializácia a spustenie kontrolera odhlásenia
$controller = new LogoutController();
$controller->handleRequest();