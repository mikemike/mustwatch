$(document).ready(function(){
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
                        $btn.html('Add to your list').removeClass('disabled');
                    } else if (d.logged_in == false) {
                        location.href = '/login';
                    } else if(d.success == true) {
                        console.log('Added ' + movieid);
                        $btn.html('Remove from your list').removeClass('btn-success disabled').addClass('btn-danger').attr('data-on-list', 1);

                        // Is this a button group that should contain a "Mark as watched" button?
                        if($btn.hasClass('add-mark-watched')) {
                            $btn.parent().prepend('<a href="javascript:void(0);" class="btn btn-info btn-mark-watched" data-is-watched="0" data-id="' + movieid + '">Mark as watched</a>');
                        }
                    } else {                        
                        alert('Sorry, there was a problem adding that item to your watch list.  Please try again.');
                        $btn.html('Add to your list').removeClass('disabled');
                    }
                },
                error: function(e) {
                    alert('Sorry, there was a problem adding that item to your watch list.  Please try again.');
                    $btn.html('Add to your list').removeClass('disabled');
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
                        $btn.html('Remove from your list').removeClass('disabled');
                    } else if (d.logged_in == false) {
                        location.href = '/login';
                    } else if(d.success == true) {
                        console.log('Removed ' + movieid);
                        $btn.html('Add to your list').removeClass('btn-danger disabled').addClass('btn-success').attr('data-on-list', 0);

                        // Is this a button group that should contain a "Mark as watched" button?
                        if($btn.hasClass('add-mark-watched')) {
                            $btn.parent().find('.btn-mark-watched').remove();
                        }
                    } else {                        
                        alert('Sorry, there was a problem removing that item to your watch list.  Please try again.');
                        $btn.html('Remove from your list').removeClass('disabled');
                    }
                },
                error: function(e) {
                    alert('Sorry, there was a problem adding that item to your watch list.  Please try again.');
                    $btn.html('Add to your list').removeClass('disabled');
                }
            });
        }
    });


    // Wants to mark as watched 
    $(document).on('click', '.btn-mark-watched', function() {
        $(this).addClass('disabled').html('Loading...');

        var $btn = $(this);
        var iswatched = $btn.attr('data-is-watched');
        var movieid = $btn.attr('data-id');

        if(iswatched == '0') {
            // Mark as watched
            $.ajax({
                url: '/ajax/mark_watched',
                data: {
                    'movie_id': movieid
                },
                success: function(d) {
                    if(typeof d.error !== 'undefined') {
                        alert(d.error)
                        $btn.html('Mark as watched').removeClass('disabled');
                    } else if (d.logged_in == false) {
                        location.href = '/login';
                    } else if(d.success == true) {
                        console.log('Marked ' + movieid);
                        $btn.html('Mark as not-watched').removeClass('btn-info disabled').addClass('btn-warning').attr('data-is-watched', 1);
                    } else {                        
                        alert('Sorry, there was a problem marking that item as watched.  Please try again.');
                        $btn.html('Mark as watched').removeClass('disabled');
                    }
                },
                error: function(e) {
                    alert('Sorry, there was a problem marking that item as watched.  Please try again.');
                    $btn.html('Mark as watched').removeClass('disabled');
                }
            });
        } else {
            // Remove from watch list 
            $.ajax({
                url: '/ajax/mark_unwatched',
                data: {
                    'movie_id': movieid
                },
                success: function(d) {
                    if(typeof d.error !== 'undefined') {
                        alert(d.error)
                        $btn.html('Mark as not-watched').removeClass('disabled');
                    } else if (d.logged_in == false) {
                        location.href = '/login';
                    } else if(d.success == true) {
                        console.log('Unmarked ' + movieid);
                        $btn.html('Mark as watched').removeClass('btn-warning disabled').addClass('btn-info').attr('data-is-watched', 0);
                    } else {                        
                        alert('Sorry, there was a problem marking that item as not-watched.  Please try again.');
                        $btn.html('Mark as not-watched').removeClass('disabled');
                    }
                },
                error: function(e) {
                    alert('Sorry, there was a problem marking that item as not-watched.  Please try again.');
                    $btn.html('Mark as not-watched').removeClass('disabled');
                }
            });
        }
    });
});