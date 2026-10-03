<?php

function criptografarMensagem($mensagem, $deslocamento) {
    $criptografada = "";
    for ($i = 0; $i < strlen($mensagem); $i++) {
        $char = $mensagem[$i];
        if (ctype_alpha($char)) {
            $ascii = ord($char);
            $base = (ctype_lower($char)) ? ord('a') : ord('A');
            $criptografada .= chr((($ascii - $base + $deslocamento) % 26) + $base);
        } else {
            $criptografada .= $char;
        }
    }
    return $criptografada;
}

function descriptografarMensagem($mensagem, $deslocamento) {
    return criptografarMensagem($mensagem, -$deslocamento);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = $_POST["mensagem"];
    $deslocamento = intval($_POST["deslocamento"]);
    $mensagemCriptografada = criptografarMensagem($mensagem, $deslocamento);
    $mensagemDescriptografada = descriptografarMensagem($mensagemCriptografada, $deslocamento);

    echo "<p>Mensagem original: " . htmlspecialchars($mensagem) . "</p>";
    echo "<p>Mensagem criptografada: " . htmlspecialchars($mensagemCriptografada) . "</p>";
    echo "<p>Mensagem descriptografada: " . htmlspecialchars($mensagemDescriptografada) . "</p>";
}
?>

<form method="post">
    <label for="mensagem">Digite a mensagem:</label>
    <input type="text" name="mensagem" id="mensagem" required>
    <label for="deslocamento">Digite o deslocamento (número inteiro):</label>
    <input type="number" name="deslocamento" id="deslocamento" required>
    <input type="submit" value="Criptografar e Descriptografar">
</form>