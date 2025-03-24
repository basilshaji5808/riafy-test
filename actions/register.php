<?php
session_start();

require '../db-conf.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $_ = $_POST;

    if(
        isset(
            $_['name'],
            $_['email'],
            $_['password'],
            $_['cpassword']
        )
    ) {
        $name = strip_tags(trim($_['name']));
        $email = strip_tags(trim($_['email']));
        $password = strip_tags(trim($_['password']));
        $cpassword = strip_tags(trim($_['cpassword']));

        if(
            $name &&
            $email &&
            filter_var($email, FILTER_VALIDATE_EMAIL) &&
            $password &&
            $password == $cpassword
        ) {
            $password = base64_encode(hash('sha256', $password, true));

            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$name, $email, $password])) {

                $ssnObj = new stdClass();
                $ssnObj->name = $name;
                $ssnObj->password = $password;
                $ssnObj->ip = $_SERVER['REMOTE_ADDR'];
                $ssnObj->exp =  time() + 3600;
                $_SESSION['user'] = $ssnObj;

                header("Location: ../login.php");
                exit;
            } else {
                echo "Error registering user.";
            }
        }
    }   
}
?>