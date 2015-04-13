$(document).ready(function(){
    $("#finder").val('frm1');
    $("#frm1_submit").click(function(event){
        event.preventDefault();
        pagenav(1);
    });
    $("#frm1_reset").click(function(event){
        event.preventDefault();
        $('#frm1')[0].reset();
        pagenav(1);
    });
    $('#pageNow').change(function(){
        var pg = parseInt( $(this).val() ), pgcnt = parseInt( $('#pageCnt').html() );
        if( pg<=1 ) pg=1;
        if( pg>pgcnt ) pg=pgcnt ;
        pagenav(pg);
    });
});