var assignments;
var assignmentProducts;
var assignProductQtys;
var assignProductIDs;
var validationQty;

let buildProduct=function(tmp,arr)
{
	let tableEntry=$("<tr></tr>");
	let quantityEntry=$("<td></td>")
	let innerDivP=$("<div></div>").addClass("input-group mx-auto");
	innerDivP.css("width","4rem");
	let inputQuantity=$("<input type='number' min='1' step='1' data-number-to-fixed='00.10' data-number-step-factor='1'></input>").addClass("form-control currency pr-0 quantityBox classQuantity");
	inputQuantity.css("height","2rem");
	inputQuantity.attr("max",arr[tmp]["QTY_SHOW"]);
	inputQuantity.attr("name",arr[tmp]["PRODUCT_ID"]);
	inputQuantity.val(arr[tmp]["QTY_SHOW"]);
	innerDivP.append(inputQuantity);
	quantityEntry.append(innerDivP);
	tableEntry.append(quantityEntry);
	let quantityVisible=$("<td></td>").addClass("py-3 text-center");
	quantityVisible.text(arr[tmp]["QTY_SHOW"]);
	tableEntry.append(quantityVisible);
	let nameEntry=$("<td></td>").addClass("py-3");
	nameEntry.text(arr[tmp]["PRODUCT_NAME"]);
	tableEntry.append(nameEntry);
	$("#tBody").append(tableEntry);
}

$(()=>{
	assignments=JSON.parse($("#aData").text());
	assignmentProducts=JSON.parse($("#apData").text());
	console.log(assignments);
	console.log(assignmentProducts);
	$(document).on('change','.classQuantity',function(e){
		e.preventDefault();
		console.log($(this).attr("max"));
		if($(this).val()==""||parseInt($(this).val())>parseInt($(this).attr("max"))||parseInt($(this).val())<0)
		{
			$(this).attr("style","border-color: #FF0000;height: 2rem;");
		}
		else
		{
			console.log($(this).val());
			$(this).attr("style","border-color: #cad1d7; height: 2rem;")
		}
	});
	$("#invNo").text("Order #"+assignments[0]["ORDER_ID"]);
	$("#delA").text(" "+assignments[0]["ADDRESS_NAME"]);
	for(let k=0;k<assignmentProducts.length;k++)
	{
		if(parseInt(assignmentProducts[k]["QTY_SHOW"])>0)
		{
			buildProduct(k,assignmentProducts);
		}
		
	}
	$("#btnSubmit").on('click',function(e){
		e.preventDefault();
		assignProductQtys=[];
		validationQty=[];
		assignProductIDs=[];
		$("#tBody input").each(function(){
			assignProductIDs.push($(this).attr("name"));
			assignProductQtys.push($(this).val());
			validationQty.push($(this).attr("max"));
		});
		console.log(assignProductQtys);
		console.log(validationQty);
		let doCall=true;
		for(let k=0;k<assignProductQtys.length;k++)
		{
			if(assignProductQtys[k]=="")
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("One or more Input Quantities are blank.Refer to Highlighted quantites");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
				e.stopPropagation();
				doCall=false;
				break;
			}
			else if(parseInt(assignProductQtys[k])>parseInt(validationQty[k]))
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("One or more quantities are too large, please check highlighted quantites.");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
				e.stopPropagation();
				doCall=false;
				break;
			}
			else if(parseInt(assignProductQtys[k])<0)
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("One or more quantities are below zero, please check highlighted quantites.");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
				e.stopPropagation();
				doCall=false;
				break;
			}
		}
		if(doCall)
		{
			console.log(assignProductIDs);
			console.log(assignProductQtys);
			let delTruckID=assignmentProducts[0]["COLLECTION_TRUCK_ID"];
			let sendAssignment=JSON.stringify(assignments);
			let sendAssignmentP=JSON.stringify(assignmentProducts);
			$.ajax({
				url:'PHPcode/makecollectioncode.php',
				type:'POST',
				data:{num:assignProductIDs.length,assignment:sendAssignment,productIDs:assignProductIDs,productQty:assignProductQtys,COLLECTION_TRUCK_ID:delTruckID}
			})
			.done(data=>{
				let doneData=data.split(",");
				console.log(doneData);
				if(doneData[0]=="T")
				{
					$('#MHeader').text("Success!");
					$("#MMessage").text(doneData[1]);
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick","window.location='select_truck_collection.php'");
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