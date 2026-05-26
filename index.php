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
    <title>Login de Cliente - GaluBikeShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="card">

        <div class="logo">
            LOGO
        </div>

        <?php echo $mensagem; ?>

        <form method="POST">
            <div class="form-grupo">
                <label>Email:</label>
                <input type="email" name="email">
            </div>

            <div class="form-grupo">
                <label>Senha:</label>
                <input type="password" name="senha">
            </div>

            <div class="botao-area">
                <button type="submit">Entrar</button>
            </div>
        </form>

        <div class="link">
            <a href="cadastro_cliente.php">Criar conta</a>
        </div>

    </div>
</div>

</body>
</html>