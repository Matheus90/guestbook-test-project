
refreshStarUI = function(rating){
    $("#reviewStars .fa-star").removeClass('active');
    $("#reviewStars .fa-star:lt("+rating+")").addClass('active');
};

loadPage = function(page){
    var count = $("#pagination-count").val();

    var url = '/guestbook?page='+page+'&count='+count;
    history.pushState(null, null, url);
    $.get(url, function(data){
        $("#review-container").replaceWith($(data).find("#review-container"));
    });
};

pageMove = function(action){
    var page = $("#review-pagination").data('page');
    var pageCount = $("#review-pagination").data('pagecount');

    if( action == 'prev' && page > 1 ){
        page--;
    } else if( action == 'next' && page < pageCount ){
        page++;
    } else
        return;

    var count = $("#pagination-count").val();
    var url = '/guestbook?page='+page+'&count='+count;
    history.pushState(null, null, url);
    $.get(url, function(data){
        $("#review-container").replaceWith($(data).find("#review-container"));
    });
}

refreshReviews = function(elementsToReplace, callback){
    var page = $("#review-pagination").data('page');
    var count = $("#pagination-count").val();

    var url = '/guestbook?page='+page+'&count='+count;
    history.pushState(null, null, url);
    $.get(url, function(data){
        for(var i = 0; i < elementsToReplace.length; i++){
            $(elementsToReplace[i]).html($(data).find(elementsToReplace[i]).html());
        }

        if( typeof callback == 'function')
            callback();
    });
};


addLoadingIndicator = function(container){
    var loading = $('<div class="load-spinner-bg"></div>');
    $(container).append(loading);
    $(loading).animate({
        opacity: 1
    }, 300);
};

removeLoadingIndicator = function(container){
    $(container).find('.load-spinner-bg').remove();
};


$("#page-guestbook").on('mouseenter', "#reviewStars .fa-star", function(e){
    var rating = $(e.target).index() + 1;

    refreshStarUI(rating);
});

$("#page-guestbook").on('mouseleave', "#reviewStars .fa-star", function(e){
    var rating = $("#reviewRating").val();

    refreshStarUI(rating);
});

$("#page-guestbook").on('click', "#reviewStars .fa-star", function(e){
    var rating = $(e.target).index() + 1;

    refreshStarUI(rating);
    $("#reviewRating").val(rating);
});


onChangeItemCount = function(e){
    var count = $(e.target).val();

    console.log(count);

    if( $.isNumeric(count) ){
        console.log('number');
        loadPage(1);
    }
}

$("#page-guestbook").on({
    change: onChangeItemCount
}, "#pagination-count");


$("#page-guestbook").on('submit', "#review-form", function(e){
    e.preventDefault();

    addLoadingIndicator("#review-form-container");

    $.ajax({
        url: "/post-review",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: 'JSON',
        complete: function(response){
            var data = response.responseJSON;

            if( data == 'success' ){
                console.log('success', data);

                setTimeout(function(){
                    var hash = "#review-container";

                    var scTop = $(hash).offset().top - 120;
                    console.log(scTop);

                    $('html, body').animate({
                        scrollTop: scTop
                    }, 300, function(){
                        window.location.hash = hash;
                        setTimeout(function(){
                            refreshReviews(["#review-container", "#review-form-container", "#avg-rating"], function(){
                                $(hash+' .review-box:first-child').hide().fadeIn(1000);
                            });
                        }, 200);
                    });

                }, 500);

            } else if( data.errors != undefined ){
                console.log('error', data);
                $('#review-form .form-group').removeClass('error');
                for(let i = 0; i < data.errors.length; i++ ){
                    let attr = data.errors[i];
                    console.log(attr);
                    $('#review-form .form-group.'+attr).addClass('error');
                }
                removeLoadingIndicator("#review-form-container");
            }
        }
    });
});

