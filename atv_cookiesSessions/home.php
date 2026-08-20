<?php

session_start();

include "verifica.php";
echo "Nome: " . $_SESSION["nome"] . "<br>";
echo "E-mail: " . $_SESSION["email"] . "<br>";
if (isset($_COOKIE["remember"]) && $_COOKIE["remember"] == "1") {
    echo "Informação salva com sucesso!<br>";
    echo "Cookie - Nome: " . $_COOKIE["nome"] . "<br>";
    echo "Cookie - E-mail: " . $_COOKIE["email"] . "<br>";
} else {
    echo "Informação esquecida!";
}
?>