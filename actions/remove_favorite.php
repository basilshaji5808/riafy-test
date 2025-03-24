<?php
require '../db-conf.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}
if (isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("DELETE FROM favorite_movies WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$id, $user_id])) {
        echo json_encode(["status" => "success", "message" => "Movie removed from favorites"]);
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to remove movie"]);
    }
    exit;
}
?>