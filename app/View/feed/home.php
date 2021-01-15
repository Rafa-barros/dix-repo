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
        idPost: "",
        postsVistos: postsVistosNav; 
        descricao: "", 
        likes: "",
        codigo: "", 
        qtdComentarios: 0},
    success:function(result){
        
    },
    error:function(){
        console.log("O servidor não encontrou o usuário");
    }
    });
</script>