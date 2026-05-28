<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["cliente_id"])) {
    header("Location: login_cliente.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("ID do produto não informado.");
}

$cliente_id = $_SESSION["cliente_id"];
$produto_id = $_GET["id"];
$mensagem = "";

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id", $produto_id);
$stmt->execute();

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantidade = $_POST["quantidade"];
    $forma_pagamento = $_POST["pagamento"];

    if (empty($quantidade) || $quantidade <= 0) {
        $mensagem = "Informe uma quantidade válida.";
    } elseif ($quantidade > $produto["quantidade"]) {
        $mensagem = "Quantidade maior que o estoque disponível.";
    } else {
        $valor_total = $produto["preco"] * $quantidade;

        $sqlVenda = "INSERT INTO vendas 
                    (cliente_id, produto_id, quantidade, valor_total, forma_pagamento)
                    VALUES 
                    (:cliente_id, :produto_id, :quantidade, :valor_total, :forma_pagamento)";

        $stmtVenda = $conexao->prepare($sqlVenda);

        $stmtVenda->bindParam(":cliente_id", $cliente_id);
        $stmtVenda->bindParam(":produto_id", $produto_id);
        $stmtVenda->bindParam(":quantidade", $quantidade);
        $stmtVenda->bindParam(":valor_total", $valor_total);
        $stmtVenda->bindParam(":forma_pagamento", $forma_pagamento);

        if ($stmtVenda->execute()) {
            $sqlEstoque = "UPDATE produtos
                           SET quantidade = quantidade - :quantidade
                           WHERE id = :produto_id";

            $stmtEstoque = $conexao->prepare($sqlEstoque);

            $stmtEstoque->bindParam(":quantidade", $quantidade);
            $stmtEstoque->bindParam(":produto_id", $produto_id);

            $stmtEstoque->execute();

            header("Location: minhas_compras.php");
            exit;
        } else {
            $mensagem = "Erro ao registrar compra.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comprar Produto - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Confirmar Compra</h1>

    <p><?php echo $mensagem; ?></p>

    <h2><?php echo $produto["nome"]; ?></h2>

    <p>Categoria: <?php echo $produto["categoria"]; ?></p>
    <p>Preço unitário: R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?></p>
    <p>Estoque disponível: <?php echo $produto["quantidade"]; ?></p>

    <form method="POST">
        <label>Quantidade:</label><br>
        <input 
            type="number" 
            name="quantidade" 
            min="1" 
            max="<?php echo $produto["quantidade"]; ?>" 
            value="1"
        ><br><br>

        <label>Forma de pagamento:</label><br>
        <select name="pagamento">
            <option value="PIX">PIX</option>
            <option value="Cartão">Cartão</option>
            <option value="Dinheiro">Dinheiro</option>
        </select>

        <br><br>

        <button type="submit">Confirmar Compra</button>
    </form>

    <br>

    <a href="produtos_cliente.php">Voltar</a>

</body>
</html>