$(document).ready(function(){
	$(".redis_test").submit(function(event) {
		if( event.preventDefault ) event.preventDefault ; else event.returnValue=false ;
		$.ajax({
			url: URLs,
			type: "POST",
			data:$(this).serialize(),
			dataType: "json"
		}).done(function(response){
			//$('#results').html(response.result);
			alert(response.result);
		});
		return false;
	});
});