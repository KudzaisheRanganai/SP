var warehouse=[];
var warehouseProduct=[];
var products=[];
var rowCount=0;
var sourceID=1;
var destinationID=1;
var items;

let preLoadSourceWarehouse= function(num)
{
	let groupDiv=$("<div></div>").addClass("custom-control custom-radio mb-3 col-3");
	let id=num;
	let inputDiv=$("<input></input>").addClass("custom-control-input classSourceUnchecked").attr("id",id);
	inputDiv.attr("type","radio");
	inputDiv.attr("name",id);
	let labelDiv=$("<label></label>").addClass("custom-control-label radio-inline").attr("for",id).text(warehouse[num-1]["NAME"]);
	groupDiv.append(inputDiv);
	groupDiv.append(labelDiv);
	$("#sourceW").append(groupDiv);
}

let uncheckSource = function()
{
	$(".classSourceChecked").each(function(){
		$(this).prop("checked",false);
		$(this).removeClass("classSourceChecked");
		$(this).addClass("classSourceUnchecked");
	})
}

let preLoadDestinationWarehouse = function(num)
{
	let dW=$("#destinationWarehouse");
	let wOption=$("<option></option>").addClass("classDestination");
	let id="d"+num;
	wOption.attr("id",id);
	wOption.attr("name",num);
	wOption.text(warehouse[num-1]["NAME"]);
	dW.append(wOption);
}

let buildDropdown = function(warehouseID)
{
	let menu=$("#menu");
	let menuItems=$("#menuItems");
	let wProducts=warehouseProduct.filter(item=>item["WAREHOUSE_ID"]==warehouseID);
	console.log(wProducts);
	let wProductItems=wProducts.map(item=>{
		let found=products.find(element=>element["PRODUCT_ID"]==item["PRODUCT_ID"]);
		return found;
	});
	console.log(wProductItems);
	let view="";
	let size="";
	let quantity=[];
	for(let k=0;k<wProductItems.length;k++)
	{
		if(wProductItems[k]["PRODUCT_SIZE_TYPE"]==3)
		{
			size="Pallet";
		}
		else if(wProductItems[k]["PRODUCT_SIZE_TYPE"]==2)
		{
			size="Case";
		}
		else
		{
			size="Individual"
		}
		quantity=wProducts.find(element=>element["PRODUCT_ID"]==wProductItems[k]["PRODUCT_ID"]);
		view+="<input type='button' class='dropdown-item productDropdownItem' id='"+wProductItems[k]["PRODUCT_ID"]+"' value='"+wProductItems[k]["NAME"]+" "+wProductItems[k]["PRODUCT_MEASUREMENT"]+wProductItems[k]["PRODUCT_MEASUREMENT_UNIT"]+" "+size+"' name='"+quantity["QUANTITY"]+"'/>";
		$('#empty').hide()
	}
	menuItems.append(view);
	menu.append(menuItems);

}

//Filter dropdown
function filter(word) 
{
  let length = items.length
  let collection = []
  let hidden = 0

  for (let i = 0; i < length; i++) 
  {
    if (items[i].value.toLowerCase().startsWith(word)) 
    {
        $(items[i]).show()
    }
    else {
        $(items[i]).hide()
        hidden++
    }
  }

  //If all items are hidden, show the empty view
  if (hidden === length) 
  {
    $('#empty').show()
  }
  else 
  {
    $('#empty').hide()
  }
}

//
let search = document.getElementById("searchProduct");
	window.addEventListener('input', function () {
		filter(search.value.trim().toLowerCase())
})

$('#menuItems').on('click', '.dropdown-item.productDropdownItem', function()
{
	  $("#dropdown_coins").dropdown('toggle');
	  $('#searchProduct').val("");
	  filter("");
})

function setTwoNumberDecimal(el) 
{
	el.value = parseFloat(el.value).toFixed(2);
};

//////////////////////////////////
let cleanDropdown = function()
{
	$("#menuItems").html("");
}

