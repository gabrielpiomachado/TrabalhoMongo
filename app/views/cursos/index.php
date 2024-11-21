<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';

use MongoDB\BSON\ObjectId;

$collection = $client->Trabalho_Mongo->Cursos;

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    if (strlen($id) == 24 && ctype_xdigit($id)) {
        $objectId = new ObjectId($id);

        $deleteResult = $collection->deleteOne(['_id' => $objectId]);

        if ($deleteResult->getDeletedCount() > 0) {
            echo "<script>alert('Curso deletado com sucesso!');</script>";
        } else {
            echo "<script>alert('Curso não encontrado para deletar.');</script>";
        }
    } else {
        echo "<script>alert('ID inválido.');</script>";
    }

    header('Location: index.php');
    exit;
}
$result = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cursos</h1>
        <a href="create.php" class="btn btn-primary mb-3">Cadastrar Novo Curso</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Professor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $curso) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($curso['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($curso['professor']) . "</td>";
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $curso['_id'] . "' class='btn btn-sm btn-warning'>Editar</a> ";
                    echo "<a href='?delete_id=" . $curso['_id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Tem certeza que deseja deletar este curso?');\">Deletar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../../../public/index.php" class="btn btn-secondary">Voltar</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
