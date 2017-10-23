
$(document).scroll(function(){
    topShadowTrigger();
});

$('body').scrollspy({target: '#nav-top', offset: 80});

$("ul.nav li a[href^='#']").on('click', function(e) {

    // prevent default anchor click behavior
    e.preventDefault();

    // store hash
    var hash = this.hash;
    var bodyTopPadding = hash != '#top' ? parseFloat($('#top').css('height')) : 0;

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