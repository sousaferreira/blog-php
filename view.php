<?php
require 'conection.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "Post não encontrado!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['titulo']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="justify-content-center">
    <h1 class="text-light"><?php echo htmlspecialchars($post['titulo']); ?></h1>
    <p class="text-light">Por: <?php echo htmlspecialchars($post['autor']); ?> | <?php echo date('d/m/Y H:i', strtotime($post['data_criacao'])); ?></p>
    <p class="text-light"><?php echo nl2br(htmlspecialchars($post['conteudo'])); ?></p>

    <a href="index.php">Voltar</a>
    </div>
    </div>
</body>
</html>
