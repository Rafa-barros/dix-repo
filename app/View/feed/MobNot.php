<nav class="nav">
    <a class="a-logo-dix" href="/feed"><img class="logo-dix" src="/app/View/assets/css/img/logo_blue.png" alt="logo"></a> 
    <div class="features-containers">
        <a href=<?php echo("\"" . "profile/" . $username . "\""); ?>><i class="fas fa-user"></i></a>
        <a href="/feed"><i class="fas fa-home"></i></a> 
        <a href="/chat" class="i-c"><i class="fas fa-comments"></i></a>
    </div>
</nav>
<div class="not-container">

<?php
                if ($tam > 0){
                    for ($i = 0; $i<$tam; $i++){
                        switch ($notificacoes[$i]['type']){
                            case 0:
                                echo ('<div class="notificacao">
                                <span>  <i class="fas fa-fire-alt like-icon"></i><a href="">' . $notificacoes[$i]['username'] . '</a>  curtiu a sua publicação! </span>
                            </div>');
                                break;
                            case 1:
                                echo ('<div class="notificacao">
                                <span> <i class="far fa-comment comment-icon"></i><a href="">' . $notificacoes[$i]['username'] . '</a> comentou na sua publicação! </span>
                            </div>  ');
                                break;
                            case 2:
                                echo ('<div class="notificacao" style="display: block;">
                                <i class="fas fa-coins coin-icon"></i>
                                <span> <a href="">' . $notificacoes[$i]['username'] . '</a>  te deu <b>' . $notificacoes[$i]['amount'] . '</b> de gorjeta! </span>
                                <div class="d-flex">
                                    <span class="gorjeta-msg">mensagem: ' . $notificacoes[$i]['msg'] . '.</span>
                                </div>
                            </div>');
                                break;
                        }
                    }
                } else {
                    echo ('<a class="dropdown-item waves-effect waves-light notificacao" href="#"> Você não tem nenhuma nova notificação</a>');
                }
                ?>

</div>

<script>
    $.ajax({
        url:"app/Models/zerarNotificacoes.php",
        dataType: 'json',
        type: "POST",
        data: {
            data: dataUser // ID DO POST
        },
        success:function(result){
            console.log("Protocolo das Notificações: " + result.data);
        }
    });
</script>