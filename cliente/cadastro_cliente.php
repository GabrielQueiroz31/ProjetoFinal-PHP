<?php

require_once "../conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($telefone) || empty($senha)) {
        $mensagem = "<p class='mensagem erro'>Preencha todos os campos!</p>";
    } else {

        // Primeiro verifica se o e-mail já existe
        $sqlVerificar = "SELECT id FROM clientes WHERE email = :email";
        $stmtVerificar = $conexao->prepare($sqlVerificar);
        $stmtVerificar->bindParam(":email", $email);
        $stmtVerificar->execute();

        if ($stmtVerificar->rowCount() > 0) {
            $mensagem = "<p class='mensagem erro'>Este e-mail já está cadastrado!</p>";
        } else {
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO clientes (nome, email, telefone, senha)
                    VALUES (:nome, :email, :telefone, :senha)";

            $stmt = $conexao->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":senha", $senhaCriptografada);

            if ($stmt->execute()) {
                header("Location: login_cliente.php");
                exit;
            } else {
                $mensagem = "<p class='mensagem erro'>Erro ao cadastrar cliente!</p>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">
    <div class="card">

        <div class="logo"><img src="../img/Logo.png" alt="logo" width="100"></div>

        <?php echo $mensagem; ?>

        <form method="POST">
            <div class="form-grupo">
                <label>Nome:</label>
                <input type="text" name="nome">
            </div>

            <div class="form-grupo">
                <label>Email:</label>
                <input type="email" name="email">
            </div>

            <div class="form-grupo">
                <label>Telefone:</label>
                <input type="text" name="telefone">
            </div>

            <div class="form-grupo">
                <label>Senha:</label>
                <input type="password" name="senha">
            </div>

            <div class="botao-area">
                <button type="submit">Cadastrar</button>
            </div>
        </form>

        <br>

        <div class="link">
            <a href="login_cliente.php">Já tenho conta</a>
        </div>

        <br>
        <button class="botao">
            <a href="login_cliente.php">voltar</a>
        </button>

    </div>
</div>

</body>
</html>