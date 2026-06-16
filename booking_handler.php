<?php
require_once __DIR__ . '/src/Repositories/BookingRepository.php';

class BookingHandlerController 
{
    /**
     * Hlavný bod vstupu pre riadenie požiadavky
     */
    public function handleRequest(): void 
    {
        // Tento handler striktne vyžaduje metódu POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendMethodNotAllowed();
        }

        $this->processBooking();
    }

    /**
     * Logika spracovania, validácie a uloženia rezervácie
     */
    private function processBooking(): void 
    {
        $name = trim($_POST['bb-name'] ?? '');
        $phone = trim($_POST['bb-phone'] ?? '');
        $date = trim($_POST['bb-date'] ?? '');
        $time = trim($_POST['bb-time'] ?? '');
        $branch = trim($_POST['bb-branch'] ?? '');
        $people = (int)($_POST['bb-number'] ?? 1);
        $message = trim($_POST['bb-message'] ?? '');

        // Základná validácia údajov
        if ($name === '' || $phone === '' || $date === '') {
            $this->redirect('index.php?booking=error&reason=invalid');
        }

        try {
            // Pokus o primárne uloženie cez Repozitár (napr. do databázy)
            $booking = new Booking(null, $name, $phone, $date, $time, $branch, $people, $message);
            $repo = new BookingRepository();
            $id = $repo->add($booking);
            
            $this->redirect('index.php?booking=ok&id=' . $id);

        } catch (Throwable $e) {
            // V prípade zlyhania zalogujeme chybu a ukladáme do záložného JSON súboru
            error_log('Booking save failed: ' . $e->getMessage());
            
            $bookingData = [
                'name' => $name,
                'phone' => $phone,
                'date' => $date,
                'time' => $time,
                'branch' => $branch,
                'people' => $people,
                'message' => $message,
                'created_at' => date('c')
            ];

            $this->saveToFallbackJson($bookingData);
            $this->redirect('index.php?booking=ok&fallback=1');
        }
    }

    /**
     * Pomocná metóda pre núdzový zápis do JSON súboru
     */
    private function saveToFallbackJson(array $bookingData): void 
    {
        $jsonPath = __DIR__ . '/data/bookings.json';
        $arr = [];
        
        if (file_exists($jsonPath)) {
            $arr = json_decode(@file_get_contents($jsonPath), true) ?: [];
        }
        
        $arr[] = $bookingData;
        file_put_contents($jsonPath, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Pomocná metóda na ukončenie požiadavky s kódom 405
     */
    private function sendMethodNotAllowed(): void 
    {
        http_response_code(405);
        echo 'Method Not Allowed';
        exit;
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

// Inicializácia a spustenie kontrolera rezervácií
$controller = new BookingHandlerController();
$controller->handleRequest();