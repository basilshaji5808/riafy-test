<?php
session_start();
require '../db-conf.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $_ = $_POST;

    if(
        isset(
            $_['username'],
            $_['password']
        )
    ) {
        $username = strip_tags(trim($_['username']));
        $password = strip_tags(trim($_['password']));

        if(
            $username &&
            $password
        ) {
            $password = base64_encode(hash('sha256', $password, true));

            $stmt = $pdo->prepare("SELECT * FROM users WHERE `name` = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && $password == $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: ../dashboard.php");
                exit;
            } else {
                echo "Invalid credentials!";
            }
        }
    }
    
    
}
?>
