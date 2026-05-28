<?php

session_start();
require_once "../conexao.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: login_admin.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("ID do cliente não informado.");
}

$id = $_GET["id"];

$sql = "DELETE FROM clientes WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    header("Location: listar_clientes.php");
    exit;
} else {
    echo "Erro ao excluir cliente.";
}

?>