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

    // Redireciona para a listagem após a tentativa de deleção
    header('Location: index.php');
    exit;
}

// Busca todos os estudantes para exibição
$result = $collection->find();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudantes</title>
</head>

<body>
    <h1>Estudantes</h1>
    <p>Estudantes Cadastrados:</p>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $estudantesArray = iterator_to_array($result);
            if (count($estudantesArray) < 1) {
                echo "<tr><td colspan='2'>Nenhum Estudante foi encontrado!</td></tr>";
            } else {
                foreach ($estudantesArray as $estudante) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($estudante['nome']) . "</td>";
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $estudante['_id'] . "'><button>Editar</button></a> ";
                    echo "<a href='?id=" . $estudante['_id'] . "' onclick=\"return confirm('Tem certeza que deseja deletar este estudante?');\"><button>Deletar</button></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <br>
    <button><a href="../estudantes/create.php">Cadastrar Novo Estudante</a></button>
    <button><a href="../../../public/">Voltar</a></button>

</body>

</html>
