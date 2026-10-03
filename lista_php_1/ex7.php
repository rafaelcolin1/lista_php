<?php
function calcularDesconto($valor) {
    if ($valor < 100 ) {
        $desconto = 0;
    }else if ($valor >= 100 && $valor < 500) {
        $desconto = 10;
    } else if ($valor >= 500 && $valor < 1000) {
        $desconto = 15;
    } else {
        $desconto = 20;
    }
    return $desconto;
}


?>
<form action="" method="post">
    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" required>
    <br><br>

    <input type="submit" value="Calcular Desconto">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valor = $_POST['valor'];

    $desconto = calcularDesconto($valor);

    $valorDesconto = $valor * ($desconto / 100);
    $resultado = $valor - $valorDesconto;

    echo "<p>Desconto: {$desconto}%</p>";
    echo "<p>Valor do desconto: R$ " . number_format($valorDesconto, 2, ',', '.') . "</p>";
    echo "<p>Valor com desconto: R$ " . number_format($resultado, 2, ',', '.') . "</p>";
}