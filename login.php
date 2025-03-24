<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="actions/login.php" method="POST">
            <input type="username" name="username" placeholder="User Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <a href="register.php">Register</a>
        </form>
    </div>
</body>
</html>