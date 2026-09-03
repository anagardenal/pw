<?php
session_start();

$arrCadastro = [
    ['drybobona@email.com', 'walugi12', 'Brunola'],
    ['brunobobao@email.com', 'walugi13', 'Dyzoca'],
    ['usuario12@email.com', 'ususs1', 'Amelie'],
    ['usu1234@email.com', 'suario2', 'Larissa'],
    ['usua123@email.com', 'asuario4', 'Fernando']
];

$correto = false;
$nomeUsuario = '';

foreach ($arrCadastro as $x) {
    if ($_POST['email'] == $x[0] && $_POST['password'] == $x[1]) {
        $correto = true;
        $nomeUsuario = $x[2];
    }
}

if ($correto == false) {
    echo "Email ou Senha incorretos!<br>";
    echo "<a href='index.php'>Voltar</a>";
    session_destroy();
    exit;
}

if (isset($_POST['remember-me'])) {
    setcookie('r', 1, time() + (86400 * 30), "/");
    setcookie('usuario', $nomeUsuario, time() + (86400 * 30), "/");
}

$token = bin2hex(random_bytes(16));

$_SESSION['s_token'] = $token;
$_SESSION['usuario'] = $nomeUsuario;

header("Location: home.php");
exit;
?>