$(document).ready(function(){
    $('li').click(function(){
        var str = '';
        str += 'data-animal-type / '+$(this).attr('data-animal-type')+'<br>';
        $('#results').html(str);
    });
});