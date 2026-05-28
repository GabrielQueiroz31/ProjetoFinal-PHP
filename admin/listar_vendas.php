<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

$sql = "SELECT 
            vendas.id,
            clientes.nome AS cliente,
            produtos.nome AS produto,
            vendas.quantidade,
            vendas.valor_total,
            vendas.forma_pagamento,
            vendas.data_venda
        FROM vendas
        INNER JOIN clientes ON vendas.cliente_id = clientes.id
        INNER JOIN produtos ON vendas.produto_id = produtos.id
        ORDER BY vendas.data_venda DESC";

$stmt = $conexao->prepare($sql);
$stmt->execute();

$vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Vendas - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Vendas Realizadas</h1>

    <?php if (count($vendas) > 0): ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                    <th>Pagamento</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($vendas as $venda): ?>
                    <tr>
                        <td><?php echo $venda["id"]; ?></td>
                        <td><?php echo $venda["cliente"]; ?></td>
                        <td><?php echo $venda["produto"]; ?></td>
                        <td><?php echo $venda["quantidade"]; ?></td>
                        <td>R$ <?php echo number_format($venda["valor_total"], 2, ",", "."); ?></td>
                        <td><?php echo $venda["forma_pagamento"]; ?></td>
                        <td><?php echo $venda["data_venda"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <p>Nenhuma venda realizada.</p>

    <?php endif; ?>

    <br>

    <a href="painel_admin.php">Voltar para o painel</a>

</body>
</html>