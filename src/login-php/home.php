<?php

include 'verifica.php';

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

    <main>

        <section class="py-5 text-center container">

            <div class="row py-lg-5">

                <div class="col-lg-6 col-md-8 mx-auto">

                    <?php

                    echo "<h1>" . $_SESSION['usuario'] . " logado com sucesso!</h1>";

                    ?>

                </div>

            </div>

        </section>

    </main>

</body>

</html>