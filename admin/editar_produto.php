<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

$mensagem = "";

if (!isset($_GET["id"])) {
    die("ID do produto não informado.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];

    if (empty($nome) || empty($categoria) || empty($preco) || $quantidade === "") {
        $mensagem = "Preencha todos os campos!";
    } elseif ($preco <= 0) {
        $mensagem = "O preço deve ser maior que zero!";
    } elseif ($quantidade < 0) {
        $mensagem = "A quantidade não pode ser negativa!";
    } else {
        $sql = "UPDATE produtos
                SET nome = :nome,
                    categoria = :categoria,
                    preco = :preco,
                    quantidade = :quantidade
                WHERE id = :id";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":preco", $preco);
        $stmt->bindParam(":quantidade", $quantidade);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            header("Location: listar_produto.php");
            exit;
        } else {
            $mensagem = "Erro ao atualizar produto.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto - GaluBikeShop</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Editar Produto</h1>

    <p><?php echo $mensagem; ?></p>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>"><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria" value="<?php echo $produto['categoria']; ?>"><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?php echo $produto['preco']; ?>"><br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>"><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <br>

    <a href="listar_produto.php">Voltar</a>

</body>
</html>