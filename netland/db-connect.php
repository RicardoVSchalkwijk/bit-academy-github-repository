<?php 

session_start();

$dbhost = "localhost";
$dbname = "netland";
$dbuser = "bit_academy";
$dbpass = "bit_academy";

$dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;

try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);
} catch (PDOException $error) {
    echo "Er is een verbindingsprobleem met de database" . $error->getMessage();
    exit();
}

?>