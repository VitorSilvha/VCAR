<?php
require 'conexao.php'; 

$id = $_POST['id'];
$ano = $_POST['ano'];
$veiculo = $_POST['veiculo'];
$tipo = $_POST['tipo'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$km = $_POST['km'];
$combustivel = $_POST['combustivel'];
$ar_condicionado = $_POST['ar_condicionado'];
$direcao = $_POST['direcao'];

// Atualiza os dados do veículo
$sql = "UPDATE veiculos SET ano_do_bem=?, veiculo=?, tipo=?, modelo=?, marca=?, km=?, combustivel=?, ar_condicionado=?, direcao=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssssi", $ano, $veiculo, $tipo, $modelo, $marca, $km, $combustivel, $ar_condicionado, $direcao, $id);
$stmt->execute();

// Processar upload de múltiplas fotos
if (isset($_FILES['fotos'])) {
    $totalFotos = count($_FILES['fotos']['name']);
    
    for ($i = 0; $i < $totalFotos; $i++) {
        $nomeTmp = $_FILES['fotos']['tmp_name'][$i];
        $nomeOriginal = $_FILES['fotos']['name'][$i];
        
        if ($nomeTmp) {
            // Gerar nome único para evitar conflito
            $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
            $novoNome = uniqid() . '.' . $extensao;
            $destino = 'uploads/' . $novoNome;
            
            if (move_uploaded_file($nomeTmp, $destino)) {
                // Inserir no banco fotos_veiculos
                $sqlFoto = "INSERT INTO fotos_veiculos (veiculo_id, arquivo) VALUES (?, ?)";
                $stmtFoto = $conn->prepare($sqlFoto);
                $stmtFoto->bind_param("is", $id, $novoNome);
                $stmtFoto->execute();
            }
        }
    }
}

header('Location: listar_veiculos.php');
exit;
