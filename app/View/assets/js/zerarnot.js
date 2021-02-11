
$('.dropdown-toggle').click(function(){
    $(this).find('.badge-danger').text('0');
    $.ajax({
        url:"app/Models/zerarNotificacoes.php",
        dataType: 'json',
        type: "POST",
        data: {
            userID: dataUser // ID DO POST
        },
        success:function(result){
            console.log("Protocolo das Notificações: " + result.userID);
        }
    });
});