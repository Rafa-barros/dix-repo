<h1 id="user">?</h1>
<img id="userImg">
<img id="postImg">
<p id="description">?</p>
<p id="likes">?</p>
<p id="qtdComentarios">?</p>

<form method="post" enctype="multipart/form-data">
    <!-- 
        - Deve ter uma caixa pra dar upload de arquivo sendo um desses: 'jpg', 'jpeg', 'png', 'mp4', 'avi', 'webp', 'gif'
        - Input text com a descrição do post: <input type="submit" name="descricao" value="Descrição">
        - Uma select box de input pra indicar se vai ser allow view (0 pra não, 1 pra sim em que name="postLiberado")
        - Um select ou input text com o valor de preço, caso seja post pago (atributo do elemento: name="valor")
     -->
    <input type="file" name="arquivo"><br>
    <input type="text" name="descriptPost"><br>
    <input type="radio" id="pago" name="postLiberado" value="0">
	<label for="pago">pago</label><br>
	<input type="radio" id="publico" name="postLiberado" value="1">
	<label for="publico">público</label><br>
    <input type="number" min="1" step="any" name="valor"/>
    <input type="submit" name="enviar">
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
        liked: 0,
        valor: 0,
        gorjetas: 0,
        idPost: 0,
        qtdComentarios: 0,
        comentarios: [[]]
    },
    success:function(result){
        $("#user").text(result.nameOp);
        $("#postImg").text(result.imgPost);
        $("#description").text(result.descricao);
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