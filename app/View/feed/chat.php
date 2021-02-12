<div class="all">

    <nav class="nav">
        <a class="a-logo-dix" href="/feed"><img class="logo-dix" src="/app/View/assets/css/img/logo_blue.png" alt="logo"></a> 
        <div class="features-containers">
            <a href="/profile" class="me" id=" "><i class="fas fa-user"></i></a>
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


    <div class="main-container">
    <div class="contatos">
        <div class="contatos-title-container">
            <h2>Contatos</h2>
            <i class="fas fa-search busca-contato" data-toggle="modal" data-target="#new-chat-modal"></i>
        </div>
        
        <div class="contact-list">
            <?php
                $chatsAbertos = $chat->carregarChats();
                $tam = count($chatsAbertos);
                echo $tam;
                for($i = 0; $i < $tam; $i++) { 
                    echo $chatsAbertos[i][0];
                    echo('<div class="contato">
                            <img class="foto-contato" src="' . $chatsAbertos[i][2] . '" alt="foto de perfil">
                            <div class="contato-info">
                                <span class="contato-name">' . $chatsAbertos[i][0] . '</span>
                                <p class="contact-last-message">' . $chatsAbertos[i][1] . '</p>
                            </div>
                        </div>');
                }
            ?>
            <!-- <div class="contato">
                <img class="foto-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name naolido">Caio Brandini</span>
                    <p class="contact-last-message naolido">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/130721573_2447514392060467_2518719859666796177_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=mYgZ_iaZMsgAX8OxWrV&_nc_ht=scontent.fcpq4-1.fna&oh=ebed84440b7f479a097acf165ec20a6f&oe=60368BEF" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Vinícius Venturini</span>
                    <p class="contact-last-message">Lorem, ipsum dolor.</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/48376083_1774848979290448_2227168575674646528_n.jpg?_nc_cat=103&ccb=2&_nc_sid=09cbfe&_nc_ohc=Cl4R69na_vQAX-XXNBd&_nc_ht=scontent.fcpq4-1.fna&oh=076a06f455381386ef3de739dec6d679&oe=6035D944" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Marcus Vinícius</span>
                    <p class="contact-last-message">Lorem ipsum dolor...</p>
                </div>
            </div>

            <div class="contato">
                <img class="foto-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Joana Paula</span>
                    <p class="contact-last-message">Lorem.</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/130721573_2447514392060467_2518719859666796177_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=mYgZ_iaZMsgAX8OxWrV&_nc_ht=scontent.fcpq4-1.fna&oh=ebed84440b7f479a097acf165ec20a6f&oe=60368BEF" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Gabriel Costa</span>
                    <p class="contact-last-message">Lorem, ipsum dolor.</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/48376083_1774848979290448_2227168575674646528_n.jpg?_nc_cat=103&ccb=2&_nc_sid=09cbfe&_nc_ohc=Cl4R69na_vQAX-XXNBd&_nc_ht=scontent.fcpq4-1.fna&oh=076a06f455381386ef3de739dec6d679&oe=6035D944" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Marcus souza</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>

            <div class="contato">
                <img class="foto-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Viviane Soares</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/130721573_2447514392060467_2518719859666796177_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=mYgZ_iaZMsgAX8OxWrV&_nc_ht=scontent.fcpq4-1.fna&oh=ebed84440b7f479a097acf165ec20a6f&oe=60368BEF" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Carlos augusto</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/48376083_1774848979290448_2227168575674646528_n.jpg?_nc_cat=103&ccb=2&_nc_sid=09cbfe&_nc_ohc=Cl4R69na_vQAX-XXNBd&_nc_ht=scontent.fcpq4-1.fna&oh=076a06f455381386ef3de739dec6d679&oe=6035D944" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Marcus Vinícius</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>

            <div class="contato">
                <img class="foto-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Caio Brandini</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/130721573_2447514392060467_2518719859666796177_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=mYgZ_iaZMsgAX8OxWrV&_nc_ht=scontent.fcpq4-1.fna&oh=ebed84440b7f479a097acf165ec20a6f&oe=60368BEF" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Vinícius Venturini</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/48376083_1774848979290448_2227168575674646528_n.jpg?_nc_cat=103&ccb=2&_nc_sid=09cbfe&_nc_ohc=Cl4R69na_vQAX-XXNBd&_nc_ht=scontent.fcpq4-1.fna&oh=076a06f455381386ef3de739dec6d679&oe=6035D944" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Marcus Vinícius</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>

            <div class="contato">
                <img class="foto-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Caio Brandini</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/130721573_2447514392060467_2518719859666796177_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=mYgZ_iaZMsgAX8OxWrV&_nc_ht=scontent.fcpq4-1.fna&oh=ebed84440b7f479a097acf165ec20a6f&oe=60368BEF" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Vinícius Venturini</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/48376083_1774848979290448_2227168575674646528_n.jpg?_nc_cat=103&ccb=2&_nc_sid=09cbfe&_nc_ohc=Cl4R69na_vQAX-XXNBd&_nc_ht=scontent.fcpq4-1.fna&oh=076a06f455381386ef3de739dec6d679&oe=6035D944" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Marcus Vinícius</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>

            <div class="contato">
                <img class="foto-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Caio Brandini</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/130721573_2447514392060467_2518719859666796177_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=mYgZ_iaZMsgAX8OxWrV&_nc_ht=scontent.fcpq4-1.fna&oh=ebed84440b7f479a097acf165ec20a6f&oe=60368BEF" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Vinícius Venturini</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div>
            
            <div class="contato">
                <img class="foto-contato" src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/48376083_1774848979290448_2227168575674646528_n.jpg?_nc_cat=103&ccb=2&_nc_sid=09cbfe&_nc_ohc=Cl4R69na_vQAX-XXNBd&_nc_ht=scontent.fcpq4-1.fna&oh=076a06f455381386ef3de739dec6d679&oe=6035D944" alt="foto de perfil">
                <div class="contato-info">
                    <span class="contato-name">Marcus Vinícius</span>
                    <p class="contact-last-message">iae</p>
                </div>
            </div> -->
            

        
        <!-- Fim contatos -->
        </div>
    </div>
    <div class="chat">
        <div class="chat-title-container">
            <div class="d-flex chat-title-info">
                <img class="foto-perfil-contato" src="/app/View/assets/css/img/Caio.jpg" alt="foto perfil contato">
                <p class="nome-contato-chat">Marcus Vinícius</p>
            </div>
        </div>

        <div class="initial">
            <div class="initial-main">
                <i class="far fa-comment"></i>
                <div class="initial-message"> 
                    <span>Suas mensagens</span> 
                    <p>Envie mensagens diretas para seus amigos</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-chat-modal">Enviar mensagem</button>
                </div>
            </div>
        </div>

        <div class="chat-right">
            <div class="chat-messages">
                <!-- Mensagens -->

                <div class="nova-data-msg">
                    <span>10/02/2021</span>
                </div>

                <div class="my-message">
                    <div class="message-content">
                        <span>oe</span>
                        <div class="time"> 20:17 </div>
                    </div>
                </div>

                <div class="my-message">
                    <div class="message-content">
                        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</span>
                        <div class="time"> 20:18 </div>
                    </div>
                </div>

                <div class="your-message">
                    <div class="message-content">
                        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</span>
                        <div class="time"> 21:12 </div>
                    </div>
                </div>

            </div>
            <div class="chat-bottom">
                <form method="POST" class="d-flex" ajax="true">
                    <input class="form-control" type="text" name="msg" placeholder="Mensagem..." autocomplete="off">
                    <button type="submit" class="btn-chat-enviar">Enviar</span>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Novo chat -->
<div class="modal fade" id="new-chat-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nova menssagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="new-chat-form">
        <div class="input-group mb-2 mt-2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" id="input-novo-contato" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary new-chat-btn">Entrar em contato</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="app/View/assets/js/chat.js"></script>
<script src="app/View/assets/js/zerarnot.js"></script>
<script>
    //Redirecionar notficações mobile

    $('.fa-bell').click(function(){
        if(window.matchMedia("(max-width: 800px)").matches){
            location.replace("/mobNot");
        } 
    });
</script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->