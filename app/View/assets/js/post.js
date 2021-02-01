$('.comment-area').hide();

// Botão de like

$('.btn-like').click(function (){
        var likeIcon = document.querySelectorAll('.btn-like')[0];

        if($(this).css("color") == "rgb(0, 0, 0)") $(this).css("color", "rgb(218, 51, 51)");
        else $( this ).css( "color", "rgb(0, 0, 0)" );

        var card = $(this).parents(".card")
        text = card.find(".nlikes").text();
        if($(this).css("color") == "rgb(0, 0, 0)"){
        card.find(".nlikes").text((parseInt(text.split()[0])+ 1).toString() + " curtidas");
        } 
        else {card.find(".nlikes").text((parseInt(text.split()[0])- 1).toString() + " curtidas")}

    });


// Comentário

$('.btn-comment').click(function (){
    var commentArea = $(this).parents(".card").find('.comment-area');
    commentArea.show();
    let idPost = $(this).parents(".card").attr("id");
    var form_url = $(this).attr("action");

    // $.ajax({
    //     url: form_url,    
    //     data: {idPost: idPost, comentarios: [], nomesComentarios:[]},     
    //     cache: false,
    //     success: function(resposta){
    //         comentarios = resposta.comentarios;
    //         pessoas = resposta.nomes;
    //         let a = comentarios.length;
    //         if(a > 10) a = 10;

    //         for(var i = 0; i<=a; i++){
    //             commentArea.prepend(' <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">'+pessoas[i]+'</a></span>'+comentarios[i]+'</p></div><div class="a-comment">');
    //         }
    //     }           
    // });   
    
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
                var i = 0;
                
                while (result.comentarios[i][0] !== ""){
                    commentArea.prepend(' <div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">'+result.comentarios[i][0]+'</a></span>'+result.comentarios[i][1]+'</p></div><div class="a-comment">');
                    if (i == 10){
                        break;
                    }
                    i++;
                }
            },
            error:function(req, status, error){
                window.alert(req);
                window.alert(status);
                window.alert(error);
            }
            });
        */

});


$(document).ready(function(e) {
    
    $("form[ajax=true]").submit(function(e) {
        
        e.preventDefault();
        
        var form_data = $(this).serialize();
        var form_url = $(this).attr("action");
        
        var card = $(this).parents(".card");
        var commentInput = card.find(".comment-input").val();
        var newComment = '<div class="a-comment"> <p class="r-comment"> <span class="a-username"><a href="">CaioBrandini</a></span>'+ htmlEntities(commentInput) +'</p> </div>';

        $.ajax({
            url: form_url,    
            data: form_data,     
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

// HtmlEntities

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
