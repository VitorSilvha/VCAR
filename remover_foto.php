<?php
require 'conexao.php';

$foto_id = $_POST['foto_id'];
$veiculo_id = $_POST['veiculo_id'];

// Buscar o arquivo para remover da pasta
$sql = "SELECT arquivo FROM fotos_veiculos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $foto_id);
$stmt->execute();
$result = $stmt->get_result();
$foto = $result->fetch_assoc();

if ($foto) {
    $caminho = "uploads/" . $foto['arquivo'];
    if (file_exists($caminho)) {
        unlink($caminho);
    }
}

// Remover do banco
$stmt = $conn->prepare("DELETE FROM fotos_veiculos WHERE id = ?");
$stmt->bind_param("i", $foto_id);
$stmt->execute();

header("Location: editar.php?id=" . $veiculo_id);
