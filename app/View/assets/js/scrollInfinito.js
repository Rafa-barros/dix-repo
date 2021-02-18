   
        $.ajax({
            url:"app/Models/newPosts.php",
            dataType: 'json',
            type: "POST",
            data: {
                nameOp: "", //Dono do post
                userOp: "", //Dono do post
                data: "", 
                imgOp: "", //Imagem do dono do post
                imgPost: "", //Imagem do post
                postsVistos: postsVistosNav,
                descricao: "", 
                likes: "",
                liked: 0,
                valor: 0,
                gorjetas: 0,
                idPost: 0,
                qtdComentarios: 0
            },
            success:function(result){

                var midia = '';
                var pago = '';
                var postLiked = '';
                
                if(result.liked == 1){
                    postLiked = 'style="color: rgb(218, 51, 51)"';
                }

                if(result.imgPost != null){
                    if(result.imgPost.split('.')[1] != undefined) var midiaext = result.imgPost.split('.')[1].toLowerCase();
                }
                
                if (result.descricao == null) result.descricao = ' ';

                if(midiaext == 'png' || midiaext == 'jpeg' || midiaext == 'jpg' || midiaext == 'gif' || midiaext == 'bmp' || midiaext == 'tiff' || midiaext == 'psd' || midiaext == 'raw' || midiaext == 'svg'){
                    midia = '<img src="'+result.imgPost+'" alt="Imagem do post">';
                } 

                else if (midiaext == undefined) {
                    midia = ' '
                }

                else {
                    midia = '<video src="'+result.imgPost+'" controls controlslist="nodownload" style="max-width:100%; max-height: 600px"></video>'
                }

                if(result.valor > 0) pago = 'pago ' + result.valor.toString();

                if(result.idPost != null)$(".posts").append('<div class="card '+pago+'" id='+result.idPost.toString()+'> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href="/profile/'+result.userOp+'"><img class="profile-image" src="'+result.imgOp+'" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="/profile/'+result.userOp+'">'+result.nameOp+'</a></p><p class="post-time"> '+ separaTempo(result.data)+' </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <pre class="description">'+result.descricao+'</pre></div></div><div class="midia-container"> '+ midia +' </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">'+result.likes+' curtidas</span> <span class="ncomments">'+result.qtdComentarios.toString()+' comentários </span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like" '+postLiked+'><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button> <span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>');

                if(result.likes == 1) { $("#"+result.idPost.toString()).find('.nlikes').text('1 curtida');}

                if(result.qtdComentarios == 1) $("#"+result.idPost.toString()).find('.ncomments').text('1 Comentário');

                postsVistosNav.push(result.idPost);

            },
            error:function(req, status, error){
                console.log(req);
                console.log(status);
                console.log(error);
            }
        });

   //Redirecionar notficações mobile

   $('.fa-bell').click(function(){
    if(window.matchMedia("(max-width: 800px)").matches){
        location.replace("/mobNot");
    } 
});

var flag = 0;
$(document).scroll(function (e){
    var pos = $(this).scrollTop();
    if (pos >= flag){
        $.ajax({
            url:"app/Models/newPosts.php",
            dataType: 'json',
            type: "POST",
            data: {
                nameOp: "", //Dono do post
                userOp: "", //Dono do post
                data: "", 
                imgOp: "", //Imagem do dono do post
                imgPost: "", //Imagem do post
                postsVistos: postsVistosNav,
                descricao: "", 
                likes: "",
                liked: 0,
                valor: 0,
                gorjetas: 0,
                idPost: 0,
                qtdComentarios: 0
            },
            success:function(result){

                var midia = '';
                var pago = '';
                var postLiked = '';
                
                if(result.liked == 1){
                    postLiked = 'style="color: rgb(218, 51, 51)"';
                }

                if(result.imgPost != null){
                    if(result.imgPost.split('.')[1] != undefined) var midiaext = result.imgPost.split('.')[1].toLowerCase();
                }
                
                if (result.descricao == null) result.descricao = ' ';

                if(midiaext == 'png' || midiaext == 'jpeg' || midiaext == 'jpg' || midiaext == 'gif' || midiaext == 'bmp' || midiaext == 'tiff' || midiaext == 'psd' || midiaext == 'raw' || midiaext == 'svg'){
                    midia = '<img src="'+result.imgPost+'" alt="Imagem do post">';
                } 

                else if (midiaext == undefined) {
                    midia = ' '
                }

                else {
                    midia = '<video src="'+result.imgPost+'" controls controlslist="nodownload" style="max-width:100%; max-height: 600px"></video>'
                }

                if(result.valor > 0) pago = 'pago ' + result.valor.toString();

                if(result.idPost != null)$(".posts").append('<div class="card '+pago+'" id='+result.idPost.toString()+'> <div class="card-top"> <div class="top-card-top"> <div class="l-card-top"> <a href="/profile/'+result.userOp+'"><img class="profile-image" src="'+result.imgOp+'" alt="Foto perfil"></a> <div class="author-info"> <p class="author-name"> <a href="/profile/'+result.userOp+'">'+result.nameOp+'</a></p><p class="post-time"> '+ separaTempo(result.data)+' </p></div></div><div class="r-card-top"> <button type="button" class="btn btn-primary btn-card-follow">Seguindo <i style="margin-left:6px;" class="fas fa-check"></i> </button> </div></div><div class="bot-card-top"> <pre class="description">'+result.descricao+'</pre></div></div><div class="midia-container"> '+ midia +' </div><div class="card-bot"> <div class="post-status"> <span class="nlikes">'+result.likes+' curtidas</span> <span class="ncomments">'+result.qtdComentarios.toString()+' comentários </span> </div><div class="g-border"></div><div class="interactive"> <div class="like"> <button class="btn-like" '+postLiked+'><span><i style="color: unset" class="fas fa-fire-alt"></i> Curtir</span> </button> </div><div class="donate"> <button class="btn-donate" data-toggle="modal" data-target="#donate-modal"><i class="fas fa-coins"></i>Gorjeta</span></button> <span> </div><div class="comment"> <button class="btn-comment"><i class="far fa-comment"></i>Comentários</span></button><span> </div></div><div class="comment-area"> <div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required> <button class="btn-send-comment"> Enviar </button> </form> </div></div></div></div>');

                if(result.likes == 1) { $("#"+result.idPost.toString()).find('.nlikes').text('1 curtida');}

                if(result.qtdComentarios == 1) $("#"+result.idPost.toString()).find('.ncomments').text('1 Comentário');

                postsVistosNav.push(result.idPost);

            },
            error:function(req, status, error){
                console.log(req);
                console.log(status);
                console.log(error);
            }
        });
        flag = flag + 600;
    
}});

function separaTempo(fullTime){
    if(fullTime == null) return '';
    return fullTime.split(' ')[1].slice(0, 5);
}