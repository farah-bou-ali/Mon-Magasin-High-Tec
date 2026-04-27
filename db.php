<?php
$host = "localhost";
$port = "5432"; 
$dbname = "panier_db";
$user = "postgres";
$password = "";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "erreur de connection : " . $e->getMessage();
}
?>