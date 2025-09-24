<?php
require 'conection.php';

// ====== LISTAR POSTS ======
$stmt = $pdo->query("SELECT * FROM posts ORDER BY data_criacao DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #121212;
            color: #f8f9fa;
        }
        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
        }
        .table-dark {
            background-color: #1e1e1e !important;
            color: #f8f9fa;
        }
        .table-dark thead th {
            background-color: #222 !important;
            color: #f8f9fa;
        }
        
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Posts</h1>

    <!-- Botão para voltar ao formulário -->
    <div class="mb-3 text-end">
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($posts) > 0): ?>
                            <?php foreach ($posts as $post): ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo htmlspecialchars($post['titulo']); ?></td>
                                    <td><?php echo htmlspecialchars($post['autor']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($post['data_criacao'])); ?></td>
                                    <td>
                                        <a href="view.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-info" title="Ver Post">
                                            <i class="bi bi-eye "></i>
                                        </a>
                                        <a href="index.php?edit=<?php echo $post['id']; ?>" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger"
                                           onclick="return confirm('Deseja realmente excluir este post?')" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Nenhum post encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
