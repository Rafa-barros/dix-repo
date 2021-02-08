
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
    
