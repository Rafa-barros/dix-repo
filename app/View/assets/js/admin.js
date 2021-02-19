
var id = '';
$(document).on('click', '.btn-pagar', function(){
    if(!($(this).hasClass('pago'))) $(this).closest('td').html('<button type="button" class="btn btn-outline-info pago">Pago</button>');
        id = $(this).closest('tr').find('th').text();

    $.ajax({
        url: 'app/Models/zerarGanhos.php', 
        method: "POST",
        data: {
            id: parseInt(id)
        },   
         dataType: "json",  
        cache: false,
    });

});

