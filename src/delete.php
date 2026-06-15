<?php

$servidor = "localhost";
$nomeBanco = "revenda_carros";
$usuarioBanco = "root";
$senhaBanco = "";

$conexao = new PDO(
    "mysql:host=$servidor;dbname=$nomeBanco",
    $usuarioBanco,
    $senhaBanco
);


$idCarro = 1;

$sqlExcluir = "
    DELETE FROM carros
    WHERE id = ?
";

$comandoSQL = $conexao->prepare($sqlExcluir);

$comandoSQL->execute([$idCarro]);

echo "Carro removido com sucesso!";