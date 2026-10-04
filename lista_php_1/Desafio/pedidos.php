<?php
function tamanho($vetor) {
    $i = 0;
    while (isset($vetor[$i])) {
        $i++;
    }
    return $i;
}

function calcularSubtotais($produtos) {
    for ($i = 0; $i < tamanho($produtos); $i++) {
        $produtos[$i]['subtotal'] = $produtos[$i]['quantidade'] * $produtos[$i]['valor'];
    }
    return $produtos;
}

function calcularTotal($produtos) {
    $total = 0;
    for ($i = 0; $i < tamanho($produtos); $i++) {
        $total = $total + $produtos[$i]['subtotal'];
    }
    return $total;
}

function contarItens($produtos) {
    $itens = 0;
    for ($i = 0; $i < tamanho($produtos); $i++) {
        $itens = $itens + $produtos[$i]['quantidade'];
    }
    return $itens;
}

function calcularDesconto($total) {
    if ($total > 1000) {
        return $total * 0.15;
    } elseif ($total > 500) {
        return $total * 0.10;
    } else {
        return 0;
    }
}

function calcularFrete($total) {
    if ($total <= 300) {
        return 20;
    } elseif ($total <= 800) {
        return 10;
    } else {
        return 0;
    }
}

function encontrarMaior($produtos, $campo) {
    $maior = $produtos[0];
    for ($i = 1; $i < tamanho($produtos); $i++) {
        if ($produtos[$i][$campo] > $maior[$campo]) {
            $maior = $produtos[$i];
        }
    }
    return $maior;
}

function formatarMoeda($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
}

function processarPedido($produtos) {
    $produtos = calcularSubtotais($produtos);
    $total = calcularTotal($produtos);
    $desconto = calcularDesconto($total);
    $frete = calcularFrete($total);
    $final = $total - $desconto + $frete;

    $relatorio = array();
    $relatorio['produtos'] = $produtos;
    $relatorio['tipos'] = tamanho($produtos);
    $relatorio['itens'] = contarItens($produtos);
    $relatorio['maisCaro'] = encontrarMaior($produtos, 'valor');
    $relatorio['maiorSubtotal'] = encontrarMaior($produtos, 'subtotal');
    $relatorio['total'] = $total;
    $relatorio['desconto'] = $desconto;
    $relatorio['frete'] = $frete;
    $relatorio['final'] = $final;

    return $relatorio;
}