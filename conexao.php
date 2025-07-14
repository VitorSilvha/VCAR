<?php
// apenas para fazer a conexão do banco em todas as class, sem precisar ficar refazendo o codigo
// em cada class
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "Carro"; 

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
