$(document).ready(function(){
    $("#contact1").submit(function() {
        $.ajax({
            type: "POST",
            url: '',
            data:$("#contact1").serialize(),
            success: function (data) {
                // Inserting html into the result div on success
                $('#results').html(data);
            },
            error: function(jqXHR, text, error){
                // Displaying if there are any errors
                $('#result').html(error);
            }
        });
        return false;
    });
});