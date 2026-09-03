<?php

session_start();

if (!isset($_SESSION['s_token'])) {
    echo "Acesso negado<br>";
    echo "<a href='index.php'>Voltar</a>";
    exit;
}

?>