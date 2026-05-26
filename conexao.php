<?php

$host = "localhost";
$porta = "5432";
$banco = "galubikeshop";
$usuario = "postgres";
$senha = "postgres";

try {
    $conexao = new PDO("pgsql:host=$host;port=$porta;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die("Erro na conexão: " . $erro->getMessage());
}

?>