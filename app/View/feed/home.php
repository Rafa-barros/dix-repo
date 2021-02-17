<navbar>
    <nav class="nav">
        <a class="a-logo-dix" href="/feed"><img class="logo-dix" src="/app/View/assets/css/img/logo_blue.png" alt="logo"></a> 
        <div class="features-containers">
            <a href=<?php echo("\"" . "profile/" . $username . "\""); ?>><i class="fas fa-user"></i></a>
            <a href="/feed"><i class="fas fa-home"></i></a>
            <a href="/chat" class="i-c"><i class="fas fa-comments"></i></a>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-secondary dropdown-toggle btn-notificacao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-danger ml-2"><?php echo($tamNovas);?></span>
                </button>
                <div class="dropdown-menu not-pop" style="width: 425px">
                
                <?php
                if ($tam > 0){
                    for ($i = 0; $i<$tam; $i++){
                        switch ($notificacoes[$i]['type']){
                            case 0:
                                echo ('<div class="notificacao">
                                <span>  <i class="fas fa-fire-alt like-icon"></i><a href="">' . $notificacoes[$i]['username'] . '</a>  curtiu a sua publicação! </span>
                            </div>');
                                break;
                            case 1:
                                echo ('<div class="notificacao">
                                <span> <i class="far fa-comment comment-icon"></i><a href="">' . $notificacoes[$i]['username'] . '</a> comentou na sua publicação! </span>
                            </div>  ');
                                break;
                            case 2:
                                echo ('<div class="notificacao" style="display: block;">
                                <i class="fas fa-coins coin-icon"></i>
                                <span> <a href="">' . $notificacoes[$i]['username'] . '</a>  te deu <b>' . $notificacoes[$i]['amount'] . '</b> de gorjeta! </span>
                                <div class="d-flex">
                                    <span class="gorjeta-msg">mensagem: ' . $notificacoes[$i]['msg'] . '.</span>
                                </div>
                            </div>');
                                break;
                        }
                    }
                } else {
                    echo ('<a class="dropdown-item waves-effect waves-light notificacao" href="#"> Você não tem nenhuma nova notificação</a>');
                }
                ?>
                </div>
            </div>
        </div>
    </nav>
</navbar>


<div class="all">
    <!-- <h1 id="user">?</h1>
    <img id="userImg">
    <img id="postImg">
    <p id="description">?</p>
    <p id="likes">?</p>
    <p id="qtdComentarios">?</p>

    <form method="post" enctype="multipart/form-data"> -->
        <!-- 
            - Deve ter uma caixa pra dar upload de arquivo sendo um desses: 'jpg', 'jpeg', 'png', 'mp4', 'avi', 'webp', 'gif'
            - Input text com a descrição do post: <input type="submit" name="descricao" value="Descrição">
            - Uma select box de input pra indicar se vai ser allow view (0 pra não, 1 pra sim em que name="postLiberado")
            - Um select ou input text com o valor de preço, caso seja post pago (atributo do elemento: name="valor")
        -->


    <div class="main-container">

        <div class="posts">

            <div id="new-post" class="card">
                <h1>Publique agora!</h1>
                <p> Crie um novo post de forma simples, fácil e rápida, adicione fotos e defina valores!</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-post-modal">Nova publicação</button>

                <!-- Modal  New Post -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal fade" id="new-post-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Nova publicação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body loading-new-post">
                            <div class="description mb-3">
                                <textarea type="text" class="form-control new-post-description" id="validationDefault01" placeholder="Escreva a descrição aqui..." name="descriptPost"></textarea>
                            </div>
                            <div class="d-flex">
                                <i class="fas fa-images"></i>
                                <label class="upload-label mb-2" for="upload">Escolher foto/vídeo</label>
                                <input type="file" name="arquivo" id="upload" />
                            </div>
                            <div class="price-btn mb-3">
                                <input type="radio" id="pago" name="postLiberado" value="0">
                                <label for="pago">pago</label>
                                <input type="radio" id="publico" name="postLiberado" value="1" checked>
                                <label for="publico">público</label>
                            </div>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                                <input type="number" step="0.01" minlength="1" name="valor" class="form-control post-price" aria-label="Amount (to the nearest dollar)" placeholder="Preço">
                            </div>
                        </div>
                        <div class="modal-footer loading-footer-new-post">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="btn-final-new-post" name="enviar">Publicar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>

            <div id="buscar-pessoas" class="card">
                <div class="d-flex encontrar-pessoas-container">
                    <span> Encontre novas pessoas: </span>
                    <button type="button" class="btn btn-primary btn-encontrar-pessoas" data-toggle="modal" data-target="#buscar-pessoas-modal"><i class="fas fa-search"></i></button>
                </div>
            </div>

        <!-- Modal Buscar pessoas -->

        <div class="modal fade" id="buscar-pessoas-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <form class="buscar-pessoa-form">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Buscar Pessoa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-2 mt-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" id="input-novo-contato" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary new-chat-btn">Buscar</button>
            </div>
            </form>
            </div>
        </div>
        </div>

            <!-- Modal PAGO-->
        <div class="modal fade" id="modal-pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Desbloqueie o post!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-vip">

                    <div class="modal-vip-container">
                        <div class="center">
                            <div>
                                <h5 class="card-title mt-3"></h5>
                                <ul class="mt-3 mb-3">
                                    <li>A publicação será desbloqueada para sempre!</li>
                                    <li>O valor do post foi definido por seu dono!</li>
                                </ul>
                                <a href="#" class="btn btn-primary mb-3 btn-preco-post" style="color: #FAFAFA;font-weight: 500;margin-left: 170px;width: 128px;">12R$</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
        </div>

        <!-- Modal Donate-->
        <div class="modal fade" id="donate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Gorjeta!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-target="#donate-modal"> 
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <form action="/pagamento" method="get">
                    <div class="input-group mb-3 mt-3">
                            <div class="input-group mb-3">
                                <span class="subtitle-modal-gorjeta">Envie uma gorjeta para <a href="" class="nome-alvo"></a>!</span> 
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Valor (R$)</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Default" placeholder="Ex.: 34,00" aria-describedby="inputGroup-sizing-default" name="valor">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="Default" placeholder="Mensagem..." aria-describedby="inputGroup-sizing-default" name="msg">
                            </div>
                    
                    </div>
                <div class=" modal-footer" style="justify-content: center; padding-top: 30px">
                    <button type="submit" class="btn btn-primary">Enviar gorjeta</button>
                </div>
                </form>

                </div>
                </div>
            </div>
        </div>

    <!-- Início Posts -->

     <!-- post 1 -->
     <div class="card">
                <div class="card-top">
                    <div class="top-card-top">
                        <div class="l-card-top">
                            <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
                            <div class="author-info">
                                <p class="author-name"> <a href="">Caio Brandini</a></p>
                                <p class="post-time"> 34 min </p>
                            </div>
                        </div>
                        <div class="r-card-top">
                            <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>
                        </div>
                    </div>
                    <div class="bot-card-top">
                        <p class="description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos sunt maxime quibusdam sequi impedit porro maiores perspiciatis ad itaque illo.</p>
                    </div>

                </div>
                <div class="midia-container">
                    <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/140726030_2932453123741462_2090715909532181379_n.jpg?_nc_cat=104&ccb=2&_nc_sid=730e14&_nc_ohc=OBII42r_vCIAX_KW_Ov&_nc_ht=scontent.fcpq4-1.fna&oh=c5e6105ef7a97f1ede98edc740351769&oe=602F52B8" alt="">
                </div>
                <div class="card-bot">
                    <div class="post-status">
                        <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span>
                    </div>
                    <div class="g-border"></div>
                    <div class="interactive">
                        <div class="like">
                            <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button>
                        </div>
                        <div class="donate">
                            <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span>
                        </div>
                        <div class="comment">
                            <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span>
                        </div>
                    </div>
                    <div class="comment-area">
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Gustavo123</a></span> Lorem, ipsum dolor.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Fernandoo</a></span> Lorem ipsum dolor sit.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">AnaJulia_50</a></span> Lorem, ipsum.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.<p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href=""> LauraaaSouza</a></span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates expedita labore quas possimus. Eaque, molestiae. Nesciunt vero minima assumenda voluptatem?</p>
                        </div>
                        <div class="end-comment-show"></div>
                        <div class="comment-now">
                            <form method="POST" class="comment-form" ajax="true">
                                <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required>
                                <button class="btn-send-comment"> Enviar </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- post 2 -->
    
            <div class="card">
                <div class="card-top">
                    <div class="top-card-top">
                        <div class="l-card-top">
                            <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
                            <div class="author-info">
                                <p class="author-name"> <a href="">Caio Brandini</a></p>
                                <p class="post-time"> 34 min </p>
                            </div>
                        </div>
                        <div class="r-card-top">
                            <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>
                        </div>
                    </div>
                    <div class="bot-card-top">
                        <p class="description"> Lorem ipsum dolor sit.</p>
                    </div>

                </div>
        <div class="midia-container">
        <video src="abromoToxico.mp4" controls controlslist="nodownload" style="max-width:100%;"></video>
        </div>
        <div class="card-bot">
            <div class="post-status">
                <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span>
            </div>
            <div class="g-border"></div>
            <div class="interactive">
                <div class="like">
                    <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button>
                </div>
                <div class="donate">
                            <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span>
                        </div>
                <div class="comment">
                    <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span>
                </div>
            </div>
            <div class="comment-area">
                <div class="a-comment">
                    <span class="a-username"><a href="">Gustavo123</a></span> <p class="r-comment">oioioi</p>
                </div>
                <div class="end-comment-show"></div>
                <div class="comment-now">
                    <form method="POST" class="comment-form" ajax="true">
                        <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required>
                        <button class="btn-send-comment"> Enviar </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- post 3 -->
    <div class="card">
                <div class="card-top">
                    <div class="top-card-top">
                        <div class="l-card-top">
                            <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
                            <div class="author-info">
                                <p class="author-name"> <a href="">Caio Brandini</a></p>
                                <p class="post-time"> 34 min </p>
                            </div>
                        </div>
                        <div class="r-card-top">
                            <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>
                        </div>
                    </div>
                    <div class="bot-card-top">
                        <p class="description"> Minha nova tatuagem :)</p>
                    </div>

                </div>
                <div class="midia-container">
                    <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/140726030_2932453123741462_2090715909532181379_n.jpg?_nc_cat=104&ccb=2&_nc_sid=730e14&_nc_ohc=OBII42r_vCIAX_KW_Ov&_nc_ht=scontent.fcpq4-1.fna&oh=c5e6105ef7a97f1ede98edc740351769&oe=602F52B8" alt="">
                </div>
                <div class="card-bot">
                    <div class="post-status">
                        <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span>
                    </div>
                    <div class="g-border"></div>
                    <div class="interactive">
                        <div class="like">
                            <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button>
                        </div>
                        <div class="donate">
                            <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span>
                        </div>
                        <div class="comment">
                            <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span>
                        </div>
                    </div>
                    <div class="comment-area">
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Gustavo123</a></span> Lorem, ipsum dolor.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Fernandoo</a></span> Lorem ipsum dolor sit.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">AnaJulia_50</a></span> Lorem, ipsum.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.<p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href=""> LauraaaSouza</a></span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates expedita labore quas possimus. Eaque, molestiae. Nesciunt vero minima assumenda voluptatem?</p>
                        </div>
                        <div class="end-comment-show"></div>
                        <div class="comment-now">
                            <form method="POST" class="comment-form" ajax="true">
                                <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required>
                                <button class="btn-send-comment"> Enviar </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


                        <!-- post 4 -->
    
            <div class="card">
                <div class="card-top">
                    <div class="top-card-top">
                        <div class="l-card-top">
                            <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
                            <div class="author-info">
                                <p class="author-name"> <a href="">Caio Brandini</a></p>
                                <p class="post-time"> 34 min </p>
                            </div>
                        </div>
                        <div class="r-card-top">
                            <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>
                        </div>
                    </div>
                    <div class="bot-card-top">
                        <p class="description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, sapiente ipsum modi dolore libero ut. Magni quidem similique, optio cumque nostrum perferendis explicabo culpa aperiam ex omnis, earum tenetur. Nulla quasi sapiente excepturi enim quia debitis accusantium est aliquam officia similique, eum natus nisi provident ipsam, fugiat suscipit inventore dignissimos consequatur optio magni quos voluptatum? Obcaecati cum molestias excepturi. Cumque.</p>
                    </div>

                </div>
        <div class="midia-container">
            <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/141305301_3904500662933554_4794639086175181746_o.jpg?_nc_cat=1&ccb=2&_nc_sid=730e14&_nc_ohc=yqZx4VzPNUoAX-2Goue&_nc_ht=scontent.fcpq4-1.fna&oh=f56c81a3579170fbcf3217b6d150fb36&oe=60314113" alt="">
        </div>
        <div class="card-bot">
            <div class="post-status">
                <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span>
            </div>
            <div class="g-border"></div>
            <div class="interactive">
                <div class="like">
                    <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button>
                </div>
                <div class="donate">
                            <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span>
                        </div>
                <div class="comment">
                    <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span>
                </div>
            </div>
            <div class="comment-area">
                <div class="a-comment">
                    <span class="a-username"><a href="">Gustavo123</a></span> <p class="r-comment">oioioi</p>
                </div>
                <div class="end-comment-show"></div>
                <div class="comment-now">
                    <form method="POST" class="comment-form" ajax="true">
                        <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required>
                        <button class="btn-send-comment"> Enviar </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


         <!-- post 5 -->
         <div class="card">
                <div class="card-top">
                    <div class="top-card-top">
                        <div class="l-card-top">
                            <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
                            <div class="author-info">
                                <p class="author-name"> <a href="">Caio Brandini</a></p>
                                <p class="post-time"> 34 min </p>
                            </div>
                        </div>
                        <div class="r-card-top">
                            <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>
                        </div>
                    </div>
                    <div class="bot-card-top">
                        <p class="description"> Minha nova tatuagem :)</p>
                    </div>

                </div>
                <div class="midia-container">
                    <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/140726030_2932453123741462_2090715909532181379_n.jpg?_nc_cat=104&ccb=2&_nc_sid=730e14&_nc_ohc=OBII42r_vCIAX_KW_Ov&_nc_ht=scontent.fcpq4-1.fna&oh=c5e6105ef7a97f1ede98edc740351769&oe=602F52B8" alt="">
                </div>
                <div class="card-bot">
                    <div class="post-status">
                        <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span>
                    </div>
                    <div class="g-border"></div>
                    <div class="interactive">
                        <div class="like">
                            <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button>
                        </div>
                        <div class="donate">
                            <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span>
                        </div>
                        <div class="comment">
                            <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span>
                        </div>
                    </div>
                    <div class="comment-area">
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Gustavo123</a></span> Lorem, ipsum dolor.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Fernandoo</a></span> Lorem ipsum dolor sit.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">AnaJulia_50</a></span> Lorem, ipsum.</p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.<p>
                        </div>
                        <div class="a-comment">
                            <p class="r-comment"> <span class="a-username"><a href=""> LauraaaSouza</a></span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates expedita labore quas possimus. Eaque, molestiae. Nesciunt vero minima assumenda voluptatem?</p>
                        </div>
                        <div class="end-comment-show"></div>
                        <div class="comment-now">
                            <form method="POST" class="comment-form" ajax="true">
                                <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required>
                                <button class="btn-send-comment"> Enviar </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




    <!-- Fim posts -->
    </div>

        </div>
    </div>

</div>

<script src="app/View/assets/js/scrollInfinito.js"></script>
<script src="app/View/assets/js/feed.js"></script>
<script src="app/View/assets/js/post.js"></script>
<script src="app/View/assets/js/zerarnot.js"></script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->