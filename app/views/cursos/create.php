<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';
$collection = $client->Trabalho_Mongo->Cursos;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $professor = $_POST['professor'];
    $insertResult = $collection->insertOne([
        'nome' => $nome,
        'descricao' => $descricao,
        'duracao' => $duracao,
        'professor' => $professor,
        'estudantes' => [] 
    ]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Curso</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cadastrar Curso</h1>
        <form action="" method="POST" class="border p-4 shadow rounded">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea name="descricao" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="duracao" class="form-label">Duração:</label>
                <input type="text" name="duracao" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="professor" class="form-label">Professor:</label>
                <input type="text" name="professor" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Salvar</button>
        </form>
        <div class="text-center mt-3">
            <a href="../cursos/index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>