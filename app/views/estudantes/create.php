<?php
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../config/conexao.php';

$collection = $client->Trabalho_Mongo->Estudantes;

$collectionCursos = $client->Trabalho_Mongo->Cursos;

$cursos = $collectionCursos->find();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];
    $nome_mae = $_POST['nome_mae'];
    $nome_pai = $_POST['nome_pai'];
    $curso_selecionado = $_POST['curso'];
    
    $endereco = [
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'bairro' => $_POST['bairro'],
        'cidade' => $_POST['cidade'],
        'estado' => $_POST['estado'],
        'cep' => $_POST['cep']
    ];

    $estudante = [
        'nome' => $nome,
        'rg' => $rg,
        'cpf' => $cpf,
        'data_nascimento' => $data_nascimento,
        'telefones' => [$telefone1, $telefone2],
        'nome_mae' => $nome_mae,
        'nome_pai' => $nome_pai,
        'endereco' => $endereco,
        'curso' => $curso_selecionado
    ];

    $insertResult = $collection->insertOne($estudante);

    if ($insertResult->getInsertedCount() > 0) {
        echo "<script>alert('Estudante cadastrado com sucesso!');</script>";
        header('Location: index.php');
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastrar Novo Estudante</h1>
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rg" class="form-label">RG:</label>
                    <input type="text" id="rg" name="rg" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone1" class="form-label">Telefone 1:</label>
                    <input type="text" id="telefone1" name="telefone1" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone2" class="form-label">Telefone 2:</label>
                    <input type="text" id="telefone2" name="telefone2" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nome_mae" class="form-label">Nome da Mãe:</label>
                    <input type="text" id="nome_mae" name="nome_mae" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nome_pai" class="form-label">Nome do Pai:</label>
                    <input type="text" id="nome_pai" name="nome_pai" class="form-control">
                </div>
            </div>
            
            <h3 class="mb-3">Endereço</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rua" class="form-label">Rua:</label>
                    <input type="text" id="rua" name="rua" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numero" class="form-label">Número:</label>
                    <input type="text" id="numero" name="numero" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bairro" class="form-label">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cidade" class="form-label">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <input type="text" id="estado" name="estado" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cep" class="form-label">CEP:</label>
                    <input type="text" id="cep" name="cep" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="curso" class="form-label">Curso:</label>
                <select id="curso" name="curso" class="form-select" required>
                    <option value="">Selecione um curso</option>
                    <?php
                    foreach ($cursos as $curso) {
                        echo "<option value='{$curso['_id']}'>{$curso['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="../estudantes/index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
