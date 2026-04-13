<?php
include 'lista_produtos.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo Simples</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #1f1f1f;
        }

        .card {
            border-radius: 10px;
        }

        .card img {
            height: 180px;
            object-fit: cover;
        }

        button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 5px 10px;
        }
    </style>
</head>

<body>

<div class="container mt-4">
    <div class="row">

        <?php foreach ($produtos as $produto): ?>

            <div class="col-md-4 mb-3">
                <div class="card">

                    <img src="<?= $produto['imagem']; ?>">

                    <div class="card-body">
                        <h5><?= $produto['nome']; ?></h5>

                        <p><?= $produto['descricao']; ?></p>

                        <p>
                            <strong>
                                R$ <?= number_format($produto['valor'], 2, ',', '.'); ?>
                            </strong>
                        </p>

                        <button>Ver mais</button>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

</body>
</html>