
    <nav class="nav justify-content-center">
      <a href="/" class="btn-return"><i class="fas fa-arrow-left fa-2x"></i></a>
      <img class="logo-dix" src="/app/View/assets/css/img/logo_original.png" alt="logo">
    </nav>
    <div class="center">
      <div class="card-email">
        <?php
          if(isset($_GET['id']) && isset($_GET['email'])){
            echo '<form class="form" action="/verificarconta?id=' . $_GET['id'] .'&email=' . $_GET['email'] . '&" method="get">';
          }else{
            echo '<form class="form" action="/verificarconta" method="get">';
          }
        ?>
          <div class="form-container">
            <h1>Verificar Código</h1>
            <div class="g-border"></div>
            <?php
              if(isset($_SESSION['erroVerify']) && $_SESSION['erroVerify'] == TRUE){
                echo "verificação de email falhou";
                unset($_SESSION['erroVerify']);
              }
            ?>
            <div class="form-group">
              <label for="exampleInputEmail1">Insira o código enviado em seu email para finalizar a ativação de conta</label>
              <input type="number" class="form-control" id="inputPassword" placeholder="Ex.: XXXXXX" name="codigo">
              <button type="submit" class="btn btn-primary btn-enviar" value="Enviar" >Enviar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>
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