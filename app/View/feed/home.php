<h1 id="user">?</h1>
<img id="userImg">
<img id="postImg">
<p id="description">?</p>
<p id="likes">?</p>
<p id="qtdComentarios">?</p>

<script>
    var newPosts = $.ajax({
    url:"app/Models/Ajax/feed/newPosts.php",
    dataType: 'json',
    type: "POST",
    data: {email: <?php echo($_COOKIE['cUser']);?>, 
        imgOp: "", 
        imgPost: "", 
        descricao: "", 
        likes: "", 
        qtdComentarios: 0},
    success:function(result){
        
    },
    error:function(){
        console.log("O servidor não encontrou o usuário");
    }
    });
</script>