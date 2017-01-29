$(document).ready(function(){
    
    $grid = $('#results .row').isotope({
        itemSelector: '.col-md-2',
    });

    $('.filters').on( 'click', 'button', function() {
        $('.filters button').removeClass('disabled');
        $(this).addClass('disabled');

        if($(this).attr('data-filter') == '*') {
            var filterValue = '*';
        } else {
            var filterValue = '.'+ $(this).attr('data-filter');
        }
        $grid.isotope({ filter: filterValue });
    });
})