$(document).ready(function(){
    $('li').click(function(){
        var str = '';
        $(this).each(function() {
            $.each(this.attributes, function() {
                // this.attributes is not a plain object, but an array
                // of attribute nodes, which contain both the name and value
                if(this.specified) {
                    console.log(this.name, this.value);
                    str += this.name+' => ('+typeof(this.value)+')'+this.value+'<br>';
                }
            });
        });
        $('#results').html(str);
    });
});