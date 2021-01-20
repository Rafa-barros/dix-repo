<h1 id="user">?</h1>
<img id="userImg">
<img id="postImg">
<p id="description">?</p>
<p id="likes">?</p>
<p id="qtdComentarios">?</p>

<form method="post">
    
</form>

<script>
    var newPosts = $.ajax({
    url:"app/Models/newPosts.php",
    dataType: 'json',
    type: "POST",
    data: {email: "joatanzinho",
        nameOp: "",
        data: "", 
        imgOp: "", 
        imgPost: "",
        postsVistos: postsVistosNav, 
        descricao: "", 
        likes: "",
        codigo: 200,
        idPost: 0,
        qtdComentarios: 0
    },
    success:function(result){
        $("#user").text(result.nameOp);
        $("#postImg").text(result.imgPost);
        $("#description").text(result.description);
        $("#likes").text(result.likes);
        $("#qtdComentarios").text(result.qtdComentarios);
        $("#userImg").attr("src", result.imgOp);
        postsVistosNav[postsVistosNav.length] = result.idPost;
    },
    error:function(req, status, error){
        window.alert(req);
        window.alert(status);
        window.alert(error);
    }
    });
</script>