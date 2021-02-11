//Atualizar contatos (novas menssagens)

// $(".contact-list").ready(function(){
//     setInterval(function(){

//         $.ajax({
//             url: form_url, 
//             method: "POST",
//             data: {
//                 nameOP: $(".nome-contato-chat").text(),
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
    $(document).on('click', '.contato', function(){

        let contato = $(this);
        let imgContato = contato.children(".foto-contato").attr("src");
        let nameContato = contato.children(".contato-info").children(".contato-name").text();
        let listaContatos = $(".contato");

        //mudando para lido 
        if(contato.find('.contato-name').hasClass('naolido')){
            contato.find('.contato-name').removeClass('naolido');
            contato.find('.contact-last-message').removeClass('naolido');
        }


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


        //Carregar mensagens
        
        // var meuId = $('.me').attr('id');

        // $.ajax({
        //     url: form_url, 
        //     method: "POST",
        //     data: {
        //         contato: $(".nome-contato-chat").text(),
        //         username: meuId
        //     },   
        //     dataType: "json",  
        //     cache: false,
        //     success: function(resposta){
        //         let chat = resposta.mensagens;

        //         for(var i=0; i < chat.length; i++){
        //             if(chat[i][1] == 1) { //mensagem minha
        //                 $(".chat-messages").append('<div class="my-message"><div class="message-content"><span>'+htmlEntities(chat[i][0])+'</span> <div class="time"> '+ chat[i][2] +' </div> </div></div>');
        //             }
        //             else { //mensagem do outro
        //                 $(".chat-messages").append('<div class="your-message"><div class="message-content"><span>'+htmlEntities(chat[i][0])+'</span> <div class="time"> '+ chat[i][2] +' </div> </div></div>');
        //             }
        //         }

        //     }
        // });



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



    //Atualizar contatos 

    /*cria uma lista contendo os @ de todas os chats com mensagens não lidas,
    compara essa lista com o backend, se faltar algum nome recebe o novo contato e sua última msg*/
    
    
    /* 
        Resposta do backend:
        [][0] nome  
        [][1] ultima msg
        [][2] src foto perfil
     */ 

    $('.contact-list').ready(function(){

        var naolidos = [];
        var atualizaContatos = setInterval(function(){

            //atualiza lista contatos
            $('.contato-info').each(function(){
                let nomeContato = $(this).find('.contato-name');
                if(nomeContato.css('font-weight') == '500'){
                    if(naolidos.indexOf(nomeContato.text()) == -1) {
                        naolidos.push(nomeContato.text());
                    }
                }
            });

            console.log(naolidos);

            //envia lista e recebe novos contatos
        
    //         var meuId = $('.me').attr('id');        PEGA ID DA ANCORA PROFILE
    //         $.ajax({
    //             url: form_url, 
    //             method: "POST",
    //             data: {
    //                 naolidos: lnaolidos,
    //             },   
    //             // dataType: "json",  

    //             cache: false,
    //             success: function(resposta){


    //                 if(resposta.novoContato.length > 0){
    //                     for(var i=0; i<resposta.nomeContato.length; i++){
    //                         $('.contato').each(function(){
    //                             if($(this).find('.contato-name').text() == resposta.nomeContato[i][0]){
    //                                 $(this).remove();
    //                             }
    //                         });
    //                         $(".contact-list").prepend(' <div class="contato"> <img class="foto-contato" src="'+resposta.novoContato[i][2]+'" alt="foto de perfil"> <div class="contato-info"> <span class="contato-name" style="color: rgb(0, 0, 0); font-weight:500;">'+resposta.novoContato[i][0]+'</span> <p class="contact-last-message" style="color: rgb(0, 0, 0); font-weight:500;" >'+resposta.novoContato[i][1]+'</p></div></div>');
    //                     }
    //                 }
    //             }
    //         });

    //         console.log(naolidos);
        }, 3000);

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
                var data = new Date();
                let msg = $(".form-control").val();
                let horaAtual = data.getHours();
                if(horaAtual < 10) horaAtual = '0' + horaAtual;
                let minutoAtual = data.getMinutes();
                if(minutoAtual < 10) minutoAtual = '0' + minutoAtual;
                let horario = horaAtual + ':' + minutoAtual
                $(".chat-messages").append('<div class="my-message"><div class="message-content"><span>'+htmlEntities(msg)+'</span> <div class="time"> '+ horario +' </div> </div></div>');


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