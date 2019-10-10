var assignments;
var assignmentProducts;
var truckID;
var preAssignQtys=[];
var trucks=[];
var removeDeliveryAssignment=0;
let buildTruck=function()
{
	for(let k=0;k<assignments.length;k++)
	{
		let found=trucks.includes(assignments[k]["TRUCK_ID"]);
		if(k==0)
		{
			truckID=assignments[k]["TRUCK_ID"];
		}
		let dW=$("#truckSelect");
		let wOption=$("<option></option>").addClass("classDestination");
		// let id="d"+num;
		// wOption.attr("id",id);
		if(!found)
		{
			trucks.push(assignments[k]["TRUCK_ID"]);
			wOption.attr("name",assignments[k]["TRUCK_ID"]);
			wOption.text(assignments[k]["REGISTRATION_NUMBER"]+"|"+assignments[k]["TRUCK_NAME"]+"|"+assignments[k]["CAPACITY"]+" Tonnes");
			dW.append(wOption);	
		}
		
	}
}
function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}
let buildProduct=function(tmp,arr)
{
	let tableEntry=$("<tr></tr>");
	let quantityEntry=$("<td></td>").addClass("py-2 px-0");
	let innerDivP=$("<div></div>").addClass("input-group mx-auto");
	innerDivP.css("width","4rem");
	let inputQuantity=$("<input type='number' min='1' step='1' data-number-to-fixed='00.10' data-number-step-factor='1'></input>").addClass("form-control currency pr-0 quantityBox classQuantity");
	inputQuantity.css("height","2rem");
	inputQuantity.attr("max",arr[tmp]["QUANTITY"]);
	inputQuantity.attr("name",arr[tmp]["PRODUCT_ID"]);
	inputQuantity.val(arr[tmp]["QUANTITY"]);
	innerDivP.append(inputQuantity);
	quantityEntry.append(innerDivP);
	tableEntry.append(quantityEntry);
	let deliveryNO=$("<td></td>").addClass("classDelivery");
	deliveryNO.attr("name",arr[tmp]["COLLECTION_TRUCK_ID"]);
	deliveryNO.text(arr[tmp]["ORDER_ID"]);
	tableEntry.append(deliveryNO);
	let nameEntry=$("<td></td>");
	nameEntry.text(arr[tmp]["PRODUCT_NAME"]);
	tableEntry.append(nameEntry);
	$("#enterProducts").append(tableEntry);
}
$(()=>{
	assignments=JSON.parse($("#adData").text());
	if(assignments==false)
	{
		$('#MHeader').text("Error!");
		$("#MMessage").text("There are no assignments to Maintain");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#btnClose").attr("onclick","window.location='../../delivery_collection.php'");
		$("#displayModal").modal("show");
		
	}
	$(document).on('change','.classQuantity',function(e){
		e.preventDefault();
		console.log($(this).attr("max"));
		if($(this).val()==""||parseInt($(this).val())>parseInt($(this).attr("max")))
		{
			$(this).attr("style","border-color: #FF0000;height: 2rem;");
		}
		else
		{
			console.log($(this).val());
			$(this).attr("style","border-color: #cad1d7; height: 2rem;")
		}
	});
	assignmentProducts=JSON.parse($("#adpData").text());
	console.log(assignments);
	console.log(assignmentProducts);
	buildTruck();
	let intialProducts=assignmentProducts.filter(element=>element["TRUCK_ID"]==truckID);
	console.log(intialProducts);
	for(let k=0;k<intialProducts.length;k++)
	{
		buildProduct(k,intialProducts);
		preAssignQtys.push(intialProducts[k]["QUANTITY"]);
	}
	$("#truckSelect").on('change',function(e){
		e.preventDefault();
		truckID=$(this).children(":selected").attr("name");
		$("#enterProducts").html('');
		let truckProducts=assignmentProducts.filter(element=>element["TRUCK_ID"]==truckID);
		preAssignQtys=[];
		for(let k=0;k<truckProducts.length;k++)
		{
			buildProduct(k,truckProducts);
			preAssignQtys.push(truckProducts[k]["QUANTITY"]);
		}
	});
	$("#btnYes").on('click',function(e){
		e.preventDefault();
		let assignProductIDs=[];
		let assignProductQtys=[];
		let assignProductDelIDs=[];
		let assignProductDelTruckIDs=[];
		let validationQty=[];
		let assignQtyRemove=[];
		let filterArr=assignmentProducts.filter(element=>element["TRUCK_ID"]==truckID);

		$("#enterProducts input").each(function()
		{
			assignProductIDs.push($(this).attr("name"));
			assignProductQtys.push($(this).val());
			validationQty.push($(this).attr("max"));

		});
		$("#enterProducts td.classDelivery").each(function()
		{
			assignProductDelTruckIDs.push(parseInt($(this).attr("name")));
			assignProductDelIDs.push(parseInt($(this).text()));
		});
		for(let k=0;k<assignProductQtys.length;k++)
		{
			let qtyfinal=preAssignQtys[k]-assignProductQtys[k];
			if(qtyfinal==0)
			{
				assignQtyRemove.push(true);
			}
			else
			{
				assignQtyRemove.push(false);
			}
			filterArr[k]["QUANTITY"]=assignProductQtys[k];
			filterArr[k]["PRODUCT_NAME"]=assignQtyRemove[k];
		}
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
				$("#select").modal("hide");
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
				$("#select").modal("hide");
				e.stopPropagation();
				doCall=false;
				break;
			}
		}
		if(doCall)
		{
			$.ajax({
				url:'PHPcode/assigncollectioncode.php',
				type:'POST',
				data:{choice:5,TRUCK_ID:truckID},
				beforeSend:function(){
					$('.loadingModal').modal('show');
				}
			})
			.done(data=>{
				let salesForTruck=JSON.parse(data);
				console.log(salesForTruck);
				for(let k=0;k<salesForTruck.length;k++)
				{
					let dataArr=filterArr.filter(element=>element["ORDER_ID"]==salesForTruck[k]["ORDER_ID"]);
					let dataArrQty=[];
					let dataArrProductIDs=[];
					let dataArrDelTruckIDs=[];
					let dataArrSaleIDs=[];
					let dataArrQtyRemove=[];
					dataArr.forEach(function(element){
						dataArrQty.push(element["QUANTITY"]);
						dataArrProductIDs.push(element["PRODUCT_ID"]);
						dataArrDelTruckIDs.push(element["COLLECTION_TRUCK_ID"]);
						dataArrSaleIDs.push(element["ORDER_ID"]);
						dataArrQtyRemove.push(element["PRODUCT_NAME"]);
					});
					removeDeliveryAssignment=0;
					let removeDeliveryAssignmentBool=false;
					dataArrQtyRemove.forEach(function(element){
						if(element==true)
						{
							removeDeliveryAssignment++;
						}
					});
					if(removeDeliveryAssignment==dataArrQtyRemove.length)
					{
						removeDeliveryAssignmentBool=true;
					}
					$.ajax({
						url:'PHPcode/assigncollectioncode.php',
						type:'POST',
						data:{choice:3,num:dataArrQty.length,productQtys:dataArrQty,productIDs:dataArrProductIDs,deltruckIDs:dataArrDelTruckIDs,saleIDs:dataArrSaleIDs,productremove:dataArrQtyRemove}
					})
					.done(data=>{
						console.log(data);
						$.ajax({
							url:'PHPcode/assigncollectioncode.php',
							type:'POST',
							data:{choice:4,remove:removeDeliveryAssignmentBool,SALE_ID:salesForTruck[k]["ORDER_ID"],TRUCK_ID:truckID}
						})
						.done(data=>{
							closeModal();
							console.log(data);
							let doneData=data.split(",");
							if(doneData[0]=="T")
							{
								$('#MHeader').text("Success!");
								$("#MMessage").text(doneData[1]);
								$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
								$("#modalHeader").css("background-color", "#1ab394");
								$("#btnClose").attr("onclick","window.location='../../delivery_collection.php'");
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
					});

				}


			});
		}
		


	});


});