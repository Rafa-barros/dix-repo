
    <nav class="nav justify-content-center">
        <a href="/" class="btn-return"><i class="fas fa-arrow-left fa-2x"></i></a>
        <p>Bem-vindo ao Dix!</p>
    </nav>
    
    <div class="cadastro">
        <div class="main-title">
          <h1>Cadastre-se</h1>
          <p>Simples, fácil e rápido</p>
        </div>
        <form>
            <div class="form-row" id="pessoais">
              <div class="col-md-4 mb-3">
                  <label class="data-label" for="validationDefault03">Dados pessoais</label>
                  <input type="text" class="form-control" id="validationDefault01" placeholder="Nome" required>
                </div>
                <div class="col-md-4 mb-3 mt-2">
                  <label for="validationDefault03"></label>
                  <input type="text" class="form-control" id="validationDefault02" placeholder="e-Mail" required>
                </div>
                <div class="col-md-4 mb-3 mt-2">
                  <label for="validationDefault04"></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend2">@</span>
                    </div>
                    <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
          </div>
            <div class="form-row" id="senha">
              <div class="col-md-4 mb-3">
                <label class="senha-label" for="validationDefault03">Senha</label>
                <input type="text" class="form-control" id="validationDefault04" placeholder="Senha" required>
              </div>
              <div class="col-md-4 mb-3 mt-2">
                <label for="validationDefault03"></label>
                <input type="text" class="form-control" id="validationDefault05" placeholder="Confirmar Senha" required>
              </div>
            </div>
            <div class="form-row" id="nascimento">
                <div class="col-md-4 mb-3">
                    <label class="data-label" for="validationDefault03">Data de nascimento</label>
                    <input type="text" class="form-control" id="validationDefault06" placeholder="Dia" required>
                  </div>
                  <div class="col-md-4 mb-3 mt-2">
                    <label for="validationDefault03"></label>
                    <input type="text" class="form-control" id="validationDefault07" placeholder="Mês" required>
                  </div>
                  <div class="col-md-4 mb-3 mt-2">
                    <label for="validationDefault04"></label>
                    <input type="text" class="form-control" id="validationDefault08" placeholder="Ano" required>
                  </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label id="termos" class="form-check-label" for="invalidCheck2">
                  Li e concordo com os termos e condições de uso
                </label>
              </div>
            </div>
            <div class="submit">
              <button id="btn-cadastro" class="btn btn-success" type="submit">Criar conta</button>
            </div>
          </form>
    </div>
    <div class="footer">
      <div class="copyright">
        <p>© 2021 - Dix corporation</p>
      </div>
    </div>