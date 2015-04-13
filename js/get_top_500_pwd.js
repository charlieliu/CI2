$(document).ready(function(){
    $("#finder").val('frm1');
    $("#frm1_submit").click(function(event){
        event.preventDefault();
        alert($('#hash_str').val());
        pagenav(1);
    });
});