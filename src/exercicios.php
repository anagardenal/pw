<?php
include_once './helpers.php';

//exer1

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

//exer4

function higienizarCadastros($usuarios)
{
    $validos = array();

    foreach ($usuarios as $usuario) {
        $nome = capitalizarPalavras(limparEspacos($usuario['nome'] ?? ''));
        $email = trim($usuario['email'] ?? '');
        $telefone = trim($usuario['telefone'] ?? '');

        if (estaVazio($nome)) {
            continue;
        }

        if (!validarEmail($email) || !validarTelefone($telefone)) {
            continue;
        }

        $validos[] = array(
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'slug_nome' => criarSlug($nome)
        );
    }

    return $validos;
}

// exer5

$textoTagsAleatorio = ' php, web, backend, web, api, css, php ';

foreach ($textoTags as $texto) {
    $tags = gerarTagsProduto($texto);
    $resultado[] = $tags;
}

$saida = gerarTagsProduto($textoTagsAleatorio);

//exer6

function gerarRelatorioAnonimizado($contatos)
{
    $linhas = array();

    foreach ($contatos as $contato) {
        $nome = capitalizarPalavras($contato['nome'] ?? '');
        $email = mascararDado($contato['email'] ?? '', 'email');
        $telefone = mascararDado($contato['telefone'] ?? '', 'telefone');

        $linhas[] = 'Nome: ' . $nome . ' | Email: ' . $email . ' | Telefone: ' . $telefone;
    }

    return $linhas;
}

//exer7

$alunosAleatorios = array('ana', 'bruno', 'carla', 'diego', 'elisa', 'fabio', 'gabi');
foreach ($alunosAleatorios as $aluno) {
    $alunosEmbaralhados = embaralharAlunos($alunosAleatorios);
    $duplas = sortearDuplas($alunosEmbaralhados);
    $resultado[] = $duplas;
}

$saida = sortearDuplas($alunosAleatorios);

//exer8

function painelLinksValidos($links)
{
    $resultado = array();

    foreach ($links as $url) {
        if (!validarUrl($url)) {
            continue;
        }

        $host = parse_url($url, PHP_URL_HOST);
        if ($host === null || $host === false) {
            continue;
        }

        $host = preg_replace('/^www\./', '', $host);
        $titulo = capitalizarPalavras(str_replace('.', ' ', $host));

        $resultado[$url] = criarSlug($titulo);
    }

    return $resultado;
}

//exer9

function resumoFinanceiro($lancamentos)
{
    if (empty($lancamentos)) {
        return array(
            'total' => formatarMoeda(0),
            'maior' => formatarMoeda(0),
            'menor' => formatarMoeda(0)
        );
    }

    $total = calcularSoma($lancamentos);
    $maior = encontrarMaximo($lancamentos);
    $menor = encontrarMinimo($lancamentos);

    return array(
        'total' => formatarMoeda($total),
        'maior' => formatarMoeda($maior),
        'menor' => formatarMoeda($menor)
    );
}

//exer10

function organizarArquivos($arquivos)
{
    $resultado = array();

    foreach ($arquivos as $arquivo) {
        $nomeLimpo = limparEspacos($arquivo['nome'] ?? '');
        $resultado[] = array(
            'nome_limpo' => $nomeLimpo,
            'nome_slug' => criarSlug($nomeLimpo),
            'tamanho_legivel' => formatarTamanhoArquivo((int) ($arquivo['tamanho_bytes'] ?? 0))
        );
    }

    return $resultado;
}
?>