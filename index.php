<?php

require_once "conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (empty($email) || empty($senha)) {
        $mensagem = "<p class='mensagem erro'>Preencha todos os campos!</p>";
    } else {
        $sql = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente && password_verify($senha, $cliente["senha"])) {
            $mensagem = "<p class='mensagem sucesso'>Login realizado com sucesso!</p>";
        } else {
            $mensagem = "<p class='mensagem erro'>E-mail ou senha incorretos!</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>GaluBikeShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>GaluBikeShop</h1>

    <p>Loja de produtos para bicicletas.</p>

    <a href="cliente/login_cliente.php">Área do Cliente</a>

    <br><br>

    <a href="admin/login_admin.php">Área do Administrador</a>   

</body>
</html>