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
                    if(data.logged_in == false) {
                        html+= '        <p class="btn-area"><a href="/login" class="btn btn-primary btn-sm btn-block">Login to Add</a></p>';
                    } else {
                        if(data.movies[i].has_added == false) {
                            html+= '        <p class="btn-area"><a href="javascript:void(0);" class="btn btn-success btn-sm btn-block btn-add" data-on-list="0" data-id="'+ data.movies[i].id +'">Add to Watch</a></p>';
                        } else {
                            html+= '        <p class="btn-area"><a href="javascript:void(0);" class="btn btn-danger btn-sm btn-block btn-add" data-on-list="1" data-id="'+ data.movies[i].id +'">Remove from Watch</a></p>';
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

    if($('#q').val().length != 0) {
        search();
    }

    // Wants to add 
    $(document).on('click', '.btn-add', function() {
        $(this).addClass('disabled').html('Loading...');

        var $btn = $(this);
        var onlist = $btn.attr('data-on-list');
        var movieid = $btn.attr('data-id');

        if(onlist == '0') {
            // Add to watch list for the user
            $.ajax({
                url: '/ajax/add_movie_to_watch',
                data: {
                    'movie_id': movieid
                },
                success: function(d) {
                    if(typeof d.error !== 'undefined') {
                        alert(d.error)
                        $btn.html('Add to Watch').removeClass('disabled');
                    } else if (d.logged_in == false) {
                        location.href = '/login';
                    } else if(d.success == true) {
                        console.log('Added ' + movieid);
                        $btn.html('Remove from Watch').removeClass('btn-success disabled').addClass('btn-danger').attr('data-on-list', 1);
                    } else {                        
                        alert('Sorry, there was a problem adding that item to your watch list.  Please try again.');
                        $btn.html('Add to Watch').removeClass('disabled');
                    }
                },
                error: function(e) {
                    alert('Sorry, there was a problem adding that item to your watch list.  Please try again.');
                    $btn.html('Add to Watch').removeClass('disabled');
                }
            });
        } else {
            // Remove from watch list 
            $.ajax({
                url: '/ajax/remove_movie_from_watch',
                data: {
                    'movie_id': movieid
                },
                success: function(d) {
                    if(typeof d.error !== 'undefined') {
                        alert(d.error)
                        $btn.html('Remove from Watch').removeClass('disabled');
                    } else if (d.logged_in == false) {
                        location.href = '/login';
                    } else if(d.success == true) {
                        console.log('Removed ' + movieid);
                        $btn.html('Add to Watch').removeClass('btn-danger disabled').addClass('btn-success').attr('data-on-list', 0);
                    } else {                        
                        alert('Sorry, there was a problem removing that item to your watch list.  Please try again.');
                        $btn.html('Remove from Watch').removeClass('disabled');
                    }
                },
                error: function(e) {
                    alert('Sorry, there was a problem adding that item to your watch list.  Please try again.');
                    $btn.html('Add to Watch').removeClass('disabled');
                }
            });
        }
    });
});