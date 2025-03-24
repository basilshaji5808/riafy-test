<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$host = 'sql107.infinityfree.com';
$dbname = 'if0_38595111_movie_app';
$username = 'if0_38595111';
$password = 'ALXSlnlG5i84kj';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>