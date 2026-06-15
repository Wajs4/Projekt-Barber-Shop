<?php
// If Composer autoloader exists, load it (PSR-4 autoloading)
$composer = __DIR__ . '/../vendor/autoload.php';
if (file_exists($composer)) {
	require_once $composer;
}

// Backwards-compatible requires (will work whether using autoload or not)
require_once __DIR__ . '/Auth/Auth.php';
require_once __DIR__ . '/Models/Service.php';
require_once __DIR__ . '/Repositories/ServiceRepository.php';
require_once __DIR__ . '/Repositories/Database.php';
require_once __DIR__ . '/Repositories/BookingRepository.php';
