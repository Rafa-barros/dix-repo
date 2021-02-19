
$('#gerarToken').click(function(){
    var infos = [];
    $('.form-control').each(function(){
        infos.push($(this).val()); 
    });

    $('.my-info').each(function(index){
        console.log(index);
        $(this).text(infos[index]);
    }); 
});

$('#btn-cartao-salvo').click(function(){
    $('#modal-confirm').modal('show');
});

    //Redirecionar notficações mobile

    $('.fa-bell').click(function(){
        if(window.matchMedia("(max-width: 800px)").matches){
            location.replace("/mobNot");
        } 
    });
    
//caruso

        //Armazena o SenderHash num input escondido
        $("#nCartao").on("click", function(){
            PagSeguroDirectPayment.onSenderHashReady(function(response){
                if(response.status == 'error') {
                    console.log(response.message);
                    return false;
                }
                $("#senderHash").val(response.senderHash);
            });
        });

        $("#nCartao").change(function(){
            
            //Pega a bandeira do cartão
            if ($("#nCartao").val().length > 14){
                PagSeguroDirectPayment.getBrand({
                    cardBin: $("#nCartao").val(),
                    success: function(response) {
                        var bandeira = response['brand']['name'];
                        $("#bandeira").text(bandeira);
                        $("#brand").val(bandeira);
                    },
                    error: function(response) {
                        //tratamento do erro
                    },
                    complete: function(response) {
                      //tratamento comum para todas chamadas
                    }
                });
            }
        });

        $("#gerarToken").click(function(){
            //Cria o token do cartão quando terminá-lo
            PagSeguroDirectPayment.createCardToken({
                    cardNumber: $("#nCartao").val(),
                    brand: $("#bandeira").text(),
                    cvv: $("#cvv").val(),
                    expirationMonth: $("#monthVal").val(),
                    expirationYear: $("#yearVal").val(),
                    success: function(response) {
                        console.log(response);
                        $("#tk").text(response.card.token);
				        $("#tokenCard").text(response.card.token);
                        $("#tokenCard").attr('value', response.card.token);
                    },
                    error: function(response) {
                        console.log("Erro no Token do cartão: " + response);
                    },
                    complete: function(response) {
                         // Callback para todas chamadas.
                    }
                });   
        });