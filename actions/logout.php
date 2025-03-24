<?php
session_start();

$_ = $_GET;

if(
    isset($_GET['id'])
) {
    $id = strip_tags(trim($_['id']));

    if(
        isset($_SESSION['user_id']) == $id
    ) {
        unset($_SESSION['user_id']);

        header("Location: ../login.php");
        exit;
    }
}
?>