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
		if(data!= false)
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

			var oldProductTypeID = $('input[name=PRODUCT_TYPE_ID]').val();
			$("#productType option[value='"+oldProductTypeID+"']").attr('selected','selected');
			selectedProdType = oldProductTypeID;
		}
		else
		{
			alert("Error");
		}
	});

	var oldMeasurementUnit = $('input[name=PRODUCT_MEASUREMENT_UNIT]').val();
	$("#productMeasurementUnit option[value='"+oldMeasurementUnit+"']").attr('selected','selected');
	 
});

$("button#maintainProduct").on('click', event => {
	event.preventDefault();
	let form = $('#maintainProductForm');
	form.validate();
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		var productGroupID = $('input[name=PRODUCT_GROUP_ID]').val();
		var prevProductName = $('input[name=NAME]').val();
		var prevUnitsPerCase = $('input[name=UNITS_PER_CASE]').val();
		var prevCasesPerPallet = $('input[name=CASES_PER_PALLET]').val();
		var prevCostPrice = $('input[name=COST_PRICE]').val();
		var prevGuideDiscount = $('input[name=GUIDE_DISCOUNT]').val();
		var prevSellingPrice = $('input[name=SELLING_PRICE]').val();
		var prevProductMeasurement = $('input[name=PRODUCT_MEASUREMENT]').val();
		var prevProductMeasurementUnit = $('input[name=PRODUCT_MEASUREMENT_UNIT]').val();
		var prevProductTypeID = $('input[name=PRODUCT_TYPE_ID]').val();
		var prevProductDescription = $('input[name=PRODUCT_DESCR]').val();
		

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
			url: 'PHPcode/maintainProduct_.php',
			type: 'POST',
			data: { 
				productGroupID_ : productGroupID,
				prevProductName_ : prevProductName,
				prevUnitsPerCase_ : prevUnitsPerCase,
				prevCasesPerPallet_ : prevCasesPerPallet,
				prevCostPrice_ : prevCostPrice,
				prevGuideDiscount_ : prevGuideDiscount,
				prevSellingPrice_ : prevSellingPrice,
				prevProductMeasurement_ : prevProductMeasurement,
				prevProductMeasurementUnit_ : prevProductMeasurementUnit,
				prevProductTypeID_ : prevProductTypeID,
				prevProductDescription_ : prevProductDescription,
				productName_ : productName,
				productDescription_ : productDescription,
				productTypeID_ : productType,
				unitsInCase_ : unitsInCase,
				casesInPallet_ : casesInPallet,
				costPrice_ : costPrice,
				discountPrice_ : discountPrice,
				sellingPrice_ : sellingPrice,
				measurement_ : measurement,
				measurementUnit_ : measurementUnit
			}
		})
		.done(response => {
			console.log(response);
			if (response == "success")
			{
				$('#MHeader').text("Success!");
				$("#MMessage").text("Product maintained sucessfully");
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$("#btnClose").attr("onclick","window.location='../../product.php'");
				$("#displayModal").modal("show");
			}
			else if(response == "product exists")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("A product with the changed name already exists");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
			else if(response == "no changes made")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("You have not made any changes to the product");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
			else if(response == "database error")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("Database error");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
			
			ajaxDone = true;
		});
	}	
});

