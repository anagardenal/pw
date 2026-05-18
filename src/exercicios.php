<?php
/**
 * EXERCICIOS NOVOS - PW2 (2o ano ETEC)
 * Tema: uso pratico das funcoes do arquivo helpers.php
 *
 * Instrucoes para os alunos:
 * 1) Leia cada desafio.
 * 2) Resolva criando uma funcao para cada exercicio.
 * 3) Reaproveite as funcoes existentes em helpers.php.
 * 4) Evite reescrever logicas que ja existem nos helpers.
 */

require_once 'helpers.php';

// ============================================================================
// EXERCICIO 8 - VITRINE DE NOTICIAS
// ============================================================================
/*
Crie a funcao montarVitrineNoticias($titulos).

Entrada:
- $titulos (array de strings com titulos de noticias)

Regras:
- Para cada titulo, limpar espacos e gerar slug.
- Montar um novo array associativo no formato:
  titulo_original => slug
- Ignorar titulos vazios apos limpeza.

Exemplo de saida esperada:
array(
  "Tecnologia no Brasil" => "tecnologia-no-brasil",
  "Mercado de Jogos" => "mercado-de-jogos"
)
*/
function montarVitrineNoticias($titulos)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 9 - BOLETIM RAPIDO DA TURMA
// ============================================================================
/*
Crie a funcao gerarBoletimRapido($notas).

Entrada:
- $notas (array associativo: nome_do_aluno => array de notas)

Regras:
- Para cada aluno, calcule a media com calcularMedia().
- Retorne um array associativo:
  nome_do_aluno => "media_formatada - situacao"
- Situacao:
  media >= 7.0 => "Aprovado"
  media >= 5.0 e < 7.0 => "Recuperacao"
  media < 5.0 => "Reprovado"
- Formate a media com 1 casa decimal usando number_format(..., 1, ',', '.').
*/
function gerarBoletimRapido($notas)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 10 - CONTAGEM REGRESSIVA DE EVENTO
// ============================================================================
/*
Crie a funcao resumoEvento($nomeEvento, $dataEventoBr).

Entrada:
- $nomeEvento (string)
- $dataEventoBr (string no formato dd/mm/yyyy)

Regras:
- Converter a data para formato BD com converterDataParaBD().
- Calcular dias faltantes entre hoje e data do evento com diferencaDias().
- Montar mensagem final:
  "Evento: NOME | Data: DATA_EXTENSO | Dias: X"
- O nome deve sair com capitalizarPalavras().
- A data deve sair com dataExtenso().
*/
function resumoEvento($nomeEvento, $dataEventoBr)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 11 - HIGIENIZACAO DE CADASTROS
// ============================================================================
/*
Crie a funcao higienizarCadastros($usuarios).

Entrada:
- $usuarios (array de arrays com campos: nome, email, telefone)

Regras:
- Limpar e formatar nome com limparEspacos() e capitalizarPalavras().
- Validar email com validarEmail().
- Validar telefone com validarTelefone().
- Retornar somente usuarios validos.
- Em cada usuario valido, incluir chave extra: slug_nome.
  (gerado com criarSlug($nome_formatado))
*/
function higienizarCadastros($usuarios)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 12 - TAGS DE PRODUTOS
// ============================================================================
/*
Crie a funcao gerarTagsProduto($textoTags).

Entrada:
- $textoTags (string: exemplo "php, web, backend, web, api")

Regras:
- Dividir por virgula.
- Limpar espacos de cada tag.
- Remover duplicatas.
- Ordenar alfabeticamente.
- Capitalizar cada tag com capitalizarPrimeira().
- Retornar string final separada por " | ".
*/
function gerarTagsProduto($textoTags)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 13 - RELATORIO ANONIMIZADO
// ============================================================================
/*
Crie a funcao gerarRelatorioAnonimizado($contatos).

Entrada:
- $contatos (array de arrays com campos: nome, email, telefone)

Regras:
- Retornar um array de strings no formato:
  "Nome: X | Email: Y | Telefone: Z"
- Nome em formato capitalizado por palavras.
- Email mascarado com mascararDado(..., "email").
- Telefone mascarado com mascararDado(..., "telefone").
*/
function gerarRelatorioAnonimizado($contatos)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 14 - SORTEIO DE DUPLAS
// ============================================================================
/*
Crie a funcao sortearDuplas($alunos).

Entrada:
- $alunos (array de nomes)

Regras:
- Embaralhar a lista com embaralharArray().
- Montar duplas sequenciais.
- Se sobrar 1 aluno, ele entra na ultima dupla (vira trio).
- Retornar array de strings:
  "Dupla 1: Nome A e Nome B"
  "Dupla 2: Nome C e Nome D"
  "Dupla 3: Nome E, Nome F e Nome G"
*/
function sortearDuplas($alunos)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 15 - PAINEL DE LINKS VALIDOS
// ============================================================================
/*
Crie a funcao painelLinksValidos($links).

Entrada:
- $links (array de strings)

Regras:
- Filtrar apenas URLs validas com validarUrl().
- Para cada URL valida, criar um titulo simples com base no dominio
  (use parse_url e capitalize quando necessario).
- Retornar array associativo:
  url => slug_do_titulo
- O slug deve ser gerado com criarSlug().
*/
function painelLinksValidos($links)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 16 - RESUMO FINANCEIRO
// ============================================================================
/*
Crie a funcao resumoFinanceiro($lancamentos).

Entrada:
- $lancamentos (array de numeros, positivos e negativos)

Regras:
- Calcular total com calcularSoma().
- Encontrar maior e menor valor com encontrarMaximo() e encontrarMinimo().
- Retornar array associativo com chaves:
  total, maior, menor
- Todos os valores devem estar formatados com formatarMoeda().
*/
function resumoFinanceiro($lancamentos)
{
    // TODO: implementar
}

// ============================================================================
// EXERCICIO 17 - ORGANIZADOR DE ARQUIVOS
// ============================================================================
/*
Crie a funcao organizarArquivos($arquivos).

Entrada:
- $arquivos (array de arrays: nome e tamanho_bytes)

Regras:
- Para cada arquivo, gerar:
  nome_limpo (limparEspacos)
  nome_slug (criarSlug)
  tamanho_legivel (formatarTamanhoArquivo)
- Retornar novo array com os dados transformados.
*/
function organizarArquivos($arquivos)
{
    // TODO: implementar
}

