<?php
function consultarTodosCarros($codigoMysql, $conexao)
{
$resultadoConsulta = $conexao->query($codigoMysql);
$listaCarros = $resultadoConsulta->fetchAll();
return $listaCarros;
}

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

var_dump(consultarTodosCarros($sqlConsulta, $conexao));