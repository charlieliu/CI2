function colorful()
{
    $('.content_value').each(function(){
        if( $(this).html()=='1' )
        {
            $(this).css('color','blue');
        }
        else if( $(this).html()=='0' )
        {
            $(this).css('color','red');
        }
    });
}

$(document).ready(function(){

    colorful();

    $('#seach').off('click').on('click',function(){
        $.post(
            "",
            {'str':$('#str').val()},
            function( data ) {
                $('#grid_view').html( data.grid_view );
                colorful();
            },
            'json'
        );
    });
});