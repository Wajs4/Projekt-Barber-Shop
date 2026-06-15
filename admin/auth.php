<?php
require_once __DIR__ . '/../src/bootstrap.php';

function is_admin() {
    return Auth::isAdmin();
}

function require_admin() {
    Auth::requireAdmin();
}

function check_credentials($user, $pass) {
    return Auth::checkCredentials($user, $pass);
}
?>
