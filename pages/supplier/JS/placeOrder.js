var ORDERSUPPLIERID;
var ORDERUSERID;
var ORDERUSERNAME;
var ORDERPRODUCTIDs = [];
var ORDERPRODUCTS = [];
var ORDERCOLLECTIONADD = false;
var ORDERCOLLECTIONADDRESSID;
var productElementsCount = 1;
var productsArray;
var suppliersArray;

var INVOICE_SUPPLIER_NAME;
var INVOICE_CUSTOMER_ADDRESS;
var INVOICE_SUPPLIER_EMAIL;
var INVOICE_ORDER_ID;

let orderCollectionLongitude;
let orderCollectionLatitude;

Array.prototype.remByVal = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
}
function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}
$(()=>{
	

	$.ajax({
		url: 'PHPcode/getProducts_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let productsArray = JSON.parse(data);
			//console.log(productsArray);
			buildDropDown(productsArray);

			$("input[id='dropdownItem']").on('click', function(){
				let productIndex = this.name;

				if (!ORDERPRODUCTIDs.includes(productsArray[productIndex].PRODUCT_ID)) 
				{

					let pType="Individual";
					let pNumber= 1;
					if(productsArray[productIndex].PRODUCT_SIZE_TYPE==2)
					{
						pType="Case";
						pNumber=productsArray[productIndex].UNITS_PER_CASE;
					}
					else if(productsArray[productIndex].PRODUCT_SIZE_TYPE==3)
					{
						pType="Pallet";
						pNumber=productsArray[productIndex].CASES_PER_PALLET;
					}

					let theProductName = productsArray[productIndex].NAME+" ("+pNumber+" x "+productsArray[productIndex].PRODUCT_MEASUREMENT+productsArray[productIndex].PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;

					let theCostPrice = productsArray[productIndex].COST_PRICE;
					let costPriceNoR = productsArray[productIndex].COST_PRICE;
					theCostPrice = theCostPrice;
					theCostPrice = numberWithSpaces(theCostPrice);
					theCostPrice = "R"+ theCostPrice;


					$('#productLine'+productElementsCount).html("<input type='hidden' value='"+productsArray[productIndex].PRODUCT_ID+"'><td class='py-2 px-0' id='quantityCol'><div class='input-group mx-auto' style='width: 4rem'><input type='number' value='1' min='0' max='100000' step='1' data-number-to-fixed='00.10' data-number-stepfactor='1' class='form-control currency pr-0 quantityBox' onchange='calculateRowTotalQuantity(this)' id='quantity"+productsArray[productIndex].PRODUCT_ID+"' style='height: 2rem;' /></div> </td><td class='py-2 pl-0'>"+ theProductName +"</td><td class='text-right py-2 pr-1 pl-2' id='costPrice"+productsArray[productIndex].PRODUCT_ID+"' value='"+costPriceNoR+"'>"+theCostPrice+"</td><td class='text-right py-2 pr-1 price'>R0.00</td><td class='pl-2 px-0 py-2'><a class='btn py-0 px-2' id='deleteRow' onclick='removeRow(this)'><i class='fas fa-times-circle' style='color: red;'></i></a></td>");
					let productsTable = $('#productsTable');
					productsTable.append('<tr id="productLine'+(productElementsCount+1)+'"></tr>');
					productElementsCount++;

					var quantityOfelementJustAdded = "quantity"+productsArray[productIndex].PRODUCT_ID;
					var quantityElement = document.getElementById(quantityOfelementJustAdded);
					calculateRowTotalQuantity(quantityElement);
					calculateVATandTotal();

					ORDERPRODUCTIDs.push(productsArray[productIndex].PRODUCT_ID);
					//console.log(ORDERPRODUCTIDs);
				}
				else
				{
					let pType="Individual";
					let pNumber= 1;
					if(productsArray[productIndex].PRODUCT_SIZE_TYPE==2)
					{
						pType="Case";
						pNumber=productsArray[productIndex].UNITS_PER_CASE;
					}
					else if(productsArray[productIndex].PRODUCT_SIZE_TYPE==3)
					{
						pType="Pallet";
						pNumber=productsArray[productIndex].CASES_PER_PALLET;
					}
					let theProductName = productsArray[productIndex].NAME+" ("+pNumber+" x "+productsArray[productIndex].PRODUCT_MEASUREMENT+productsArray[productIndex].PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;

					$('#modal-title-default2').text("Error!");
					$('#modalText').text("The product "+theProductName+" has already been added to the order.");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#modalCloseButton").attr("onclick","");
					$('#successfullyAdded').modal("show");
				}
				
			});
		}
		else
		{
			alert("Error");
		}
	});

	$.ajax({
		url: 'PHPcode/getSuppliers.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let suppliersArray = JSON.parse(data);
			//console.log(suppliersArray);
			buildSuppliersDropDown(suppliersArray);

			$("input[id*='dropdownItemCust']").on('click', function(){
				let customerIndex = this.name;


				ORDERSUPPLIERID = suppliersArray[customerIndex].SUPPLIER_ID;
				//console.log(ORDERSUPPLIERID);
				$('#supplierSearchInput').val("");
				let supplierID = $('#supplierSearchInput').val();
				let supplierCard = $('#supplierCard');
				let supplierInfo = '<tr><th class="py-1">Supplier ID</th><td class="py-1">'+suppliersArray[customerIndex].SUPPLIER_ID+'</td></tr><tr><th class="py-1">Supplier Name</th><td class="py-1">'+suppliersArray[customerIndex].NAME+'</td></tr>';
				
				supplierInfo +='<tr><th class="py-1">VAT #</th><td class="py-1">'+suppliersArray[customerIndex].VAT_NUMBER+'</td></tr>';
				supplierInfo +='<tr><th class="py-1">Contact #</th><td class="py-1">'+suppliersArray[customerIndex].CONTACT_NUMBER+'</td></tr>';
				supplierInfo +='<tr><th class="py-1">Email</th><td class="py-1">'+suppliersArray[customerIndex].EMAIL+'</td></tr>';
				supplierCard.html(supplierInfo);

				INVOICE_SUPPLIER_NAME = suppliersArray[customerIndex].NAME;
				INVOICE_SUPPLIER_EMAIL = suppliersArray[customerIndex].EMAIL;

				$.ajax({
					url: 'PHPcode/getOrderCollectionAddress.php',
					type: 'POST',
					data: { 
						supplierID_ : ORDERSUPPLIERID,
					},
					beforeSend: function() {
			
			    	}
				})
				.done(response => {
					let customerAddressDetails = JSON.parse(response);
					//console.log(customerAddressDetails);
					
					if (response != "false") 
					{
						var addresses = "";
						for (var i = 0; i < customerAddressDetails.length; i++) {
							//console.log(customerAddressDetails[i].ADDRESS_ID);
							var checked = "";
							if (i == 0) 
							{
								checked = "checked";
								INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;

							}
							addresses +='<div class="custom-control custom-radio mb-3 col"><input name="custom-radio-2" class="custom-control-input deliveryAddressSelect" array-index="'+i+'" id="addressSelect'+i+'" type="radio" value="'+customerAddressDetails[i].ADDRESS_ID+'"'+checked+'><label class="custom-control-label" for="addressSelect'+i+'">'+customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE+'</label></div>';
						}
						let addressesDiv = $('#customerAddresses');
						addressesDiv.html(addresses);

						ORDERCOLLECTIONADDRESSID = $('.deliveryAddressSelect:checked').val();
						//console.log(ORDERCOLLECTIONADDRESSID);

						$('.deliveryAddressSelect').on('input', function()
						{
							//console.log(this.value);
							if (this.checked) 
							{
								ORDERCOLLECTIONADDRESSID = this.value;
								i = this.getAttribute("array-index");;
								INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;
								//console.log(INVOICE_CUSTOMER_ADDRESS);
								//console.log(ORDERCOLLECTIONADDRESSID);
								

							}
							else
							{
								//console.log(ORDERCOLLECTIONADDRESSID);
							}
						});	
					}
					else
					{
						var addresses = "";
						let addressesDiv = $('#customerAddresses');
						addressesDiv.html(addresses);
					}
					
					ajaxDone = true;
				});
				
			});
		}
		else
		{
			alert("Error retrieving customers");
		}
	});

	ORDERUSERID = SESSION['userID'];
	ORDERUSERNAME = SESSION['name'];
});


