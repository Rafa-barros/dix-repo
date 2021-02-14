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

<div class="profile">
    <div class="profile-top">
        <img src=<?php echo("\"" . $fotoCapa . "\""); ?>  class="img-capa" alt="Imagem de capa">
        <div class="prof-status-container">
            <div class="profile-img-container">
                <img src=<?php echo("\"" . $img . "\""); ?> class="profile-img" alt="">
            </div>
            <p class="prof-name"><?php echo($pname); ?></p>
            <p class="prof-description"> </p>
            <div class="follower-status">
                <span> <b class="nfollowers"><?php echo($followers); ?></b> seguidores</span>
                <span> <b><?php echo($vips); ?></b> VIPS</span>
            </div>
        </div>
        <div class="profile-btn-area">
            <?php if(base64_decode($_COOKIE['cUser']) == $email){
               echo ('<button type="button" class="btn btn-primary btn-profile-message mr-1" id="btn-config" data-toggle="modal" data-target="#modal-config">Configurações <i class="fas fa-cog"></i> </button>');
            } else {
               echo ('<button type="button" class="btn btn-outline-primary btn-profile-follow seguindo" style="background-color: rgb(57, 132, 218); color: white;">Seguindo <i class="fas fa-check check-follow-profile"></i></button>
               <button type="button" class="btn btn-primary btn-profile-message mr-1" id="gorjeta-profile" data-toggle="modal" data-target="#donate-modal">Gorjeta <i class="fas fa-coins"></i> </button>
               <button type="button" class="btn btn-primary btn-profile-message btn-profile-message-o">Mensagem</button> <br/>');
            }
            ?>
        </div>
        <div class="profile-img-container-border-bottom"></div>
    </div>

    <div class="VIP">
    <?php if(base64_decode($_COOKIE['cUser']) == $email){
               echo ('<button type="button" class="btn btn-primary btn-editar-perfil" data-toggle="modal" data-target="#modal-edit-prof"> Editar Perfil</button>');
            } else {
               echo ('<button type="button" class="btn btn-warning btn-VIP" data-toggle="modal" data-target="#modal-vip"> Torne-se VIP!</button>');
            }
            ?>
        
    </div>

    <!-- Modal VIP-->
<div class="modal fade" id="modal-vip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Torne-se VIP!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body-vip">

        <div class="modal-vip-container">
            <div class="center">
                <div>
                    <h5 class="card-title mt-3">Assinatura mensal</h5>
                    <ul class="mt-3 mb-3">
                        <li>Todas as fotos liberadas</li>
                        <li>Atualizações frequentes</li>
                    </ul>
                    <a href="#" class="btn btn-warning mb-3" style="margin-left: 70px; color: #FAFAFA; font-weight: 500">15R$ / mês</a>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


    <!-- Modal Delete Post-->
    <div class="modal" id="modal-del-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Apagar publicação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body-vip">

        <div class="modal-vip-container">
            <div class="center">
                <div>
                    <span style="margin-bottom: 10px">Você quer mesmo deletar a publicação?</span>
                    <div class="d-flex justify-content-center mt-2">
                        <button type="button" class="btn btn-outline-danger btn-deletar-post">Apagar publicação</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

                <!-- Modal  Edit Post -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Editar publicação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 20px 50px">
                            <form>
                                <div class="description mb-3" style="padding-left:0">
                                    <textarea type="text" class="form-control new-post-description" id="validationDefault01" placeholder="Escreva a descrição aqui..." name="descriptPost"></textarea>
                                </div>
                                <div class="d-flex">
                                    <i class="fas fa-images"></i>
                                    <label class="upload-label mb-2" for="upload">Foto</label>
                                    <input type="file" name="arquivo" id="upload" />
                                </div>
                                <div class="price-btn mb-3">
                                    <input type="radio" id="pago" name="postLiberado" value="0">
                                    <label for="pago">pago</label>
                                    <input type="radio" id="publico" name="postLiberado" value="1" >
                                    <label for="publico">público</label>
                                </div>
                                <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                    <input type="number" class="form-control post-price" aria-label="Amount (to the nearest dollar)" placeholder="Preço">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="enviar">Salvar alterações</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
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


<!-- Modal Editar perfil -->

<div class="modal fade" id="modal-edit-prof" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="input-group mb-3 mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Descrição Rápida</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" placeholder="Ex.: Atriz e modelo" aria-describedby="inputGroup-sizing-default">
                </div>
                
            <div class="prof-description mb-2">
                <textarea type="text" class="form-control edit-post-description edit-profile-description" id="validationDefault01" placeholder="Sobre mim..." name="descriptPost"></textarea>
            </div>
            <div class="d-flex">
                <label class="upload-label mb-2 d-flex" for="upload"><i class="fas fa-images mr-2"></i>Escolher foto de capa</label>
                <input type="file" name="arquivo" id="upload" />
            </div>
            <div class="d-flex">
                <label class="upload-label mb-2 d-flex" for="upload"><i class="fas fa-images mr-2"></i>Escolher foto de perfil</label>
                <input type="file" name="arquivo" id="upload" />
            </div>
            </form>
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal Configurações -->

<div class="modal fade" id="modal-config" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Configurações</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post">
                <label class="config-label">Alterar Username</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">@</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" placeholder="Username" aria-describedby="inputGroup-sizing-default">
                </div>
                
                <label class="config-label">Data de nascimento</label>
                <div class="input-group mb-3 d-flex">
                    <div class="d-flex">
                        <input type="text" class="form-control data-nascimento" aria-label="Default" placeholder="DD" aria-describedby="inputGroup-sizing-default">
                        <input type="text" class="form-control data-nascimento" aria-label="Default" placeholder="MM" aria-describedby="inputGroup-sizing-default">
                        <input type="text" class="form-control data-nascimento" aria-label="Default" placeholder="AAAA" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                
                <button type="button" name="logout" id="btn-logout" class="btn btn-outline-danger mt-4">Log out</button>
        
    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
      </div>
      </form>
    </div>

  </div>
</div>

    <div class="profile-bottom">

        <div class="profile-l-content">
            <h2 class="about-me">Sobre mim</h2>
            <p class="bio"><?php echo($bio); ?></p>
            <div class="g-border"></div>
            <h2 class="nposts-title">Número de posts</h2>
            <p class="nposts"><?php echo($posts) ?></p>
        </div>
    
        <div class="profile-posts">
    

     <!-- post 1 -->
     <div class="card">
                <div class="card-top">

                    <div class="card-options-container" style="display: flex; justify-content: flex-end;">
                        <div class="btn-group dropup">
                            <button type="button" class="btn dropdown-toggle btn-edit-post" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h mr-4" style="font-size:22px; color:rgb(142, 142, 142,0.7); cursor: pointer;"></i>
                            </button>
                            <div class="post-edit-pop dropdown-menu ">
                                <button class="dropdown-item edit-post-drop" type="button" data-toggle="modal" data-target="#edit-post" >Editar publicação</button>
                                <button class="dropdown-item delete-post-drop" type="button" >Apagar publicação</button>
                            </div>
                        </div>    
                    </div>

                    <div class="top-card-top">
                        <div class="l-card-top">
                            <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
                            <div class="author-info">
                                <p class="author-name"> <a href="">Giovana</a></p>
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
                <div class="card-options-container" style="display: flex; justify-content: flex-end;">
                        <div class="btn-group dropup">
                            <button type="button" class="btn dropdown-toggle btn-edit-post" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h mr-4" style="font-size:22px; color:rgb(142, 142, 142,0.7); cursor: pointer;"></i>
                            </button>
                            <div class="post-edit-pop dropdown-menu ">
                                <button class="dropdown-item edit-post-drop" type="button" data-toggle="modal" data-target="#edit-post" >Editar publicação</button>
                                <button class="dropdown-item delete-post-drop" type="button">Apagar publicação</button>
                            </div>
                        </div>    
                    </div>
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



        <!-- /profile-posts -->

    </div>
</div>
<div class="footer">
    <div class="copyright">
        <p>© 2021 - Dix corporation</p>
    </div>
</div>


<script src="../app/View/assets/js/post.js"></script>
<script src="../app/View/assets/js/profile.js"></script>
<script src="../app/View/assets/js/zerarnot.js"></script>

<script>

    $(document).on('click', '#btn-logout', function(){

        $.ajax({
            dataType: 'json',
            method: "POST",
            url: "../app/Models/logout.php",    
            data: {logout: 1},     
            cache: false,
            success:function(){
              window.location.href = "http://dix.net.br";
            }        
        });
        
    });

    if(window.matchMedia("(max-width: 530px)").matches){
        $(".btn-profile-message-o").hide();
    } 

//Redirecionar notficações mobile

$('.fa-bell').click(function(){
    if(window.matchMedia("(max-width: 800px)").matches){
        location.replace("/mobNot");
    } 
});

//Área lateral

    if(window.matchMedia("(max-width: 1250px)").matches){
        $(".profile-l-content").hide();
    } 


//carregar posts

var flag = 300;
    $(document).scroll(function (e) {
    var pos = $(this).scrollTop();
    if (pos >= flag){

        // $.ajax({
        //         url:"app/Models/newPosts.php",
        //         dataType: 'json',
        //         type: "POST",
        //         data: {email: "marvinn2002vcl@gmail.com",
        //             nameOp: "", //Dono do post
        //             userOp: "", //Dono do post
        //             data: "", 
        //             imgOp: "", //Imagem do dono do post
        //             imgPost: "", //Imagem do post
        //             postsVistos: postsVistosNav, 
        //             descricao: "", 
        //             likes: "",
        //             liked: 0,
        //             valor: 0,
        //             gorjetas: 0,
        //             idPost: 0,
        //             qtdComentarios: 0
        //         },
        //         success:function(result){

        //             var midia = '';

        //             var postLiked = '';
                    
        //             if(result.liked == 1){
        //                 postLiked = 'style="color: rgb(218, 51, 51)"';
        //             }

        //             let midiaext = result.imgPost.split('.')[1].toLowerCase();

        //             if(midiaext == 'png' || midiaext == 'jpeg' || midiaext == 'jpg' || midiaext == 'gif' || midiaext == 'bmp' || midiaext == 'tiff' || midiaext == 'psd' || midiaext == 'raw' || midiaext == 'svg'){
        //                 midia = '<img src="'+result.imgPost+'" alt="Imagem do post">';
        //             } 

        //             else if (midiaext == undefined) {
        //                 midia = ' '
        //             }

        //             else {
        //                 midia = '<video src="'+result.imgPost+'" controls controlslist="nodownload" style="max-width:100%;"></video>'
        //             }

        //             var editBtn = '<div class="card-options-container" style="display: flex; justify-content: flex-end;"> <div class="btn-group dropup"> <button type="button" class="btn dropdown-toggle btn-edit-post" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-h mr-4" style="font-size:22px; color:rgb(142, 142, 142,0.7); cursor: pointer;"></i> </button> <div class="post-edit-pop dropdown-menu "> <button class="dropdown-item edit-post-drop" type="button" data-toggle="modal" data-target="#edit-post" >Editar publicação</button> <button class="dropdown-item delete-post-drop" type="button">Apagar publicação</button> </div></div></div>';
        //             var cardFollowBtn = '<button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>';
        //             $(".profile-posts").append('<div class="card" id='+result.idPost.toString()+'> <div class="card-top"> <div class="top-card-top"> '+ editBtn +'<div class="l-card-top"> <a href="/'+result.userOp+'"><img class="profile-image" src="'+$(".profile-img").attr('src')+'" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="/'+result.userOp+'">'+result.nameOp+'</a></p><p class="post-time"> '+ separaTempo(result.data)+' </p></div></div><div class="r-card-top"> '+ cardFollowBtn +' </div></div><div class="bot-card-top"> <p class="description"> '+result.descricao+' </p></div></div><div class="midia-container"> '+ midia +' </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">'+result.likes+' curtidas</span> <span class="ncomments">'+result.qtdComentarios.toString()+' comentários </span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like" '+postLiked+'><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button> <span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>');

        //             flag = flag += 1200;
        //         },
        //         error:function(req, status, error){
        //             console.log(req);
        //             console.log(status);
        //             console.log(error);
        //         }
        //     });

             $(".profile-posts").append(' <div class="card"> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="">Caio Brandini</a></p><p class="post-time"> 34 min </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos sunt maxime quibusdam sequi impedit porro maiores perspiciatis ad itaque illo.</p></div></div><div class="midia-container"> <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/140726030_2932453123741462_2090715909532181379_n.jpg?_nc_cat=104&ccb=2&_nc_sid=730e14&_nc_ohc=OBII42r_vCIAX_KW_Ov&_nc_ht=scontent.fcpq4-1.fna&oh=c5e6105ef7a97f1ede98edc740351769&oe=602F52B8" alt=""> </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Gustavo123</a></span> Lorem, ipsum dolor.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Fernandoo</a></span> Lorem ipsum dolor sit.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">AnaJulia_50</a></span> Lorem, ipsum.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.<p> </div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href=""> LauraaaSouza</a></span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates expedita labore quas possimus. Eaque, molestiae. Nesciunt vero minima assumenda voluptatem?</p></div><div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div><div class="card"> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="">Caio Brandini</a></p><p class="post-time"> 34 min </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> Lorem ipsum dolor sit.</p></div></div><div class="midia-container"> <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/141305301_3904500662933554_4794639086175181746_o.jpg?_nc_cat=1&ccb=2&_nc_sid=730e14&_nc_ohc=yqZx4VzPNUoAX-2Goue&_nc_ht=scontent.fcpq4-1.fna&oh=f56c81a3579170fbcf3217b6d150fb36&oe=60314113" alt=""> </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="a-comment"> <span class="a-username"><a href="">Gustavo123</a></span> <p class="r-comment">oioioi</p></div><div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>')

        
    }
    });




</script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->