<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

$sql = "SELECT id, nome, email, telefone FROM clientes ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Clientes - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="card tabela-card">

        <h1>Clientes cadastrados</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente["id"]; ?></td>
                        <td><?php echo $cliente["nome"]; ?></td>
                        <td><?php echo $cliente["email"]; ?></td>
                        <td><?php echo $cliente["telefone"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <br>

        <a href="painel_admin.php">Voltar para o painel</a>

    </div>
</div>

</body>
</html>