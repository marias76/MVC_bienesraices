<?php

//require 'funciones.php'; // Already autoloaded by composer
//require './includes/config/database.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectar a la base de datos
$db = conectarDB();
use Model\ActiveRecord;
ActiveRecord::setDB($db);

