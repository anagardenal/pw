<?php

// perfil.php
session_start();

echo "Nome: {$_SESSION['nome']} <br>";
echo "Email: {$_SESSION['email']} <br>";
echo "Idade: {$_SESSION['idade']} <br>";

?>

<a href="pagina3.php">Ir para página 3</a>