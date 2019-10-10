var selectedProdType;
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
});

$("button#maintainProductType").on('click', event => {
	event.preventDefault();
	let form = $('#maintainProductTypeForm');
	form.validate();
	if(form.valid() === false)
	{
		event.stopPropagation();
	}
	else
	{
		let productTypeID = $("#ProductTypeID").val();

		let productTypeName = $("#productTypeName").val();
		let productTypeDescription = $("#productTypeDescription").val();

		let prevProductTypeName = $("#previousTypeName").val();
		let prevProductTypeDescription = $("#previousDescription").val();

		$.ajax({
			url: 'PHPcode/maintainProductType_.php',
			type: 'POST',
			data: { 
				productTypeID_ : productTypeID,
				productTypeName_ : productTypeName,
				productTypeDescription_ : productTypeDescription,
				prevProductTypeName_ : prevProductTypeName,
				prevProductTypeDescription_ : prevProductTypeDescription
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
				$("#MMessage").text("Product type maintained sucessfully");
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$("#btnClose").attr("onclick","window.location='../../product.php'");
				$("#displayModal").modal("show");
			}
			else if(response == "product type exists")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("A product type with the same name already exists");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
			else if(response == "no changes made")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("You have not made any changes to the product type");
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

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}

