
    <nav class="nav justify-content-center">
      <a href="/" class="btn-return"><i class="fas fa-arrow-left fa-2x"></i></a>
      <img class="logo-dix" src="/app/View/assets/css/img/logo_original.png" alt="logo">
    </nav>

    <?php
      if(!isset($_SESSION['inserirCodigo']) && !isset($_SESSION['newPwd'])){
        echo '<div class="center">';
        if(isset($_SESSION['emailInvalido'])){
          echo 'E-mail inválido';
          unset($_SESSION['emailInvalido']);
        }
        echo '<div class="card-email">
            <form class="form" method="post">
              <div class="form-container">
                <h1>Redefinir senha</h1>
                <div class="g-border"></div>
                <div class="form-group">
                <label for="exampleInputEmail1">Insira o seu email para iniciar a recuperação de conta</label>
                  <input type="text" class="form-control" id="inputPassword" placeholder="E-mail" name="email" required>
                  <button type="submit" class="btn btn-primary btn-enviar">Enviar</button>
                </div>
                
              </div>
            </form>
          </div>
        </div>
        </div>';
      }else if(isset($_SESSION['inserirCodigo']) && $_SESSION['inserirCodigo'] == TRUE){
        echo '<div class="center">
            <div class="card-email">';
        if(isset($_SESSION['codigoExpirado'])){
          echo 'Código de verificação expirado';
          unset($_SESSION['codigoExpirado']);
        }
        echo '<form class="form" method="get">
              <div class="form-container">
                <h1>Redefinir senha</h1>
                <div class="g-border"></div>
                <div class="form-group">
                <label for="exampleInputEmail1">Insira o Código enviado em seu e-mail</label>
                  <input type="number" class="form-control" placeholder="XXXXXX" name="codigo" required>
                  <button type="submit" class="btn btn-primary btn-enviar">Enviar</button>
                </div>
                
              </div>
            </form>
          </div>
        </div>
        </div>';
      }else if(isset($_SESSION['newPwd']) && $_SESSION['newPwd'] == TRUE){
        echo '<div class="center">';
        if(isset($_SESSION['senhaDiferente'])){
          echo 'A confirmação de senha falhou';
          unset($_SESSION['senhaDiferente']);
        }
        echo '<div class="card-email-senha">
            <form class="form" method="post">
              <div class="form-container">
                <h1>Redefinir senha</h1>
                <div class="g-border"></div>
                <div class="form-group">
                <label for="exampleInputEmail1">Tudo pronto! Escolha sua nova senha</label>
                  <input type="password" class="form-control" placeholder="Nova Senha" minlength="8" name="pwd" required>
                  <input type="password" class="form-control" placeholder="Confirmar Nova Senha" minlength="8" name="confirmPwd" required>
                  <button type="submit" class="btn btn-primary btn-enviar">Enviar</button>
                </div>
                
              </div>
            </form>
          </div>
        </div>
        </div>';
      }
    ?>

    <div class="footer">
      <div class="copyright">
        <p>© 2021 - Dix corporation</p>
      </div>
    </div>

<script>

  if(window.matchMedia("(max-width: 800px)").matches){
    $(".center").css("background-color","rgb(246, 246, 246)");
    $(".card-email").css({"background-color":"rgb(246, 246, 246)","box-shadow":"none"});
  } 

</script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->