//Atualizar contatos (novas menssagens)

// $(".contact-list").ready(function(){
//     setInterval(function(){

//         $.ajax({
//             url: form_url, 
//             method: "POST",
//             data: {
//                 nameOP: $(".nome-contato-chat").text(),
//                 contactName:"caiobrandini"
//             },   
//             // dataType: "json",  
//             cache: false,
//             success: function(resposta){
//             }
//         });

//     }, 1000)
// });



$(".chat-title-container").hide();
    $(".chat-right").hide();

    if(window.matchMedia("(max-width: 975px)").matches){
            $(".chat").hide();
    } 


    //contato slecionado
    $(".contato").click(function(){

        let contato = $(this);
        let imgContato = contato.children(".foto-contato").attr("src");
        let nameContato = contato.children(".contato-info").children(".contato-name").text();
        let listaContatos = $(".contato");


        listaContatos.each(function(){
            if($(this).css("background-color") == "rgb(245, 244, 244)"){
                $(this).css("background-color", "rgb(252, 252, 252)");
                return;
            }
        });

        $(this).css("background-color", "rgb(245, 244, 244)");

        var form_url = $(this).attr("action");

        $(".chat-title-container").html('<div class="d-flex chat-title-info"><img class="foto-perfil-contato" src='+imgContato+' alt="foto perfil contato"><p class="nome-contato-chat">'+nameContato+'</p></div>');
        $(".chat-title-container").show();
        $(".initial").hide();
        $(".chat-right").show();

        if($("body").width() < 975) {
            $(".contatos").hide();
            $(".chat").css("width","100%");
            $(".chat").show();
            $(".chat-title-container").append('<div class="btn-return-mob"> Voltar </div>');

            $(".btn-return-mob").click(function(){
                $(".contatos").show();
                $(".chat").css("width","0");
                $(".chat").hide();
                $(".chat-messages").unbind("ready");
                clearInterval(atualizaChat);
            });
        }

        $.ajax({
            url: form_url, 
            method: "POST",
            data: {
                nameOP: $(".nome-contato-chat").text(),
                contactName:"caiobrandini"
            },   
            // dataType: "json",  
            cache: false,
            success: function(resposta){
            }
        });


        //atualizar Chat

        $(".chat-messages").unbind("ready");
        $(".chat-messages").ready(function(){
        if (typeof atualizaChat !== 'undefined') clearInterval(atualizaChat);

        atualizaChat = setInterval(function(){
                var lastmsggrr = $(".message-content")[$(".message-content").length - 1];
                var lastmsg = $(".chat-messages").find(lastmsggrr).find("span").text();
                var chatId = $(".chat").attr("id");

                $.ajax({
                    url: form_url, 
                    method: "POST",
                    data: {
                        novaMenssagem: "",
                        ultimaMenssagem: lastmsg,
                        chatId: chatId
                    },   
                    // dataType: "json",  
                    cache: false,
                    success: function(resposta){
                        if(resposta.novaMenssagem != "" && resposta.novaMenssagem != undefined){
                            $(".chat-messages").append('<div class="my-message"><div class="message-content"><span>'+htmlEntities(resposta.novaMenssagem)+'</span></div></div>');
                        }
                    }
                });
            }, 300);

        });
        

    });

    






    $(document).ready(function(e) {
    
    //ao enviar mensagem
    $("form[ajax=true]").submit(function(e) {
        
        e.preventDefault();
        
        var form_data = $(this).serialize();
        let msg = $(".form-control").val();
        var form_url = $(this).attr("action");

        if(msg != "" && msg != " "){
            $.ajax({
            url: form_url, 
            method: "POST",
            data: {
                menssage: msg,
                nameOP: $(".nome-contato-chat").text()
            },   
            // dataType: "json",  
            cache: false,
            success: function(){

                //envia menssagem
                let msg = $(".form-control").val();
                $(".chat-messages").append('<div class="my-message"><div class="message-content"><span>'+htmlEntities(msg)+'</span></div></div>');


                //apagar valor do submit
                $(".form-control").val("");

                let messages = $(".chat-messages").children();
                let lastMessageDiv = messages[messages.length-1];

                let lastMessage = $(".chat-messages").find(lastMessageDiv).find(".message-content span").text();

                let listaContatos = $(".contato");

                listaContatos.each(function(){
                    if($(this).css("background-color") == "rgb(245, 244, 244)"){
                        
                        if(lastMessage.length > 16){
                            lastMessage = lastMessage.slice(0,16) + '...';
                        }

                        $(this).find(".contato-info p").text(lastMessage);
                        return;
                    }
                });
                
                //descer barra do chat
                $(".chat-messages").scrollTop(100000);


                //elevar contato
                listaContatos.each(function(){
                    if($(this).css("background-color") == "rgb(245, 244, 244)"){
                        $(this).remove();
                        $(".contact-list").prepend('<div class="contato" style="background-color: rgb(245, 244, 244)">'+$(this).html()+'</div>');
                    }
                });


            }           
        });    


        
        }

    });
    
});

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}