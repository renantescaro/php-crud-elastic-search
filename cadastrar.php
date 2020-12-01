<?php
    require_once 'includes.php';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if(isset($_POST['btnSalvar'])) Pessoa::salvar($_POST,$id);
    $pessoa = !empty($id) ? Pessoa::getPorId($_GET['id']) : null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Cadastrar</title>
</head>
<body>
    <div style="text-align: center;">
        <h1>Cadastrar</h1>
    </div>
    <div class="form-group" style="padding: 30px;">
        <form method="POST">
            <div class="row">
                <label>Id</label>
                <input name="id" class="form-control" value="<?=isset($_GET['id']) ? $_GET['id'] : ''?>" readonly>
            </div>
            <div class="row">
                <label>Nome</label>
                <input name="nome" class="form-control" value="<?=isset($pessoa->_source->nome) ? $pessoa->_source->nome : ''?>">
            </div>
            <div class="row">
                <label>Cidade</label>
                <input name="cidade" class="form-control" value="<?=isset($pessoa->_source->cidade) ? $pessoa->_source->cidade : ''?>">
            </div>
            <div class="row">
                <label>Formação</label>
                <input name="formação" class="form-control" value="<?=isset($pessoa->_source->formação) ? $pessoa->_source->formação : ''?>">
            </div>
            <div class="row">
                <label>Estado</label>
                <input name="estado" class="form-control" value="<?=isset($pessoa->_source->estado) ? $pessoa->_source->estado : ''?>">
            </div>
            <div class="row">
                <label>País</label>
                <input name="país" class="form-control" value="<?=isset($pessoa->_source->país) ? $pessoa->_source->país : ''?>">
            </div>
            <button type="submit" name="btnSalvar" class="btn btn-primary" value="salvar">Salvar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>