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


// CONSULTA TODOS OS CARROS
$sqlConsulta = "
    SELECT
        carros.id,
        marcas.nome AS marca,
        carros.modelo,
        carros.ano,
        carros.preco,
        carros.cor
    FROM carros
    INNER JOIN marcas
        ON carros.marca_id = marcas.id
";

$resultadoConsulta = $conexao->query($sqlConsulta);

$listaCarros = $resultadoConsulta->fetchAll();

foreach ($listaCarros as $carro) {

    echo "{$carro['id']} - ";
    echo "{$carro['marca']} ";
    echo "{$carro['modelo']} ";
    echo "({$carro['ano']}) - ";
    echo "R$ {$carro['preco']}<br>";
}



// CONSULTA UM CARRO ESPECÍFICO
$idCarro = 1;

$sqlConsulta = "
    SELECT *
    FROM carros
    WHERE id = ?
";

$comandoSQL = $conexao->prepare($sqlConsulta);

$comandoSQL->execute([$idCarro]);

$carroEncontrado = $comandoSQL->fetch();

echo "<hr>Modelo: " . $carroEncontrado['modelo'];