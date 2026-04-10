<?php
include 'lista_produtos.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>atv-catalogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #292929
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card {
            border-radius: 15px;
        }

    </style>
</head>

<body>

<div class="container mt-5 text-center">
    <div class="row justify-content-center">

        <?php foreach ($produtos as $produto): ?>

            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <div class="card h-100 shadow text-center" style="width: 18rem;">

                    <img src="<?php echo $produto['imagem']; ?>" class="card-img-top">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">
                            <?php echo $produto['nome']; ?>
                        </h5>

                        <p class="card-text text-muted">
                            <?php echo $produto['descricao']; ?>
                        </p>

                        <p class="mt-auto fs-5 text-success fw-bold">
                            R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?>
                        </p>

                        <a href="#" class="btn btn-primary mt-2">Ver Mais</a>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

</body>
</html>