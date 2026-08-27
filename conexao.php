<?php
$host = "localhost";
$usuario = "root";
$senha = "";

// 1. Conecta primeiro ao servidor MySQL (sem especificar o banco de dados)
$conexao = new mysqli($host, $usuario, $senha);

if ($conexao->connect_error) {
    die("Erro na conexão com o servidor: " . $conexao->connect_error);
}

// 2. Cria o banco de dados 'mural_escola' se ele não existir no computador da pessoa
$conexao->query("CREATE DATABASE IF NOT EXISTS mural_escola");

// 3. Seleciona o banco de dados para uso
$conexao->select_db("mural_escola");

// 4. Cria a tabela de feedbacks automaticamente se ela não existir
$sql_tabela = "CREATE TABLE IF NOT EXISTS feedbacks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(70) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conexao->query($sql_tabela);

// 5. Configura a acentuação correta
$conexao->set_charset("utf8mb4");
?>
