<?php
require 'conexao.php';

// Consulta simples
$sql = "SELECT * FROM veiculos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Veículos Cadastrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img.thumb {
            width: 80px;
            height: auto;
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
    <h3 class="mb-3">Veículos Cadastrados</h3>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Ano</th>
                <th>Veículo</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>KM</th>
                <th>Combustível</th>
                <th>Ar Cond.</th>
                <th>Direção</th>
                <th>Foto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['ano_do_bem'] ?></td>
                        <td><?= $row['veiculo'] ?></td>
                        <td><?= $row['tipo'] ?></td>
                        <td><?= $row['modelo'] ?></td>
                        <td><?= $row['marca'] ?></td>
                        <td><?= $row['km'] ?></td>
                        <td><?= $row['combustivel'] ?></td>
                        <td><?= $row['ar_condicionado'] ?></td>
                        <td><?= $row['direcao'] ?></td>
                        <td>
                            <?php if ($row['foto']): ?>
                                <img src="uploads/<?= $row['foto'] ?>" class="thumb">
                            <?php else: ?>
                                Sem foto
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="remover.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma remoção?')">Remover</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="12">Nenhum veículo encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
