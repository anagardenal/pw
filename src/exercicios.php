<?php
include_once './helpers.php';

$titulosAleatorios = array(
    '  Tecnologia avanca no interior  ',
    'Mercado de jogos bate recorde em 2026',
    '   ',
    'Saude digital cresce nas escolas'
);

  foreach ($titulos as $titulo) {
    $tituloLimpo = limparEspacos($titulo);

    $resultado[] = [
      'titulo'   => $tituloLimpo,
      'slug'     => criarSlug(removerAcentos($tituloLimpo)) 
    ];
}

// exer2

$notasAleatorias = array(
    'Ana Silva' => array(8, 7, 9, 6),
    'Bruno Costa' => array(5, 5, 6, 4),
    'Carla Lima' => array(2, 3, 4, 5)
);

foreach ($notas as $aluno => $notasAluno) {
    $media = calcularMedia($notasAluno);
    $situacao = determinarSituacao($media);

    $resultado[] = [
      'aluno' => $aluno,
      'média' => $media,
      'situação' => $situacao
    ];
}

// exer3

$nomeEventoAleatorio = 'feira de tecnologia';
$dataEventoBrAleatoria = '18/09/2026';

foreach ($eventos as $evento) {
    $resumo = resumoEvento($evento['nome'], $evento['data']);
    $resultado[] = $resumo;
}

$saida = resumoEvento($nomeEventoAleatorio, $dataEventoBrAleatoria);

// exer5

$textoTagsAleatorio = ' php, web, backend, web, api, css, php ';

foreach ($textoTags as $texto) {
    $tags = gerarTagsProduto($texto);
    $resultado[] = $tags;
}

$saida = gerarTagsProduto($textoTagsAleatorio);

//exer7
$alunosAleatorios = array('ana', 'bruno', 'carla', 'diego', 'elisa', 'fabio', 'gabi');
foreach ($alunosAleatorios as $aluno) {
    $alunosEmbaralhados = embaralharAlunos($alunosAleatorios);
    $duplas = sortearDuplas($alunosEmbaralhados);
    $resultado[] = $duplas;
}

$saida = sortearDuplas($alunosAleatorios);
?>