<?php
function analisarProdutos($produtos, $produtoPesquisa) {
    $maisCaro = null;
    $maisBarato = null;
    $somaPrecos = 0;
    $quantidadeProdutos = count($produtos);
    $produtoEncontrado = null;

    foreach ($produtos as $produto) {
        if ($maisCaro === null || $produto['preco'] > $maisCaro['preco']) {
            $maisCaro = $produto;
        }
        if ($maisBarato === null || $produto['preco'] < $maisBarato['preco']) {
            $maisBarato = $produto;
        }
        $somaPrecos += $produto['preco'];

        if (strcasecmp($produto['nome'], $produtoPesquisa) == 0) {
            $produtoEncontrado = $produto;
        }
    }

    $mediaPrecos = ($quantidadeProdutos > 0) ? ($somaPrecos / $quantidadeProdutos) : 0;

    return [
        "maisCaro" => $maisCaro,
        "maisBarato" => $maisBarato,
        "mediaPrecos" => $mediaPrecos,
        "produtoEncontrado" => $produtoEncontrado
    ];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produtos = [
        ["nome" => "Arroz", "preco" => 20.0],
        ["nome" => "Feijão", "preco" => 10.0],
        ["nome" => "Macarrão", "preco" => 15.0],
        ["nome" => "Açúcar", "preco" => 8.0],
        ["nome" => "Óleo", "preco" => 12.0]
    ];

    $produtoPesquisa = $_POST["produto"];
    $resultado = analisarProdutos($produtos, $produtoPesquisa);

    echo "<p>Produto mais caro: " . $resultado["maisCaro"]["nome"] . " - R$ " . number_format($resultado["maisCaro"]["preco"], 2) . "</p>";
    echo "<p>Produto mais barato: " . $resultado["maisBarato"]["nome"] . " - R$ " . number_format($resultado["maisBarato"]["preco"], 2) . "</p>";
    echo "<p>Média dos preços: R$ " . number_format($resultado["mediaPrecos"], 2) . "</p>";

    if ($resultado["produtoEncontrado"]) {
        echo "<p>Produto encontrado: " . $resultado["produtoEncontrado"]["nome"] . " - R$ " . number_format($resultado["produtoEncontrado"]["preco"], 2) . "</p>";
    } else {
        echo "<p>Produto não encontrado.</p>";
    }
}
?>
<h1>Produtos: </h1>
<p>Arroz</p>
<p>Feijão</p>
<p>Macarrão</p>
<p>Açúcar</p>
<p>Óleo</p>
<form method="post">
    <label for="produto">Digite o nome do produto para pesquisa:</label>
    <input type="text" name="produto" id="produto" required>
    <input type="submit" value="Analisar Produtos">
</form>