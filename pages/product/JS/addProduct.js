function setTwoNumberDecimal(el) {
    el.value = parseFloat(el.value).toFixed(2);
};

var selectedProdType;
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
	
	$("select#productType").change(function(){
        selectedProdType = $(this).children("option:selected").val();
    });

	$.ajax({
		url: 'PHPcode/getProductTypes_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let arr = JSON.parse(data);
			let options="";
			let formView="";
			let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				options+="<option value='"+arr[k]["PRODUCT_TYPE_ID"]+"' >"+arr[k]["TYPE_NAME"]+"</option>";
			}
			$("#productType").append(options);
			
		}
		else
		{
			alert("Error");
		}
	});
});

$("button#addProduct").on('click', event => {
	event.preventDefault();
	let form=$('#addProductForm');
	form.validate();
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		let productName = $("#productName").val();
		let productDescription = $("#productDescription").val();
		let unitsInCase = $("#unitsInCase").val();
		let casesInPallet = $("#casesInPallet").val();
		let costPrice = $("#costPrice").val();
		let discountPrice = $("#discountPrice").val();
		let sellingPrice = $("#sellingPrice").val();
		let measurement = $("#productMeasurement").val();
		let measurementUnit = $("#productMeasurementUnit").val();
		let productType = selectedProdType;

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
				$('.loadingModal').modal('show');
	    	}
		})
		.done(response => {
			closeModal();
			console.log(response);
			if (response == "success")
			{
				$('#MHeader').text("Success!");
				$("#MMessage").text("Product added sucessfully");
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$("#btnClose").attr("onclick","window.location='../../product.php'");
				$("#displayModal").modal("show");
			}
			else if(response == "product name exists")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("This product already exists");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
			else if(response == "databaseError")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("Error adding product");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
			
			ajaxDone = true;
		});
	}	
});

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}

