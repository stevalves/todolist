<?php
session_start();
require_once('conexao.php');

$tarefa = [];

if (!isset($_GET['id'])) {
    header('Location: index.php');
} else {
    $tarefaId = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM todolist WHERE id = '{$tarefaId}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $tarefa = mysqli_fetch_array($query);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar tarefa
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($tarefa) :
                        ?>
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="tarefa_id" value="<?=$tarefa['id']?>">
                            <div class="mb-3">
                                <label for="txtNome">Nome</label>
                                <input type="text" name="txtNome" id="txtNome" value="<?=$tarefa['nome']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="txtDescricao">Descrição</label>
                                <input type="text" name="txtDescricao" id="txtDescricao" value="<?=$tarefa['descricao']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="txtSituacao">Situação</label>
                                <select name="txtSituacao" id="txtSituacao" class="form-select">
                                    <option value="0">Incompleto</option>
                                    <option value="1">Em Andamento</option>
                                    <option value="2">Finalizado</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="txtDataLimite">Data Limite</label>
                                <input type="date" name="txtDataLimite" id="txtDataLimite" value="<?=$tarefa['data_limite']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="edit_tarefa" class="btn btn-primary float-end">Salvar</button>
                            </div>
                        </form>
                        <?php
                        else:
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Tarefa não encontrada
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>