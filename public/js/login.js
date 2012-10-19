$(document).keyup(function(e) {

    if(e.keyCode == 27){
        $('.the-password').slideUp();
    }

});
$(document).ready(function() {

    myPassword          = "hola";
    password            = $('input#password');
    usuario             = $("input#username");
    shieldPassword  = $('.the-password');
    
    $('.the-username').mouseover(function() {
        if(shieldPassword.css('display') == "none")
            $(this).addClass('the-username-focus');
        
    }).click(function() {
        shieldPassword.slideToggle();
        usuario.focus();
        
    });
    $('form').submit(function(e) {
        // e.preventDefault();
        if(password.val() == "" || usuario.val() == "") {
            options = {distance: 10, times: 2};
            $('.login').effect('shake', options, 35, function() {
                if(usuario.val()=="") {
                    usuario.focus();
                    
                }else if(password.val()==""){
                    password.focus();
                    
                }else{
                    usuario.focus();
                }
            });
            return false;
        } else {
            $(this).submit();
        }
        return false;
    });

    $('.try-again').click(function() {
        shieldPassword.slideToggle();
        usuario.focus();

    });

    var susp_up = $("div#suspender_up");

    susp_up.css({
            'width':document.width,
            'height':document.height + 200
        }).fadeIn();
    $('.suspender').click(function(){

        susp_up.fadeIn();
    });
    // susp_up.click(function(){ $(this).fadeOut()});

    // susp_up.mouseover(function(){ $(this).fadeOut()});
});