<?php


class ReviewsHandlerController 
{
   
    public function handleRequest(): void 
    {
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendMethodNotAllowed();
        }

        $this->processReview();
    }

   
    private function processReview(): void 
    {
        $name = trim($_POST['rv-name'] ?? '');
        $rating = (int)($_POST['rv-rating'] ?? 5);
        $message = trim($_POST['rv-message'] ?? '');

        
        if ($name === '' || $message === '') {
            $this->redirect('index.php?review=error#reviews');
        }

        
        $path = __DIR__ . '/data/reviews.json';
        $data = @file_get_contents($path);
        $arr = json_decode($data, true);
        
        if (!is_array($arr)) {
            $arr = [];
        }

        
        $entry = [
            'name' => $name,
            'rating' => max(1, min(5, $rating)),
            'message' => $message,
            'created_at' => date('c')
        ];

        
        $arr[] = $entry;
        file_put_contents($path, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        
        $this->redirect('index.php?review=ok#reviews');
    }

   
    private function sendMethodNotAllowed(): void 
    {
        http_response_code(405);
        echo 'Method Not Allowed';
        exit;
    }

    
    private function redirect(string $url): void 
    {
        header("Location: $url");
        exit;
    }
}


$controller = new ReviewsHandlerController();
$controller->handleRequest();