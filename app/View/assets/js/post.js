var urlprof = '';
if(window.location.href.split('/')[3] == 'profile') urlprof = '../'

// Botão de like

var buttonLike = '';
$(document).on('click', '.btn-like', function(){
        var likeIcon = document.querySelectorAll('.btn-like')[0];
        let idPost = $(this).parents(".card").attr("id");
        buttonLike = $(this);

        if(!buttonLike.hasClass("curtido")){
            buttonLike.css("color", "rgb(218, 51, 51)").addClass('curtido');
        }
        else {
            buttonLike.css( "color", "rgb(0, 0, 0)" ).removeClass('curtido');
        }

        $.ajax({
            url: urlprof +"app/Models/curtirPost.php",
            dataType: 'json',
            type: "POST",
            data: {
                id: idPost, // ID DO POST
            }
            
            });


        var card = $(this).parents(".card")
        text = card.find(".nlikes").text();
        if($(this).css("color") == "rgb(0, 0, 0)"){
            card.find(".nlikes").text((parseInt(text.split('c')[0])+ 1).toString() + " curtidas");
        } 
        else {card.find(".nlikes").text((parseInt(text.split('c')[0])- 1).toString() + " curtidas")}
        text = card.find(".nlikes").text();
        if(parseInt(text.split('c')[0]) == 1) card.find(".nlikes").text('1 curtida');
    });


// Comentário
var commentArea = '';
$(document).on('click', '.btn-comment', function(){
    if( !$(this).hasClass('open-comment-Area')){

        $(this).addClass('open-comment-Area');
        commentArea = $(this).parents(".card").find('.comment-area');
        commentArea.show();
        let idPost = $(this).parents(".card").attr("id");

        //Carregar comentários

            $.ajax({
                url: urlprof + "app/Models/loadComments.php",
                dataType: 'json',
                type: "POST",
                data: {
                    idPost: idPost, // ID DO POST
                    comentarios: [[]]
                },
                success:function(result){
                    if(result.comentarios != null && result.comentarios != undefined){
                        var i = result.comentarios.length - 1;

                        while (result.comentarios[i][0] !== ""){
                            commentArea.prepend(' <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="https://dix.net.br/profile/'+result.comentarios[i][0]+'">'+result.comentarios[i][0]+'</a></span>'+result.comentarios[i][1]+'</p></div><div class="a-comment">');
                            if (i == 0){
                                break;
                            }
                            i--;
                        }
                    }
                },
                error:function(req, status, error){
                console.log(req);
                console.log(status);
                console.log(error);
                }
                });
    }
    else {
        commentArea.hide().html('<div class="end-comment-show"></div><div class="comment-now"> <form method="POST" class="comment-form" ajax="true"> <input type="text" class="form-control comment-input" placeholder="Deixe seu comentário aqui..." required=""> <button class="btn-send-comment"> Enviar </button> </form> </div>');
        $('.btn-comment').removeClass('open-comment-Area');
    }

});

$(document).ready(function(e) {
    
    //Enviar comentários

    $(document).on('submit', 'form[ajax=true]', function(e){

        e.preventDefault();
        
        var card = $(this).parents(".card");
        let idPost = card.attr('id');
        var commentInput = card.find(".comment-input").val();
        var newComment = '<div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">'+ $('.features-containers a').attr('href').split('/')[2] +'</a></span>'+ htmlEntities(commentInput) +'</p> </div>';

        $.ajax({
            url: urlprof + 'app/Models/comentarPost.php',
            method: "POST",
            dataType: "json",     
            data: {
                idPost: idPost,
                descript: commentInput
            },     
            cache: false,
            success: function(){
                var commentInput = card.find(".end-comment-show").before(newComment);
                $('.comment-input').val("");      
                ncomments = card.find(".ncomments").text();
                card.find(".ncomments").text((parseInt(ncomments.split()[0])+ 1).toString() + " comentários")         
            }           
        });    
        
    });
    
});


//post pago

cardpago = '';

$(document).on('click', '.pago img', function(){
    cardpago = $(this).closest('.card');

    let classes = cardpago.attr('class').split(' ');
    let preco = 0;
    for(var i=0; i<classes.length; i++){
        if(isNumber(classes[i])) preco = classes[i];
    }
    $('.btn-preco-post').text('R$' + preco);
    $('#modal-pago').modal('show');

});

$(document).on('click', '.btn-preco-post', function(){
    let urlpreco = 'https://dix.net.br/pagamento?amount=' + $('.btn-preco-post').text().slice(2) + '&user=' + cardpago.attr('id') + '&idPost=1'
    window.location.href = urlpreco;
});

//isNumber

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}


// HtmlEntities

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

