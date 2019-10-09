var productID;
var warehouseProduct;
var filterProduct;
var warehouseID;
var sizeType=[];
sizeType[1]="Individual";
sizeType[2]="Case";
sizeType[3]="Pallet";
let preLoadDestinationWarehouse = function(num)
{
	let dW=$("#destinationWarehouse");
	let wOption=$("<option></option>").addClass("classDestination");
	wOption.attr("name",warehouseProduct[num]["WAREHOUSE_ID"]);
	wOption.text(warehouseProduct[num]["NAME"]);
	dW.append(wOption);
}
$(()=>{
	productID=$("#pID").text();
	let sizeID=parseInt($("#sizeID").text());
	$("#sType").text(sizeType[sizeID]);
	warehouseProduct=JSON.parse($("#warehouseP").text());
	if(warehouseProduct==false)
	{
		$('#MHeader').text("Error!");
		$("#MMessage").text("There are no products to writeoff for this product. Please choose another product.");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#btnClose").attr("onclick","window.location='../../stock.php'");
		$("#displayModal").modal("show");
	}
	else
	{
		warehouseID=warehouseProduct[0]["WAREHOUSE_ID"];
		console.log(productID);
		console.log(warehouseProduct);
		filterProduct=warehouseProduct.filter(element=>element["WAREHOUSE_ID"]==warehouseID);
		$("#writeoffQty").attr("max",filterProduct[0]["QUANTITY"]);
		$("#writeoffQty").val(1);
		for(let k=0;k<warehouseProduct.length;k++)
		{
			preLoadDestinationWarehouse(k);
		}
	}
	$("#destinationWarehouse").on('change',function(e){
		e.preventDefault();
		warehouseID=$(this).children(":selected").attr("name");
		filterProduct=warehouseProduct.filter(element=>element["WAREHOUSE_ID"]==warehouseID);
		console.log(filterProduct);
		$("#writeoffQty").attr("max",filterProduct[0]["QUANTITY"]);
		$("#writeoffQty").val(1);
	});
	$(document).on('change','.classQuantity',function(e){
		e.preventDefault();
		if(parseInt($(this).val())>parseInt($(this).attr("max")))
		{
			$(this).attr("style","border-color: #FF0000;");
		}
		else
		{
			$(this).attr("style","border-color: #cad1d7;")
		}
	});
	$("#btnSave").on('click',function(e){
		let quantity=parseInt($("#writeoffQty").val());
		let validationQty=parseInt($("#writeoffQty").attr("max"));
		let reason=$("#wReason").val();
		console.log(validationQty);
		if(quantity>validationQty)
		{
			$('#MHeader').text("Error!");
			$("#MMessage").text("The quantity entered is too large. Please enter another quantity. Refer to highlighted quantity.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#btnClose").attr("data-dismiss","modal");
			$("#displayModal").modal("show");
		}
		else if(reason=="")
		{
			$('#MHeader').text("Error!");
			$("#MMessage").text("Please enter a reason for Writeoff.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#btnClose").attr("data-dismiss","modal");
			$("#displayModal").modal("show");
		}
		else
		{
			$.ajax({
				url:'PHPcode/writeoffcode.php',
				type:'POST',
				data:{WAREHOUSE_ID:warehouseID,PRODUCT_ID:productID,QUANTITY:quantity,REASON:reason},
				beforeSend:function(){
					$('.loadingModal').modal('show');
				}
			})
			.done(data=>{
				$('.loadingModal').modal('hide');
				let doneData=data.split(",");
				console.log(doneData);
				if(doneData[0]=="T")
				{
					$('#MHeader').text("Success!");
					$("#MMessage").text(doneData[1]);
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick","window.location='../../stock.php'");
					$("#displayModal").modal("show");
				}
				else
				{
					$('#MHeader').text("Error!");
					$("#MMessage").text(doneData[1]);
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
				}
			});
		}

	});
});