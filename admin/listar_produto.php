<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
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

    <h1>Produtos cadastrados</h1>

    <a href="cadastrar_produto.php">Cadastrar novo produto</a>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo $produto["id"]; ?></td>
                    <td><?php echo $produto["nome"]; ?></td>
                    <td><?php echo $produto["categoria"]; ?></td>
                    <td>R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?></td>
                    <td><?php echo $produto["quantidade"]; ?></td>
                    <td>
                        <a href="editar_produto.php?id=<?php echo $produto["id"]; ?>">Editar</a>
                        |
                        <a href="excluir_produto.php?id=<?php echo $produto["id"]; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <a href="painel_admin.php">Voltar para o painel</a>

</body>
</html>