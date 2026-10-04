<?php
function contarMaiusculas($senha) {
    $contagem = 0;
    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $contagem++;
        }
    }
    return $contagem;
}

function contarMinusculas($senha) {
    $contagem = 0;
    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $contagem++;
        }
    }
    return $contagem;
}

function contarNumeros($senha) {
    $contagem = 0;
    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_digit($senha[$i])) {
            $contagem++;
        }
    }
    return $contagem;
}

function contarEspeciais($senha) {
    $contagem = 0;
    $especiais = "!@#$%^&*()-+";
    for ($i = 0; $i < strlen($senha); $i++) {
        if (strpos($especiais, $senha[$i]) !== false) {
            $contagem++;
        }
    }
    return $contagem;
}

function classificarSenha($senha) {
    $tamanho = strlen($senha);
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);

    if ($tamanho < 8) {
        return "Fraca";
    }

    if ($maiusculas > 0 && $minusculas > 0 && $numeros > 0 && $especiais > 0) {
        return "Muito Forte";
    }

    if ($maiusculas > 0 && $minusculas > 0 && $numeros > 0) {
        return "Forte";
    }

    if ($maiusculas > 0 && $minusculas > 0) {
        return "Média";
    }

    return "Fraca";
}

function analisarSenha($senha) {
    return array(
        "letras_maiusculas" => contarMaiusculas($senha),
        "letras_minusculas" => contarMinusculas($senha),
        "numeros" => contarNumeros($senha),
        "caracteres_especiais" => contarEspeciais($senha),
        "tamanho" => strlen($senha),
        "nivel_seguranca" => classificarSenha($senha)
    );
    
}
?>

<form action="" method="post">
    Digite sua senha: <input type="password" name="senha">
    <input type="submit" value="Analisar Senha">
</form>

<?php
if (isset($_POST['senha'])) {
    $senha = $_POST['senha'];
    $analise = analisarSenha($senha);

    echo "<h3>Resultado da Análise</h3>";
    echo "<p>Letras maiúsculas: " . $analise['letras_maiusculas'] . "</p>";
    echo "<p>Letras minúsculas: " . $analise['letras_minusculas'] . "</p>";
    echo "<p>Números: " . $analise['numeros'] . "</p>";
    echo "<p>Caracteres especiais: " . $analise['caracteres_especiais'] . "</p>";
    echo "<p>Tamanho da senha: " . $analise['tamanho'] . "</p>";
    echo "<p>Nível de segurança: " . $analise['nivel_seguranca'] . "</p>";
}
?>