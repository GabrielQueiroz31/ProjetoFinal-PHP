<?php

session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Painel do Administrador</h1>

    <p>Bem-vindo, <?php echo $_SESSION["admin_nome"]; ?>!</p>

    <ul>
        <li><a href="listar_cliente.php">Ver Clientes</a></li>
        <li><a href="listar_produto.php">Gerenciar Produtos</a></li>
        <li><a href="listar_vendas.php">Ver Vendas</a></li>
        <li><a href="logout_admin.php">Sair</a></li>
    </ul>

</body>
</html>