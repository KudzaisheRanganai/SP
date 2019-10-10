var orderDetails;
var orderProducts;
let buildProduct=function(tmp,arr)
{
	let tableEntry=$("<tr></tr>");
	let quantityEntry=$("<td></td>")
	let innerDivP=$("<div></div>").addClass("input-group mx-auto");
	innerDivP.css("width","4rem");
	let inputQuantity=$("<input type='number' min='0' step='1' data-number-to-fixed='00.10' data-number-step-factor='1'></input>").addClass("form-control currency pr-0 classQuantity");
	inputQuantity.css("height","2rem");
	inputQuantity.attr("max",arr[tmp]["QUANTITY_TO_RECEIVE"]);
	inputQuantity.attr("name",arr[tmp]["PRODUCT_ID"]);
	inputQuantity.val(arr[tmp]["QUANTITY_TO_RECEIVE"]);
	innerDivP.append(inputQuantity);
	quantityEntry.append(innerDivP);
	let quantityVisible=$("<td></td>").addClass("py-3 text-center");
	quantityVisible.text(arr[tmp]["QUANTITY_TO_RECEIVE"]);
	tableEntry.append(quantityVisible);
	let nameEntry=$("<td></td>").addClass("py-3");
	nameEntry.text(arr[tmp]["PRODUCT_NAME"]);
	tableEntry.append(nameEntry);
	tableEntry.append(quantityEntry);
	$("#tBody").append(tableEntry);
}

$(()=>{
	orderDetails=JSON.parse($("#oDet").text());
	orderProducts=JSON.parse($("#oProd").text());
	orderProducts=orderProducts.filter(element=>element["QUANTITY_TO_RECEIVE"]!=0);
	console.log(orderDetails);
	console.log(orderProducts);
	for(let k=0;k<orderProducts.length;k++)
	{
		buildProduct(k,orderProducts);
	}
	///////////////////////////////////////
	$(document).on('change','.classQuantity',function(e){
		e.preventDefault();
		if(parseInt($(this).val())>parseInt($(this).attr("max")))
		{
			$(this).attr("style","border-color: #FF0000;height: 2rem;");
		}
		else
		{
			$(this).attr("style","border-color: #cad1d7; height: 2rem;")
		}
	});
	//////////////////////////////////////////////
	$("#btnSave").on('click',function(e){
		e.preventDefault();
		let assignProductIDs=[];
		let assignProductQtys=[];
		let quantityDifference=[];
		let tCall=true;
		$("#tBody input").each(function(){
			assignProductIDs.push($(this).attr("name"));
			assignProductQtys.push($(this).val());
		});
		console.log(assignProductQtys);
		for(let k=0;k<orderProducts.length;k++)
		{
			if(assignProductQtys[k]=="")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("One or more Input Quantities are blank");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
				tCall=false;
				e.stopPropagation();
				break;
			}
			else if(parseInt(assignProductQtys[k])>parseInt(orderProducts[k]["QUANTITY_TO_RECEIVE"]))
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("One or more quantities are too large, please check highlighted quantites.");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
				tCall=false;
				e.stopPropagation();
				break;
			}
		}
		if(tCall)
		{
			for(let k=0;k<orderProducts.length;k++)
			{
				let dif=parseInt(orderProducts[k]["QUANTITY_TO_RECEIVE"]-assignProductQtys[k]);
				quantityDifference.push(dif);
			}
			console.log(quantityDifference);
			$.ajax({
				url:'PHPcode/receivestockcode.php',
				type:'POST',
				data:{num:orderProducts.length,orderID:orderDetails["ORDER_ID"],productIDs:assignProductIDs,productQtys:assignProductQtys,differenceQty:quantityDifference},
				beforeSend:function(){
					$('.loadingModal').modal('show');
				}
			})
			.done(data=>{
				closeModal();
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

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}