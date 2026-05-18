<?php
/**
 * ============================================================================
 * ARQUIVO: helpers.php
 * ============================================================================
 * Arquivo com funções auxiliares para dinamização de websites
 * Criado para demonstração didática de funções em PHP
 * 
 * Tópicos cobertos:
 * - Funções básicas de formatação
 * - Conversão e tratamento de strings
 * - Manipulação de datas
 * - Transformação para URL-friendly (slug)
 * - Remoção de acentos
 * - Validações
 * - Manipulação de arrays
 * 
 * @author Professor PW2
 * @version 1.0
 * ============================================================================
 */

// ============================================================================
// SEÇÃO 1: FUNÇÕES DE FORMATAÇÃO E TRATAMENTO DE STRINGS
// ============================================================================

/**
 * Capitaliza a primeira letra de uma string
 * Útil para nomes, títulos, etc.
 * 
 * @param string $texto - O texto a ser capitalizado
 * @return string - Texto com primeira letra em maiúscula
 */
function capitalizarPrimeira($texto)
{
    // strtolower() = converte tudo para minúscula
    // ucfirst() = coloca primeira letra em maiúscula
    return ucfirst(strtolower(trim($texto)));
}

/**
 * Capitaliza a primeira letra de cada palavra
 * Útil para títulos completos
 * 
 * Exemplo: "olá mundo" -> "Olá Mundo"
 * 
 * @param string $texto - O texto a ser processado
 * @return string - Texto com primeira letra de cada palavra em maiúscula
 */
function capitalizarPalavras($texto)
{
    // ucwords() = capitaliza primeira letra de cada palavra
    return ucwords(strtolower(trim($texto)));
}

/**
 * Remove espaços em branco do início, fim e excesso no meio
 * Útil para limpar dados de formulários
 * 
 * Exemplo: "  olá   mundo  " -> "olá mundo"
 * 
 * @param string $texto - O texto a ser limpo
 * @return string - Texto limpo
 */
function limparEspacos($texto)
{
    // trim() = remove espaços do início e fim
    // preg_replace() = substitui padrões (regex)
    //   '/\s+/' = padrão que encontra 1 ou mais espaços em branco
    //   ' ' = substitui por um único espaço
    return preg_replace('/\s+/', ' ', trim($texto));
}

/**
 * Trunca um texto limitando a quantidade de caracteres
 * Útil para exibir resumos ou descrições curtas
 * 
 * Exemplo: truncarTexto("Olá mundo PHP", 7) -> "Olá mun..."
 * 
 * @param string $texto - O texto a ser truncado
 * @param int $limite - Quantidade máxima de caracteres
 * @param string $sufixo - Texto adicionado ao final (padrão: "...")
 * @return string - Texto truncado
 */
function truncarTexto($texto, $limite, $sufixo = "...")
{
    // strlen() = conta quantidade de caracteres
    // substr() = extrai parte da string
    
    // Se o texto é maior que o limite
    if (strlen($texto) > $limite) {
        // Extrair apenas os primeiros $limite caracteres e adicionar sufixo
        return substr($texto, 0, $limite) . $sufixo;
    }
    
    // Se não excede o limite, retorna o texto original
    return $texto;
}

/**
 * Mascara dados sensíveis (e-mail, telefone, CPF)
 * Útil para mostrar informações de forma segura
 * 
 * Exemplo: mascararEmail("usuario@email.com") -> "u***@email.com"
 * 
 * @param string $dado - O dado a ser mascarado
 * @param string $tipo - Tipo de dado (email, telefone, cpf)
 * @return string - Dado mascarado
 */
function mascararDado($dado, $tipo = "email")
{
    // Diferentes tipos de máscaras
    switch ($tipo) {
        case "email":
            // Encontra a posição do @
            $arroba = strpos($dado, "@");
            // Pega primeira letra + asteriscos + domínio
            return substr($dado, 0, 1) . str_repeat("*", $arroba - 1) . substr($dado, $arroba);
            
        case "telefone":
            // Mostra apenas últimos 4 dígitos: (***) ****-9999
            return "(***) ****-" . substr(preg_replace("/[^0-9]/", "", $dado), -4);
            
        case "cpf":
            // Mostra apenas últimos 3 dígitos: ***.***.**-99
            $cpfLimpo = preg_replace("/[^0-9]/", "", $dado);
            return "***." . substr($cpfLimpo, 3, 3) . ".**-" . substr($cpfLimpo, -2);
            
        default:
            return $dado;
    }
}

