
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

//post pago

cardpago = '';

$(document).on('click', '.pago', function(){
    cardpago = $(this).closest('.card');

    let classes = cardpago.attr('class').split(' ');
    let preco = 0;
    for(var i=0; i<classes.length; i++){
        if(isNumber(classes[i])) preco = classes[i];
    }
    $('.btn-preco-post').text(preco + 'R$');
    $('#modal-pago').modal('show');

});

$(document).on('click', '.btn-preco-post', function(){
    let urlpreco = 'http://dix.net.br/pagamento?amout=' + $('.btn-preco-post').text() + '&user=' + cardpago.attr('id') + '&user=1'
    window.location.href = urlpreco;
});


//Buscar Pessoa

$(document).on('submit', '.buscar-pessoa-form', function(e){
    e.preventDefault();
    window.location.href = 'http://dix.net.br/profile/' + $('#input-novo-contato').val();
    $('#input-novo-contato').val('');
});

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}
