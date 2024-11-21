<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title">Editar Curso</h2>
            </div>
            <div class="card-body">
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" 
                            value="<?php echo htmlspecialchars($curso['nome']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="4" required><?php echo htmlspecialchars($curso['descricao']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="duracao" class="form-label">Duração</label>
                        <input type="text" id="duracao" name="duracao" class="form-control" 
                            value="<?php echo htmlspecialchars($curso['duracao']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="professor" class="form-label">Professor</label>
                        <input type="text" id="professor" name="professor" class="form-control" 
                            value="<?php echo htmlspecialchars($curso['professor']); ?>" required>
                    </div>

                    <h5 class="mt-4">Estudantes Participantes</h5>
                    <div class="mb-3">
                        <?php foreach ($estudantes as $estudante): ?>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="estudantes[]"
                                    value="<?php echo $estudante['_id']; ?>"
                                    id="estudante-<?php echo $estudante['_id']; ?>"
                                    <?php
                                    $estudantesCurso = $curso['estudantes'] ? $curso['estudantes']->getArrayCopy() : [];
                                    echo in_array($estudante['_id'], $estudantesCurso) ? 'checked' : '';
                                    ?>>
                                <label class="form-check-label" for="estudante-<?php echo $estudante['_id']; ?>">
                                    <?php echo htmlspecialchars($estudante['nome']); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
