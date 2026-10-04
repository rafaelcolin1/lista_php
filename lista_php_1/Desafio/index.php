<?php require_once 'pedidos.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
</head>
<body>

<h1>Relatório do Pedido</h1>

<form method="post">
    <?php
    for ($i = 0; $i < 5; $i++) {
        $numero = $i + 1;
        echo "<p>Produto " . $numero . ": ";
        echo "<input type='text' name='nome" . $i . "' placeholder='Nome'> ";
        echo "<input type='number' name='quantidade" . $i . "' placeholder='Quantidade'> ";
        echo "<input type='number' step='0.01' name='valor" . $i . "' placeholder='Valor'>";
        echo "</p>";
    }
    ?>
    <input type="submit" name="btn_pedido" value="Processar Pedido">
</form>

<?php
if (isset($_POST['btn_pedido'])) {

    // monta o pedido so com as linhas preenchidas
    $pedido = array();
    $n = 0;
    for ($i = 0; $i < 5; $i++) {
        if ($_POST['nome' . $i] != "") {
            $pedido[$n] = array(
                "nome" => $_POST['nome' . $i],
                "quantidade" => $_POST['quantidade' . $i],
                "valor" => $_POST['valor' . $i]
            );
            $n++;
        }
    }

    if (tamanho($pedido) == 0) {
        echo "<p>Preencha pelo menos um produto.</p>";
    } else {
        $relatorio = processarPedido($pedido);

        echo "<h3>Produtos</h3>";
        echo "<table>";
        echo "<tr><th>Produto</th><th>Quantidade</th><th>Valor</th><th>Subtotal</th></tr>";
        for ($i = 0; $i < $relatorio['tipos']; $i++) {
            echo "<tr>";
            echo "<td>" . $relatorio['produtos'][$i]['nome'] . "</td>";
            echo "<td>" . $relatorio['produtos'][$i]['quantidade'] . "</td>";
            echo "<td>" . formatarMoeda($relatorio['produtos'][$i]['valor']) . "</td>";
            echo "<td>" . formatarMoeda($relatorio['produtos'][$i]['subtotal']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<h3>Resumo</h3>";
        echo "<p>Produtos diferentes: " . $relatorio['tipos'] . "</p>";
        echo "<p>Total de itens: " . $relatorio['itens'] . "</p>";
        echo "<p>Produto mais caro: " . $relatorio['maisCaro']['nome'] . "</p>";
        echo "<p>Maior subtotal: " . $relatorio['maiorSubtotal']['nome'] . "</p>";

        echo "<h3>Valores</h3>";
        echo "<p>Total: " . formatarMoeda($relatorio['total']) . "</p>";
        echo "<p>Desconto: " . formatarMoeda($relatorio['desconto']) . "</p>";
        echo "<p>Frete: " . formatarMoeda($relatorio['frete']) . "</p>";
        echo "<h2>Valor final: " . formatarMoeda($relatorio['final']) . "</h2>";
    }
}
?>

</body>
</html>