$("button#placeOrderButton").on('click', event => {
	//console.log(ORDERSUPPLIERID);
	//console.log(ORDERPRODUCTIDs);
	if (ORDERSUPPLIERID == undefined && ORDERPRODUCTIDs.length == 0) 
	{
		event.stopPropagation();
		$('#modal-title-default2').text("Error!");
		$('#modalText').text("Please add a supplier and products to the order");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#modalCloseButton").attr("onclick","");
		$('#successfullyAdded').modal("show");
	}
	else if (ORDERSUPPLIERID == undefined) 
	{
		event.stopPropagation();
		$('#modal-title-default2').text("Error!");
		$('#modalText').text("Please add a supplier to the order");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#modalCloseButton").attr("onclick","");
		$('#successfullyAdded').modal("show");
	}
	else if (ORDERPRODUCTIDs.length == 0) 
	{
		event.stopPropagation();
		$('#modal-title-default2').text("Error!");
		$('#modalText').text("Please add products to the order");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#modalCloseButton").attr("onclick","");
		$('#successfullyAdded').modal("show");
	}

	let placeProductQty=[];
	let validationQty=[];
	$("#tBody").find('tr').each(function(rowIndex,r){
		if ($(this).find(">:nth-child(2)>:first-child>:first-child").val() != undefined) 
		{
			placeProductQty.push(parseInt($(this).find(">:nth-child(2)>:first-child>:first-child").val()));
			// console.log($(this).find(">:nth-child(2)>:first-child>:first-child").val());

			validationQty.push(parseInt($(this).find(">:nth-child(2)>:first-child>:first-child").attr("max")));
			// console.log($(this).find(">:nth-child(2)>:first-child>:first-child").attr("max"));
		}
	});
	var errors = 0;
	for(let k=0;k<placeProductQty.length;k++)
	{
		if(Number.isNaN(placeProductQty[k]))
		{
			event.stopPropagation();
			$('#modal-title-default2').text("Error!");
			$("#modalText").text("One or more Input quantities are empty, please check highlighted quantites.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("data-dismiss","modal");
			$("#successfullyAdded").modal("show");
			errors++;
			break;
		}
		else if(placeProductQty[k] == 0)
		{
			event.stopPropagation();
			$('#modal-title-default2').text("Error!");
			$("#modalText").text("One or more Input quantities are zero, please check highlighted quantites.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("data-dismiss","modal");
			$("#successfullyAdded").modal("show");
			errors++;
			break;
		}
	}
});

$("button#confirmPlaceOrder").on('click', event => {

	ORDERPRODUCTS = [];
	for (var i = ORDERPRODUCTIDs.length - 1; i >= 0; i--) 
	{
		var thisProductID = ORDERPRODUCTIDs[i];
		var thisProductQuantity = $('#quantity'+thisProductID).val();
		var thisCostPrice = $('#costPrice'+thisProductID).attr("value");
		

		var productLine = {
		    'PRODUCT_ID': thisProductID,
		    'QUANTITY': thisProductQuantity,
		    'COST_PRICE': thisCostPrice
		};
		ORDERPRODUCTS.push(productLine);
	}

	$.getJSON("https://geocoder.api.here.com/6.2/geocode.json?searchtext="+INVOICE_CUSTOMER_ADDRESS+"&gen=9&app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw",{
	format:"json"
	})
	.done(data=>{
		coordinates=data;
		orderCollectionLatitude = coordinates["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Latitude"];
		orderCollectionLongitude = coordinates["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Longitude"];

		//console.log("Longitude Before => "+orderCollectionLongitude+", Latitude Before => "+orderCollectionLatitude);

		$.ajax({
	        url:'PHPcode/placeOrder_.php',
	        type:'post',
	        data:{ 
	        	orderProducts : ORDERPRODUCTS,
	        	supplierID : ORDERSUPPLIERID,
	        	orderUserID : ORDERUSERID,
	        	addOrderCollection: ORDERCOLLECTIONADD,
	        	orderCollectionAddressID: ORDERCOLLECTIONADDRESSID,
	        	collectionLongitude: orderCollectionLongitude,
	        	collectionLatitude: orderCollectionLatitude
	        },
	        beforeSend: function(){
	            $('.loadingModal').modal('show');
	            //console.log("Longitude => "+orderCollectionLongitude+", Latitude => "+orderCollectionLatitude);
	        }
	    })
	    .done(response => {
	    	closeModal();
	    	console.log(response);
	    	var reponseArray = response.split(',');
	    	INVOICE_ORDER_ID = reponseArray[1];
	    	var responseText = reponseArray[0];
	    	//console.log(reponseArray);

	        if (responseText == "success")
			{
				$('#modal-title-default2').text("Success!");
				$('#modalText').text("Order is complete. Generating invoice....");
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$('#successfullyAdded').modal("show");
				
				setTimeout(function(){
					$('#successfullyAdded').modal("hide");
				    callTwo();
				}, 2000);
				
				//$("#modalCloseButton").attr("onclick","window.location='../../supplier.php'");
				
			}
			else if(response == "failed")
			{
				$('#modal-title-default2').text("Error!");
				$('#modalText').text("Incorrect password entered");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("onclick", '$("#modal-salesManagerPassword").modal("show")');
				$('#successfullyAdded').modal("show");
			}
			else if(response == "Database error")
			{
				$('#modal-title-default2').text("Database Error!");
				$('#modalText').text("Database error whilst verifying password");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			
			ajaxDone = true;
	    });
	});
});



////////////////////////////CODE FROM PHP///////////////////////////////

function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

$('#menuItems').on('click', '.dropdown-item', function()
{
	$("#productsDropdownToggle").dropdown('toggle');
	$('#searchProduct').val("");
	filter("");
});

$('#menuOfCustomers').on('click', '.dropdown-item', function()
{
	$("#supplierDropdownToggle").dropdown('toggle');
	$('#supplierSearchInput').val("");
	filterCustomers("");
});

$('#addSaleDeliveryCheckbox').on('input', function()
{
	var addCollection = $('#addSaleDeliveryCheckbox').is(":checked");
	if (addCollection == true) 
	{
		ORDERCOLLECTIONADD = true;
		//console.log("Adding Delivery => "+makeDelivery);
	}
	else
	{
		ORDERCOLLECTIONADD = false;
		//console.log("Not adding Delivery => "+makeDelivery);
	}
});

if (productElementsCount == 1) {
	//console.log(this.name);
	let productIndex = this.name;

	let productsTable = $('#productsTable');
	productsTable.append('<tr id="productLine'+(productElementsCount+1)+'"></tr>');
	productElementsCount++;
	calculateVATandTotal();
};

$('#searchProduct').on('input', function()
{
	var dropdownShown = $("#menu").hasClass("show");
	let search = $("#searchProduct");
	let searchWord = search.val().trim().toLowerCase();
	if(dropdownShown === false)
	{
		$("#productsDropdownToggle").dropdown('toggle');
	}

	filter(searchWord);
});

$('#supplierSearchInput').on('input', function()
{
	var dropdownShown = $("#menuCust").hasClass("show");

	if(dropdownShown === false)
	{
		$("#supplierDropdownToggle").dropdown('toggle');
	}
	let search2 = $("#supplierSearchInput");
	let searchWord2 = search2.val().trim().toLowerCase();
	filterCustomers(searchWord2);
});


$('.productDropdownMenuItem').on('click', function()
{
	console.log(this.name);
});

function buildDropDown(arrayOfProducts) 
{
  let contents = []
  let ind = 0;
  for (let product of arrayOfProducts) 
  {
  	let pType="Individual";
	let pNumber= 1;
	if(product.PRODUCT_SIZE_TYPE==2)
	{
		pType="Case";
		pNumber=product.UNITS_PER_CASE;
	}
	else if(product.PRODUCT_SIZE_TYPE==3)
	{
		pType="Pallet";
		pNumber=product.CASES_PER_PALLET;
	}
  	let productName = product.NAME+" ("+pNumber+" x "+product.PRODUCT_MEASUREMENT+product.PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;
  	contents.push('<input type="button" class="dropdown-item productDropdownMenuItem" id="dropdownItem" type="button" value="' + productName + '" name="'+ind+'"/>');
  	ind++;

  }
  $('#menuItems').append(contents.join(""));

  //Hide the row that shows no items were found
  $('#empty').hide();
  //console.log(productDetails);
}

function buildSuppliersDropDown(arrayOfSuppliers) 
{
  let contents = []
  let ind = 0;
  for (let supplier of arrayOfSuppliers) 
  {

  	let supplierName = supplier.NAME+ " (ID : "+supplier.SUPPLIER_ID+")";

  	contents.push('<input type="button" class="dropdown-item customerDropdownMenuItem dropdownItemCust" id="dropdownItemCust'+ind+'" type="button" value="' + supplierName + '" name="'+ind+'"/>');
  	ind++;

  }
  $('#menuOfCustomers').append(contents.join(""));

  //Hide the row that shows no items were found
  $('#empty2').hide();
  //console.log(productDetails);
}

//For every word entered by the user, check if the symbol starts with that word
//If it does show the symbol, else hide it
function filter(word) 
{
	let items = $(".dropdown-item.productDropdownMenuItem");
  	let length = items.length
  	let collection = []
  	let hidden = 0

  	for (let i = 0; i < length; i++) 
	{
	    if (items[i].value.toLowerCase().includes(word)) 
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

function filterCustomers(word) 
{
	let items = $(".dropdown-item.customerDropdownMenuItem");
  	let length = items.length
  	let collection = []
  	let hidden = 0

  	for (let i = 0; i < length; i++) 
	{
	    if (items[i].value.toLowerCase().includes(word)) 
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
		$('#empty2').show()
	}
	else 
	{
		$('#empty2').hide()
	}
}


//buildDropDown(productDetails);

function callTwo(){

	//var URL = "invoice/invoice.php";
	//window.open(URL, '_blank');
	console.log(ORDERPRODUCTS);
	var form="<form target='_blank' action='invoice/invoice.php' id='sendSaleInfo' method='POST'><input type='hidden' name='SUPPLIER_NAME' value='"+INVOICE_SUPPLIER_NAME+"'>"+"<input type='hidden' name='ADDRESS' value='"+INVOICE_CUSTOMER_ADDRESS+"'>"+"<input type='hidden' name='ORDER_ID' value='"+INVOICE_ORDER_ID+"'>"+"<input type='hidden' name='ORDERED_BY' value='"+ORDERUSERNAME+"'>"+"<input type='hidden' name='EMAIL' value='"+INVOICE_SUPPLIER_EMAIL+"'>"+"<input type='hidden' name='ORDER_PRODUCTS' value='"+JSON.stringify(ORDERPRODUCTS)+"'>"+"</form>";
	$("body").append(form);

	$( "#sendSaleInfo" ).submit();
	
	location.reload();
}

// Adding Rows
$(document).ready(function(){
    
});

function calculateRowTotalQuantity(element)
{
	var thisQuantity = element.value;
	var costPrice = element.parentNode.parentNode.nextSibling.nextSibling.getAttribute("value");
	//console.log(thisQuantity);
	//console.log(costPrice);

	var rowTotal = thisQuantity * costPrice;
	rowTotal = rowTotal.toFixed(2);
	rowTotal = numberWithSpaces(rowTotal);
	rowTotal = "R"+ rowTotal;

	element.parentNode.parentNode.nextSibling.nextSibling.nextSibling.innerHTML = rowTotal;
	calculateVATandTotal();
}

function calculateVATandTotal()
{
	var sum = 0;
	// iterate through each td based on class and add the values
	$(".price").each(function() 
	{
	    var value = $(this).text().replace("R","").replace(/\s/g, "");
	    // add only if the value is number
	    if(!isNaN(value) && value.length != 0) {
	        sum += parseFloat(value);
	    }
	});
	
	var vat = (sum*0.15).toFixed(2);
	sum = sum.toFixed(2);

	sum = numberWithSpaces(sum);	
	vat = numberWithSpaces(vat);

	$('#totalOfSale').html('<b>R'+sum+'</b>');
	$('#vatOfSale').html('<b>R'+vat+'</b>');
}

function removeRow(src)
{
    /* src refers to the input button that was clicked. 
       to get a reference to the containing <tr> element,
       get the parent of the parent (in this case <tr>)
    */   
    var oRow = src.parentElement.parentElement;  
    //var quantity = element.parentNode.parentNode.previousSibling.previousSibling.childNodes[0].childNodes[0].value;
    var productID = src.parentNode.parentNode.childNodes[0].value;
    //console.log(productID);
    
    //once the row reference is obtained, delete it passing in its rowIndex   
    document.all("productsTable").deleteRow(oRow.rowIndex);  
    calculateVATandTotal();
    ORDERPRODUCTIDs = ORDERPRODUCTIDs.remByVal(productID);

    //console.log(ORDERPRODUCTIDs);

} 

$(document).on('change','.quantityBox',function(e){
	e.preventDefault();
	//console.log($(this).attr("max"));
	if(parseInt($(this).val()) == parseInt($(this).attr("max")))
	{
		$(this).attr("style","border-color: orange;height: 2rem; color: orange;");
	}
	else if(parseInt($(this).val()) > parseInt($(this).attr("max")))
	{
		$(this).attr("style","border-color: red;height: 2rem; color: red;");
	}
	else if(parseInt($(this).val()) == 0 || Number.isNaN(parseInt($(this).val())))
	{
		$(this).attr("style","border-color: red;height: 2rem; color: red;");
	}
	else
	{
		//console.log($(this).val());
		$(this).attr("style","border-color: #cad1d7; height: 2rem; color: #8898aa;")
	}
})