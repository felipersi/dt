<html lang="en">
<head>
    <title>TRANSPORTE DE DADOS</title>

    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./view/css/style.css">

    <!-- Inclusão do jQuery-->
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
    <!-- Inclusão do Plugin jQuery Validation-->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>    <!-- Inclusão das funções do JS-->
</head>

<body>
  <div class="jumbotron">
    <div class="container">
      <h1 class="header-main-title"></h1>



<form id="form" action="./controllers/rotas.php" method="post">
 <fieldset>




  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="host_origem">Host</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">ftp://</span>
            </div>
      <input type="text" class="form-control" name="host_origem" id="host_origem" placeholder="host-origem.com/public_html">
    </div>
    </div>

    <div class="form-group col-md-6">
      <label for="">Usuario</label>
      <input type="text" class="form-control" name="usuario_origem" id="usuario_origem" placeholder="Usuario Origem">
    </div>
  </div>
  <div class="form-group">
    <label for="">Senha</label>
    <input type="text" class="form-control" name="senha_origem" id="senha_origem" placeholder="Senha Origem">
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="host_destino">Host</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">ftp://</span>
            </div>
      <input type="host_destino" class="form-control" name="host_destino" id="host_destino" placeholder="web1256.kinghost.net">
    </div>
    </div>
    <div class="form-group col-md-6">
      <label for="usuario_destino">Usuario</label>
      <input type="usuario_destino" class="form-control" name="usuario_destino" id="usuario_destino" placeholder="Usuario Destino">
    </div>

  </div>
  <div class="form-group">
    <label for="senha_destino">Senha</label>
    <input type="text" class="form-control" name="senha_destino" id="senha_destino" placeholder="Senha Destino">

  </div>
    <button type="submit" id="enviar" class="btn btn-primary">Migrar</button>
    </fieldset>
</form>


    </div>
  </div>
<div class="table-responsive-lg">
<table class="table table-striped">

    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Origem</th>
      <th scope="col">Destino</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

  <tbody>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] .'/ftp/models/classDB.php');
$conecta = new db();
$migracoes = $conecta->monta_tabela_migracoes();
?>
 </div>
</div>
  <div class="container" id="contentContainer">

    <div class="d-flex align-items-center" id="characterSpinnerSection"></div>
    <div class="d-flex align-items-center" id="comicsSpinnerSection"></div>

    <section id="characterSection"></section>

    <section id="comicSection"></section>
  </div>


  <!-- Optional JavaScript -->
  <script src="./view/js/valida.js"type="text/javascript"></script>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>
