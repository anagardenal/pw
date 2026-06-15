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
$novoModelo = "Corolla";
$novoAno = 2024;
$novoPreco = 145000;
$novaCor = "Branco";

$sqlAtualizar = "
    UPDATE carros
    SET
        modelo = ?,
        ano = ?,
        preco = ?,
        cor = ?
    WHERE id = ?
";

$comandoSQL = $conexao->prepare($sqlAtualizar);

$comandoSQL->execute([
    $novoModelo,
    $novoAno,
    $novoPreco,
    $novaCor,
    $idCarro
]);

echo "Carro atualizado com sucesso!";