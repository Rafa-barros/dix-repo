<div class="card">
    <div class="card-top">
        <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
        <div class="author-info">
            <p class="author-name"> <a href="">Caio Brandini</a></p>
            <p class="post-time"> 34 min </p>
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
                 <p class="r-comment"> <span class="a-username"><a href="">Marcus13</a></span> Lorem ipsum dolor sit amet consectetur adipisicing.p>
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

<div class="card">
    <div class="card-top">
        <a href=""><img class="profile-image" src="/app/View/assets/css/img/Caio.jpg" alt="Foto perfil"></a>
        <div class="author-info">
            <p class="author-name"> <a href="">Caio Brandini</a></p>
            <p class="post-time"> 12h </p>
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

<script>

// $(".comment-input").on("change paste keyup", function() {
//    if($(this).val()!="") $(this).css("background-color", "red");
// });

$('.comment-area').hide();

//Botão de like

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

    $('.btn-comment').click(function (){
        var card = $(this).parents(".card").find('.comment-area').show();
    });


//Teste comentário

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

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

</script>

<!-- 
    By: Caio C. Brandini da Silva - 2021

    Linkedin: https://www.linkedin.com/in/caiobrandini/
-->