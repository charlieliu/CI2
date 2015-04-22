$(document).ready(function(){
	$(".redis_test").submit(function() {
		event.preventDefault();
		$.ajax({
			url: URLs,
			type: "POST",
			data:$(this).serialize(),
			dataType: "json"
		}).done(function(response){
			//$('#results').html(response.result);
			alert(response.result);
		});
	});
});