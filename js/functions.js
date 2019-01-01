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

$(".submit").on('submit', function(e){	
	e.preventDefault();

	var count, TypeLevels, Type;
	count = $(this).find('#cardCount').val();
	TypeLevels = $(this).find('#cardTypeLevels').val();
	Type = $(this).find('#cardType').val();
	
	var $form = $(this);
	var $inputs = $form.find("input, select, button");

	var serializedData = $form.serialize();

	request = $.ajax({
        url: "calculator.php",
        type: "post",
        data: serializedData
    });

	request.done(function (response, textStatus, jqXHR){
        // Log a message to the console        
        console.log(response);
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });
});

