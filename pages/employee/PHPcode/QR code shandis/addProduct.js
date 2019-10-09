$(document).ready(function(){
    $("#productType").change(function(){
    	console.log("Clicked");
        var selectedProdType = $(this).children("option:selected").val();
    });
});

$("button#addProduct").on('click', event => {
	event.preventDefault();
	console.log("clicked");
	let form=$('#addProductForm');
	form.validate();
	console.log($("#productType").filter(":selected").attr("value").val());
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		let productName = $("#productName").val();
		let productDescription = $("#productDescription").val();
		let productType = $("#productType").find(":selected").attr("value").val();
		let unitsInCase = $("#unitsInCase").val();
		let casesInPallet = $("#casesInPallet").val();
		let costPrice = $("#costPrice").val();
		let discountPrice = $("#discountPrice").val();
		let sellingPrice = $("#sellingPrice").val();
		let measurement = $("#productMeasurement").val();
		let measurementUnit = $("#productMeasurementUnit").val();

		console.log(productType);

		$.ajax({
			url: 'PHPcode/addProduct_.php',
			type: 'POST',
			data: { 
				productName_ : productName,
				productDescription_ : productDescription,
				productType_ : productType,
				unitsInCase_ : unitsInCase,
				casesInPallet_ : casesInPallet,
				costPrice_ : costPrice,
				discountPrice_ : discountPrice,
				sellingPrice_ : sellingPrice,
				measurement_ : measurement,
				measurementUnit_ : measurementUnit
			},
			beforeSend: function() {
	
	    	}
		})
		.done(response => {
			console.log(response);
			if (response == "success") 
			{
				$('#modal-title-default').text("Success!");
				$('#modalText').text("Product added sucessfully");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "databaseError")
			{
				$('#modal-title-default').text("Error!");
				$('#modalText').text("Error adding product");
				$('#successfullyAdded').modal("show");
			}
			ajaxDone = true;
		});
	}	
});

