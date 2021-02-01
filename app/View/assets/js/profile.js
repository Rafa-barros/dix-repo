// Seguir

$(".btn-profile-follow").click(follow);

$(".btn-card-follow").click(follow);

function follow() {
    let thiss =  $(".btn-profile-follow");
    if(thiss.css("background-color") != "rgb(57, 132, 218)"){
        let nfollowers = $(".nfollowers").text();
        thiss.css("background-color", "rgb(57, 132, 218)").css("color", "white").html('Seguindo <i class="fas fa-check check-follow-profile"></i>');
        $(".btn-card-follow").css("background-color", "rgb(45, 81, 122))").html('Seguindo <i style="margin-left:6px;" class="fas fa-check"></i>');
        $(".nfollowers").text((parseInt(nfollowers)+ 1).toString() );
    }
    
    else {
        let nfollowers = $(".nfollowers").text();
        thiss.css("background-color", "transparent").css("color", "rgb(57, 132, 218)").text("Seguir");
        $(".btn-card-follow").css("background-color", "rgb(45, 81, 122))").html('seguir');
        $(".nfollowers").text((parseInt(nfollowers)- 1).toString() );
    }
}
