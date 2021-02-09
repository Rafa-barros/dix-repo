   //Redirecionar notficações mobile

   $('.fa-bell').click(function(){
    if(window.matchMedia("(max-width: 800px)").matches){
        location.replace("/mobNot");
    } 
});

var flag = 500;
$(document).scroll(function (e){
    var pos = $(this).scrollTop();
    if (pos >= flag){

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

            //         var postLiked = '';
                    
            //         if(result.liked == 1){
            //             postLiked = 'style="color: rgb(218, 51, 51)"';
            //         }

            //         $(".posts").append('<div class="card" id='+result.toString()+'> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href="/'+result.userOp+'"><img class="profile-image" src="'+result.imgOp+'" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="/'+result.userOp+'">'+result.nameOp+'</a></p><p class="post-time"> '+result.data+' </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> '+result.descricao+' </p></div></div><div class="midia-container"> '+elementoImagem+' </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">'+result.likes+' curtidas</span> <span class="ncomments">'+result.qtdComentarios.toString()+' comentários </span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like" '+postLiked+'><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button> <span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>');

            //         postsVistosNav.push(result.idPost);

            //     },
            //     error:function(req, status, error){
            //         console.log(req);
            //         console.log(status);
            //         console.log(error);
            //     }
            //     });



        /*
        $.ajax({
            url:"app/Models/loadComments.php",
            dataType: 'json',
            type: "POST",
            data: {
                idPost: IDPOST, // ID DO POST
                comentarios: [[]]
            },
            success:function(result){
                //result.comentarios[][]  
            },
            error:function(req, status, error){
                window.alert(req);
                window.alert(status);
                window.alert(error);
            }
            });
        */

  

        $(".posts").append(' <div class="card"> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="">Caio Brandini</a></p><p class="post-time"> 34 min </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos sunt maxime quibusdam sequi impedit porro maiores perspiciatis ad itaque illo.</p></div></div><div class="midia-container"> <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/140726030_2932453123741462_2090715909532181379_n.jpg?_nc_cat=104&ccb=2&_nc_sid=730e14&_nc_ohc=OBII42r_vCIAX_KW_Ov&_nc_ht=scontent.fcpq4-1.fna&oh=c5e6105ef7a97f1ede98edc740351769&oe=602F52B8" alt=""> </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Gustavo123</a></span> Lorem, ipsum dolor.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Fernandoo</a></span> Lorem ipsum dolor sit.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">AnaJulia_50</a></span> Lorem, ipsum.</p></div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.<p> </div><div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href=""> LauraaaSouza</a></span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates expedita labore quas possimus. Eaque, molestiae. Nesciunt vero minima assumenda voluptatem?</p></div><div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div><div class="card"> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="">Caio Brandini</a></p><p class="post-time"> 34 min </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <p class="description"> Lorem ipsum dolor sit.</p></div></div><div class="midia-container"> <img src="https://scontent.fcpq4-1.fna.fbcdn.net/v/t1.0-9/141305301_3904500662933554_4794639086175181746_o.jpg?_nc_cat=1&ccb=2&_nc_sid=730e14&_nc_ohc=yqZx4VzPNUoAX-2Goue&_nc_ht=scontent.fcpq4-1.fna&oh=f56c81a3579170fbcf3217b6d150fb36&oe=60314113" alt=""> </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">218 curtidas</span> <span class="ncomments">23 comentários</span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like"><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button><span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="a-comment"> <span class="a-username"><a href="">Gustavo123</a></span> <p class="r-comment">oioioi</p></div><div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>')

        flag = flag + 1210;
        $('.comment-area').hide();
        // load_js();
        
    
}});

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
  script2.src= 'app/View/assets/js/feed.js';
  head.appendChild(script2).classList.toggle("deletar-2");
}

