<?php
require 'conexao.php';

$id = $_GET['id'];

// Consulta do veículo
$sql = "SELECT * FROM veiculos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$veiculo = $result->fetch_assoc();

// Consulta das fotos adicionais (fotos_veiculos)
$fotos = [];
$sql_fotos = "SELECT * FROM fotos_veiculos WHERE veiculo_id = ?";
$stmt_foto = $conn->prepare($sql_fotos);
$stmt_foto->bind_param("i", $id);
$stmt_foto->execute();
$result_foto = $stmt_foto->get_result();
while ($foto = $result_foto->fetch_assoc()) {
    $fotos[] = $foto;
}

if (!$veiculo) {
    die("Veículo não encontrado.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Veículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumb {
            width: 100px;
            margin: 5px;
            position: relative;
        }

        .img-thumb img {
            width: 100%;
            border: 1px solid #ccc;
        }

        .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Sistema de Veículos</span>
    </div>
</nav>

<div class="container mt-4">
    <h3>Editar Veículo</h3>

    <form action="atualizar_carro.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $veiculo['id'] ?>">

        <div class="row mb-2">
            <div class="col">
                <label>Ano</label>
                <input type="text" name="ano" class="form-control" value="<?= $veiculo['ano_do_bem'] ?>">
            </div>
            <div class="col">
                <label>Veículo</label>
                <input type="text" name="veiculo" class="form-control" value="<?= $veiculo['veiculo'] ?>">
            </div>
            <div class="col">
                <label>Tipo</label>
                <input type="text" name="tipo" class="form-control" value="<?= $veiculo['tipo'] ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <label>Modelo</label>
                <input type="text" name="modelo" class="form-control" value="<?= $veiculo['modelo'] ?>">
            </div>
            <div class="col">
                <label>Marca</label>
                <input type="text" name="marca" class="form-control" value="<?= $veiculo['marca'] ?>">
            </div>
            <div class="col">
                <label>KM</label>
                <input type="text" name="km" class="form-control" value="<?= $veiculo['km'] ?>">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <label>Combustível</label>
                <input type="text" name="combustivel" class="form-control" value="<?= $veiculo['combustivel'] ?>">
            </div>
            <div class="col">
                <label>Ar Condicionado</label>
                <input type="text" name="ar_condicionado" class="form-control" value="<?= $veiculo['ar_condicionado'] ?>">
            </div>
            <div class="col">
                <label>Direção</label>
                <input type="text" name="direcao" class="form-control" value="<?= $veiculo['direcao'] ?>">
            </div>
        </div>

        <!-- Fotos Atuais -->
        <label class="form-label">Fotos atuais</label><br>
        <div class="d-flex flex-wrap mb-3">
            <?php foreach ($fotos as $foto): ?>
                <div class="img-thumb">
                    <form action="remover_foto.php" method="POST" style="display:inline;">
                        <input type="hidden" name="foto_id" value="<?= $foto['id'] ?>">
                        <input type="hidden" name="veiculo_id" value="<?= $veiculo['id'] ?>">
                        <button type="submit" class="remove-btn">×</button>
                        <img src="uploads/<?= $foto['arquivo'] ?>" alt="">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Upload de novas fotos -->
        <label class="form-label">Adicionar novas fotos</label>
        <input type="file" name="fotos[]" multiple class="form-control mb-3">

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="listar_veiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
