$(document).ready(function() {
    $('#q').on('keypress change', function(){
        source: $.ajax({
            url: '/search/ajax',
            data: {
                'q': $('#q').val()
            },
            success: function(data){
                console.log(data);
            },
            error: function() {
                alert('error');
            }
        })
    });
});