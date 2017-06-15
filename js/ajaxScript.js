$(document).ready(function() {
    $('.content').on('click', '.load-movies', function(){
        var page = $(this).data('page');
        loadMovies(page);
    });
});

function loadMovies(page) {
    $.ajax({
        type: "POST",
        url: 'getMovies.php',
        data: 'page=' + page,
        cache: false,
        success: successFnc,
        dataType: 'html'//json
    });
}

function successFnc(data,status,xhr) {
    $('.load-movies').replaceWith(data);
}