$(()=>{
	$.ajax({
		url:'PHPcode/stockcode.php',
		type:'POST',
		data:{choice:1},
		beforeSend:function(){
					$('.loadingModal').modal('show');
		}
	})
	.done(warehouseDetails=>{
		warehouse=JSON.parse(warehouseDetails);
		console.log(warehouse);
		$.ajax({
			url:'PHPcode/stockcode.php',
			type:'POST',
			data:{choice:2}
		})
		.done(productDetails=>{
			products=JSON.parse(productDetails);
			console.log(products);
			$.ajax({
				url:'PHPcode/stockcode.php',
				type:'POST',
				data:{choice:3}
			})
			.done(warehouseProductDetails=>{
				$('.loadingModal').modal('hide');
				warehouseProduct=JSON.parse(warehouseProductDetails);
				console.log(warehouseProduct);
				for(let k=1;k<=warehouse.length;k++)
				{
					preLoadSourceWarehouse(k);
					preLoadDestinationWarehouse(k);
				}
			});
		});
	});

	$("#sourceW").on('click','.classSourceUnchecked',function(e){
		uncheckSource();
		$(this).removeClass("classSourceUnchecked");
		$(this).addClass("classSourceChecked");
		cleanDropdown();
		$("#tBody").html("");
		buildDropdown($(this).attr("name"));
		items = $(".dropdown-item.productDropdownItem");
		sourceID=$(this).attr("name");
	});


	$("#menuItems").on('click','.dropdown-item',function(e){
		e.preventDefault();
		rowCount++;
		let tableEntry=$("<tr></tr>");
		let rowName=$(this).attr("id");
		tableEntry.attr("name",rowName);
		let entryInput=$("<td></td>").addClass("py-2 px-0");
		let entryInputDiv=$("<div></div>").addClass("input-group mx-auto").attr("style","width: 4rem");
		let inputInner=$("<input></input>");
		let qty=$(this).attr("name");
		inputInner.attr("type","number");
		inputInner.attr("value","0");
		inputInner.attr("min","0");
		inputInner.attr("max",qty);
		inputInner.attr("step","1");
		inputInner.attr("data-number-to-fixed","00.10");
		inputInner.attr("data-number-stepfactor","10");
		inputInner.attr("style","height: 2rem;");
		inputInner.addClass("form-control currency pr-0 classQuantity");
		entryInputDiv.append(inputInner);
		entryInput.append(entryInputDiv);
		tableEntry.append(entryInput);
		let entryName=$("<td></td>").addClass("py-2").text($(this).val());
		tableEntry.append(entryName);
		let entryQty=$("<td></td>").addClass("text-center").text(qty);
		let entryRemove=$("<td></td>").addClass("class py-2 px-0");
		let innerEntryRemove=$("<a></a>").addClass("btn py-0 px-2 classRemove").html("<i class='fas fa-times-circle' style='color: red;'></i>")
		entryRemove.append(innerEntryRemove);
		tableEntry.append(entryQty);
		tableEntry.append(entryRemove);
		$("#tBody").append(tableEntry);
	});// Error check for quantity and adding the same product twice.
	/////////////////////////////
	$(document).on('change','.classQuantity',function(e){
		e.preventDefault();
		console.log($(this).attr("max"));
		if(parseInt($(this).val())>parseInt($(this).attr("max")))
		{
			$(this).attr("style","border-color: #FF0000;height: 2rem;");
		}
		else
		{
			console.log($(this).val());
			$(this).attr("style","border-color: #cad1d7; height: 2rem;")
		}
	});
	////////////////////////////
	$("#tBody").on('click','.classRemove',function(e){
		e.preventDefault();
		rowCount--;
		$(this).closest('tr').remove();
	})

	$("#destinationWarehouse").on('change',function(e){
		e.preventDefault();
		destinationID=$(this).children(":selected").attr("name");
	});

	$("#btnSave").on('click',function(e){
		e.preventDefault();
		$("#modal-confirm").modal("hide");
		let emptyBody=$("#tBody>tr").length;
		console.log(emptyBody);
		if(emptyBody==0)
		{
			$('#MHeader').text("Error!");
			$("#MMessage").text("Please Select Products");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#btnClose").attr("data-dismiss","modal");
			$("#displayModal").modal("show");
			e.stopPropagation();
		}
		else
		{
			let placeProducts=[];
			let placeProductQty=[];
			let validationQty=[];
			let doCall=true;
			$("#tBody").find('tr').each(function(rowIndex,r){
				placeProducts.push($(this).attr("name"));
				placeProductQty.push(parseInt($(this).find(">:first-child>:first-child>:first-child").val()));
				console.log(parseInt($(this).find(">:first-child>:first-child>:first-child").val()));
				validationQty.push(parseInt($(this).find(">:nth-last-child(2)").text()));
				console.log(parseInt($(this).find(">:nth-last-child(2)").text()));
			});
			for(let k=0;k<placeProductQty.length;k++)
			{
				if(placeProductQty[k]==0||placeProductQty[k]=="")
				{
					$('#MHeader').text("Error!");
					$("#MMessage").text("One or more Input Quantities are zero");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
					e.stopPropagation();
					doCall=false;
					break;
				}
				else if(placeProductQty[k]>validationQty[k])
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
			}
			if(doCall)
			{
				$.ajax({
				url:'PHPcode/stockcode.php',
				type:'POST',
				data:{choice:4,source:sourceID,destination:destinationID,product:placeProducts,qty:placeProductQty,length:placeProducts.length},
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
		}
		
	});

});
