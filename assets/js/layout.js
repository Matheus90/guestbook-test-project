
$(document).scroll(function(){
    topShadowTrigger();
});


$("ul.nav li a[href^='#'], #nav-top > a.navbar-brand").on('click', function(e) {

    // prevent default anchor click behavior
    e.preventDefault();

    // store hash
    var hash = this.hash;
    var bodyTopPadding = hash != '#top' ? parseFloat($('#top').css('height'))+60 : 0;

    // animate
    $('html, body').animate({
        scrollTop: $(hash).offset().top - bodyTopPadding
    }, 300, function(){
        window.location.hash = hash;
    });

});

topShadowTrigger = function(){
    if( document.body.scrollTop > 20 )
        $('#nav-top-bg').addClass('scrolled');
    else
        $('#nav-top-bg').removeClass('scrolled');
};

topShadowTrigger();