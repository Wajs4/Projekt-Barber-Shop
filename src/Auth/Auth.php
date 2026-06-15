<?php
namespace App\Auth;

class Auth {
    private static $usersFile;

    private static function usersFilePath()
    {
        if (self::$usersFile === null) {
            self::$usersFile = __DIR__ . '/../../data/admin_users.json';
        }
        return self::$usersFile;
    }

    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
            session_set_cookie_params(0, '/', '', $secure, true);
            session_start();
        }
    }

    private static function ensureUsersFile()
    {
        $path = self::usersFilePath();
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
        if (!file_exists($path)) {
            // create default admin with password 'admin123' (will be hashed)
            $default = [
                ['username' => 'admin', 'password' => password_hash('admin123', PASSWORD_DEFAULT)]
            ];
            file_put_contents($path, json_encode($default, JSON_PRETTY_PRINT));
            return;
        }

        // If file exists but contains placeholder passwords, replace them with hashed defaults.
        $data = @file_get_contents($path);
        $arr = json_decode($data, true) ?: [];
        $changed = false;
        foreach ($arr as &$u) {
            if (isset($u['password']) && $u['password'] === '__AUTO_GENERATED__') {
                $u['password'] = password_hash('admin123', PASSWORD_DEFAULT);
                $changed = true;
            }
        }
        if ($changed) {
            file_put_contents($path, json_encode($arr, JSON_PRETTY_PRINT));
        }
    }

    private static function loadUsers()
    {
        self::ensureUsersFile();
        $data = @file_get_contents(self::usersFilePath());
        $arr = json_decode($data, true) ?: [];
        $out = [];
        foreach ($arr as $u) {
            if (isset($u['username']) && isset($u['password'])) {
                $out[$u['username']] = $u['password'];
            }
        }
        return $out;
    }

    public static function checkCredentials($user, $pass) {
        $users = self::loadUsers();
        if (!isset($users[$user])) return false;
        return password_verify($pass, $users[$user]);
    }

    public static function login($user, $pass)
    {
        self::start();
        if (self::checkCredentials($user, $pass)) {
            session_regenerate_id(true);
            $_SESSION['admin'] = true;
            $_SESSION['admin_user'] = $user;
            return true;
        }
        return false;
    }

    public static function logout()
    {
        self::start();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
    }

    public static function isAdmin()
    {
        self::start();
        return !empty($_SESSION['admin']) && $_SESSION['admin'] === true;
    }

    public static function requireAdmin()
    {
        if (!self::isAdmin()) {
            header('Location: /barber/admin/login.php');
            exit;
        }
    }
}

// Backwards-compatibility: alias namespaced class to global name
if (!class_exists('Auth')) {
    class_alias(__NAMESPACE__ . '\\Auth', 'Auth');
}
