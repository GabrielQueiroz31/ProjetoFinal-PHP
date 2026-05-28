<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

$mensagem = "";

if (!isset($_GET["id"])) {
    die("ID do cliente não informado.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM clientes WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    if (empty($nome) || empty($email) || empty($telefone)) {
        $mensagem = "Preencha todos os campos!";
    } else {
        $sql = "UPDATE clientes
                SET nome = :nome,
                    email = :email,
                    telefone = :telefone
                WHERE id = :id";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            header("Location: listar_cliente.php");
            exit;
        } else {
            $mensagem = "Erro ao atualizar cliente.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - GaluBikeShop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Editar Cliente</h1>

    <p><?php echo $mensagem; ?></p>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $cliente['email']; ?>"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?php echo $cliente['telefone']; ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <br>

    <a href="listar_cliente.php">Voltar</a>

</body>
</html>