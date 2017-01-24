$(document).ready(function() {
    $('#q').on('keyup', function() {
        clearTimeout($.data(this, 'timer'));
        var wait = setTimeout(function(){
            var qval = $('#q').val();
            window.history.pushState(null, null, '/search?q=' + qval);
            search();
        }, 500);
        $(this).data('timer', wait);
    });

    function search() {
        var qval = $('#q').val();
        $('#results').html('Loading...');
        
        $.ajax({
            url: '/search/ajax',
            data: {
                'q': qval
            },
            success: function(data){
                console.log(data);
                $('#results').html('<div class="row is-flex"></div>');

                $.each(data.movies, function(i, v){
                    var html = '';
                    html+= '<div class="col-md-2 fadein">';
                    html+= '    <div class="movie">';
                    html+= '        <img src="'+ data.movies[i].poster +'">';
                    html+= '        <h2>'+ data.movies[i].title +'</h2>';
                    html+= '        <p class="text-muted">'+ data.movies[i].type +'</p>';
                    html+= '        <p class="btn-area"><a href="' + ( (data.logged_in == false) ? '/login?r=' + location.href : 'javascript:void(0);') + '" class="btn btn-primary btn-sm btn-block btn-add">Add to watch</a></p>';
                    html+= '    </div>';
                    html+= '</div>'+"\n\n";

                    $('#results .row').append(html);
                });

            },
            error: function() {
                alert('error');
            }
        })
    }

    if($('#q').val().length != 0) {
        search();
    }
});