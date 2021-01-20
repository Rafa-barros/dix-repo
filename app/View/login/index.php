
    <div class="main">
      <div class="container">

        <!-- Left Container -->
          <div class="l-container">
            <div class="test">
              <div id="form-container" class="container-fluid">
                <form id="login" class="pb-md-5 mb-md-3" action="login.php" method="post">
                  <div class="form-group">
                    <div class="title">
                      <h2>Entrar</h2>
                    </div>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome de usuário ou e-mail" name="who">
                  </div>
                  <div class="form-group" style="margin-bottom: 14px;">
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="pass"> 
                  </div>
                  <button type="submit" id="btn-entrar" class="btn btn-primary btn-lg btn-block"  name="login">Entrar</button>
                  <div class="esqueci-div">
                    <a class="esqueci" href="">Esqueceu a senha?</a>
                  </div>
                  <div class="new">
                    <a href="/cadastro"><div id="btn-conta" class="btn btn-success btn-lg btn-block">Cadastre-se</div></a>
                  </div>
                </form>
              </div>
  
              <div class="ou-container">
                <div class="bar"></div> <div class="ou"> OU </div> <div class="bar"></div>
              </div>
              <div class="social-medias-login">
                <a href=""><img src="/app/View/assets/css/img/facebook-icon.png" alt="ícone do facebook" class="midia-icon"></a>
                <a href=""><img src="/app/View/assets/css/img/google-icon3.png" alt="ícone google" class="midia-icon"></a>
              </div>
            </div>
          </div>

          <!-- Right Container -->
          <div class="r-container">
              <img id="logo" src="/app/View/assets/css/img/logo_original.png" alt="logo">
              <p>Bem-vindo à sua plataforma de conexões</P>
              <button class="about">Sobre</button>
          </div>
      </div>

      <div class="footer">
        <div class="copyright">
          <p>© 2021 - Dix corporation</p>
        </div>
      </div>
    
    <script>
      if(window.matchMedia("(max-width: 800px)").matches){
    $(".r-container").hide();
    } 

    </script>
