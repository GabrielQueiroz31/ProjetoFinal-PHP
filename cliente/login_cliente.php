<?php

session_start();
require_once "../conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (empty($email) || empty($senha)) {
        $mensagem = "Preencha todos os campos!";
    } else {
        $sql = "SELECT * FROM clientes WHERE email = :email";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente && password_verify($senha, $cliente["senha"])) {
            $_SESSION["cliente_id"] = $cliente["id"];
            $_SESSION["cliente_nome"] = $cliente["nome"];

            header("Location: area_cliente.php");
            exit;
        } else {
            $mensagem = "E-mail ou senha incorretos!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Cliente - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="card">

        <div class="logo">
            <img src="../img/Logo.png" alt="logo" width="100">
        </div>

        <h1>Login de Cliente</h1>

        <p><?php echo $mensagem; ?></p>

        <form method="POST">
            <div class="form-grupo">
                <label>Email:</label>
                <input type="email" name="email">
            </div>

            <div class="form-grupo">
                <label>Senha:</label>
                <input type="password" name="senha">
            </div>

            <div class="link">
                <a href="cadastro_cliente.php">Criar conta</a>
            </div>

            <div class="botao-area">
                <button type="submit">Entrar</button>
            </div>
        </form>

        <br>

        <a href="../index.php">Voltar</a>

    </div>
</div>

</body>
</html>