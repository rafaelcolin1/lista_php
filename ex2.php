<?php
// Una empresa de tecnologia está desenvolvendo um sistema para tratamento de textos. 
// Crie uma função chamada inverterTexto) que receba uma string e retorne o texto
// completamente invertido. 
// Além disso, exiba a quantidade de caracteres existentes na string original.

function inverterTexto($texto){

// strrev() inverte byte a byte, o que quebra acentos e caracteres especiais 
// (em UTF-8, letras como "c" e "a" ocupan mais de 1 byte).
// Por isso separamos o texto em um array de caracteres "de verdade" com
//  preg split() usando a flag "u" (Unicode/UTF-8).

$caracteres = preg_split('//u', $texto, -1, PREG_SPLIT_NO_EMPTY);

// array reverse() inverte a ordee dos itens do array de caracteres

$caracteresInvertidos = array_reverse($caracteres);

// implode() junta o array invertido de volta en uma única string

$textoInvertido = implode('', $caracteresInvertidos);

//mb strlen() conta corretamente a quantidade de caracteres mesmo com facentos e simbolos especiais (diferente de strlen(), que conta bytes)

$quantidadeCaracteres = mb_strlen($texto);

// Como a função só pode ter um "return", devolvemos os dois valores
// Juntes dentro de um array associativo
return [
"invertido" => $textoInvertido,
"quantidade" => $quantidadeCaracteres
];

}
$texto_usuario = "Eu amo água e Café!";

echo "Texto original: $texto_usuario <br>";

$resultado = inverterTexto($texto_usuario);

echo "Texto invertido: " . $resultado["invertido"] ."<br>"; 
echo "Quantidade de caracteres: " . $resultado["quantidade"] .
"<br>";
?>