<?php
// Inicia a sessão para acessar as variáveis salvas em $_SESSION.
// Isso permite confirmar se o usuário já fez login corretamente.
session_start();

// Verifica se a variável s_token existe na sessão.
// Se ela não existir, significa que o usuário não passou pelo processo de autenticação.
if (!isset($_SESSION['s_token'])) {
    echo "Acesso negado<br>";
    echo "<a href='index.php'>Voltar</a>";
    exit;
}
?>