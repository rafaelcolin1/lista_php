<?php
function formatarTexto($texto) {
    $maiusculas = strtoupper($texto);
    $minusculas = strtolower($texto);
    $titulo = ucwords(strtolower($texto));
    $quantidade = strlen($texto);

    return [
        "maiusculas" => $maiusculas,
        "minusculas" => $minusculas,
        "titulo" => $titulo,
        "quantidade" => $quantidade
    ];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"];
    $resultado = formatarTexto($texto);
    echo "<p>Texto em maiúsculas: " . $resultado["maiusculas"] . "</p>";
    echo "<p>Texto em minúsculas: " . $resultado["minusculas"] . "</p>";
    echo "<p>Texto em formato de título: " . $resultado["titulo"] . "</p>";
    echo "<p>Quantidade de caracteres: " . $resultado["quantidade"] . "</p>";
}
?>

<form method="post">
    <label for="texto">Digite um texto:</label>
    <input type="text" name="texto" id="texto" required>
    <input type="submit" value="Formatar Texto">
</form>