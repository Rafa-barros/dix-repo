
// Seguir

$(document).on('click', '.btn-card-follow', function(){
    if($(this).hasClass("unfollow")){
        //seguir
        $(this).css("background-color", "rgb(57, 132, 218)").css("color", "white").html('Seguindo <i class="fas fa-check check-follow-profile"></i>');
        $(this).css("background-color", "rgb(45, 81, 122))").html('Seguindo <i style="margin-left:6px;" class="fas fa-check"></i>').toggleClass("unfollow");
    }
    
    else {
        //deixar de seguir
        $(this).css("background-color", "transparent").css("color", "rgb(57, 132, 218)").text("Seguir");
        $(this).css("background-color", "rgb(45, 81, 122))").html('seguir').toggleClass("unfollow");
        
    }
});



