<?php

$servidor = "localhost";
$nomeBanco = "revenda_carros";
$usuarioBanco = "root";
$senhaBanco = "";


$opcoesPDO = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$conexao = new PDO(
    "mysql:host=$servidor;dbname=$nomeBanco",
    $usuarioBanco,
    $senhaBanco,
    $opcoesPDO
);

$marcaId = 1;
$modelo = "Civic";
$ano = 2022;
$preco = 120000;
$cor = "Prata";

$sqlInserir = "
    INSERT INTO carros
    (marca_id, modelo, ano, preco, cor)
    VALUES
    (?, ?, ?, ?, ?)
";

$comandoSQL = $conexao->prepare($sqlInserir);

$comandoSQL->execute([
    $marcaId,
    $modelo,
    $ano,
    $preco,
    $cor
]);

echo "Carro cadastrado com sucesso!";