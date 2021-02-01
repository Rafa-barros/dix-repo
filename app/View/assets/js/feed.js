

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






    // Caruso

    // var newPosts = $.ajax({
    // url:"app/Models/newPosts.php",
    // dataType: 'json',
    // type: "POST",
    // data: {email: "joatanzinho",
    //     nameOp: "", //Dono do post
    //     data: "", 
    //     imgOp: "", //Imagem do dono do post
    //     imgPost: "", //Imagem do post
    //     postsVistos: postsVistosNav, 
    //     descricao: "", 
    //     likes: "",
    //     liked: 0,
    //     valor: 0,
    //     gorjetas: 0,
    //     idPost: 0,
    //     qtdComentarios: 0,
    //     comentarios: [[]]
    // },
    // success:function(result){
    //     $("#donoDoPost").text(result.nameOp);
    //     $("#postImg").text(result.imgPost);
    //     $("#description").text(result.descricao);
    //     $("#likes").text(result.likes);
    //     $("#qtdComentarios").text(result.qtdComentarios);
    //     $("#userImg").attr("src", result.imgOp);
    //     postsVistosNav[postsVistosNav.length] = result.idPost;
    // },
    // error:function(req, status, error){
    //     window.alert(req);
    //     window.alert(status);
    //     window.alert(error);
    // }
    // });

    // var editarPost = $.ajax({
    // url:"app/Models/editarPost.php",
    // dataType: 'json',
    // type: "POST",
    // data: {
    //     id: "" //SUBSTITUIR COM VARIAVEL DO POST
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

    // var apagarPost = $.ajax({
    // url:"app/Models/excluirPost.php",
    // dataType: 'json',
    // type: "POST",
    // data: {
    //     id: "" //SUBSTITUIR COM VARIAVEL DO POST
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