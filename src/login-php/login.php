<?php
session_start();

$arrCadastro = [
    ['usuario567@gmail.com', '123456', 'Sara'],
    ['dudabobona@gmail.com', '234567', 'Maria Eduarda'],
    ['usuario12@gmail.com', '345678', 'Ana'],
    ['usuario1234@gmail.com', '456789', 'Larissa'],
    ['usuario123@gmail.com', '5678910', 'Leonardo']
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
    echo "Email ou Senha incorretos<br>";
    echo "<a href='index.php'>Voltar</a>";
    session_destroy(); exit;
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