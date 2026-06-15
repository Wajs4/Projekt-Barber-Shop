<?php
require_once __DIR__ . '/src/Repositories/BookingRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['bb-name'] ?? '');
    $phone = trim($_POST['bb-phone'] ?? '');
    $date = trim($_POST['bb-date'] ?? '');
    $time = trim($_POST['bb-time'] ?? '');
    $branch = trim($_POST['bb-branch'] ?? '');
    $people = (int)($_POST['bb-number'] ?? 1);
    $message = trim($_POST['bb-message'] ?? '');

    // Basic validation
    if ($name === '' || $phone === '' || $date === '') {
        header('Location: index.php?booking=error&reason=invalid');
        exit;
    }

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

    try {
        $booking = new Booking(, $name, $phone, $date, $time, $branch, $people, $message);
        $repo = new BookingRepository();
        $id = $repo->add($booking);
        header('Location: index.php?booking=ok&id=' . $id);
        exit;
    } catch (Throwable $e) {
        // Log error and fall back to JSON storage
        error_log('Booking save failed: ' . $e->getMessage());
        $jsonPath = __DIR__ . '/data/bookings.json';
        $arr = [];
        if (file_exists($jsonPath)) {
            $arr = json_decode(@file_get_contents($jsonPath), true) ?: [];
        }
        $arr[] = $bookingData;
        file_put_contents($jsonPath, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: index.php?booking=ok&fallback=1');
        exit;
    }

}

http_response_code(405);
echo 'Method Not Allowed';

?>
