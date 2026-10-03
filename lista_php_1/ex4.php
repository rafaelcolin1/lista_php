<?php
function gerarSenha($x){

    $caractere = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^';
    $tamanho = $x;
    $senha = "";

    for ($i = 0; $i < $tamanho; $i++) {
        
        $senha .= $caractere[rand(19,67)];
    }
    return $senha;
}

echo "Senha: " . gerarSenha(19);
?>