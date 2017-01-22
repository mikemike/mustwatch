$(document).ready(function() {
    $('#q').on('keyup', function() {
        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(search, 500);
        $(this).data('timer', wait);
    });

    function search() {
        $('#results').html('Loading...');
        
        $.ajax({
            url: '/search/ajax',
            data: {
                'q': $('#q').val()
            },
            success: function(data){
                console.log(data);

                $('#results').html('<div class="row is-flex"></div>');

                $.each(data.movies, function(i, v){
                    var html = '';
                    html+= '<div class="col-md-2">';
                    html+= '    <img src="'+ data.movies[i].poster +'">';
                    html+= '    <h2>'+ data.movies[i].title +'</h2>';
                    html+= '    <p class="text-muted">'+ data.movies[i].type +'</p>';
                    html+= '    <p>'+ data.movies[i].plot +'</p>';
                    html+= '</div>'+"\n\n";

                    $('#results .row').append(html);
                    console.log(v);
                });

            },
            error: function() {
                alert('error');
            }
        })
    }
});