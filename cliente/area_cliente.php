<?php

session_start();

if (!isset($_SESSION["cliente_id"])) {
    header("Location: login_cliente.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Cliente - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Área do Cliente</h1>

    <p>Bem-vindo, <?php echo $_SESSION["cliente_nome"]; ?>!</p>

    <ul>
        <li><a href="produtos_cliente.php">Ver Produtos</a></li>
        <li><a href="minhas_compras.php">Minhas Compras</a></li>
        <a href="logout_cliente.php">Sair</a>
    </ul>

</body>
</html>