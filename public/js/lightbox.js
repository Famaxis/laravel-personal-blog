$(document).ready(function() {
    // Load lightbox observers
    imgObserver();
});

// Display image lightbox
function imgObserver() {
    $("article img").click(function() {

        console.log("Image tapped. Source " + $(this).attr("src"));

        $('body').prepend(" \
            <div class='lightbox-display'> \
                <img class='lightbox-content' src='"+ $(this).attr("src") +"'> \
            </div>\
        ");
        $( ".lightbox-display" ).fadeIn();
        $( ".lightbox-content" ).fadeIn();


        // $("#lightbox-display").show();
        lightboxObserver();
    });
}

// Close lightbox when no longer needed
function lightboxObserver()
{
    $(".lightbox-display").click(function() {
        console.log("Closing lightbox.");
        $( ".lightbox-display" ).fadeOut();
        $( ".lightbox-content" ).fadeOut();
        // $(".lightbox-display").remove();
    });
}