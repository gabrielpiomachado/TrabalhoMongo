<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';

$collection = $client->Trabalho_Mongo->Estudantes;

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];
    $nome_mae = $_POST['nome_mae'];
    $nome_pai = $_POST['nome_pai'];
    
    // Campos do endereço
    $endereco = [
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'bairro' => $_POST['bairro'],
        'cidade' => $_POST['cidade'],
        'estado' => $_POST['estado'],
        'cep' => $_POST['cep']
    ];

    // Insere os dados no MongoDB
    $estudante = [
        'nome' => $nome,
        'rg' => $rg,
        'cpf' => $cpf,
        'data_nascimento' => $data_nascimento,
        'telefones' => [$telefone1, $telefone2],
        'nome_mae' => $nome_mae,
        'nome_pai' => $nome_pai,
        'endereco' => $endereco
    ];

    $insertResult = $collection->insertOne($estudante);

    if ($insertResult->getInsertedCount() > 0) {
        echo "<script>alert('Estudante cadastrado com sucesso!');</script>";
        header('Location: index.php'); // Redireciona para a listagem
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar estudante.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Estudante</title>
</head>

<body>
    <h1>Cadastrar Novo Estudante</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="rg">RG:</label><br>
        <input type="text" id="rg" name="rg" required><br><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

        <label for="telefone1">Telefone 1:</label><br>
        <input type="text" id="telefone1" name="telefone1" required><br><br>

        <label for="telefone2">Telefone 2:</label><br>
        <input type="text" id="telefone2" name="telefone2"><br><br>

        <label for="nome_mae">Nome da Mãe:</label><br>
        <input type="text" id="nome_mae" name="nome_mae" required><br><br>

        <label for="nome_pai">Nome do Pai:</label><br>
        <input type="text" id="nome_pai" name="nome_pai"><br><br>

        <h3>Endereço</h3>
        <label for="rua">Rua:</label><br>
        <input type="text" id="rua" name="rua" required><br><br>

        <label for="numero">Número:</label><br>
        <input type="text" id="numero" name="numero" required><br><br>

        <label for="bairro">Bairro:</label><br>
        <input type="text" id="bairro" name="bairro" required><br><br>

        <label for="cidade">Cidade:</label><br>
        <input type="text" id="cidade" name="cidade" required><br><br>

        <label for="estado">Estado:</label><br>
        <input type="text" id="estado" name="estado" required><br><br>

        <label for="cep">CEP:</label><br>
        <input type="text" id="cep" name="cep" required><br><br>

        <button type="submit">Cadastrar</button>
        <button><a href="../index.php">Voltar</a></button>
    </form>
</body>

</html>
