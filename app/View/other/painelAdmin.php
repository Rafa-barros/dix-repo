
    <nav class="nav justify-content-center">
      <a href="/" class="btn-return"><i class="fas fa-arrow-left fa-2x"></i></a>
      <img class="logo-dix" src="/app/View/assets/css/img/logo_original.png" alt="logo">
    </nav>

    <h1 class ="page-title">Painel de administração</h1>

    <session>
      <div class="config-container">
        <h2 class="config-title">Configurações do PagSeguro</h2>
      </div>

      <div class="form-config">
        <form method="post">
          <div class="form-group">
            <label class="config-label" for="formGroupExampleInput">Id</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="id" placeholder="Insira o id">
          </div>
          <div class="form-group">
            <label class="config-label" for="formGroupExampleInput2">Chave</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="key" placeholder="Insira a chave">
          </div>
          <div class="form-group">
            <label class="config-label" for="formGroupExampleInput">E-mail</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="email" placeholder="Insira o E-mail">
          </div>
          <div class="form-group">
            <label class="config-label" for="formGroupExampleInput2">Token</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="token" placeholder="Insira o Token">
          </div>
          <div class="form-group">
            <label class="config-label" for="formGroupExampleInput">Porcentagem por cada transação</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="porcentagem" placeholder="% por transação">
          </div>
          <button type="submit" class="btn btn-success btn-lg btn-block btn-config">Enviar</button>
        </form>
        <div class="buttons d-flex">
          <a href="http://162.214.189.150:2086/cpsess0395353610/3rdparty/phpMyAdmin/index.php"><button type="button" class="btn btn-primary btn-lg btn-3"> Banco de dados</button></a>
          <a href="#table"><button type="button" class="btn btn-primary btn-lg btn-3"> Base de dados</button></a>
          <a href="https://registro.br/"><button type="button" class="btn btn-primary btn-lg btn-3"> Domínio</button></a>
        </div>
      </div>
    </session>

    <session>

      <div class="config-container" id="bd-title">
        <h2 class="table-title">Base de dados</h2>
      </div>

      <div class="table-container" id="table">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">PIX</th>
              <th scope="col">Conta</th>
              <th scope="col">Agência</th>
              <th scope="col">Número do banco</th>
              <th scope="col">CPF</th>
              <th scope="col">Ganho</th>
              <th scope="col">Pago</th>
            </tr>
          </thead>
          <tbody>
          <?php for($k=0; $k<$admin->tam; $k++){ ?>
            <tr>
              <th scope="row"><?php echo($admin->influencers[$k]['id']); ?></th>
              <td><?php echo($admin->influencers[$k]['pix']); ?></td>
              <td><?php echo($admin->influencers[$k]['conta']); ?></td>
              <td><?php echo($admin->influencers[$k]['agencia']); ?></td>
              <td><?php echo($admin->influencers[$k]['nBanco']); ?></td>
              <td><?php echo($admin->influencers[$k]['cpf']); ?></td>
              <td><?php echo($admin->influencers[$k]['ganhos']); ?></td>
              <td><button type="button" class="btn btn-info btn-pagar" id="<?php echo($admin->influencers[$k]['id']); ?>"> pagar </button></td>
            </tr>
            <?php }?>
            
          </tbody>
        </table>
      </div>

    </session>

    <script src="app/View/assets/js/admin.js"></script>