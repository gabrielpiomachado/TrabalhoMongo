<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';

use MongoDB\BSON\ObjectId;

$collection = $client->Trabalho_Mongo->Estudantes;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (strlen($id) == 24 && ctype_xdigit($id)) {
        try {
            $objectId = new ObjectId($id);

            $deleteResult = $collection->deleteOne(['_id' => $objectId]);

            if ($deleteResult->getDeletedCount() > 0) {
                echo "<script>alert('Estudante deletado com sucesso!');</script>";
            } else {
                echo "<script>alert('Estudante não encontrado para deletar.');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Erro ao deletar o estudante: " . $e->getMessage() . "');</script>";
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
    <title>Lista de Estudantes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Estudantes</h1>
        <a href="../estudantes/create.php" class="btn btn-primary mb-3">Cadastrar Novo Estudante</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $estudantesArray = iterator_to_array($result);
                if (count($estudantesArray) < 1) {
                    echo "<tr><td colspan='2' class='text-center'>Nenhum Estudante foi encontrado!</td></tr>";
                } else {
                    foreach ($estudantesArray as $estudante) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($estudante['nome']) . "</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=" . $estudante['_id'] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                        echo "<a href='?id=" . $estudante['_id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Tem certeza que deseja deletar este estudante?');\">Deletar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="../../../public/" class="btn btn-secondary">Voltar</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
