<?php
// Constantes de configuración para la conexión a la base de datos

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "voting_system";

if (!defined('DB_HOST')) {
    define('DB_HOST', $server_name);
}

if (!defined('DB_USER')) {
    define('DB_USER', $user_name);
}

if (!defined('DB_PASS')) {
    define('DB_PASS', $password);
}

if (!defined('DB_NAME')) {
    define('DB_NAME', $db_name);
}
?>