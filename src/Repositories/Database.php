<?php
namespace App\Repositories;

class Database
{
    private static $pdo;

    public static function getConnection()
    {
        if (self::$pdo === null) {
            $dir = __DIR__ . '/../../data';
            if (!is_dir($dir)) mkdir($dir, 0777, true);
            $path = $dir . '/database.sqlite';
            $dsn = 'sqlite:' . $path;
            self::$pdo = new PDO($dsn);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}

// Backwards-compatibility alias
if (!class_exists('Database')) {
    class_alias(__NAMESPACE__ . '\\Database', 'Database');
}

?>
