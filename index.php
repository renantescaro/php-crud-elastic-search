<?php
    require_once 'includes.php';
    $filtro  = isset($_GET['filtro']) ? $_GET['filtro'] : 'tudo';
    $pessoas = isset($_GET['operacao']) ? Pessoa::get($_GET['txtBusca'],$_GET['filtro']) : Pessoa::get();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Catalago</title>
</head>
<body>
    <div style="padding: 30px;">
        <div style="text-align: center;">
            <h1>Listagem de Pessoas</h1>
        </div>
        <br>
        <form method="GET">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="form-check form-check-inline">
                        <input name="filtro" class="form-check-input" type="radio" id="inlineRadio1" value="tudo" <?=$filtro=='tudo'?'checked':''?>>
                        <label class="form-check-label" for="inlineRadio1">Tudo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="filtro" class="form-check-input" type="radio" id="inlineRadio2" value="nome" <?=$filtro=='nome'?'checked':''?>>
                        <label class="form-check-label" for="inlineRadio2">Nome</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="filtro" class="form-check-input" type="radio" id="inlineRadio3" value="cidade" <?=$filtro=='cidade'?'checked':''?>>
                        <label class="form-check-label" for="inlineRadio3">Cidade</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="filtro" class="form-check-input" type="radio" id="inlineRadio4" value="estado" <?=$filtro=='estado'?'checked':''?>>
                        <label class="form-check-label" for="inlineRadio4">Estado</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <input name="txtBusca" class="form-control" type="text">
                </div>
                <div class="col-md-1">
                    <button type="submit" name="operacao" value="buscar" class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-1">
                    <a href="cadastrar.php" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pessoas as $p){ ?>
                <tr>
                    <td><?=$p->_source->nome?></td>
                    <td><?=$p->_source->cidade?></td>
                    <td><?=$p->_source->estado?></td>
                    <td>
                        <a class="btn btn-warning" href='cadastrar.php/?id=<?=$p->_id?>'>Editar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>