<?php
function consultarTodosCarros($codigoMysql)
{
    global $conexao;
    $resultadoConsulta = $conexao->query($codigoMysql);
    $listaCarros = $resultadoConsulta->fetchAll();
    return $listaCarros;
}
//consultar por id
//cadastrar
//alterar
//excluir
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

function cadastrarCarro($marcaId, $modelo, $ano, $preco, $cor)
{
    global $conexao;
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
    return $conexao->lastInsertId();
    echo "Carro cadastrado com sucesso!";
}

function alterarCarro($id, $marcaId, $modelo, $ano, $preco, $cor)
{
    global $conexao;
    $sqlAlterar = "
        UPDATE carros
        SET marca_id = ?, modelo = ?, ano = ?, preco = ?, cor = ?
        WHERE id = ?
    ";
    $comandoSQL = $conexao->prepare($sqlAlterar);
    $comandoSQL->execute([
        $marcaId,
        $modelo,
        $ano,
        $preco,
        $cor,
        $id
    ]);
    echo "Carro alterado com sucesso!";
}

//marcas

function consultarTodasMarcas($codigoMysql)
{
    global $conexao;
    $resultadoConsulta = $conexao->query($codigoMysql);
    $listaMarcas = $resultadoConsulta->fetchAll();
    return $listaMarcas;
}



function cadastrarMarca($nome)
{
    global $conexao;
    $sqlInserir = "
        INSERT INTO marcas
        (nome)
        VALUES
        (?)
    ";
    $comandoSQL = $conexao->prepare($sqlInserir);
    $comandoSQL->execute([
        $nome
    ]);
    return $conexao->lastInsertId();
    echo "Marca cadastrada com sucesso!";
}

function alterarMarca($id, $nome)
{
    global $conexao;
    $sqlAlterar = "
        UPDATE marcas
        SET nome = ?
        WHERE id = ?
    ";
    $comandoSQL = $conexao->prepare($sqlAlterar);
    $comandoSQL->execute([
        $nome,
        $id
    ]);
    echo "Marca alterada com sucesso!";
}
