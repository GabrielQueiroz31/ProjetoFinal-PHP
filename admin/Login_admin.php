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
        $sql = "SELECT * FROM administradores WHERE email = :email";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && $senha == $admin["senha"]) {
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_nome"] = $admin["nome"];

            header("Location: painel_admin.php");
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
    <title>Login Admin - GaluBikeShop</title>
</head>
<body>

    <h1>Login do Administrador</h1>

    <p><?php echo $mensagem; ?></p>

    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha"><br><br>

        <button type="submit">Entrar</button>

        <button class="botao">
            <a href="../index.php">Voltar</a>
        </button>
    </form>

</body>
</html>