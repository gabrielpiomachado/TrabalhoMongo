<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';

use MongoDB\BSON\ObjectId;

$collection = $client->Trabalho_Mongo->Estudantes;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (strlen($id) == 24 && ctype_xdigit($id)) {
        $objectId = new ObjectId($id);
    } else {
        echo "ID inválido.";
        exit;
    }
    $estudante = $collection->findOne(['_id' => $objectId]);
    if (!$estudante) {
        echo "Estudante não encontrado.";
        exit;
    }
} else {
    
    echo "ID do estudante não informado.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];
    $nome_mae = $_POST['nome_mae'];
    $nome_pai = $_POST['nome_pai'];

    $endereco = [
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'bairro' => $_POST['bairro'],
        'cidade' => $_POST['cidade'],
        'estado' => $_POST['estado'],
        'cep' => $_POST['cep']
    ];
    $updateResult = $collection->updateOne(
        ['_id' => $objectId],
        [
            '$set' => [
                'nome' => $nome,
                'rg' => $rg,
                'cpf' => $cpf,
                'data_nascimento' => $data_nascimento,
                'telefones' => [$telefone1, $telefone2],
                'nome_mae' => $nome_mae,
                'nome_pai' => $nome_pai,
                'endereco' => $endereco
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
    <title>Editar Estudante</title>
</head>

<body>
    <h2>Editar Estudante</h2>

    <form action="" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($estudante['nome']); ?>" required><br><br>

        <label for="rg">RG:</label><br>
        <input type="text" id="rg" name="rg" value="<?php echo htmlspecialchars($estudante['rg'] ?? ''); ?>" required><br><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($estudante['cpf'] ?? ''); ?>" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($estudante['data_nascimento'] ?? ''); ?>" required><br><br>

        <label for="telefone1">Telefone 1:</label><br>
        <input type="text" id="telefone1" name="telefone1" value="<?php echo htmlspecialchars($estudante['telefones'][0] ?? ''); ?>" required><br><br>

        <label for="telefone2">Telefone 2:</label><br>
        <input type="text" id="telefone2" name="telefone2" value="<?php echo htmlspecialchars($estudante['telefones'][1] ?? ''); ?>"><br><br>

        <label for="nome_mae">Nome da Mãe:</label><br>
        <input type="text" id="nome_mae" name="nome_mae" value="<?php echo htmlspecialchars($estudante['nome_mae'] ?? ''); ?>" required><br><br>

        <label for="nome_pai">Nome do Pai:</label><br>
        <input type="text" id="nome_pai" name="nome_pai" value="<?php echo htmlspecialchars($estudante['nome_pai'] ?? ''); ?>"><br><br>

        <h3>Endereço</h3>
        <label for="rua">Rua:</label><br>
        <input type="text" id="rua" name="rua" value="<?php echo htmlspecialchars($estudante['endereco']['rua'] ?? ''); ?>" required><br><br>

        <label for="numero">Número:</label><br>
        <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($estudante['endereco']['numero'] ?? ''); ?>" required><br><br>

        <label for="bairro">Bairro:</label><br>
        <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($estudante['endereco']['bairro'] ?? ''); ?>" required><br><br>

        <label for="cidade">Cidade:</label><br>
        <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($estudante['endereco']['cidade'] ?? ''); ?>" required><br><br>

        <label for="estado">Estado:</label><br>
        <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($estudante['endereco']['estado'] ?? ''); ?>" required><br><br>

        <label for="cep">CEP:</label><br>
        <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($estudante['endereco']['cep'] ?? ''); ?>" required><br><br>

        <button type="submit">Salvar</button>
        <button><a href="index.php">Cancelar</a></button>
    </form>
</body>

</html>
