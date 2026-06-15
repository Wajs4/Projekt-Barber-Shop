<?php
// Simple handler to save reviews into data/reviews.json
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(300);
    echo 'Method Not Allowed';
    exit;
}

$name = trim($_POST['rv-name'] ?? '');
$rating = (int)($_POST['rv-rating'] ?? 5);
$message = trim($_POST['rv-message'] ?? '');

if ($name === '' || $message === '') {
    header('Location: index.php?review=error#reviews');
    exit;
}

$path = __DIR__ . '/data/reviews.json';
$data = @file_get_contents($path);
$arr = json_decode($data, true);
if (!is_array($arr)) $arr = [];

$entry = [
    'name' => $name,
    'rating' => max(1, min(5, $rating)),
    'message' => $message,
    'created_at' => date('c')
];

$arr[] = $entry;
file_put_contents($path, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header('Location: index.php?review=ok#reviews');
exit;

?>
