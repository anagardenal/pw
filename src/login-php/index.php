<?php

if (isset($_COOKIE['r']) && $_COOKIE['r'] == 1) {

    session_start();

    $token = bin2hex(random_bytes(16));

    $_SESSION['s_token'] = $token;

    if (isset($_COOKIE['usuario'])) {
        $_SESSION['usuario'] = $_COOKIE['usuario'];
    }

    header("Location: home.php");
    exit;
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link href="sign-in.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">

        <form action="login.php" method="POST">

            <h1 class="h3 mb-3 fw-normal">
                Faça seu login
            </h1>

            <div class="form-floating">

                <input
                    type="email"
                    class="form-control"
                    id="floatingInput"
                    name="email"
                    placeholder="name@example.com"
                    required
                >

                <label for="floatingInput">
                    Email
                </label>

            </div>

            <div class="form-floating">

                <input
                    type="password"
                    class="form-control"
                    id="floatingPassword"
                    name="password"
                    placeholder="Password"
                    required
                >

                <label for="floatingPassword">
                    Senha
                </label>

            </div>

            <div class="form-check text-start my-3">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember-me"
                    value="remember-me"
                    id="checkDefault"
                >

                <label
                    class="form-check-label"
                    for="checkDefault"
                >
                    Lembre de mim
                </label>

            </div>

            <button
                class="btn btn-primary w-100 py-2"
                type="submit"
            >
                Entrar
            </button>

        </form>

    </main>

</body>

</html>