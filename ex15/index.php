<?php require_once 'funcoes.php'; 
date_default_timezone_set('America/Sao_Paulo');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca de Funções</title>
</head>
<body>

<h1>Biblioteca de Funções</h1>
<h4><?php echo gerarSaudacao(); ?></h4>

<h3>Calcular IMC</h3>
<form method="post">
    <label for="altura">Altura (em metros):</label>
    <input type="number" step="0.01" name="altura" id="altura" required>
    <label for="peso">Peso (em kg):</label>
    <input type="number" step="0.01" name="peso" id="peso" required>
    <input type="submit" name="btn_imc" value="Calcular IMC">
</form>
<?php
if (isset($_POST['btn_imc'])) {
    $imc = calcularIMC($_POST['peso'], $_POST['altura']);
    echo "<p>Seu IMC: $imc</p>";
}
?>

<h3>Validar E-mail</h3>
<form method="post">
    <label for="email">Digite seu e-mail:</label>
    <input type="text" name="email" id="email" required>
    <input type="submit" name="btn_email" value="Validar E-mail">
</form>
<?php
if (isset($_POST['btn_email'])) {
    if (validarEmail($_POST['email'])) {
        echo "<p>E-mail válido!</p>";
    } else {
        echo "<p>E-mail inválido.</p>";
    }
}
?>

<h3>Senha Aleatória</h3>
<p>Senha gerada: <?php echo gerarSenhaAleatoria(10); ?></p>

<h3>Contar Vogais e Inverter Texto</h3>
<form method="post">
    <label for="texto">Digite um texto:</label>
    <input type="text" name="texto" id="texto" required>
    <input type="submit" name="btn_texto" value="Enviar">
</form>
<?php
if (isset($_POST['btn_texto'])) {
    $texto = $_POST['texto'];
    echo "<p>Vogais: " . contarVogais($texto) . "</p>";
    echo "<p>Texto invertido: " . inverterTexto($texto) . "</p>";
}
?>

<h3>Calcular Idade</h3>
<form method="post">
    <label for="dataNascimento">Data de nascimento:</label>
    <input type="date" name="dataNascimento" id="dataNascimento" required>
    <input type="submit" name="btn_idade" value="Calcular Idade">
</form>
<?php
if (isset($_POST['btn_idade'])) {
    $idade = calcularIdade($_POST['dataNascimento']);
    echo "<p>Você tem $idade anos.</p>";
}
?>

<h3>Converter Moeda</h3>
<form method="post">
    <label for="valor">Valor:</label>
    <input type="number" step="0.01" name="valor" id="valor" required>
    <label for="de">De (USD, EUR, BRL):</label>
    <input type="text" name="de" id="de" required>
    <label for="para">Para (USD, EUR, BRL):</label>
    <input type="text" name="para" id="para" required>
    <input type="submit" name="btn_moeda" value="Converter">
</form>
<?php
if (isset($_POST['btn_moeda'])) {
    $de = strtoupper($_POST['de']);
    $para = strtoupper($_POST['para']);
    $resultado = converterMoeda($_POST['valor'], $de, $para);
    echo "<p>Resultado: $resultado $para</p>";
}
?>

<h3>Formatar Telefone</h3>
<form method="post">
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" id="telefone" required>
    <input type="submit" name="btn_telefone" value="Formatar">
</form>
<?php
if (isset($_POST['btn_telefone'])) {
    echo "<p>Telefone formatado: " . formatarTelefone($_POST['telefone']) . "</p>";
}
?>

<h3>Validar Senha Forte</h3>
<form method="post">
    <label for="senhaForte">Digite uma senha:</label>
    <input type="password" name="senhaForte" id="senhaForte" required>
    <input type="submit" name="btn_senha" value="Validar Senha">
</form>
<?php
if (isset($_POST['btn_senha'])) {
    if (validarSenhaForte($_POST['senhaForte'])) {
        echo "<p>Senha forte!</p>";
    } else {
        echo "<p>Senha fraca. Use 8+ caracteres, maiúscula, minúscula, número e símbolo.</p>";
    }
}
?>

</body>
</html>