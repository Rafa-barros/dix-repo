//Adicionar contato GET
if(window.location.href.split('username=')[1] != undefined){

    var usernameGET = window.location.href.split('username=')[1];

    $.ajax({
        url: 'app/Models/chatMsg.php', 
        method: "POST",
        data: {
            username: usernameGET,
            funcao: 'novoChat',
            mensagens: []
        },   
        dataType: "json",  
        cache: false,
        success: function(resposta){

            let listaContatos = $(".contato");
            listaContatos.each(function(){
                if($(this).find('.contato-name').text() == resposta.mensagens[0]){
                    $(this).remove();
                    return false;
                }
            })
            $(".contact-list").prepend(' <div class="contato"> <img class="foto-contato" src="'+resposta.mensagens[2]+'" alt="foto de perfil"> <div class="contato-info"> <span class="contato-name">'+resposta.mensagens[0]+'</span> <p class="contact-last-message" id="'+resposta.mensagens[3].replace(' ', '/')+'">'+resposta.mensagens[1]+'</p></div></div>');
            
        }

    });
}


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

        $(".chat-title-container").html('<div class="d-flex chat-title-info"><img class="foto-perfil-contato" src='+imgContato+' alt="foto perfil contato"><a href="https://dix.net.br/profile/'+nameContato+'" class="nome-contato-chat">'+nameContato+'</a></div>');
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

        //Apagar mensagens anteriores
        $('.chat-messages').html(' ');


        //Carregar mensagens

        $.ajax({
            url: 'app/Models/chatMsg.php', 
            method: "POST",
            data: {
                username: $(".nome-contato-chat").text(),
                funcao: 'carregarMensagens',
                mensagens: [[]]
            },   
            dataType: "json",  
            cache: false,
            success: function(resposta){
                let chat = resposta.mensagens;

                for(var i=0; i < chat.length; i++){
                    if(chat[i][1] == 1) { //mensagem minha
                        if(chat[i][3] != 0) $(".chat-messages").append('<div class="nova-data-msg"> <span>'+chat[i][2].slice(0,10).replaceAll('-','/')+'</span> </div>');
                        $(".chat-messages").append('<div class="my-message"><div class="message-content"><span>'+htmlEntities(chat[i][0])+'</span> <div class="time"> '+ separaTempo(chat[i][2]) +' </div> </div></div>'); 

                    }
                    else { //mensagem do outro
                        if(chat[i][3] != 0) $(".chat-messages").append('<div class="nova-data-msg"> <span>'+chat[i][2].slice(0,10).replaceAll('-','/')+'</span> </div>');
                        $(".chat-messages").append('<div class="your-message"><div class="message-content"><span>'+htmlEntities(chat[i][0])+'</span> <div class="time" id="' +chat[i][2].replace(' ','/')+'"> '+ separaTempo(chat[i][2]) +' </div> </div></div>');
                        
                    }
                }
                $('.chat-messages').scrollTop(1000000);
            }
        });



        //atualizar Chat

        $(".chat-messages").unbind("ready");
        $(".chat-messages").ready(function(){
        if (typeof atualizaChat !== 'undefined') clearInterval(atualizaChat);

        atualizaChat = setInterval(function(){
                var lastmsggrr = $(".your-message")[$(".your-message").length - 1];
                var lastmsg = $(".chat-messages").find(lastmsggrr).find("span").text();
                var targetUser = $('.nome-contato-chat').text();
                var lastDate = $(".chat-messages").find(lastmsggrr).find(".time").attr('id');

                if(lastmsg == undefined) lastmsg = "";
                if(lastDate == undefined) lastDate = "";

                $.ajax({
                    url: 'app/Models/attMsg.php', 
                    method: "POST",
                    data: {
                        username: targetUser,
                        mensagem: lastmsg,
                        msgDate: lastDate.replace('/',' '),
                        newMsg: []
                    },   
                     dataType: "json",  
                    cache: false,
                    success: function(resposta){
                        //[0] mensagem
                        //[1] Tempo
                
                        if(resposta.newMsg != null){
                            let msgTime = separaTempo(resposta.newMsg[1])
                            $(".chat-messages").append(' <div class="your-message"> <div class="message-content"> <span>'+htmlEntities(resposta.newMsg[0])+'</span> <div class="time" id="' +resposta.newMsg[1].replace(' ','/')+'" > '+ msgTime +' </div></div></div>');
                            $('.chat-messages').scrollTop(1000000);
                        }
                    }
                });
            }, 450);

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
        [][3] horário da msg
     */ 

    $('.contact-list').ready(function(){

        var contactList = [[]];
        var atualizaContatos = setInterval(function(){
            contactList = [[]];

            //atualiza lista contatos
            $('.contato-info').each(function(){
                let nomeContato = $(this).find('.contato-name').text();
                let lastmsg = $(this).find('.contact-last-message').text();
                let time = $(this).find('.contact-last-message').attr('id');

                let contato = [nomeContato, lastmsg, time];
                contactList.push(contato);
            });

            console.log(contactList);

            //envia lista e recebe novos contatos
        
            $.ajax({
                url: 'app/Models/attChats.php', 
                method: "POST",
                data: {
                    chatsCarregados: contactList,
                    newChats: [[]]
                },   
                dataType: "json",  

                cache: false,
                success: function(resposta){
                    let negrito = '';

                    if(resposta.newChats != null){
                        for(var i=0; i<resposta.newChats.length; i++){
                            negrito = '';
                            if(resposta.newChats[i][1].length > 16){
                                resposta.newChats[i][1] = resposta.newChats[i][1].slice(0,16) + '...';
                            }
                            $('.contato').each(function(){
                                if($(this).find('.contato-name').text() == resposta.newChats[i][0]){
                                    $(this).remove();
                                }
                            });
                            if(resposta.newChats[i][4] == "0" && resposta.newChats[i][5] == 0){
                              negrito = ' naolido';  
                            } 
                            
                            $(".contact-list").prepend(' <div class="contato"> <img class="foto-contato" src="'+resposta.newChats[i][2]+'" alt="foto de perfil"> <div class="contato-info"> <span class="contato-name'+negrito+'">'+resposta.newChats[i][0]+'</span> <p class="contact-last-message'+negrito+'" id="'+resposta.newChats[i][3].replace(' ', '/')+'" >'+resposta.newChats[i][1]+'</p></div></div>');

                        }
                    }
                }
            });

        }, 1000);

    });


    $(document).ready(function(e) {
    


    //ao enviar mensagem
    $("form[ajax=true]").submit(function(e) {
        
        e.preventDefault();
        
        let msg = $(".form-control").val();

        if(msg != "" && msg != " "){
            $.ajax({
            url: 'app/Models/sendMsg.php', 
            method: "POST",
            data: {
                message: msg,
                username: $(".nome-contato-chat").text()
            },   
            dataType: "json",  
            cache: false,
            success: function(){

                //envia mensagem
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

    $(document).on('click', '.tentarNovamente', function(){
        $('.modal-footer').html('<button type="submit" class="btn btn-primary new-chat-btn">Entrar em contato</button>');
        $('.modal-body').html(' <div class="input-group mb-2 mt-2"> <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">@</span> </div><input type="text" id="input-novo-contato" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1"> </div>');
    });

    //adicionar novo contato
    $(document).on('submit', '.new-chat-form', function(e){
        e.preventDefault();
        var newUser = $('#input-novo-contato').val();
        $('#input-novo-contato').val('');
        $('#new-chat-modal').modal('hide');

        $.ajax({
            url: 'app/Models/chatMsg.php', 
            method: "POST",
            data: {
                username: newUser,
                funcao: 'novoChat',
                mensagens: []
            },   
            dataType: "json",  
            cache: false,
            success: function(resposta){

                if(resposta.mensagens == null){
                    setTimeout(function(){
                        $('#new-chat-modal').modal('show');
                    }, 1000);
                    $('.modal-body').html('<span>Contato não encontrado...</span>');
                    $('.modal-footer').html('<div class="btn btn-primary tentarNovamente">Tentar novamente</div>');
                }
                else{
                    let listaContatos = $(".contato");
                    listaContatos.each(function(){
                        if($(this).find('.contato-name').text() == resposta.mensagens[0]){
                            $(this).remove();
                            return false;
                        }
                    })
                    $(".contact-list").prepend(' <div class="contato"> <img class="foto-contato" src="'+resposta.mensagens[2]+'" alt="foto de perfil"> <div class="contato-info"> <span class="contato-name">'+resposta.mensagens[0]+'</span> <p class="contact-last-message" id="'+resposta.mensagens[3].replace(' ', '/')+'">'+resposta.mensagens[1]+'</p></div></div>');
                }
            }

        });

        
    });
    
});

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function separaTempo(fullTime){
    return fullTime.split(' ')[1].slice(0, 5);
}
