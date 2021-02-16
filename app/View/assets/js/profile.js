
    $(document).on('click', '#btn-logout', function(){

        $.ajax({
            dataType: 'json',
            method: "POST",
            url: "../app/Models/logout.php",    
            data: {logout: 1},     
            cache: false,
            success:function(){
              window.location.href = "http://dix.net.br";
            }        
        });
        
    });

    if(window.matchMedia("(max-width: 530px)").matches){
        $(".btn-profile-message-o").hide();
    } 

//Redirecionar notficações mobile

$('.fa-bell').click(function(){
    if(window.matchMedia("(max-width: 800px)").matches){
        location.replace("/mobNot");
    } 
});

//Área lateral

    if(window.matchMedia("(max-width: 1250px)").matches){
        $(".profile-l-content").hide();
    } 

// Seguir

$(document).on('click', '.btn-profile-follow', follow);

$(document).on('click', '.btn-card-follow', follow);

function follow() {
    let thiss =  $(".btn-profile-follow");
    let profuser = window.location.href.split('/')[4];

    $.ajax({
        url: '../app/Models/follow.php', 
        dataType: 'json',
        type: "POST",   
        data: {username: profuser},     
        cache: false,

    });

    if(!thiss.hasClass('seguindo')){
        let nfollowers = $(".nfollowers").text();
        thiss.css("background-color", "rgb(57, 132, 218)").css("color", "white").html('Seguindo <i class="fas fa-check check-follow-profile"></i>').addClass('seguindo');
        $(".btn-card-follow").css("background-color", "rgb(45, 81, 122))").html('Seguindo <i style="margin-left:6px;" class="fas fa-check"></i>');
        $(".nfollowers").text((parseInt(nfollowers)+ 1).toString() );
    }
    
    else {
        let nfollowers = $(".nfollowers").text();
        thiss.css("background-color", "transparent").css("color", "rgb(57, 132, 218)").text("Seguir").removeClass('seguindo');
        $(".btn-card-follow").css("background-color", "rgb(45, 81, 122))").html('seguir');
        $(".nfollowers").text((parseInt(nfollowers)- 1).toString() );
    }

}

postEditado = "";

$(document).on('click', '.edit-post-drop', function(){
    postEditado = $(this).closest('.card');
});

$(document).on('click', '.btn-send-post-edit', function(){
    let cardId = postEditado.attr('id');
    let pago = $('input:checked').val();
    let editPostDescrption = $('.new-post-description').val();
    let editPostPrice = $('.post-price').val();
    
    $.ajax({
        url: '../app/Models/editarPost.php', 
        dataType: 'json',
        type: "POST",   
        data: {
            id: cardId, 
            descript: editPostDescrption, 
            price: editPostPrice,
            viewAuth: pago, 
        },     
        cache: false,
        success: function(){
            location.reload();
        }
                
    });   

});


$(document).on('click', '.delete-post-drop', function(){
    cardDel = $(this).closest('.card');
    $('#modal-del-post').modal('show');
});

$(document).on('click', '.btn-deletar-post', function(){

    let id = cardDel.attr('id');
    cardDel.remove();

    $.ajax({
    url:"../app/Models/excluirPost.php",
    dataType: 'json',
    type: "POST",
    data: {
        id: id
    },
    success:function(){
         cardDel.remove();
    },
    error:function(req, status, error){
        window.alert(req);
        window.alert(status);
        window.alert(error);
    }
    });

    $('#modal-del-post').modal('hide');
});

$('#gorjeta-profile').click(function(e){
    $('.nome-alvo').text($('.prof-name').text());
});

$('.btn-profile-message-o').click(function(){
    let username = window.location.href.split('/')[4];
    window.location.href = 'http://dix.net.br/chat?username='+username;
});