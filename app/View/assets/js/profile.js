// Seguir

$(".btn-profile-follow").click(follow);

$(".btn-card-follow").click(follow);

function follow() {
    let thiss =  $(".btn-profile-follow");
    if(thiss.css("background-color") != "rgb(57, 132, 218)"){
        let nfollowers = $(".nfollowers").text();
        thiss.css("background-color", "rgb(57, 132, 218)").css("color", "white").html('Seguindo <i class="fas fa-check check-follow-profile"></i>');
        $(".btn-card-follow").css("background-color", "rgb(45, 81, 122))").html('Seguindo <i style="margin-left:6px;" class="fas fa-check"></i>');
        $(".nfollowers").text((parseInt(nfollowers)+ 1).toString() );
    }
    
    else {
        let nfollowers = $(".nfollowers").text();
        thiss.css("background-color", "transparent").css("color", "rgb(57, 132, 218)").text("Seguir");
        $(".btn-card-follow").css("background-color", "rgb(45, 81, 122))").html('seguir');
        $(".nfollowers").text((parseInt(nfollowers)- 1).toString() );
    }
}

var postEditado = "";

$(".edit-post-drop").click(function(){
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


$(".delete-post-drop").click(function(){
    cardDel = $(this).closest('.card');
    $('#modal-del-post').modal('show');
});

$(".btn-deletar-post").click(function(){

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