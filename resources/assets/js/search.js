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
                    html+= '        <img src="'+ data.movies[i].poster +'" class="poster" onerror="imgError(this);">';
                    html+= '        <a href="/title/'+ data.movies[i].slug +'/' + data.movies[i].id +'"><h2>'+ data.movies[i].title +'</h2></a>';
                    html+= '        <p class="text-muted">'+ data.movies[i].type +'</p>';
                    if(data.logged_in == false) {
                        html+= '        <p class="btn-area"><a href="/login" class="btn btn-primary btn-sm btn-block">Login to Add</a></p>';
                    } else {
                        if(data.movies[i].has_added == false) {
                            html+= '        <p class="btn-area"><a href="javascript:void(0);" class="btn btn-success btn-sm btn-block btn-add" data-on-list="0" data-id="'+ data.movies[i].id +'">Add to your list</a></p>';
                        } else {
                            html+= '        <p class="btn-area"><a href="javascript:void(0);" class="btn btn-danger btn-sm btn-block btn-add" data-on-list="1" data-id="'+ data.movies[i].id +'">Remove from your list</a></p>';
                        }                        
                    }
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

    if($('#q').length) {
        if($('#q').val().length != 0) {
            search();
        }
    }
});