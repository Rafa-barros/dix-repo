
<nav class="nav">
    <a class="a-logo-dix" href="/feed"><img class="logo-dix" src="/app/View/assets/css/img/logo_blue.png" alt="logo"></a> 
    <div class="features-containers">
        <a href=""><i class="fas fa-user"></i></a>
        <a href="/feed"><i class="fas fa-home"></i></a> 
        <a href="/chat" class="i-c"><i class="fas fa-comments"></i></a>
          <div class="btn-group dropleft">
            <button type="button" class="btn btn-secondary dropdown-toggle btn-notificacao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger ml-2">4</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item waves-effect waves-light notificacao" href="#"> Você não tem nenhuma notificação</a>
            </div>
        </div>
    </div>
</nav>


<div class="profile">
    <div class="profile-top">
        <img src="https://pesquisei.club/wp-content/uploads/2018/05/img_5af35102b4d4c.png"  class="img-capa" alt="Imagem de capa">
        <div class="prof-status-container">
            <div class="profile-img-container">
                <img src="/app/View/assets/css/img/Caio.jpg" class="profile-img" alt="">
            </div>
            <p class="prof-name">Caio Brandini</p>
            <p class="prof-description">Lorem ipsum dolor sit amet.</p>
            <div class="follower-status">
                <span> <b class="nfollowers">12</b> seguidores</span>
                <span> <b>7</b> VIPS</span>
            </div>
        </div>
        <div class="profile-btn-area">
            <button type="button" class="btn btn-outline-primary btn-profile-follow">Seguir</button>
            <button type="button" class="btn btn-primary btn-profile-message">Mensagem</button>
        </div>
        <div class="profile-img-container-border-bottom"></div>
    </div>

    <div class="VIP">
        <!-- BOTAR PHP AQUI -->
        <button type="button" class="btn btn-warning btn-VIP" data-toggle="modal" data-target="#modal-vip"> Torne-se VIP!</button>
        <!-- <button type="button" class="btn btn-primary btn-editar-perfil" data-toggle="modal" data-target="#modal-edit-prof"> Editar Perfil</button> -->
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
        ...
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



    <div class="profile-bottom">

        <div class="profile-l-content">
            <h2 class="about-me">Sobre mim</h2>
            <p class="bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam placeat quae magni error, unde laborum quisquam, earum sit illum ipsum et delectus tenetur perferendis soluta sint maiores animi.</p>
            <div class="g-border"></div>
            <h2 class="nposts-title">Número de posts</h2>
            <p class="nposts">28</p>
        </div>
    
        <div class="profile-posts">
    

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


<script src="app/View/assets/js/post.js" class="deletar-1" ></script>
<script src="app/View/assets/js/profile.js" class="deletar-2" ></script>

<script>

$('.comment-area').hide();

//Área lateral

    if(window.matchMedia("(max-width: 1250px)").matches){
        $(".profile-l-content").hide();
    } 


//carregar posts

var flag = 300;
    $(document).scroll(function (e) {
    var pos = $(this).scrollTop();
    if (pos > flag){

            // $.ajax({
            //     url:"app/Models/newPosts.php",
            //     dataType: 'json',
            //     type: "POST",
            //     data: {email: "brandinicaio@gmail.com",
            //         nameOp: "", //Dono do post
            //         userOp: "", //Dono do post
            //         data: "", 
            //         imgOp: "", //Imagem do dono do post
            //         imgPost: "", //Imagem do post
            //         postsVistos: postsVistosNav, 
            //         descricao: "", 
            //         likes: "",
            //         liked: 0,
            //         valor: 0,
            //         gorjetas: 0,
            //         idPost: 0,
            //         qtdComentarios: 0
            //     },
            //     success:function(result){

            //         var elementoImagem = '';

            //         if(result.imgPost != 0){
            //             elementoImagem = '<img src="'+result.imgPost+'" alt="Imagem do post">';
            //         }

            //          let postLiked = 'style="color: rgb(218, 51, 51);
             //         if(result.liked == 0){postLiked = ""}

            //         $(".posts").append('<div class="card" id='+result.toString()+'> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href="/'+result.userOp+'"><img class="profile-image" src="'+result.imgOp+'" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="/'+result.userOp+'">'+result.nameOp+'</a></p><p class="post-time"> '+result.data+' </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> '+result.descricao+' </p></div></div><div class="midia-container"> '+elementoImagem+' </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">'+result.likes+' curtidas</span> <span class="ncomments">'+result.qtdComentarios.toString()+' comentários </span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like" '+postLiked+'><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button> <span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>');

            //         postsVistosNav.push(result.idPost);

            //     },
            //     error:function(req, status, error){
            //         console.log(req);
            //         console.log(status);
            //         console.log(error);
            //     }
            //     });

            // }

        $(".profile-posts").append(' <div class="card"> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="">Caio Brandini</a></p><p class="post-time"> 34 min </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos sunt maxime quibusdam sequi impedit porro maiores perspiciatis ad itaque illo.</p></div></div><div class="midia-container"> <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/140726030_2932453123741462_2090715909532181379_n.jpg?_nc_cat=104&ccb=2&_nc_sid=730e14&_nc_ohc=OBII42r_vCIAX_KW_Ov&_nc_ht=scontent.fcpq4-1.fna&oh=c5e6105ef7a97f1ede98edc740351769&oe=602F52B8" alt=""> </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Gustavo123</a></span> Lorem, ipsum dolor.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Fernandoo</a></span> Lorem ipsum dolor sit.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">AnaJulia_50</a></span> Lorem, ipsum.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.<p> </div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href=""> LauraaaSouza</a></span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates expedita labore quas possimus. Eaque, molestiae. Nesciunt vero minima assumenda voluptatem?</p></div><div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div><div class="card"> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="">Caio Brandini</a></p><p class="post-time"> 34 min </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> Lorem ipsum dolor sit.</p></div></div><div class="midia-container"> <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/141305301_3904500662933554_4794639086175181746_o.jpg?_nc_cat=1&ccb=2&_nc_sid=730e14&_nc_ohc=yqZx4VzPNUoAX-2Goue&_nc_ht=scontent.fcpq4-1.fna&oh=f56c81a3579170fbcf3217b6d150fb36&oe=60314113" alt=""> </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="a-comment"> <span class="a-username"><a href="">Gustavo123</a></span> <p class="r-comment">oioioi</p></div><div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>')
        flag = flag += 1200;
        load_js();
        
    }
    });

    function load_js() {
      $(".deletar-1").remove();
      $(".deletar-2").remove();

      //Remover Jquery listeners (otimizar)
      $("body").find("*").each(function() {
        $(this).unbind();
      });
      var head= document.getElementsByTagName('head')[0];
      var script= document.createElement('script');
      script.src= 'app/View/assets/js/post.js';
      head.appendChild(script).classList.toggle("deletar-1");
      var script2= document.createElement('script');
      script2.src= 'app/View/assets/js/profile.js';
      head.appendChild(script2).classList.toggle("deletar-2");
    }

</script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
 -->