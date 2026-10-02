<?php

function mascaraCPF($CPF){
    return str_repeat ('*', strlen($CPF) -4) . substr($CPF, -4);
}

$cpf = "12345678901";
echo mascaraCPF($cpf);

?>