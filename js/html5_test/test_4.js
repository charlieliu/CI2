$(document).ready(function(){

    $('#c').val($('#a').val());

    $('#a').change(function(){$('#c').val(parseInt($('#a').val()))});

    $('#d').change(function(){$('#g').val(parseInt($('#d').val())+parseInt($('#f').val()))});
});