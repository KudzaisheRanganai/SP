var warehouseData;
var warehouseProduct;
var filteredProducts;
var USERID;
var EMPLOYEEID;
var sourceID=0;
let nameOfWarehouse;
let preLoadSourceWarehouse= function(num)
{
	let groupDiv=$("<div></div>").addClass("custom-control custom-radio mb-3 col-3");
	let id=num;
	let inputDiv=$("<input></input>").addClass("custom-control-input classSourceUnchecked").attr("id",id);
	inputDiv.attr("type","radio");
	inputDiv.attr("name",id);
	inputDiv.attr("wareHouseName",warehouseData[num-1]["NAME"]);
	let labelDiv=$("<label></label>").addClass("custom-control-label radio-inline").attr("for",id).text(warehouseData[num-1]["NAME"]);
 
	groupDiv.append(inputDiv);
	groupDiv.append(labelDiv);
	$("#sourceW").append(groupDiv);
}
function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}
let uncheckSource = function()
{
	$(".classSourceChecked").each(function(){
		$(this).prop("checked",false);
		$(this).removeClass("classSourceChecked");
		$(this).addClass("classSourceUnchecked");
	})
}
let buildProduct=function(tmp,arr)
{
	let tableEntry=$("<tr></tr>");
	let quantityEntry1=$("<td></td>").addClass("py-2 px-0 table-light");
	let innerDivP1=$("<div></div>").addClass("input-group mx-auto");
	innerDivP1.css("width","4rem");
	let inputQuantity1=$("<input type='number' min='0' step='1' data-number-to-fixed='00.10' data-number-step-factor='1'></input>").addClass("form-control currency pr-0 classQuantity");
	inputQuantity1.css("height","2rem");
	//inputQuantity1.attr("max",arr[tmp]["QUANTITY_TO_RECEIVE"]);
	inputQuantity1.attr("name",arr[tmp]["PRODUCT_ID"]);
	inputQuantity1.val(0);
	innerDivP1.append(inputQuantity1);
	quantityEntry1.append(innerDivP1);
	let quantityVisible=$("<td></td>");
	quantityVisible.text(arr[tmp]["TYPE_NAME"]);
	let nameEntry=$("<td></td>");
	nameEntry.text(arr[tmp]["PRODUCT_NAME"]);
	tableEntry.append(nameEntry);
	tableEntry.append(quantityVisible);
	tableEntry.append(quantityEntry1);
	$("#tBody").append(tableEntry);
}
$(()=>{
	USERID = SESSION['userID'];
	EMPLOYEEID = SESSION['employeeID'];
	console.log(USERID);
	console.log(EMPLOYEEID);
	warehouseData=JSON.parse($("#wData").text());
	warehouseProduct=JSON.parse($("#wpData").text());
	console.log(warehouseData);
	console.log(warehouseProduct);
	for(let k=1;k<=warehouseData.length;k++)
	{
		preLoadSourceWarehouse(k);
	}
	$("#sourceW").on('click','.classSourceUnchecked',function(e){
		uncheckSource();
		$("#myInput").val("");
		$(this).removeClass("classSourceUnchecked");
		$(this).addClass("classSourceChecked");
		//cleanDropdown();
		$("#tBody").html("");
		//console.log($(this).attr("wareHouseName"));
		nameOfWarehouse = $(this).attr("wareHouseName");
		filteredProducts=warehouseProduct.filter(element=>element["WAREHOUSE_ID"]==$(this).attr("name"));
		for(let k=0;k<filteredProducts.length;k++)
		{
			buildProduct(k,filteredProducts);
		}
		let searchEmpty=$('<tr id="emptySearch" style="display: none;" class="table-danger"><td class="py-2"><b>Product Not Found</b></td><td class="py-2"></td><td class="py-2"></td></tr>');
		$("#tBody").append(searchEmpty);
		console.log(filteredProducts);
		sourceID=$(this).attr("name");
		console.log(sourceID);
	});
	////////////////////////////////////////
	$("#btnSave").on('click',function(e){
		e.preventDefault();
		if(sourceID==0)
		{
			$('#MHeader').text("Error!");
			$("#MMessage").text("Please Select A Warehouse!");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#btnClose").attr("data-dismiss","modal");
			$("#displayModal").modal("show");
		}
		else
		{
			//nameOfWarehouse = $(".custom-control-label radio-inline").attr("for",id).text(warehouseData[num-1]["NAME"]);
			//console.log(nameOfWarehouse);
			let assignProductIDs=[];
			let assignProductQtys=[];
			let quantityDifference=[];
			let systemQuantity = [];
			let nameOfProducts = [];
			$("#tBody input").each(function(){
				assignProductIDs.push($(this).attr("name"));
				assignProductQtys.push($(this).val());
			});
			console.log(assignProductQtys);
			for(let k=0;k<filteredProducts.length;k++)
			{
				let dif=parseInt(filteredProducts[k]["QUANTITY"]-assignProductQtys[k]);
				systemQuantity.push(filteredProducts[k]["QUANTITY"]);
				nameOfProducts.push(filteredProducts[k]["PRODUCT_NAME"]);
				quantityDifference.push(dif);
			}
			console.log(quantityDifference);
			$.ajax({
				url:'PHPcode/stocktakecode.php',
				type:'POST',
				data:{num:filteredProducts.length,warehouseID:sourceID,productIDs:assignProductIDs,productQtys:assignProductQtys,differenceQty:quantityDifference,userID:USERID,employeeID:EMPLOYEEID},
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
					//$("#btnClose").attr("onclick","window.location=''");
					$("#displayModal").modal("show");
					console.log(nameOfWarehouse);
					 $("#btnClose").click(function(e) {

                                    e.preventDefault();
									setTimeout(function(){
										$('#displayModal').modal("hide");
										callTwo(nameOfProducts,nameOfWarehouse,systemQuantity,quantityDifference,assignProductQtys);
									}, 2000);
                                    //window.location=`stock-take-report.php?wareHouseName=${nameOfWarehouse}&qty=${systemQuantity}&diffQty=${quantityDifference}&inputQty=${assignProductQtys}&`;
                                });
					
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
})

function myFunction() 
{
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");
	var showCount = 0;
	for (i = 0; i < tr.length; i++) 
	{
	  td = tr[i].getElementsByTagName("td")[0];
	  if (td) 
	  {
	    txtValue = td.textContent || td.innerText;
	    if (txtValue.toUpperCase().indexOf(filter)> -1) 
	    {
	      tr[i].style.display = "";
	      showCount += 1;
	    } 
	    else 
	    {
	      tr[i].style.display = "none";
	    }
	  }       
	}

	if (showCount === 0)
	{
	  $("#emptySearch").show();
	} 
	else
	{
	  $("#emptySearch").hide();
	}
}

function callTwo(PROD_NAMES,WAREHOUSE_NAMES,QTY,DIFF_QTY,IN_QTY){
	
		//var URL = "invoice/invoice.php";
		//window.open(URL, '_blank');
		var form="<form target='_blank' action='stock-take-report.php' id='sendStockTakeValues' method='POST'><input type='hidden' name='PRODUCT_NAMES' value='"+PROD_NAMES+"'>"+"<input type='hidden' name='WAREHOUSE_NAME' value='"+WAREHOUSE_NAMES+"'>"+"<input type='hidden' name='QTY' value='"+QTY+"'>"+"<input type='hidden' name='QTY_DIFF' value='"+DIFF_QTY+"'>"+"<input type='hidden' name='QTY_COUNTED' value='"+IN_QTY+"'>"+"</form>";
	
		$("body").append(form);
		$( "#sendStockTakeValues" ).submit();
		location.reload();
	}