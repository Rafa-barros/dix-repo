<h1 id="user">?</h1>
<img id="userImg">
<img id="postImg">
<p id="description">?</p>
<p id="likes">?</p>
<p id="qtdComentarios">?</p>

<form method="post">
    <!-- 
        - Deve ter uma caixa pra dar upload de arquivo sendo um desses: 'jpg', 'jpeg', 'png', 'mp4', 'avi', 'webp', 'gif'
        - Input text com a descrição do post: <input type="submit" name="descricao" value="Descrição">
        - Uma select box de input pra indicar se vai ser allow view (0 pra não, 1 pra sim em que name="postLiberado")
        - Um select ou input text com o valor de preço, caso seja post pago (atributo do elemento: name="valor")
     -->
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
        valor: 0,
        gorjetas: 0,
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