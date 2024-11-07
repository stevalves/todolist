<?php
session_start();
require_once('conexao.php');

if (isset($_POST['create_tarefa'])) {
    $nome = trim($_POST['txtNome']);
    $descricao = trim($_POST['txtDescricao']);
    $situacao = trim($_POST['txtSituacao']);
    $dataLimite = trim($_POST['txtDataLimite']);

    $sql = "INSERT INTO todolist (nome, descricao, situacao, data_limite) VALUES('$nome', '$descricao', '$situacao', '$dataLimite')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['delete_tarefa']);
    $sql = "DELETE FROM todolist WHERE id = '$tarefaId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa com ID {$tarefaId} excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir a tarefa!";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset ($_POST['status'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['tarefa_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $sql = "UPDATE todolist SET situacao = '{$status}' WHERE id = '{$tarefaId}'";
    echo $tarefaId;

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Situação da {$tarefaId} alterada com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! atualização mal sucedida!";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['edit_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['tarefa_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $situacao = mysqli_real_escape_string($conn, $_POST['txtSituacao']);
    $dataLimite = mysqli_real_escape_string($conn, $_POST['txtDataLimite']);

    $sql = "UPDATE todolist SET nome = '{$nome}', descricao = '{$descricao}', situacao = '{$situacao}', data_limite = '{$dataLimite}' WHERE id = '{$tarefaId}'";
    echo $sql;
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Tarefa {$tarefaId} atualizado com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível atualizar a tarefa {$tarefaId}!";
        $_SESSION['type'] = 'error';
    }

    header("Location: index.php");
    exit;
}