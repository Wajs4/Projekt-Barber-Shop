<?php
namespace App\Repositories;

require_once __DIR__ . '/../Models/Booking.php';
require_once __DIR__ . '/Database.php';

use App\Models\Booking;

class BookingRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->migrate();
    }

    private function migrate()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            phone TEXT,
            date TEXT,
            time TEXT,
            branch TEXT,
            people INTEGER,
            message TEXT,
            created_at TEXT
        )");
    }

    public function add(Booking $b)
    {
        $stmt = $this->pdo->prepare('INSERT INTO bookings (name,phone,date,time,branch,people,message,created_at) VALUES (?,?,?,?,?,?,?,datetime("now"))');
        $stmt->execute([
            $b->getName(), $b->getPhone(), $b->getDate(), $b->getTime(), $b->getBranch(), $b->getPeople(), $b->getMessage()
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM bookings ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Backwards-compatibility alias
if (!class_exists('BookingRepository')) {
    class_alias(__NAMESPACE__ . '\\BookingRepository', 'BookingRepository');
}

?>
