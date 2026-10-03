<?php

function analisarTexto() {
    $texto = "Brasil vai ser campeão em 2030?";
  
    $totalCaracteres = mb_strlen($texto, 'UTF-8');
    
    preg_match_all('/[a-zA-ZÀ-ÿ]+/u', $texto, $palavras);
    $totalPalavras = count($palavras[0]);
    
    preg_match_all('/[aeiouáéíóúâêîôûãõàèìòùäëïöü]/ui', $texto, $vogais);
    $totalVogais = count($vogais[0]);
    
    preg_match_all('/[bcdfghjklmnpqrstvwxyzç]/ui', $texto, $consoantes);
    $totalConsoantes = count($consoantes[0]);

    return [
        'texto' => $texto,
        'caracteres' => $totalCaracteres,
        'palavras' => $totalPalavras,
        'vogais' => $totalVogais,
        'consoantes' => $totalConsoantes
    ];
}

$resultado = analisarTexto();

echo "<strong>Texto:</strong> \"{$resultado['texto']}\"<br><br>";
echo " <strong>Análise do Texto:</strong><br>";
echo "- Caracteres: {$resultado['caracteres']}<br>";
echo "- Palavras: {$resultado['palavras']}<br>";
echo "- Vogais: {$resultado['vogais']}<br>";
echo "- Consoantes: {$resultado['consoantes']}<br>";

?>