$(document).ready(function(){
    
    $grid = $('#results .row').isotope({
        itemSelector: '.col-md-2',
        getSortData: {
            year: '[data-year]',
            rating: '[data-rating]'
        },
        sortAscending: {
            year: false,
            rating: false
        }
    });

    // Filters
    var filters = {};
    $('.filters').on( 'click', 'button', function() {
        var group = $(this).parent().attr('class');

        // Handle button disables
        $('.filters .' + group + ' button').removeClass('disabled');      
        $(this).addClass('disabled');

        if($(this).attr('data-filter') == '*') {
            filters[ group ] = '*';
        } else {

            if(group == 'watched') {
                filters[ group ] = '[data-watched="'+ $(this).attr('data-filter') +'"]';
            } else {
                filters[ group ] = $(this).attr('data-filter');
            }

        }

        var filterValue = concatValues( filters );
        $grid.isotope({ filter: filterValue });
    });

    // Sortby
    $('.sort').on( 'click', 'button', function() {
        var group = $(this).parent().attr('class');

        // Handle button disables
        $('.sort button').removeClass('disabled');      
        $(this).addClass('disabled');
        
        $grid.isotope({ sortBy: $(this).attr('data-filter')});
    });

    // Re-apply fixes buggy layout
    setTimeout(function(){
        $grid.isotope()
    }, 100);
});

// flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
        value += obj[ prop ];
    }
    return value;
}