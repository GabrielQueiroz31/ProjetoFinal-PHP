<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["cliente_id"])) {
    header("Location: login_cliente.php");
    exit;
}

$cliente_id = $_SESSION["cliente_id"];

$sql = "SELECT 
            vendas.id,
            produtos.nome AS produto,
            vendas.quantidade,
            vendas.valor_total,
            vendas.forma_pagamento,
            vendas.data_venda
        FROM vendas
        INNER JOIN produtos ON vendas.produto_id = produtos.id
        WHERE vendas.cliente_id = :cliente_id
        ORDER BY vendas.data_venda DESC";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(":cliente_id", $cliente_id);
$stmt->execute();

$compras = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Compras - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Minhas Compras</h1>

    <?php if (count($compras) > 0): ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                    <th>Pagamento</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($compras as $compra): ?>
                    <tr>
                        <td><?php echo $compra["id"]; ?></td>
                        <td><?php echo $compra["produto"]; ?></td>
                        <td><?php echo $compra["quantidade"]; ?></td>
                        <td>R$ <?php echo number_format($compra["valor_total"], 2, ",", "."); ?></td>
                        <td><?php echo $compra["forma_pagamento"]; ?></td>
                        <td><?php echo $compra["data_venda"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <p>Você ainda não realizou nenhuma compra.</p>

    <?php endif; ?>

    <br>

    <a href="area_cliente.php">Voltar</a>

</body>
</html>