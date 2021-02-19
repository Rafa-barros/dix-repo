<div id="main" class="d-flex">
        <div class="bgimg"><a href="index.php"><img src="app/View/assets/css/img/back.svg" alt=""></a></div>
        <div id="form-container" class="container-fluid">
            <form id="login" class="pb-md-5 mb-md-3" action="login.php" method="post">
                <div class="form-group">
                    <h2>Faça login para continuar</h2>

                    <label for="exampleInputEmail1">Nome de usuário</label> 
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuário" name="who">
                  </div>
                  <div class="form-group" style="margin-bottom: 8px;">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="pass"> 
                  </div>
                  <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Manter logado</label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg btn-block" style="width: 380px;" name="login">Login</button>
            </form>
        </div>
    </div>