// Seguir

$(document).on('click', '.btn-profile-follow', follow);

$(document).on('click', '.btn-card-follow', follow);

function follow() {
    let thiss =  $(".btn-profile-follow");
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

var postEditado = "";

$(document).on('click', '.edit-post-drop', function(){
    let card = $(this).closest('.card');
    let cardId = card.attr('id');
    
    //$.ajax({
    // url:"app/Models/editarPost.php",
    // dataType: 'json',
    // type: "POST",
    // data: {
    //     id: cardId,
    //     descript: "",
    //     viewAuth: 0
    // },
    // success:function(result){
    //     //Result.id
    // },
    // error:function(req, status, error){
    //     window.alert(req);
    //     window.alert(status);
    //     window.alert(error);
    // }
    // });

});


$(document).on('click', '.delete-post-drop', function(){
    cardDel = $(this).closest('.card');
    $('#modal-del-post').modal('show');
});

$(document).on('click', '.btn-deletar-post', function(){

    let id = cardDel.attr('id');
    cardDel.remove();

    // $.ajax({
    // url:"app/Models/excluirPost.php",
    // dataType: 'json',
    // type: "POST",
    // data: {
    //     id: id
    // },
    // success:function(result){
    //      cardDel.remove();
    // },
    // error:function(req, status, error){
    //     window.alert(req);
    //     window.alert(status);
    //     window.alert(error);
    // }
    // });

    $('#modal-del-post').modal('hide');
});