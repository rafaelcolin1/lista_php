<?php
function calcularMedia($numeros) {
    $soma = array_sum($numeros);
    $quantidade = count($numeros);
    if ($quantidade > 0) {
        return $soma / $quantidade;
    } else {
        return 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeros = array_map('intval', explode(',', $_POST["numeros"]));
    $media = calcularMedia($numeros);
    echo "A média dos números é: $media";
}

?>
<form method="post">
    <label for="numeros">Digite números separados por vírgula:</label>
    <input type="text" name="numeros" id="numeros" required>
    <input type="submit" value="Calcular Média">