
    <nav class="nav">
        <a class="a-logo-dix" href="/feed"><img class="logo-dix" src="/app/View/assets/css/img/logo_blue.png" alt="logo"></a> 
        <div class="features-containers">
            <a href=""><i class="fas fa-user"></i></a>
            <a href="/feed"><i class="fas fa-home"></i></a> 
            <a href="/chat" class="i-c"><i class="fas fa-comments"></i></a>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-secondary dropdown-toggle btn-notificacao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-danger ml-2">0</span>
                </button>
                <div class="dropdown-menu not-pop">
                    <a class="dropdown-item waves-effect waves-light notificacao" href="#"> Você não tem nenhuma notificação</a>
                </div>
            </div>
        </div>
    </nav>


    <form method="post">

        <div class="pagamento-container">
            <h1 class="titulo-area">Dados do Usuário</h1>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default" placeholder="João da Silva">Nome do titular</span>
                </div>
                <input type="text" class="form-control" id="nomeTitular" name="nomeTitular" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nascimento</span>
                </div>
                <input type="text" class="form-control" id="nascimento" name="nascimento" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="DD/MM/AAAA" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">CPF do Titular</span>
                </div>
                <input type="text" class="form-control" id="cpfTitular" name="cpfTitular" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="XXXXXXXXXXX" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">DDD do telefone</span>
                </div>
                <input type="text" class="form-control" id="dddTel" name="dddTel" placeholder="XX" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nº de telefone</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" id="numeroTelefone" name="numeroTelefone" placeholder="XXXXXXXXX" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                </div>
                <input type="text" class="form-control" id="email" name="email" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Joao@exemplo.com" required>
            </div>
            
    
            <h2 class="titulo-area" >Dados do Cartão</h2>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Nº do Cartão</span>
                </div>
                <input type="text" class="form-control" id="nCartao" name="nCartao" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">CVV</span>
                </div>
                <input type="text" class="form-control" id="cvv" name="cvv" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
    
            <h6 class="mt-3">Validade do cartão</h6>
            <div class="input-group mb-3">
                <div class="d-flex">
    
                </div>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Mês</span>
                </div>
                <input type="text" class="form-control" id="monthVal" name="monthVal" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="MM" required>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Ano</span>
                </div>
                <input type="text" class="form-control" id="yearVal" name="yearVal" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="AAAA" required>
            </div>
    
            <h2 class="titulo-area" >Endereço de Cobrança</h2>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Rua</span>
                </div>
                <input type="text" class="form-control" id="rua" name="rua" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Número do Local</span>
                </div>
                <input type="text" class="form-control" id="nLocal" name="nLocal" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">CEP</span>
                </div>
                <input type="text" class="form-control" id="complemento" name="cep" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="XXXXXXXX" required>
            </div>
    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Bairro</span>
                </div>
                <input type="text" class="form-control" id="bairro" name="bairro" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Cidade</span>
                </div>
                <input type="text" class="form-control" id="cidade" name="cidade" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
            </div>
    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Estado UF</span>
                </div>
                <input type="text" class="form-control" id="estado" name="estado" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Ex.: SP" required>
            </div>
            <div class="form-check salvar-cartao">
                <input class="form-check-input" type="checkbox" id="defaultCheck1" name="salvarCartao" value="sim" >
                <label class="form-check-label" for="defaultCheck1">
                    Salvar cartão
                </label>
            </div>    
        
            <input id="senderHash" name="senderHash" type="hidden"></input>
            <input id="brand" name="bandeira" type="hidden"></input>
            <input id="tokenCard" name="tokenCard" type="hidden"></input>
            <button id="gerarToken" class="btn btn-success btn-lg btn-block" type="button" data-toggle="modal" data-target="#modal-confirm"> Avançar </button>

        </div>



        <!-- Modal Confirmação-->
        <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-confirm-title"> Confirmar pedido </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            <!-- Botar PHP -->
                <div class="modal-info-session">
                    <h6 class="modal-confirm-subtitle">Dados do usuário</h6>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Nome:</span>
                        <span class="ml-2 my-info"><?php echo($userInfo['holder']); ?></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Nascimento:</span>
                        <span class="ml-2 my-info"><?php echo($this->decript($userInfo['birthDate'])); ?></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">CPF:</span>
                        <span class="ml-2 my-info"><?php echo($this->decript($userInfo['cpf'])); ?></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Telefone:</span>
                        <div class="d-flex">
                            <span class="ml-2 my-info"><?php echo($this->decript($userInfo['areaCode'])); ?></span>
                            <span class="ml-2 my-info"><?php echo($this->decript($userInfo['phone'])); ?></span>
                        </div>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Email:</span>
                        <span class="ml-2 my-info"><?php echo($this->decript($userInfo['emailOwner'])); ?></span>
                    </div>
                </div>

                <div class="modal-info-session">
                    <h6 class="modal-confirm-subtitle">Dados do cartão</h6>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">N do cartão:</span>
                        <span class="ml-2 my-info"><?php echo($this->decript($userInfo['nCard'])); ?></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">CVV:</span>
                        <span class="ml-2 my-info"><?php echo($this->decript($userInfo['cvv'])); ?></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Validade:</span>
                        <div class="d-flex">
                            <span class="ml-2 my-info"><?php echo($this->decript($userInfo['monthVal'])); ?></span>
                            <span class="ml-2 ">/</span>
                            <span class="ml-2 my-info"><?php echo($this->decript($userInfo['yearVal'])); ?></span>
                        </div>
                        
                    </div>
                </div>

                <div class="modal-info-session">
                    <h6 class="modal-confirm-subtitle">Endereço de cobrança</h6>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Rua:</span>
                        <span class="ml-2 my-info"></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Número do local:</span>
                        <span class="ml-2 my-info"></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Complemento:</span>
                        <span class="ml-2 my-info"></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Bairro:</span>
                        <span class="ml-2 my-info"></span>
                    </div>
                    <div class="modal-info d-flex">
                        <span class="modal-negrito-title">Estado UF:</span>
                        <span class="ml-2 my-info"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary open-confirm-modal">Confirmar</button>
            </div>
            </div>
        </div>
        </div>

        <script src="app/View/assets/js/pagamento.js"></script>
    </form>


    <!-- <p id="bandeira">jorge</p>
    <p>Token: <a id="tk"></a></p> -->
    <script>
        PagSeguroDirectPayment.setSessionId('<?php echo ($retornoInit)?>');
    </script>
