<?php
function contarCaracteres($texto) {
    return strlen($texto);
}
function contarPalavras($texto) {
    $palavras = explode(" ", trim($texto));
    return count($palavras);
}
function contarFrases($texto) {
    return substr_count($texto, ".") +
           substr_count($texto, "!") +
           substr_count($texto, "?");
}
function maiorPalavra($palavras) {
    $maior = "";
    for ($i = 0; $i < count($palavras); $i++) {
        if (strlen($palavras[$i]) > strlen($maior)) {
            $maior = $palavras[$i];
        }
    }
    return $maior;
}
function menorPalavra($palavras) {
    $menor = $palavras[0];

    for ($i = 1; $i < count($palavras); $i++) {
        if (strlen($palavras[$i]) < strlen($menor)) {
            $menor = $palavras[$i];
        }
    }
    return $menor;
}
function palavrasRepetidas($palavras) {
    $contagem = array_count_values($palavras);
    $repetidas = 0;
    for ($i = 0; $i < count($contagem); $i++) {
        if (array_values($contagem)[$i] > 1) {
            $repetidas++;
        }
    }
    return $repetidas;
}
function cincoMaisFrequentes($palavras) {
    $contagem = array_count_values($palavras);
    arsort($contagem);
    return array_slice($contagem, 0, 5, true);
}
function removerEspacos($texto) {
    return preg_replace('/\s+/', ' ', trim($texto));
}
function formatarTexto($texto) {
    return ucwords(strtolower($texto));
}
function processarTexto($texto) {

    $texto = removerEspacos($texto);
    $palavras = explode(" ", $texto);
    $resultado = array();

    $resultado["caracteres"] = contarCaracteres($texto);
    $resultado["palavras"] = contarPalavras($texto);
    $resultado["frases"] = contarFrases($texto);
    $resultado["maior"] = maiorPalavra($palavras);
    $resultado["menor"] = menorPalavra($palavras);
    $resultado["repetidas"] = palavrasRepetidas($palavras);
    $resultado["frequentes"] = cincoMaisFrequentes($palavras);
    $resultado["semEspacos"] = removerEspacos($texto);
    $resultado["formatado"] = formatarTexto($texto);

    return $resultado;
}

?>

<form method="post">
    <label>Digite o texto:</label><br>
    <textarea name="texto" rows="8" cols="60"></textarea>
    <br><br>
    <input type="submit" value="Processar Texto">
</form>
<?php

if (isset($_POST["texto"])) {
    $resultado = processarTexto($_POST["texto"]);
    echo "<h2>Resultado</h2>";
    echo "Quantidade de caracteres: ";
    echo $resultado["caracteres"];
    echo "<br>";

    echo "Quantidade de palavras: ";
    echo $resultado["palavras"];
    echo "<br>";

    echo "Quantidade de frases: ";
    echo $resultado["frases"];
    echo "<br>";

    echo "Palavra mais longa: ";
    echo $resultado["maior"];
    echo "<br>";

    echo "Palavra mais curta: ";
    echo $resultado["menor"];
    echo "<br>";

    echo "Quantidade de palavras repetidas: ";
    echo $resultado["repetidas"];
    echo "<br>";

    echo "<h3>Cinco palavras mais frequentes:</h3>";
    $frequentes = $resultado["frequentes"];
    $i = 0;
    foreach ($frequentes as $palavra => $quantidade) {
        echo $palavra . " - " . $quantidade . " vezes<br>";
        $i++;
        if ($i == 5) {
            break;
        }
    }
    echo "<br>";

    echo "Texto sem espaços duplicados:<br>";
    echo $resultado["semEspacos"];

    echo "<br><br>";

    echo "Texto formatado:<br>";
    echo $resultado["formatado"];
}

?>