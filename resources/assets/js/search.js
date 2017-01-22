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
                
                html = '';
                html+= '<img src="'+ data.movies.poster +'"><br>';
                html+= '<h1>'+ data.movies.title +'</h1>';
                html+= '<p class="text-muted">'+ data.movies.type +'</p>';
                html+= '<p>'+ data.movies.plot +'</p>';

                $('#results').html(html);
            },
            error: function() {
                alert('error');
            }
        })
    }
});