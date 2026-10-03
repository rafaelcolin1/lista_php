<?php
function calcularIMC($peso, $altura) {
    if ($altura <= 0) {
        return "Altura inválida.";
    }
    $imc = $peso / ($altura * $altura);
    return round($imc, 2);
}
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
function gerarSenhaAleatoria($tamanho = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=';
    $senha = '';
    for ($i = 0; $i < $tamanho; $i++) {
        $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $senha;
}
function contarVogais($texto) {
    return preg_match_all('/[aeiouAEIOU]/', $texto);
}
function inverterTexto($texto) {
    return strrev($texto);
}
function calcularIdade($dataNascimento) {
    $dataNascimento = new DateTime($dataNascimento);
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNascimento);
    return $idade->y;
}
function converterMoeda($valor, $de, $para) { 
    $taxas = [
        'USD' => 1,
        'EUR' => 0.85,
        'BRL' => 5.2
    ];
    if (!isset($taxas[$de]) || !isset($taxas[$para])) {
        return "Moeda inválida.";
    }
    $valorEmUSD = $valor / $taxas[$de];
    return round($valorEmUSD * $taxas[$para], 2);
}
function formatarTelefone($telefone) {
    $telefone = preg_replace('/\D/', '', $telefone);
    if (strlen($telefone) == 10) {
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
    } elseif (strlen($telefone) == 11) {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
    } else {
        return "Telefone inválido.";
    }
}
function gerarSaudacao() {
    $hora = (int) date('H');
    if ($hora < 12) {
        return "Bom dia!";
    } elseif ($hora < 18) {
        return "Boa tarde!";
    } else {
        return "Boa noite!";
    }
}
function validarSenhaForte($senha) {
    $temMaiuscula = preg_match('/[A-Z]/', $senha);
    $temMinuscula = preg_match('/[a-z]/', $senha);
    $temNumero = preg_match('/[0-9]/', $senha);
    $temEspecial = preg_match('/[\W]/', $senha);
    return $temMaiuscula && $temMinuscula && $temNumero && $temEspecial && strlen($senha) >= 8;
}
    ?>