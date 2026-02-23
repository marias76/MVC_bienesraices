<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$appTimezone = $_ENV['APP_TIMEZONE'] ?? date_default_timezone_get();
if (!@date_default_timezone_set($appTimezone)) {
    date_default_timezone_set('UTC');
}

function conectarDB(): mysqli
{
    $port = isset($_ENV['DB_PORT']) ? (int) $_ENV['DB_PORT'] : 3306;

    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_DATABASE'],
        $port
    );

    if ($db->connect_error) {
        throw new Exception("Error de conexión: " . $db->connect_error);
    }

    $timezone = new DateTimeZone(date_default_timezone_get());
    $offset = $timezone->getOffset(new DateTime('now', $timezone));
    $sign = $offset >= 0 ? '+' : '-';
    $offset = abs($offset);
    $hours = str_pad((string) intdiv($offset, 3600), 2, '0', STR_PAD_LEFT);
    $minutes = str_pad((string) intdiv($offset % 3600, 60), 2, '0', STR_PAD_LEFT);
    $mysqlOffset = $sign . $hours . ':' . $minutes;
    $db->query("SET time_zone = '{$mysqlOffset}'");

    return $db;
}

// Probar la conexión
// $db = conectarDB();
// echo "Conexión exitosa a la base de datos.";
