var selectedProdType;
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});

	$("button#addProductType").on('click', event => {
		event.preventDefault();
		let form = $('#addProductTypeForm');
		form.validate();
		if(form.valid() === false)
		{
			event.stopPropagation();
		}
		else
		{
			console.log('starting AJAX');
			let productTypeName = $("#productTypeName").val();
			let productTypeDescription = $("#productTypeDescription").val();

			$.ajax({
				url: 'PHPcode/addProductType_.php',
				type: 'POST',
				data: { 
					productTypeName_ : productTypeName,
					productTypeDescription_ : productTypeDescription
				},
				beforeSend: function() {
		
		    	}
			})
			.done(response => {
				console.log(response);
				if (response == "success")
				{
					$('#MHeader').text("Success!");
					$("#MMessage").text("Product Type added sucessfully");
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick","window.location='../../product.php'");
					$("#displayModal").modal("show");
				}
				else if(response == "product type exists")
				{
					$('#MHeader').text("Error!");
					$("#MMessage").text("This product type already exists");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
				}
				else if(response == "database error")
				{
					$('#MHeader').text("Error!");
					$("#MMessage").text("Error adding product type");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
				}
				
				ajaxDone = true;
			});
		}	
	});

});



