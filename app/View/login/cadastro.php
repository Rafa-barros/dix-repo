
    <nav class="nav justify-content-center">
        <a href="/" class="btn-return"><i class="fas fa-arrow-left fa-2x"></i></a>
        <p>Bem-vindo ao Dix!</p>
    </nav>
    
    <div class="cadastro">
        <div class="main-title">
          <h1>Cadastre-se</h1>
          <p>Simples, fácil e rápido</p>
        </div>
        <form method="post">
            <?php
                if(isset($_SESSION['emailInvalido']) && $_SESSION['emailInvalido'] == TRUE){
                  echo "Email inválido";
                  unset($_SESSION['emailInvalido']);
                }
                if(isset($_SESSION['existeEmail']) && $_SESSION['existeEmail'] == TRUE){
                  echo "Email já em uso";
                  unset($_SESSION['existeEmail']);
                }
                if(isset($_SESSION['existeUsuario']) && $_SESSION['existeUsuario'] == TRUE){
                  echo "Usuário já existente";
                  unset($_SESSION['existeUsuario']);
                }
              ?>
            <div class="form-row" id="pessoais">
              <div class="col-md-4 mb-3">
                  <label class="data-label" for="validationDefault03">Dados pessoais</label>
                  <?php
                    if(isset($_POST['pname'])){
                      echo '<input type="text" class="form-control" id="validationDefault01" placeholder="Nome" value="' . $_POST['pname'] . '" name="pname">';
                    }else{
                      echo '<input type="text" class="form-control" id="validationDefault01" placeholder="Nome" name="pname">';
                    }
                  ?>
                </div>
                <div class="col-md-4 mb-3 mt-2">
                  <label for="validationDefault03"></label>
                  <?php
                    if(isset($_POST['email'])){
                      echo '<input type="text" class="form-control" id="validationDefault02" placeholder="e-mail" value="' . $_POST['email'] . '" name="email" required>';
                    }else{
                      echo '<input type="text" class="form-control" id="validationDefault02" placeholder="e-mail" name="email" required>';
                    }
                  ?>
                </div>
                <div class="col-md-4 mb-3 mt-2">
                  <label for="validationDefault04"></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend2">@</span>
                    </div>
                    <?php
                      if(isset($_POST['username'])){
                        echo '<input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username" aria-describedby="inputGroupPrepend2" value="' . $_POST['username'] . '" name="username" required>';
                      }else{
                        echo '<input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username" aria-describedby="inputGroupPrepend2" name="username" required>';
                      }
                    ?>
                  </div>
                </div>
          </div>
            <?php
                if(isset($_SESSION['senhaCurta']) && $_SESSION['senhaCurta'] == TRUE){
                  echo "Senha curta";
                  unset($_SESSION['senhaCurta']);
                }
                if(isset($_SESSION['confirmFalse']) && $_SESSION['confirmFalse'] == TRUE){
                  echo "Confirmação de senha falhou";
                  unset($_SESSION['confirmFalse']);
                }
              ?>
            <div class="form-row" id="senha">
              <div class="col-md-4 mb-3">
                <label class="senha-label" for="validationDefault03">Senha</label>
                <?php
                  if(isset($_POST['pwd'])){
                    echo '<input type="password" class="form-control" id="validationDefault04" placeholder="Senha" value="' . $_POST['pwd'] . '" name="pwd" required>';
                  }else{
                    echo '<input type="password" class="form-control" id="validationDefault04" placeholder="Senha" name="pwd" required>';
                  }
                ?>
              </div>
              <div class="col-md-4 mb-3 mt-2">
                <label for="validationDefault03"></label>
                <?php
                  if(isset($_POST['confirmPwd'])){
                    echo '<input type="password" class="form-control" id="validationDefault05" placeholder="Confirmar Senha" value="' . $_POST['confirmPwd'] . '" name="confirmPwd" required>';
                  }else{
                    echo '<input type="password" class="form-control" id="validationDefault05" placeholder="Confirmar Senha" name="confirmPwd" required>';
                  }
                ?>
              </div>
            </div>
            <div class="form-row" id="nascimento">
                <div class="col-md-4 mb-3">
                    <label class="data-label" for="validationDefault03">Data de nascimento</label>
                    <?php
                      if(isset($_POST['dia'])){
                        echo '<input type="number" class="form-control" id="validationDefault06" placeholder="Dia" value="' . $_POST['dia'] . '" name="dia" min="1" max="31" required>';
                      }else{
                        echo '<input type="number" class="form-control" id="validationDefault06" placeholder="Dia" name="dia" min="1" max="31" required>';
                      }
                    ?>
                  </div>
                  <div class="col-md-4 mb-3 mt-2">
                    <label for="validationDefault03"></label>
                    <?php
                      if(isset($_POST['mes'])){
                        echo '<input type="number" class="form-control" id="validationDefault07" placeholder="Mês" value="' . $_POST['mes'] . '" name="mes" min="1" max="12" required>';
                      }else{
                        echo '<input type="number" class="form-control" id="validationDefault07" placeholder="Mês" name="mes" min="1" max="12" required>';
                      }
                    ?>
                  </div>
                  <div class="col-md-4 mb-3 mt-2">
                    <label for="validationDefault04"></label>
                    <?php
                      if(isset($_POST['ano'])){
                        echo '<input type="number" class="form-control" id="validationDefault08" placeholder="Ano" value="' . $_POST['ano'] . '" name="ano" min="1900" max="' . date("Y") . '" required>';
                      }else{
                        echo '<input type="number" class="form-control" id="validationDefault08" placeholder="Ano" name="ano" min="1900" max="' . date("Y") . '" required>';
                      }
                    ?>
                  </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <?php
                  if(isset($_POST['termos'])){
                    echo '<input class="form-check-input" type="checkbox" value="accept" id="invalidCheck2" name="termos" required checked>';
                  }else{
                    echo '<input class="form-check-input" type="checkbox" value="accept" id="invalidCheck2" name="termos" required>';
                  }
                ?>
                <label id="termos" class="form-check-label" for="invalidCheck2">
                  Li e concordo com os termos e condições de uso
                </label>
              </div>
            </div>
            <div class="submit">
              <button id="btn-cadastro" class="btn btn-success" type="submit" value="submit" name="submit">Criar conta</button>
            </div>
          </form>
    </div>
    <div class="footer">
      <div class="copyright">
        <p>© 2021 - Dix corporation</p>
      </div>
    </div>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->