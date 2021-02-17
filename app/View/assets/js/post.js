
// Botão de like

$(document).on('click', '.btn-like', function(){
        var likeIcon = document.querySelectorAll('.btn-like')[0];
        let idPost = $(this).parents(".card").attr("id");
        let buttonLike = $(this);



        $.ajax({
            url:"app/Models/curtirPost.php",
            dataType: 'json',
            type: "POST",
            data: {
                id: idPost, // ID DO POST
            },
            complete:function(){
                if(buttonLike.css("color") == "rgb(0, 0, 0)")buttonLike.css("color", "rgb(218, 51, 51)");
                else buttonLike.css( "color", "rgb(0, 0, 0)" );
            }
            });


        var card = $(this).parents(".card")
        text = card.find(".nlikes").text();
        if($(this).css("color") == "rgb(0, 0, 0)"){
            card.find(".nlikes").text((parseInt(text.split()[0])+ 1).toString() + " curtidas");
        } 
        else {card.find(".nlikes").text((parseInt(text.split()[0])- 1).toString() + " curtidas")}

    });


// Comentário

$(document).on('click', '.btn-comment', function(){
    var commentArea = $(this).parents(".card").find('.comment-area');
    commentArea.show();
    let idPost = $(this).parents(".card").attr("id");

    //Carregar comentários

        $.ajax({
            url:"app/Models/loadComments.php",
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
                        commentArea.prepend(' <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">'+result.comentarios[i][0]+'</a></span>'+result.comentarios[i][1]+'</p></div><div class="a-comment">');
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
        

});

$(document).ready(function(e) {
    
    //Enviar comentários

    $(document).on('submit', 'form[ajax=true]', function(e){

        e.preventDefault();
        
        var card = $(this).parents(".card");
        let idPost = card.attr('id');
        var commentInput = card.find(".comment-input").val();
        var newComment = '<div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">'+ $('.features-containers a').attr('href').split('/')[1] +'</a></span>'+ htmlEntities(commentInput) +'</p> </div>';

        $.ajax({
            url: 'app/Models/comentarPost.php',
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

cardGorjeta = '';
$(document).on('click', '.btn-donate', function(){
    cardGorjeta = $(this).closest('.card').attr('id');
    let nomeCard = $(this).closest('.card').find('.author-name').text();
    $('.nome-alvo').text(nomeCard);
});

$(document).on('click', '.gorjeta-submit', function(){
    let urlpreco = 'http://dix.net.br/pagamento?amout=' + $('.g-price').val(); + '&user=' + cardGorjeta + '&idPost=1' + '&msg=' + $('.g-msg').val();
    window.location.href = urlpreco;
});

// HtmlEntities

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}


//URL DECODE
function urldecodepirata(url) {
    return decodeURIComponent(url.replace(/+/g, ' '));
  }