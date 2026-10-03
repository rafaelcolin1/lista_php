<?php

function estatisticasNumericas($numeros) {
    $soma = array_sum($numeros);
    $media = $soma / count($numeros);
    $maior = max($numeros);
    $menor = min($numeros);
    
    sort($numeros);
    $tamanho = count($numeros);
    if ($tamanho % 2 == 0) {
        $mediana = ($numeros[$tamanho / 2 - 1] + $numeros[$tamanho / 2]) / 2;
    } else {
        $mediana = $numeros[floor($tamanho / 2)];
    }


    $pares = 0;
    $ímpares = 0;
    foreach ($numeros as $numero) {
        if ($numero % 2 == 0) {
            $pares++;
        } else {
            $ímpares++;
        }
    }

    return [
        "soma" => $soma,
        "media" => $media,
        "maior" => $maior,
        "menor" => $menor,
        "mediana" => $mediana,
        "pares" => $pares,
        "ímpares" => $ímpares
    ];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeros = array_map('intval', explode(',', $_POST["numeros"]));
    $resultado = estatisticasNumericas($numeros);
    
    echo "<p>Soma: " . $resultado["soma"] . "</p>";
    echo "<p>Média: " . $resultado["media"] . "</p>";
    echo "<p>Maior valor: " . $resultado["maior"] . "</p>";
    echo "<p>Menor valor: " . $resultado["menor"] . "</p>";
    echo "<p>Mediana: " . $resultado["mediana"] . "</p>";
    echo "<p>Quantidade de números pares: " . $resultado["pares"] . "</p>";
    echo "<p>Quantidade de números ímpares: " . $resultado["ímpares"] . "</p>";
}
?>

<form method="post">
    <label for="numeros">Digite números separados por vírgula:</label>
    <input type="text" name="numeros" id="numeros" required>
    <input type="submit" value="Calcular Estatísticas">
</form>