// ============================================================================
// SEÇÃO 2: FUNÇÕES DE CONVERSÃO E LIMPEZA PARA URL (SLUG)
// ============================================================================

/**
 * Remove acentos de uma string
 * Necessário para criar URLs amigáveis (slug)
 * 
 * Exemplo: removerAcentos("São Paulo") -> "Sao Paulo"
 * 
 * @param string $texto - Texto com possíveis acentos
 * @return string - Texto sem acentos
 */
function removerAcentos($texto)
{
    // iconv() = converte entre codificações de caracteres
    // //TRANSLIT = transliterar caracteres acentuados
    // //IGNORE = ignora caracteres que não podem ser convertidos
    
    $acentosOrigem = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÑñ";
    $acentosDestino = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeeCcIIIIiiiiUUUUuuuuNn";
    
    // str_replace() = substitui cada acento por sua versão sem acento
    return str_replace(
        str_split($acentosOrigem),
        str_split($acentosDestino),
        $texto
    );
}

/**
 * Converte um texto em slug URL-friendly
 * Ideal para criar URLs legíveis
 * 
 * Exemplo: criarSlug("Olá! Bem-vindo à PHP") -> "ola-bem-vindo-a-php"
 * 
 * @param string $texto - O texto a ser convertido
 * @param string $separador - Caractere separador (padrão: "-")
 * @return string - Texto formatado como slug
 */
function criarSlug($texto, $separador = "-")
{
    // 1. Remove acentos
    $slug = removerAcentos($texto);
    
    // 2. Converte para minúsculas
    $slug = strtolower($slug);
    
    // 3. Remove caracteres especiais, mantendo apenas letras, números e hífen
    // preg_replace() = substitui padrões
    // [^a-z0-9-] = tudo que NÃO seja letra, número ou hífen
    $slug = preg_replace('/[^a-z0-9-]/', $separador, $slug);
    
    // 4. Remove hífens múltiplos
    $slug = preg_replace('/-+/', $separador, $slug);
    
    // 5. Remove hífens do início e fim
    $slug = trim($slug, $separador);
    
    return $slug;
}

/**
 * Gera um slug único para evitar duplicatas (opcional para futuro BD)
 * 
 * Exemplo: gerarSlugUnico("Meu Artigo") -> "meu-artigo-1621234567"
 * 
 * @param string $texto - O texto base
 * @param bool $adicionarTimestamp - Se verdadeiro, adiciona timestamp
 * @return string - Slug único
 */
function gerarSlugUnico($texto, $adicionarTimestamp = false)
{
    // Criar slug normal
    $slug = criarSlug($texto);
    
    // Adicionar timestamp para garantir unicidade
    if ($adicionarTimestamp) {
        $slug .= "-" . time();
    }
    
    return $slug;
}

// ============================================================================
// SEÇÃO 3: FUNÇÕES DE CONVERSÃO E FORMATAÇÃO DE DATAS
// ============================================================================

/**
 * Converte uma data em formato brasileiro (dd/mm/yyyy)
 * 
 * Exemplo: formatarDataBR("2024-05-17") -> "17/05/2024"
 * 
 * @param string $data - Data em formato yyyy-mm-dd
 * @return string - Data formatada
 */
function formatarDataBR($data)
{
    // strtotime() = converte string em timestamp (segundos desde 01/01/1970)
    // date() = formata um timestamp em data legível
    
    // Proteger contra datas inválidas
    if (empty($data)) {
        return "";
    }
    
    // Converter para timestamp
    $timestamp = strtotime($data);
    
    // Verificar se conversão foi bem-sucedida
    if ($timestamp === false) {
        return "Data inválida";
    }
    
    // Formatar em padrão brasileiro
    // d = dia (com zero à esquerda)
    // m = mês (com zero à esquerda)
    // Y = ano com 4 dígitos
    return date('d/m/Y', $timestamp);
}

/**
 * Converte data brasileira (dd/mm/yyyy) em formato de banco de dados (yyyy-mm-dd)
 * 
 * Exemplo: converterDataParaBD("17/05/2024") -> "2024-05-17"
 * 
 * @param string $dataBR - Data em formato brasileiro
 * @return string - Data em formato de banco de dados
 */
