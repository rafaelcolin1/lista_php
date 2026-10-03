<?php
    
function Parimpar($numero) {
    if ($numero % 2 == 0) {
        return "O número $numero é par.";
    } else {
        return "O número $numero é ímpar.";
    }
}

function primo($numero) {
    if ($numero <= 1) {
        return "O número $numero não é primo.";
    }
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return "O número $numero não é primo.";
        }
    }
    return "O número $numero é primo.";
}

function perfeito($numero) {
    $soma = 0;
    for ($i = 1; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            $soma += $i;
        }
    }
    if ($soma == $numero) {
        return "O número $numero é perfeito.";
    } else {
        return "O número $numero não é perfeito.";
    }
}

?>

<form method="post">
    <label for="numero">Digite um número:</label>
    <input type="number" name="numero" id="numero" required>
    <input type="submit" value="Verificar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = intval($_POST["numero"]);
    
    echo Parimpar($numero) . "<br>";
    echo primo($numero) . "<br>";
    echo perfeito($numero) . "<br>";
}
?>