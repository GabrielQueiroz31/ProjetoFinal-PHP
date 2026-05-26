<?php

require_once "conexao.php";

$sql = "SELECT * FROM clientes ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Clientes - GaluBikeShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="card tabela-card">

        <h1>Clientes cadastrados</h1>

        <a href="cadastro_cliente.php" class="btn">Cadastrar novo cliente</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente["id"]; ?></td>
                        <td><?php echo $cliente["nome"]; ?></td>
                        <td><?php echo $cliente["email"]; ?></td>
                        <td><?php echo $cliente["telefone"]; ?></td>
                        <td>
                            <a href="editar_cliente.php?id=<?php echo $cliente["id"]; ?>" class="btn">Editar</a>
                            <a href="excluir_cliente.php?id=<?php echo $cliente["id"]; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>