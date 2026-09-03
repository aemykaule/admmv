<?php
$host = "localhost";
$usuario = "root";
$senha = "";


$conexao = new mysqli($host, $usuario, $senha);

if ($conexao->connect_error) {
    die("Erro na conexão com o servidor: " . $conexao->connect_error);
}


$conexao->query("CREATE DATABASE IF NOT EXISTS mural_escola");

$conexao->select_db("mural_escola");

$sql_tabela = "CREATE TABLE IF NOT EXISTS feedbacks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(70) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conexao->query($sql_tabela);


$conexao->set_charset("utf8mb4");
?>