function converterDataParaBD($dataBR)
{
    // Verificar se data não está vazia
    if (empty($dataBR)) {
        return "";
    }
    
    // Separar dia, mês e ano usando explode()
    // explode() = divide uma string em um array usando um separador
    $partes = explode('/', $dataBR);
    
    // Verificar se tem exatamente 3 partes (dd, mm, yyyy)
    if (count($partes) != 3) {
        return "Data inválida";
    }
    
    // Extrair dia, mês e ano
    $dia = $partes[0];
    $mes = $partes[1];
    $ano = $partes[2];
    
    // Validação simples
    if ($dia < 1 || $dia > 31 || $mes < 1 || $mes > 12 || $ano < 1900) {
        return "Data inválida";
    }
    
    // Retornar no formato de banco de dados (yyyy-mm-dd)
    return $ano . "-" . str_pad($mes, 2, "0", STR_PAD_LEFT) . "-" . str_pad($dia, 2, "0", STR_PAD_LEFT);
}

/**
 * Calcula a diferença entre duas datas em dias
 * 
 * Exemplo: diferencaDias("2024-05-10", "2024-05-17") -> 7
 * 
 * @param string $dataInicio - Data inicial (yyyy-mm-dd)
 * @param string $dataFim - Data final (yyyy-mm-dd)
 * @return int - Diferença em dias
 */
function diferencaDias($dataInicio, $dataFim)
{
    // Converter ambas para timestamp
    $timestamp1 = strtotime($dataInicio);
    $timestamp2 = strtotime($dataFim);
    
    // Proteger contra datas inválidas
    if ($timestamp1 === false || $timestamp2 === false) {
        return 0;
    }
    
    // Calcular diferença em segundos
    $diferenca = abs($timestamp2 - $timestamp1);
    
    // Converter para dias (86400 segundos = 1 dia)
    return floor($diferenca / 86400);
}

/**
 * Retorna uma data em formato legível em português
 * 
 * Exemplo: dataExtenso("2024-05-17") -> "17 de maio de 2024"
 * 
 * @param string $data - Data em formato yyyy-mm-dd
 * @return string - Data em formato extenso
 */
function dataExtenso($data)
{
    // Array com nomes dos meses em português
    $meses = array(
        1 => "janeiro",
        2 => "fevereiro",
        3 => "março",
        4 => "abril",
        5 => "maio",
        6 => "junho",
        7 => "julho",
        8 => "agosto",
        9 => "setembro",
        10 => "outubro",
        11 => "novembro",
        12 => "dezembro"
    );
    
    // Converter para timestamp
    $timestamp = strtotime($data);
    
    if ($timestamp === false) {
        return "Data inválida";
    }
    
    // Extrair dia e mês
    $dia = date('d', $timestamp);
    $mes = (int) date('m', $timestamp);
    $ano = date('Y', $timestamp);
    
    // Remover zeros à esquerda do dia
    $dia = (int) $dia;
    
    // Montar string
    return $dia . " de " . $meses[$mes] . " de " . $ano;
}

// ============================================================================
// SEÇÃO 4: FUNÇÕES DE VALIDAÇÃO
// ============================================================================

/**
 * Valida se um e-mail é válido
 * 
 * Exemplo: validarEmail("usuario@email.com") -> true
 * 
 * @param string $email - E-mail a validar
 * @return bool - true se válido, false caso contrário
 */
