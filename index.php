<?php
require 'conection.php';

$editando = false;
$titulo = '';
$conteudo = '';
$autor = '';
$id_edit = 0;

// ====== EDITAR POST ======
if (isset($_GET['edit'])) {
    $id_edit = (int) $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id_edit]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($post) {
        $editando = true;
        $titulo = $post['titulo'];
        $conteudo = $post['conteudo'];
        $autor = $post['autor'];
    }
}

// ====== CRIAR OU ATUALIZAR POST ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo_form = $_POST['titulo'];
    $conteudo_form = $_POST['conteudo'];
    $autor_form = $_POST['autor'];

    if (!empty($_POST['id'])) {
        // Atualizar
        $stmt = $pdo->prepare("UPDATE posts SET titulo = ?, conteudo = ?, autor = ? WHERE id = ?");
        $stmt->execute([$titulo_form, $conteudo_form, $autor_form, $_POST['id']]);
    } else {
        // Criar
        $stmt = $pdo->prepare("INSERT INTO posts (titulo, conteudo, autor) VALUES (?, ?, ?)");
        $stmt->execute([$titulo_form, $conteudo_form, $autor_form]);
    }

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Blog Simples</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #121212; /* Fundo bem escuro */
            color: #f8f9fa;
        }
        .card {
            background-color: #1e1e1e; /* Card bem escuro */
            border: 1px solid #333;
        }
        .form-control, .form-control:focus {
            background-color: #2b2b2b;
            border: 1px solid #444;
            color: #f8f9fa;
        }
        .form-control::placeholder {
            color: #aaa;
        }
       
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Blog Simples</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center text-light">
                        <?php echo $editando ? 'Editar Post' : 'Criar Novo Post'; ?>
                    </h4>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $editando ? $id_edit : ''; ?>">

                        <div class="mb-3">
                            <label class="form-label">Título:</label>
                            <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($titulo); ?>" required placeholder="Digite o título">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Conteúdo:</label>
                            <textarea name="conteudo" class="form-control" rows="4" required placeholder="Digite o conteúdo"><?php echo htmlspecialchars($conteudo); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Autor:</label>
                            <input type="text" name="autor" class="form-control" value="<?php echo htmlspecialchars($autor); ?>" required placeholder="Nome do autor">
                        </div>

                        <button type="submit" class="btn btn-danger w-100 mb-2">
                            <?php echo $editando ? 'Atualizar' : 'Salvar'; ?>
                        </button>
                    </form>

                    <!-- Botão para acessar a lista de posts -->
                    <a href="post.php" class="btn btn-success w-100">Ver Todos os Posts</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
