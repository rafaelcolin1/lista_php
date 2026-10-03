<?php
function converterTemperatura($temperatura, $unidadeOrigem, $unidadeDestino) {
    if ($unidadeOrigem === 'C' && $unidadeDestino === 'F') {
        return ($temperatura * 9/5) + 32;
    } elseif ($unidadeOrigem === 'F' && $unidadeDestino === 'C') {
        return ($temperatura - 32) * 5/9;
    } elseif ($unidadeOrigem === 'C' && $unidadeDestino === 'K') {
        return $temperatura + 273;
    } elseif ($unidadeOrigem === 'K' && $unidadeDestino === 'C') {
        return $temperatura - 273;
    } elseif ($unidadeOrigem === 'F' && $unidadeDestino === 'K') {
        return ($temperatura - 32) * 5/9 + 273;
    } elseif ($unidadeOrigem === 'K' && $unidadeDestino === 'F') {
        return ($temperatura - 273) * 9/5 + 32;
    } else {
        return "Unidades de temperatura inválidas.";
    }
}
?>
<form action="" method="post">
    <label for="temperatura">Temperatura:</label>
    <input type="number" id="temperatura" name="temperatura" step="0.01" required>
    <br><br>
    <label for="unidadeOrigem">Unidade de Origem:</label>
    <select id="unidadeOrigem" name="unidadeOrigem" required>
        <option value="C">Celsius</option>
        <option value="F">Fahrenheit</option>
        <option value="K">Kelvin</option>
    </select>
    <br><br>
    <label for="unidadeDestino">Unidade de Destino:</label>
    <select id="unidadeDestino" name="unidadeDestino" required>
        <option value="C">Celsius</option>
        <option value="F">Fahrenheit</option>
        <option value="K">Kelvin</option>
    </select>
    <br><br>
    <input type="submit" value="Converter">
</form>

<?php
echo "<h2>Resultado da Conversão:</h2>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temperatura = $_POST['temperatura'];
    $unidadeOrigem = $_POST['unidadeOrigem'];
    $unidadeDestino = $_POST['unidadeDestino'];

    $resultado = converterTemperatura($temperatura, $unidadeOrigem, $unidadeDestino);
    echo "<p>{$temperatura}°{$unidadeOrigem} é igual a {$resultado}°{$unidadeDestino}</p>";
}
?>