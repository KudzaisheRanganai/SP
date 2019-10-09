var productForm;
var NAME;
var PRODUCT_GROUP_ID;
var UNITS_PER_CASE;
var CASES_PER_PALLET;
var INDIVIDUAL_QUANTITY;
var CASES_QUANTITY;
var PALLETS_QUANTITY;
var COST_PRICE;
var GUIDE_DISCOUNT;
var SELLING_PRICE;
var PRODUCT_MEASUREMENT;
var PRODUCT_MEASUREMENT_UNIT;
var PRODUCT_TYPE_ID;
var TYPE_NAME;
var PRODUCT_DESCR;
var SIZE_TYPE_ID;

$(()=>{
	NAME = $('input[name=NAME]').val();
	PRODUCT_GROUP_ID = $('input[name=PRODUCT_GROUP_ID]').val();
	UNITS_PER_CASE = $('input[name=UNITS_PER_CASE]').val();
	CASES_PER_PALLET = $('input[name=CASES_PER_PALLET]').val();
	INDIVIDUAL_QUANTITY = $('input[name=INDIVIDUAL_QUANTITY]').val();
	CASES_QUANTITY = $('input[name=CASES_QUANTITY]').val();
	PALLETS_QUANTITY = $('input[name=PALLETS_QUANTITY]').val();
	COST_PRICE = $('input[name=COST_PRICE]').val();
	GUIDE_DISCOUNT = $('input[name=GUIDE_DISCOUNT]').val();
	SELLING_PRICE = $('input[name=SELLING_PRICE]').val();
	PRODUCT_MEASUREMENT = $('input[name=PRODUCT_MEASUREMENT]').val();
	PRODUCT_MEASUREMENT_UNIT = $('input[name=PRODUCT_MEASUREMENT_UNIT]').val();
	PRODUCT_TYPE_ID = $('input[name=PRODUCT_TYPE_ID]').val();
	TYPE_NAME = $('input[name=TYPE_NAME]').val();
	PRODUCT_DESCR = $('input[name=PRODUCT_DESCR]').val();
	SIZE_TYPE_ID = $('input[name=SIZE_TYPE_ID]').val();

	productForm = $('#productForm');
	//Maintain Product
	$("button#maintainProduct").on('click', event => {
		event.preventDefault();
		$("#productForm").attr("action","maintain.php");
		$("#productForm" ).submit();
	});

	//Convert Pallet
	$("button#convertPallet").on('click', event => {
		event.preventDefault();
		$('input[name=SIZE_TYPE_ID]').attr("value","3");
		let productID=parseInt(PRODUCT_GROUP_ID)+2;
		$('input[name=PRODUCT_ID]').attr("value",productID);
		$("#productForm").attr("action","../stock/convert.php");
		$("#productForm" ).submit();
	});

	//Writeofff Pallet
	$("button#writeOffPallet").on('click', event => {
		event.preventDefault();
		$('input[name=SIZE_TYPE_ID]').attr("value","3");
		let productID=parseInt(PRODUCT_GROUP_ID)+2;
		$('input[name=PRODUCT_ID]').attr("value",productID);
		$("#productForm").attr("action","../stock/writeoff.php");
		$("#productForm" ).submit();
	});

	//Convert Case
	$("button#convertCase").on('click', event => {
		event.preventDefault();
		$('input[name=SIZE_TYPE_ID]').attr("value","2");
		let productID=parseInt(PRODUCT_GROUP_ID)+1;
		$('input[name=PRODUCT_ID]').attr("value",productID);
		$("#productForm").attr("action","../stock/convert.php");
		$("#productForm" ).submit();
	});

	//Writeoff Case
	$("button#writeOffCase").on('click', event => {
		event.preventDefault();
		$('input[name=SIZE_TYPE_ID]').attr("value","2");
		let productID=parseInt(PRODUCT_GROUP_ID)+1;
		$('input[name=PRODUCT_ID]').attr("value",productID);
		$("#productForm").attr("action","../stock/writeoff.php");
		$("#productForm" ).submit();
	});

	//Writeoff Individual
	$("button#writeOffIndividual").on('click', event => {
		event.preventDefault();
		$('input[name=SIZE_TYPE_ID]').attr("value","1");
		let productID=parseInt(PRODUCT_GROUP_ID);
		$('input[name=PRODUCT_ID]').attr("value",productID);
		$("#productForm").attr("action","../stock/writeoff.php");
		$("#productForm" ).submit();
	});

	//Delete Product
	$("button#deleteProduct").on('click', event => {
		event.preventDefault();
		console.log(PRODUCT_GROUP_ID);
				$.ajax({
				url: 'PHPcode/deleteProduct_.php',
				type: 'POST',
				data: { 
					PRODUCT_NAME_ : NAME,
					PRODUCT_GROUP_ID_ : PRODUCT_GROUP_ID,
					UNITS_PER_CASE_ : UNITS_PER_CASE
				},
				beforeSend: function() {
		
		    	}
			})
			.done(response => {
				console.log(response);
				if (response == "T,Product Deleted Successfully")
				{
					$('#modal-title-default-deleteModal').text("Success!");
					$('#modalText').text("Product Deleted Successfully");
					$('#modal-delete').modal("show");
				}
				else if(response == "F,SYSTEM RESTRICT: This Product cannot be deleted from the system")
				{
					$('#modal-title-default-deleteModal').text("Error!");
					$('#modalText').text("This Product cannot be deleted from the system");
					$("#modalCloseButton").attr("onclick","");
					$('#modal-delete').modal("show");
				}
				else if(response == "databaseError")
				{
					$('#modal-title-default-deleteModal').text("Error!");
					$('#modalText').text("Database error deleting product");
					$("#modalCloseButton").attr("onclick","");
					$('#modal-delete').modal("show");
				}
				
				ajaxDone = true;
			});
	});
});


