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
</head>
<body>
    <h1>Cadastrar Curso</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br>

        <label for="duracao">Duração:</label>
        <input type="text" name="duracao" required><br>

        <label for="professor">Professor:</label>
        <input type="text" name="professor" required><br>

        <button type="submit">Salvar</button>
    </form>
    <button><a href="../cursos/index.php">Voltar</a></button>
</body>
</html>
