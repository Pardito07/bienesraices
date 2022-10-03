<?php

use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';
require 'funciones.php';
require 'config/database.php';

$db = conectarDB();

ActiveRecord::setDB($db);