function validarEmail($email)
{
    // filter_var() = filtra uma variável com filtros específicos
    // FILTER_VALIDATE_EMAIL = valida se é um e-mail
    
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Valida se uma URL é válida
 * 
 * Exemplo: validarUrl("https://www.google.com") -> true
 * 
 * @param string $url - URL a validar
 * @return bool - true se válida, false caso contrário
 */
function validarUrl($url)
{
    // FILTER_VALIDATE_URL = valida se é uma URL
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Valida se um número de telefone tem formato válido (apenas números)
 * 
 * Exemplo: validarTelefone("11987654321") -> true
 * 
 * @param string $telefone - Telefone a validar
 * @return bool - true se válido, false caso contrário
 */
function validarTelefone($telefone)
{
    // Remover caracteres não numéricos
    $telefoneLimpo = preg_replace('/[^0-9]/', '', $telefone);
    
    // Verificar se tem entre 10 e 11 dígitos (formato brasileiro)
    return strlen($telefoneLimpo) >= 10 && strlen($telefoneLimpo) <= 11;
}

/**
 * Valida se um valor é um número
 * 
 * Exemplo: validarNumero("123") -> true
 * Exemplo: validarNumero("123abc") -> false
 * 
 * @param mixed $valor - Valor a validar
 * @return bool - true se é número, false caso contrário
 */
function validarNumero($valor)
{
    // is_numeric() = verifica se é número (int, float ou string numérica)
    return is_numeric($valor);
}

/**
 * Valida se um string é vazia (null, vazia ou só espaços)
 * 
 * Exemplo: estaVazio("  ") -> true
 * 
 * @param mixed $valor - Valor a validar
 * @return bool - true se vazio, false caso contrário
 */
function estaVazio($valor)
{
    // empty() = verifica se variável está vazia
    return empty(trim($valor ?? ''));
}

// ============================================================================
// SEÇÃO 5: FUNÇÕES DE FORMATAÇÃO NUMÉRICA
// ============================================================================

/**
 * Formata um número como moeda brasileira
 * 
 * Exemplo: formatarMoeda(1234.56) -> "R$ 1.234,56"
 * 
 * @param float $valor - Valor a formatar
 * @param string $simbolo - Símbolo da moeda (padrão: "R$")
 * @return string - Valor formatado
 */
function formatarMoeda($valor, $simbolo = "R$")
{
    // number_format() = formata número com separadores
    // 2 = 2 casas decimais
    // ',' = separador decimal
    // '.' = separador de milhares
    
    return $simbolo . " " . number_format($valor, 2, ',', '.');
}

/**
 * Formata um número com separador de milhares
 * 
 * Exemplo: formatarNumero(1234567) -> "1.234.567"
 * 
 * @param int $numero - Número a formatar
 * @param int $decimais - Quantidade de casas decimais
 * @return string - Número formatado
 */
function formatarNumero($numero, $decimais = 0)
{
    // Usar '.' como separador de milhares
    return number_format($numero, $decimais, ',', '.');
}

/**
 * Converte bytes para formato legível (KB, MB, GB)
 * 
 * Exemplo: formatarTamanhoArquivo(1048576) -> "1.00 MB"
 * 
 * @param int $bytes - Tamanho em bytes
 * @return string - Tamanho formatado
 */
function formatarTamanhoArquivo($bytes)
{
    // Array com unidades
    $unidades = array('B', 'KB', 'MB', 'GB', 'TB');
    
    // Começar com bytes
    $tamanho = $bytes;
    $indice = 0;
    
    // Enquanto o tamanho for maior que 1024, converter para próxima unidade
    while ($tamanho >= 1024 && $indice < count($unidades) - 1) {
        $tamanho /= 1024;
        $indice++;
    }
    
    // Formatar com 2 casas decimais
    return number_format($tamanho, 2, ',', '.') . " " . $unidades[$indice];
}

// ============================================================================
// SEÇÃO 6: FUNÇÕES DE MANIPULAÇÃO DE ARRAYS
// ============================================================================

/**
 * Busca um valor em um array e retorna sua posição (chave)
 * 
 * Exemplo:
 * $frutas = array("maçã", "banana", "laranja");
 * encontrarPosicao("banana", $frutas) -> 1
 * 
 * @param mixed $valor - Valor a procurar
 * @param array $array - Array onde procurar
 * @return mixed - Chave se encontrado, false caso contrário
 */
function encontrarPosicao($valor, $array)
{
    // array_search() = procura valor em um array e retorna sua chave
    return array_search($valor, $array);
}

/**
 * Verifica se um valor existe em um array
 * 
 * Exemplo:
 * $cores = array("vermelho", "verde", "azul");
 * valorExisteNoArray("verde", $cores) -> true
 * 
 * @param mixed $valor - Valor a procurar
 * @param array $array - Array onde procurar
 * @return bool - true se existe, false caso contrário
 */
function valorExisteNoArray($valor, $array)
{
    // in_array() = verifica se um valor existe em um array
    return in_array($valor, $array);
}

/**
 * Conta quantas vezes um valor aparece em um array
 * 
 * Exemplo:
 * $numeros = array(1, 2, 2, 3, 2, 4);
 * contarOcorrencias(2, $numeros) -> 3
 * 
 * @param mixed $valor - Valor a contar
 * @param array $array - Array a procurar
 * @return int - Quantidade de ocorrências
 */
function contarOcorrencias($valor, $array)
{
    // array_count_values() = conta ocorrências de cada valor
    // Retorna um novo array com valor => quantidade
    
    $contagem = array_count_values($array);
    
    // Retornar quantidade do valor procurado, ou 0 se não existe
    return $contagem[$valor] ?? 0;
}

/**
 * Filtra um array removendo valores duplicados
 * 
 * Exemplo:
 * $numeros = array(1, 2, 2, 3, 2, 4);
 * removerDuplicatas($numeros) -> array(1, 2, 3, 4)
 * 
 * @param array $array - Array a filtrar
 * @return array - Array sem duplicatas
 */
function removerDuplicatas($array)
{
    // array_unique() = remove valores duplicados
    return array_unique($array);
}

/**
 * Inverte a ordem dos elementos em um array
 * 
 * Exemplo:
 * $numeros = array(1, 2, 3, 4);
 * inverterArray($numeros) -> array(4, 3, 2, 1)
 * 
 * @param array $array - Array a inverter
 * @return array - Array invertido
 */
function inverterArray($array)
{
    // array_reverse() = inverte ordem dos elementos
    return array_reverse($array);
}

/**
 * Ordena um array em ordem alfabética
 * 
 * Exemplo:
 * $frutas = array("banana", "maçã", "abacaxi");
 * ordenarAlfabeticamente($frutas) -> array("abacaxi", "banana", "maçã")
 * 
 * @param array $array - Array a ordenar
 * @return array - Array ordenado
 */
function ordenarAlfabeticamente($array)
{
    // sort() = ordena array em ordem ascendente
    sort($array);
    return $array;
}

/**
 * Ordena um array em ordem reversa
 * 
 * Exemplo:
 * $numeros = array(3, 1, 4, 1, 5);
 * ordenarDescendente($numeros) -> array(5, 4, 3, 1, 1)
 * 
 * @param array $array - Array a ordenar
 * @return array - Array ordenado
 */
function ordenarDescendente($array)
{
    // rsort() = ordena array em ordem descendente
    rsort($array);
    return $array;
}

/**
 * Junta elementos de um array em uma string com separador
 * 
 * Exemplo:
 * $frutas = array("maçã", "banana", "laranja");
 * juntarComSeparador($frutas, ", ") -> "maçã, banana, laranja"
 * 
 * @param array $array - Array a juntar
 * @param string $separador - Separador entre elementos
 * @return string - String com elementos unidos
 */
function juntarComSeparador($array, $separador = ", ")
{
    // implode() = junta elementos de um array em uma string
    return implode($separador, $array);
}

/**
 * Divide uma string em um array usando um separador
 * 
 * Exemplo:
 * dividirString("maçã, banana, laranja", ", ") -> array("maçã", "banana", "laranja")
 * 
 * @param string $string - String a dividir
 * @param string $separador - Separador usado
 * @return array - Array com os elementos
 */
function dividirString($string, $separador = ", ")
{
    // explode() = divide uma string em um array usando separador
    return explode($separador, $string);
}

/**
 * Extrai um intervalo de elementos de um array
 * 
 * Exemplo:
 * $numeros = array(1, 2, 3, 4, 5);
 * extrairIntervalo($numeros, 1, 3) -> array(2, 3, 4)
 * 
 * @param array $array - Array original
 * @param int $inicio - Posição inicial (começa em 0)
 * @param int $quantidade - Quantidade de elementos a extrair
 * @return array - Array com elementos extraídos
 */
function extrairIntervalo($array, $inicio, $quantidade)
{
    // array_slice() = extrai um intervalo de um array
    return array_slice($array, $inicio, $quantidade);
}

/**
 * Mistura os elementos de um array em ordem aleatória
 * 
 * Exemplo:
 * $numeros = array(1, 2, 3, 4, 5);
 * embaralharArray($numeros) -> array(3, 1, 5, 2, 4) // ordem aleatória
 * 
 * @param array $array - Array a embaralhar
 * @return array - Array embaralhado
 */
function embaralharArray($array)
{
    // shuffle() = mistura array em ordem aleatória (modifica o array original)
    shuffle($array);
    return $array;
}

/**
 * Retorna um elemento aleatório de um array
 * 
 * Exemplo:
 * $frutas = array("maçã", "banana", "laranja");
 * elementoAleatorio($frutas) -> "banana" (aleatório)
 * 
 * @param array $array - Array onde escolher
 * @return mixed - Elemento aleatório
 */
function elementoAleatorio($array)
{
    // array_rand() = retorna chave aleatória
    $chaveAleatoria = array_rand($array);
    return $array[$chaveAleatoria];
}

/**
 * Cria um array preenchido com um valor repetido
 * 
 * Exemplo:
 * arrayPreenchido(0, 5) -> array(0, 0, 0, 0, 0)
 * 
 * @param mixed $valor - Valor a repetir
 * @param int $quantidade - Quantas vezes repetir
 * @return array - Array preenchido
 */
function arrayPreenchido($valor, $quantidade)
{
    // array_fill() = cria array preenchido com um valor
    return array_fill(0, $quantidade, $valor);
}

/**
 * Combina dois arrays em um novo array
 * 
 * Exemplo:
 * $numeros = array(1, 2, 3);
 * $letras = array("a", "b", "c");
 * combinarArrays($numeros, $letras) -> array(1, 2, 3, "a", "b", "c")
 * 
 * @param array $array1 - Primeiro array
 * @param array $array2 - Segundo array
 * @return array - Array combinado
 */
function combinarArrays($array1, $array2)
{
    // array_merge() = combina dois ou mais arrays em um
    return array_merge($array1, $array2);
}

/**
 * Obtém apenas as chaves (índices) de um array
 * 
 * Exemplo:
 * $dados = array("nome" => "João", "idade" => 25);
 * obterChaves($dados) -> array("nome", "idade")
 * 
 * @param array $array - Array original
 * @return array - Array com apenas as chaves
 */
function obterChaves($array)
{
    // array_keys() = retorna todas as chaves de um array
    return array_keys($array);
}

/**
 * Obtém apenas os valores de um array
 * 
 * Exemplo:
 * $dados = array("nome" => "João", "idade" => 25);
 * obterValores($dados) -> array("João", 25)
 * 
 * @param array $array - Array original
 * @return array - Array com apenas os valores
 */
function obterValores($array)
{
    // array_values() = retorna apenas os valores de um array
    return array_values($array);
}

/**
 * Cria um array associativo (chave => valor) a partir de dois arrays
 * 
 * Exemplo:
 * $chaves = array("nome", "idade", "cidade");
 * $valores = array("João", 25, "São Paulo");
 * criarArrayAssociativo($chaves, $valores) -> 
 *   array("nome" => "João", "idade" => 25, "cidade" => "São Paulo")
 * 
 * @param array $chaves - Array com as chaves
 * @param array $valores - Array com os valores
 * @return array - Array associativo
 */
function criarArrayAssociativo($chaves, $valores)
{
    // array_combine() = cria array associativo combinando chaves e valores
    return array_combine($chaves, $valores);
}

/**
 * Encontra o maior valor em um array
 * 
 * Exemplo:
 * $numeros = array(10, 25, 5, 30, 15);
 * encontrarMaximo($numeros) -> 30
 * 
 * @param array $array - Array de números
 * @return mixed - Maior valor
 */
function encontrarMaximo($array)
{
    // max() = retorna o maior valor
    return max($array);
}

/**
 * Encontra o menor valor em um array
 * 
 * Exemplo:
 * $numeros = array(10, 25, 5, 30, 15);
 * encontrarMinimo($numeros) -> 5
 * 
 * @param array $array - Array de números
 * @return mixed - Menor valor
 */
function encontrarMinimo($array)
{
    // min() = retorna o menor valor
    return min($array);
}

/**
 * Calcula a média dos valores em um array
 * 
 * Exemplo:
 * $notas = array(7, 8, 9, 6);
 * calcularMedia($notas) -> 7.5
 * 
 * @param array $array - Array de números
 * @return float - Média dos valores
 */
function calcularMedia($array)
{
    // Se array está vazio, retornar 0
    if (empty($array)) {
        return 0;
    }
    
    // array_sum() = soma todos os valores do array
    // count() = conta quantos elementos
    $soma = array_sum($array);
    $quantidade = count($array);
    
    return $soma / $quantidade;
}

/**
 * Soma todos os valores em um array
 * 
 * Exemplo:
 * $numeros = array(10, 20, 30);
 * calcularSoma($numeros) -> 60
 * 
 * @param array $array - Array de números
 * @return mixed - Soma total
 */
function calcularSoma($array)
{
    // array_sum() = soma todos os valores
    return array_sum($array);
}

// ============================================================================
// SEÇÃO 7: EXERCÍCIOS PARA PRATICAR
// ============================================================================

/**
 * 
 * EXERCÍCIOS - Desafie seus alunos com estes exercícios!
 * 
 * ============================================================================
 * EXERCÍCIO 1: MANIPULAÇÃO DE STRINGS
 * ============================================================================
 * 
 * Crie uma função chamada "saudacao" que receba um nome e retorne uma 
 * mensagem formatada.
 * 
 * Exemplo: saudacao("maria") deve retornar "Olá, Maria! Bem-vinda!"
 * Dica: Use capitalizarPrimeira() e concatenação de strings
 * 
 * Código:
 * function saudacao($nome) {
 *     $nomeFormatado = capitalizarPrimeira($nome);
 *     return "Olá, " . $nomeFormatado . "! Bem-vindo(a)!";
 * }
 * 
 * ============================================================================
 * EXERCÍCIO 2: CRIAÇÃO DE SLUG
 * ============================================================================
 * 
 * Crie uma função "gerarUrlDeBlog" que converta um título em uma URL válida.
 * 
 * Exemplo: gerarUrlDeBlog("Meu Primeiro Artigo!!!") 
 * deve retornar "meu-primeiro-artigo"
 * 
 * Dica: Use criarSlug()
 * 
 * Código:
 * function gerarUrlDeBlog($titulo) {
 *     return criarSlug($titulo);
 * }
 * 
 * ============================================================================
 * EXERCÍCIO 3: MANIPULAÇÃO DE ARRAYS - LISTA DE COMPRAS
 * ============================================================================
 * 
 * Crie uma função "processarListaCompras" que:
 * - Receba um array de produtos
 * - Remova duplicatas
 * - Ordene alfabeticamente
 * - Retorne como string separada por vírgula
 * 
 * Exemplo: 
 * $compras = array("pão", "leite", "pão", "ovos", "leite");
 * processarListaCompras($compras) deve retornar "leite, ovos, pão"
 * 
 * Dica: Use removerDuplicatas(), ordenarAlfabeticamente(), juntarComSeparador()
 * 
 * Código:
 * function processarListaCompras($produtos) {
 *     $semDuplicatas = removerDuplicatas($produtos);
 *     $ordenado = ordenarAlfabeticamente($semDuplicatas);
 *     return juntarComSeparador($ordenado, ", ");
 * }
 * 
 * ============================================================================
 * EXERCÍCIO 4: VALIDAÇÃO DE DADOS
 * ============================================================================
 * 
 * Crie uma função "validarFormulario" que:
 * - Receba um array associativo com nome, email, telefone
 * - Valide cada campo
 * - Retorne true se TODOS são válidos, false caso contrário
 * 
 * Exemplo:
 * $dados = array(
 *     "nome" => "João Silva",
 *     "email" => "joao@email.com",
 *     "telefone" => "11987654321"
 * );
 * validarFormulario($dados) deve retornar true
 * 
 * Dica: Use validarEmail(), validarTelefone(), estaVazio()
 * 
 * Código:
 * function validarFormulario($dados) {
 *     // Verificar se nome não está vazio e tem pelo menos 3 caracteres
 *     if (estaVazio($dados["nome"]) || strlen($dados["nome"]) < 3) {
 *         return false;
 *     }
 *     
 *     // Verificar email
 *     if (!validarEmail($dados["email"])) {
 *         return false;
 *     }
 *     
 *     // Verificar telefone
 *     if (!validarTelefone($dados["telefone"])) {
 *         return false;
 *     }
 *     
 *     return true;
 * }
 * 
 * ============================================================================
 * EXERCÍCIO 5: COMBINAÇÃO DE FUNÇÕES - PERFIL DE USUÁRIO
 * ============================================================================
 * 
 * Crie uma função "formatarPerfilUsuario" que:
 * - Receba um array com dados do usuário (nome, email, data_cadastro, bio)
 * - Formate e retorne uma string bem apresentada
 * 
 * Exemplo:
 * $usuario = array(
 *     "nome" => "joão silva",
 *     "email" => "joao@email.com",
 *     "data_cadastro" => "2024-01-15",
 *     "bio" => "Desenvolvendor de sistemas"
 * );
 * 
 * Resultado esperado:
 * "João Silva - joao@...com.br - Cadastrado em 15 de janeiro de 2024 - Bio: Desenvolvendor de s..."
 * 
 * Dica: Use capitalizarPalavras(), mascararDado(), dataExtenso(), truncarTexto()
 * 
 * Código:
 * function formatarPerfilUsuario($usuario) {
 *     $nome = capitalizarPalavras($usuario["nome"]);
 *     $emailMascarado = mascararDado($usuario["email"], "email");
 *     $dataLegivel = dataExtenso($usuario["data_cadastro"]);
 *     $bioTruncada = truncarTexto($usuario["bio"], 30);
 *     
 *     return "$nome - $emailMascarado - Cadastrado em $dataLegivel - Bio: $bioTruncada";
 * }
 * 
 * ============================================================================
 * EXERCÍCIO 6: ARRAY AVANÇADO - RANKING DE NOTAS
 * ============================================================================
 * 
 * Crie uma função "gerarRankingNotas" que:
 * - Receba um array associativo com nome => nota de alunos
 * - Ordene de forma descendente (maior nota primeiro)
 * - Retorne um array com ranking (posição => nome - nota)
 * 
 * Exemplo:
 * $alunos = array(
 *     "Maria" => 9.5,
 *     "João" => 8.0,
 *     "Pedro" => 9.5,
 *     "Ana" => 7.5
 * );
 * 
 * Resultado esperado:
 * array(
 *     "1º lugar" => "Maria - 9.5",
 *     "2º lugar" => "Pedro - 9.5",
 *     "3º lugar" => "João - 8.0",
 *     "4º lugar" => "Ana - 7.5"
 * )
 * 
 * Dica: Use arsort() para ordenar arrays associativos em ordem descendente
 * 
 * Código:
 * function gerarRankingNotas($alunos) {
 *     arsort($alunos); // Ordena de forma descendente mantendo associação chave-valor
 *     $ranking = array();
 *     $posicao = 1;
 *     
 *     foreach ($alunos as $nome => $nota) {
 *         $ranking[$posicao . "º lugar"] = $nome . " - " . $nota;
 *         $posicao++;
 *     }
 *     
 *     return $ranking;
 * }
 * 
 * ============================================================================
 * EXERCÍCIO 7: DESAFIO - PROCESSAR LISTA DE CATEGORIAS
 * ============================================================================
 * 
 * Crie uma função "processarCategorias" que:
 * - Receba um array de categorias separadas por vírgula como string
 *   Exemplo: "php, web, programação, php, web"
 * - Divida a string em array
 * - Limpe espaços em branco
 * - Remova duplicatas
 * - Ordene alfabeticamente
 * - Retorne uma string formatada como "Categoria 1, Categoria 2..."
 * 
 * Resultado esperado: "Programação, Php, Web"
 * 
 * Dica: Use dividirString(), removerDuplicatas(), ordenarAlfabeticamente(), 
 *       capitalizarPalavras(), juntarComSeparador()
 * 
 * Código:
 * function processarCategorias($string) {
 *     // Dividir string em array
 *     $categorias = dividirString($string, ",");
 *     
 *     // Limpar espaços e aplicar trim em cada elemento
 *     $categorias = array_map('trim', $categorias);
 *     
 *     // Remover duplicatas
 *     $categorias = removerDuplicatas($categorias);
 *     
 *     // Ordenar alfabeticamente
 *     $categorias = ordenarAlfabeticamente($categorias);
 *     
 *     // Capitalizar cada palavra
 *     $categorias = array_map('capitalizarPalavras', $categorias);
 *     
 *     // Retornar como string
 *     return juntarComSeparador($categorias, ", ");
 * }
 * 
 * ============================================================================
 * 
 * GABARITO: As soluções estão comentadas acima!
 * 
 * Desafie seus alunos a:
 * 1. Escrever as funções sem olhar o gabarito
 * 2. Testar com diferentes valores
 * 3. Encontrar possíveis melhorias
 * 4. Adicionar validações extras
 * 
 * ============================================================================
 */

?>
