<h1 id="user">?</h1>
<img id="userImg">
<img id="postImg">
<p id="description">?</p>
<p id="likes">?</p>
<p id="qtdComentarios">?</p>

<script>
    var postsVistosNav = []; //Evitar que haja posts repetidos
    var newPosts = $.ajax({
    url:"app/Models/Ajax/feed/newPosts.php",
    dataType: 'json',
    type: "POST",
    data: {email: <?php echo($_COOKIE['cUser']);?>,
        nameOp: "",
        data: "", 
        imgOp: "", 
        imgPost: "",
        postsVistos: postsVistosNav; 
        descricao: "", 
        likes: "",
        qtdComentarios: 0},
    success:function(result){
        $("#user").text(result.nameOp);
        $("#userImg").text(result.imgOp);
        $("#postImg").text(result.imgPost);
        $("#description").text(result.description);
        $("#likes").text(result.likes);
        $("#qtdComentarios").text(result.qtdComentarios);
    },
    error:function(req, status, error){
        window.alert(req);
        window.alert(status);
        window.alert(error);
    }
    });
</script>