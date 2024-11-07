<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM todolist";
$tarefas = mysqli_query($conn, $sql);
function definirSituacaoTarefa($num)
{
    if ($num == 0) {
        return "Incompleto";
    } else if ($num == 1) {
        return "Em andamento";
    } else {
        return "Finalizado";
    }
}

function definirCorPelaSituacao($num) {
    if ($num == 0) {
        return "border border-secondary";
    } else if ($num == 1) {
        return "border border-warning";
    } else {
        return "border border-success";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem - Usuários</title>
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
                            Lista de Tarefas
                            <a href="tarefa-create.php" class="btn btn-md btn-primary float-end">Adicionar Tarefa</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include 'mensagem.php'; ?>
                            <div class="container py-4">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                                    <?php foreach ($tarefas as $tarefa): ?>
                                    <div class="col">
                                        <div class="list-group-item shadow-sm rounded bg-light p-2 <?php echo definirCorPelaSituacao($tarefa['situacao']); ?>">
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="d-flex flex-column">
                                                    <h4 class="mb-1"><?php echo $tarefa['nome']; ?></h4>
                                                    <h6 class="mb-1"><?php echo definirSituacaoTarefa($tarefa['situacao']); ?></h6>
                                                </div>
                                                <small class="text-muted"><?php echo $tarefa['id']; ?></small>
                                            </div>
                                            <p class="mb-1" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?php echo $tarefa['descricao']; ?></p>
                                            <small class="text-muted"><?php echo date('d/m/Y', strtotime($tarefa['data_limite'])); ?></small>
                                            
                                            <div class="d-flex justify-content-between pt-3">
                                                <form action="acoes.php" method="POST" class="g-2">
                                                    <input type="hidden" name="tarefa_id" value="<?=$tarefa['id']?>">
                                                    <button type="submit" class="btn btn-md btn-danger" name="status" value="0" <?php if ($tarefa['situacao'] == 0) echo "disabled" ?>>
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                    <button type="submit" class="btn btn-md btn-warning" name="status" value="1" <?php if ($tarefa['situacao'] == 1) echo "disabled" ?>>
                                                        <i class="bi bi-arrow-clockwise"></i>
                                                    </button>
                                                    <button type="submit" class="btn btn-md btn-success" name="status" value="2" <?php if ($tarefa['situacao'] == 2) echo "disabled" ?>>
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                                <div class="g-2">
                                                    <a href="tarefa-edit.php?id=<?= $tarefa['id'] ?>" class="btn btn-md btn-secondary">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form action="acoes.php" method="POST" class="d-inline">
                                                        <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_tarefa" type="submit" value="<?= $tarefa['id'] ?>" class="btn btn-md btn-danger">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>