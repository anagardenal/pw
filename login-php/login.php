<?php

// Simula um usuário cadastrado no sistema. Em um projeto real, esses valores viriam de um banco de dados.
$email_db = 'teste@teste.com.br';
$password_db = '123456';

// Faz a validação do campo de email enviado pelo formulário.
// Se o email informado não for igual ao email cadastrado, mostra uma mensagem e interrompe a execução.
if ($_POST['email'] != $email_db) {
    echo "Email incorreto<br>";
    echo "<a href='index.php'>Voltar</a>";
    session_destroy();
    exit;
}

// Faz a validação da senha. Se estiver errada, também bloqueia o acesso e encerra a execução.
if ($_POST['password'] != $password_db) {
    echo "Senha incorreta<br>";
    echo "<a href='index.php'>Voltar</a>";
    session_destroy();
    exit;
}

// Se o checkbox "remember-me" foi marcado, cria um cookie para identificar que o usuário deseja continuar logado.
// O cookie 'r' será salvo por 30 dias e terá acesso em toda a aplicação ("/").
if (isset($_POST['remember-me'])) {
    setcookie('r', 1, time() + (86400 * 30), "/");
}

// Gera um token aleatório para aumentar a segurança da sessão.
// random_bytes(16) cria 16 bytes aleatórios e bin2hex converte para texto hexadecimal.
$token = bin2hex(random_bytes(16));

// Inicia a sessão do PHP e salva esse token em $_SESSION.
// A partir daqui, a aplicação pode verificar se o usuário está autenticado em outras páginas.
session_start();
$_SESSION['s_token'] = $token;

// Redireciona o usuário para a página home.php, que é a área restrita após login bem-sucedido.
header("Location: home.php");
