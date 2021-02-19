
// Seguir

$(document).on('click', '.btn-card-follow', function(){

    var targetName = $(this).closest('.card').find('.author-name a').text();
    var btnFollow = $(this);

        $.ajax({
            url: 'app/Models/follow.php', 
            dataType: 'json',
            type: "POST",   
            data: {username: targetName},     
            cache: false,
            success: function(){
                if(btnFollow.hasClass("unfollow")){
                    btnFollow.css("background-color", "rgb(57, 132, 218)").css("color", "white").html('Seguindo <i class="fas fa-check check-follow-profile"></i>');
                    btnFollow.css("background-color", "rgb(45, 81, 122))").html('Seguindo <i style="margin-left:6px;" class="fas fa-check"></i>').toggleClass("unfollow");
                }

                else {
                    btnFollow.css("background-color", "transparent").css("color", "rgb(57, 132, 218)").text("Seguir");
                    btnFollow.css("background-color", "rgb(45, 81, 122))").html('seguir').toggleClass("unfollow");
                }
            }           
        });   
});

//loading gif

//new post gif

$(document).on('click', '#btn-final-new-post', function(){
    $('.loading-hidden').hide();
    $('.loading-new-post').html('<div class="modal-body"> <h5>Enviando...</h5> <div class="loading-container"> <img src="app/View/assets/css/img/loading.gif" style=""> </div></div>');
    $('.loading-footer-new-post').hide();
});


//Gorjeta

cardGorjeta = '';
$(document).on('click', '.btn-donate', function(){
    cardGorjeta = $(this).closest('.card').attr('id');
    let nomeCard = $(this).closest('.card').find('.author-name').text();
    $('.nome-alvo').text(nomeCard);
});

$(document).on('click', '.gorjeta-submit', function(){
    let urlpreco = 'https://dix.net.br/pagamento?amount=' + $('.g-price').val() + '&user=' + cardGorjeta + '&idPost=1' + '&msg=' + $('.g-msg').val();
    window.location.href = urlpreco;
});


//Buscar Pessoa

$(document).on('submit', '.buscar-pessoa-form', function(e){
    e.preventDefault();
    window.location.href = 'https://dix.net.br/profile/' + $('#input-novo-contato').val();
    $('#input-novo-contato').val('');
});

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
