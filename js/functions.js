$("#cardType").on('change', function(e){
	var cardTypes;
	cardTypes = $(this).val();
	$.ajax({
	    type: "POST",
	    data: {
	      cardType: cardTypes
	    },
	    url: "calculator.php",
	    dataType: "html",
	    async: false,
	    success: function(data) {
	    	console.log(data);
	    	$('#cardTypeLevels').each( function() {
	       		$(this).html(data);
	   		});
	  }
	});
});
