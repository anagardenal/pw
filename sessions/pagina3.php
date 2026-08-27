<?php

// pagina3.php
session_start();

echo "Nome: {$_SESSION['nome']} <br>";
echo "Email: {$_SESSION['email']} <br>";
echo "Idade: {$_SESSION['idade']} <br>";

?>

<a href="index.php">Voltar</a>
