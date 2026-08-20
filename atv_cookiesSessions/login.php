<?php

session_start();

if (isset($_POST["name"]) && isset($_POST["email"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $remember = isset($_POST["remember"]);
    $_SESSION["nome"] = $name;
    $_SESSION["email"] = $email;
    if ($remember) {
        setcookie("nome", $name, time() + 3600);
        setcookie("email", $email, time() + 3600);
        setcookie("remember", "1", time() + 3600);
    }
    header("Location: home.php");
    exit;
} else {
    echo "Login inválido!";
}