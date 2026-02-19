<?php
require dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

function conectarDB(): mysqli
{
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_DATABASE']
    );

    if ($db->connect_error) {
        throw new Exception("Error de conexión: " . $db->connect_error);
    }

    return $db;
}

// Probar la conexión
//$db = conectarDB();
//echo "Conexión exitosa a la base de datos.";
