

//carregar posts

var flag = 300;
    $(document).scroll(function (e) {
    var pos = $(this).scrollTop();
    if (pos >= flag){

        // $.ajax({
        //         url:"app/Models/newPosts.php",
        //         dataType: 'json',
        //         type: "POST",
        //         data: {
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
        //             var pago = '';
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

        //             if(result.valor > 0) pago = 'pago ' + result.valor.toString();

        //             var editBtn = '<div class="card-options-container" style="display: flex; justify-content: flex-end;"> <div class="btn-group dropup"> <button type="button" class="btn dropdown-toggle btn-edit-post" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-h mr-4" style="font-size:22px; color:rgb(142, 142, 142,0.7); cursor: pointer;"></i> </button> <div class="post-edit-pop dropdown-menu "> <button class="dropdown-item edit-post-drop" type="button" data-toggle="modal" data-target="#edit-post" >Editar publicação</button> <button class="dropdown-item delete-post-drop" type="button">Apagar publicação</button> </div></div></div>';

        //             var cardFollowBtn = '<button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button>';
        //             if( !$('.btn-profile-follow').hasClass('seguindo')) cardFollowBtn = '<button type="button" class="btn btn-outline-primary btn-profile-follow" style="background-color: transparent; color: rgb(57, 132, 218);">Seguir</button>';
        
                    // if(me == 0) editBtn = ' ';
                    // else cardFollowBtn =' ';
        //             if(result.idPost != null) $(".profile-posts").append('<div class="card '+pago+'" id='+result.idPost.toString()+'> <div class="card-top"> <div class="top-card-top"> '+ editBtn +'<div class="l-card-top"> <a href="/profile/'+result.userOp+'"><img class="profile-image" src="'+$(".profile-img").attr('src')+'" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="/profile/'+result.userOp+'">'+result.nameOp+'</a></p><p class="post-time"> '+ separaTempo(result.data)+' </p></div></div><div class="r-card-top"> '+ cardFollowBtn +' </div></div><div class="bot-card-top"> <pre class="description">'+result.descricao+'</pre></div></div><div class="midia-container"> '+ midia +' </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">'+result.likes+' curtidas</span> <span class="ncomments">'+result.qtdComentarios.toString()+' comentários </span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like" '+postLiked+'><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button> <span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>');

        //             if(result.likes == 1) { $("#"+result.idPost.toString()).find('.nlikes').text('1 curtida');}

        //             if(result.qtdComentarios == 1) $("#"+result.idPost.toString()).find('.ncomments').text('1 Comentário');

        //             flag = flag += 500;
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
