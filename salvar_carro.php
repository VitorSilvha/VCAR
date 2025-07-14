<?php
require 'conexao.php';

// Recebe os dados do formulário
$ano = $_POST['ano'];
$veiculo = $_POST['veiculo'];
$tipo = $_POST['tipo'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$km = $_POST['km'];
$combustivel = $_POST['combustivel'];
$ar_condicionado = $_POST['ar_condicionado'];
$direcao = $_POST['direcao'];

// Upload da foto principal
$foto = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = uniqid() . "." . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
}

// Inserir no banco
$sql = "INSERT INTO veiculos (ano_do_bem, veiculo, tipo, modelo, marca, km, combustivel, ar_condicionado, direcao, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssssss", $ano, $veiculo, $tipo, $modelo, $marca, $km, $combustivel, $ar_condicionado, $direcao, $foto);

if ($stmt->execute()) {
    header("Location: listar_veiculos.php");
    exit;
} else {
    echo "Erro ao salvar veículo: " . $stmt->error;
}
?>
