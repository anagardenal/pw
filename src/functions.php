<?php

function somar_v1(): float{
    $resultado = 10 + 10;
    return $resultado;
}

function somar_v2():void{
    $resultado = 10 + 10;
    echo "Soma: {$resultado}";
}

function somar_v3(float $x, float $y): float{
    $resultado = $x + $y;
    return $resultado;
}

/**
 * Processa o pagamento de um pedido.
 *
 * @author João Silva <joao@empresa.com>
 * @since 2.1.0
 * 
 * @param float $valor O montante a ser cobrado.
 * @param string $moeda O código da moeda (ex: "BRL").
 * 
 * @return bool Retorna true em caso de sucesso.
 * @throws PaymentException Se o saldo for insuficiente.
 * 
 * @see PaymentGateway::execute()
 * @todo Implementar suporte para criptomoedas.
 */
function somar_v4($x, $y){
    $valores = [2,2,2,2,2,2,2,];

    $resultado =  array_sum($valores);
    return $resultado;
}