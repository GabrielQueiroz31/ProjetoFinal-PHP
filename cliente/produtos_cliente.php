<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["cliente_id"])) {
    header("Location: login_cliente.php");
    exit;
}

$sql = "SELECT * FROM produtos ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Produtos Disponíveis</h1>

    <p>Bem-vindo, <?php echo $_SESSION["cliente_nome"]; ?>!</p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Midia</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo $produto["id"]; ?></td>

                    <td><?php echo $produto["nome"]; ?></td>

                    <td>
                        <?php if ($produto["id"] == 1): ?>
                            <img src="../img/bike.webp" alt="Bicicleta" width="80">

                        <?php elseif ($produto["id"] == 2): ?>
                            <img src="../img/capacete.webp" alt="Capacete" width="80">

                        <?php elseif ($produto["id"] == 3): ?>
                            <img src="../img/luva.webp" alt="Luva" width="80">

                        <?php elseif ($produto["id"] == 4): ?>
                            <img src="../img/relogio.webp" alt="Relógio" width="80">

                        <?php else: ?>
                            Sem imagem
                        <?php endif; ?>
                    </td>

                    <td><?php echo $produto["categoria"]; ?></td>

                    <td>R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?></td>

                    <td><?php echo $produto["quantidade"]; ?></td>

                    <td>
                        <?php if ($produto["quantidade"] > 0): ?>
                            <a href="comprar_produto.php?id=<?php echo $produto["id"]; ?>">Comprar</a>
                        <?php else: ?>
                            Indisponível
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <a href="area_cliente.php">Voltar</a>

</body>
</html>