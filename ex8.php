<?php
// A função deverá transformar os nomes em um vetor, remover espaços desnecessários, ordenar em ordem alfabética e retornar a lista organizada
function ordenarNomes($nomes) {
    $nomes = array_map('trim', $nomes);
    sort($nomes);
    return $nomes;
}
?>

<form action="" method="post">
    <label for="nomes">Nomes:</label>
    <textarea id="nomes" name="nomes" rows="6" required></textarea>
    <br><br>
    <input type="submit" value="Ordenar Nomes">

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = explode("\n", $_POST['nomes']);
    $nomesOrdenados = ordenarNomes($nomes);

    echo "<p>Nomes ordenados:</p>";
    echo "<ul>";

    foreach ($nomesOrdenados as $nome) {
        echo "<li>" . htmlspecialchars($nome) . "</li>";
    }
    echo "</ul>";
}
?>