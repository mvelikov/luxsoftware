$(document).ready(function(){

    // Blur images on mouse over
    $(".portfolio a").hover(function(){ 
        $(this).children("img").animate({
            opacity: 0.75
        }, "fast"); 
    }, function(){ 
        $(this).children("img").animate({
            opacity: 1.0
        }, "slow"); 
    }); 
	
 //navigation sticky
    $("nav").sticky({
        topSpacing:0
    });
});