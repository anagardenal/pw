<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="login.php" method="post">
    Nome: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    Lembrar-me: <input type="checkbox" name="remember"><br>
    <input type="submit" value="Enviar">
</form>
</body>
</html>