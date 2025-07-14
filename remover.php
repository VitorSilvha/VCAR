<?php
require 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM veiculos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_veiculos.php");
} else {
    echo "Erro ao remover.";
}
?>
