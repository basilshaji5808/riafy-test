<?php
require '../db-conf.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$_ = $_GET;

if(
    isset(
        $_['title'],
        $_['id'],
        $_['poster']
    )
) {
    $uid = $_SESSION['user_id'];
    $title = $_['title'];
    $id = $_['id'];
    $poster = $_['poster'];

    $stmt = $pdo->prepare("INSERT INTO favorite_movies (user_id, movie_title, movie_id, poster_url) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$uid, $title, $id, $poster])) {
        echo json_encode(["status" => "success", "message" => "Movie added to favorites"]);
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add movie"]);
    }
    exit;
}
?>
