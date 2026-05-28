<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

    if (empty($nome) || empty($categoria) || empty($preco) || empty($quantidade)) {
        $mensagem = "Preencha todos os campos!";
    } elseif ($preco <= 0) {
        $mensagem = "O preço deve ser maior que zero!";
    } elseif ($quantidade < 0) {
        $mensagem = "A quantidade não pode ser negativa!";
    } else {
        $sql = "INSERT INTO produtos (nome, categoria, preco, quantidade)
                VALUES (:nome, :categoria, :preco, :quantidade)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":quantidade", $quantidade);

        if ($stmt->execute()) {
            header("Location: listar_produto.php");
            exit;
        } else {
            $mensagem = "Erro ao cadastrar produto.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Cadastrar Produto</h1>

    <p><?php echo $mensagem; ?></p>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome"><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria"><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco"><br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="quantidade"><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>

    <a href="listar_produto.php">Voltar</a>

</body>
</html>