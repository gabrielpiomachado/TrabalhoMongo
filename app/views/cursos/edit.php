<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';

use MongoDB\BSON\ObjectId;

$collectionCursos = $client->Trabalho_Mongo->Cursos;
$collectionEstudantes = $client->Trabalho_Mongo->Estudantes;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (strlen($id) == 24 && ctype_xdigit($id)) {
        $objectId = new ObjectId($id);
    } else {
        echo "ID inválido.";
        exit;
    }
    $curso = $collectionCursos->findOne(['_id' => $objectId]);
    if (!$curso) {
        echo "Curso não encontrado.";
        exit;
    }
} else {
    echo "ID do curso não informado.";
    exit;
}

$estudantes = $collectionEstudantes->find();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $duracao = $_POST['duracao'];
    $professor = $_POST['professor'];
    $estudantesSelecionados = isset($_POST['estudantes']) ? $_POST['estudantes'] : [];
    $updateResult = $collectionCursos->updateOne(
        ['_id' => $objectId],
        [
            '$set' => [
                'nome' => $nome,
                'descricao' => $descricao,
                'duracao' => $duracao,
                'professor' => $professor,
                'estudantes' => array_map(fn($id) => new ObjectId($id), $estudantesSelecionados)
            ]
        ]
    );

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
</head>

<body>
    <h1>Editar Curso</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($curso['nome']); ?>" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo htmlspecialchars($curso['descricao']); ?></textarea><br>

        <label for="duracao">Duração:</label>
        <input type="text" name="duracao" value="<?php echo htmlspecialchars($curso['duracao']); ?>" required><br>

        <label for="professor">Professor:</label>
        <input type="text" name="professor" value="<?php echo htmlspecialchars($curso['professor']); ?>" required><br>

        <h2>Estudantes Participantes</h2>
        <?php foreach ($estudantes as $estudante): ?>
            <div>
                <label>
                    <input
                        type="checkbox"
                        name="estudantes[]"
                        value="<?php echo $estudante['_id']; ?>"
                        <?php
                        $estudantesCurso = $curso['estudantes'] ? $curso['estudantes']->getArrayCopy() : [];
                        echo in_array($estudante['_id'], $estudantesCurso) ? 'checked' : '';
                        ?>>
                    <?php echo htmlspecialchars($estudante['nome']); ?>
                </label>
            </div>
        <?php endforeach; ?>

        <button type="submit">Salvar Alterações</button>
    </form>
    <a href="index.php">Voltar</a>
</body>

</html>