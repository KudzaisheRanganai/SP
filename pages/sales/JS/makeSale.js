var SALECUSTOMERID;
var SALEUSERID;
var SALEUSERNAME;
var SALEPRODUCTIDs = [];
var SALEPRODUCTS = [];
var SALEDELIVERYADD ="NO";
var SALEDELIVERYADDRESSID;
var productElementsCount = 1;
var productsArray;
var customersArray;

var INVOICE_CUSTOMER_NAME;
var INVOICE_CUSTOMER_ADDRESS;
var INVOICE_CUSTOMER_EMAIL;
var INVOICE_SALE_ID;

let saleDeliveryLongitude;
let saleDeliveryLatitude;

let checkDate=function()
{
   var selectedText =$("#delDate").val() //document.getElementById('datepicker').value;
   var selectedDate = new Date(selectedText);
   var now = new Date();
   console.log(selectedDate.getDate());
   console.log(now.getDate());
   if (selectedDate.getDate() < now.getDate()) {
    return false;
   }
   else
   {
   	return true;
   }
}

Array.prototype.remByVal = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
}

$(()=>{
	//$('#successfullyAdded').modal("show");

	$.ajax({
		url: 'PHPcode/getProducts_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let productsArray = JSON.parse(data);
			console.log(productsArray);
			buildDropDown(productsArray);

			$("input[id='dropdownItem']").on('click', function(){
				let productIndex = this.name;
				console.log(SALEDELIVERYADD);

				if (productsArray[productIndex].QUANTITY_AVAILABLE == 0) 
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
					$('#modalText').text("There is no stock available for  "+theProductName);
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#modalCloseButton").attr("onclick","");
					$('#successfullyAdded').modal("show");
				}
				else
				{


					if (!SALEPRODUCTIDs.includes(productsArray[productIndex].PRODUCT_ID)) 
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

						let theUnitPrice = productsArray[productIndex].SELLING_PRICE;
						theUnitPrice = theUnitPrice;

						let theGuidePrice = productsArray[productIndex].GUIDE_DISCOUNT;
						theGuidePrice = theGuidePrice;
						theGuidePrice = numberWithSpaces(theGuidePrice);
						theGuidePrice = "R"+ theGuidePrice;

						let theCostPrice = productsArray[productIndex].COST_PRICE;
						theCostPrice = theCostPrice;
						theCostPrice = numberWithSpaces(theCostPrice);
						theCostPrice = "R"+ theCostPrice;

						let theProfit = productsArray[productIndex].SELLING_PRICE - productsArray[productIndex].COST_PRICE;
						theProfit = theProfit.toFixed(2);
						theProfit = numberWithSpaces(theProfit);
						theProfit = "R"+ theProfit;


						$('#productLine'+productElementsCount).html("<input type='hidden' value='"+productsArray[productIndex].PRODUCT_ID+"'><td class='py-2 px-0' id='quantityCol'><div class='input-group mx-auto' style='width: 4rem'><input type='number' value='1' min='0' max='"+productsArray[productIndex].QUANTITY_AVAILABLE+"' step='1' data-number-to-fixed='00.10' data-number-stepfactor='1' class='form-control currency pr-0 quantityBox' onchange='calculateRowTotalQuantity(this)' id='quantity"+productsArray[productIndex].PRODUCT_ID+"' style='height: 2rem;' /></div> </td><td class='py-2 pl-0'>"+ theProductName +"</td><td class='py-2 px-0 float-center unitPrice'><div class='input-group mx-auto' style='width: 6.4rem'> <div class='input-group-prepend'><span class='input-group-text' id='inputGroupFileAddon01' style='height: 2rem; font-size: 0.9rem'>R</span></div><input type='number' value='"+theUnitPrice+"' min='0' step='.10' data-number-to-fixed='00.10' data-number-stepfactor='10' class='form-control currency pr-0 unitPriceSpinBox' onchange='calculateRowTotalUnitPrice(this)' id='unitPrice"+productsArray[productIndex].PRODUCT_ID+"' style='height: 2rem;' onchange='setTwoNumberDecimal(this)' /></div> </td><td class='text-right py-2 pr-1'>"+theGuidePrice+"</td><td class='text-right py-2 pr-1 pl-2'>"+theCostPrice+"</td><td class='text-right py-2 pr-1 pl-2'>"+theProfit+"</td><td class='text-right py-2 pr-1 price'>R0.00</td><td class='pl-2 px-0 py-2'><a class='btn py-0 px-2' id='deleteRow' onclick='removeRow(this)'><i class='fas fa-times-circle' style='color: red;'></i></a></td>");
						let productsTable = $('#productsTable');
						productsTable.append('<tr id="productLine'+(productElementsCount+1)+'"></tr>');
						productElementsCount++;

						var quantityOfelementJustAdded = "quantity"+productsArray[productIndex].PRODUCT_ID;
						var unitPriceOfelementJustAdded = "unitPrice"+productsArray[productIndex].PRODUCT_ID;

						var quantityElement = document.getElementById(quantityOfelementJustAdded);
						var unitPriceElement = document.getElementById(unitPriceOfelementJustAdded);

						calculateRowTotalUnitPrice(unitPriceElement);
						calculateRowTotalQuantity(quantityElement);
						calculateVATandTotal();
						SALEPRODUCTIDs.push(productsArray[productIndex].PRODUCT_ID);
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
						$('#modalText').text("The product "+theProductName+" has already been added to the sale.");
						$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
						$("#modalHeader").css("background-color", "red");
						$("#modalCloseButton").attr("onclick","");
						$('#successfullyAdded').modal("show");
					}
				}

				$('.unitPriceSpinBox').on('input', function()
				{
					//console.log(this.value);
					//console.log(this.parentNode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML);
					var costPriceOfRow = this.parentNode.parentNode.nextSibling.nextSibling.innerHTML;
					costPriceOfRow = costPriceOfRow.slice(1);
					costPriceOfRow = costPriceOfRow.replace(/\s/g, '');
					costPriceOfRow = parseFloat(costPriceOfRow);

					var thisPrice = this.value;
					thisPrice = thisPrice.replace(/\s/g, '');
					thisPrice = parseFloat(thisPrice);

					if (thisPrice < costPriceOfRow) 
					{
						this.style.color = "red";
						this.style.borderColor ="red";
						this.previousSibling.firstChild.style.borderColor ="red";
					}
					else if (thisPrice == costPriceOfRow) 
					{
						this.style.color = "orange";
						this.style.borderColor ="orange";
						this.previousSibling.firstChild.style.borderColor ="orange";
					}
					else
					{
						this.style.color = "#525f7f";
						this.style.borderColor ="#cad1d7";
						this.previousSibling.firstChild.style.borderColor ="#cad1d7";
					}
				});
				
			});
		}
		else
		{
			alert("Error");
		}
	});

	$.ajax({
		url: 'PHPcode/getCustomers.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let customersArray = JSON.parse(data);
			console.log(customersArray);
			buildCustomersDropDown(customersArray);

			$("input[id*='dropdownItemCust']").on('click', function(){
				let customerIndex = this.name;
				console.log(SALEDELIVERYADD);

				SALECUSTOMERID = customersArray[customerIndex].CUSTOMER_ID;
				//console.log(SALECUSTOMERID);
				$('#customerSearchInput').val("");
				let custtomerID = $('#customerSearchInput').val();
				let customerCard = $('#customerCard');
				let customerInfo = '<tr><th class="py-1">Customer ID</th><td class="py-1">'+customersArray[customerIndex].CUSTOMER_ID+'</td></tr><tr><th class="py-1">Name</th><td class="py-1">'+customersArray[customerIndex].NAME+'</td></tr>';
				INVOICE_CUSTOMER_NAME = customersArray[customerIndex].NAME;
				INVOICE_CUSTOMER_EMAIL = customersArray[customerIndex].EMAIL;
				if (customersArray[customerIndex].SURNAME != null) 
				{
					customerInfo +='<tr><th class="py-1">Surname</th><td class="py-1">'+customersArray[customerIndex].SURNAME+'</td></tr>';
					INVOICE_CUSTOMER_NAME += " ";
					INVOICE_CUSTOMER_NAME += customersArray[customerIndex].SURNAME;
				}
				else
				{
					customerInfo +='<tr><th class="py-1">VAT Number</th><td class="py-1">'+customersArray[customerIndex].VAT_NUMBER+'</td></tr>';
				}
				customerInfo +='<tr><th class="py-1">Contact No</th><td class="py-1">'+customersArray[customerIndex].CONTACT_NUMBER+'</td></tr>'
				customerCard.html(customerInfo);

				$.ajax({
					url: 'PHPcode/getSaleDeliveryAddress.php',
					type: 'POST',
					data: { 
						customerID : SALECUSTOMERID,
					},
					beforeSend: function() {
			
			    	}
				})
				.done(response => {
					let customerAddressDetails = JSON.parse(response);
					
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
						addressesDiv.append($("<input type='date' name='dtp' id='delDate' style='width:15rem'></input>").addClass("form-control"));

						SALEDELIVERYADDRESSID = $('.deliveryAddressSelect:checked').val();
						//console.log(SALEDELIVERYADDRESSID);

						$('.deliveryAddressSelect').on('input', function()
						{
							//console.log(this.value);
							if (this.checked) 
							{
								SALEDELIVERYADDRESSID = this.value;
								i = this.getAttribute("array-index");;
								INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;
								//console.log(INVOICE_CUSTOMER_ADDRESS);
								//console.log(SALEDELIVERYADDRESSID);
								

							}
							else
							{
								console.log(SALEDELIVERYADDRESSID);
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

	SALEUSERID = SESSION['userID'];
	SALEUSERNAME = SESSION['name'];
});


$("button#finaliseSale").on('click', event => {
	//console.log(SALECUSTOMERID);
	//console.log(SALEPRODUCTIDs);
	let doAjax=true;
	let deliveryDate=$("#delDate").val();
	if (SALECUSTOMERID == undefined && SALEPRODUCTIDs.length == 0) 
	{
		event.stopPropagation();
		$('#modal-title-default2').text("Error!");
		$('#modalText').text("Please add a customer and products to the sale");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#modalCloseButton").attr("onclick","");
		$('#successfullyAdded').modal("show");
	}
	else if (SALECUSTOMERID == undefined) 
	{
		event.stopPropagation();
		$('#modal-title-default2').text("Error!");
		$('#modalText').text("Please add a customer to the sale");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#modalCloseButton").attr("onclick","");
		$('#successfullyAdded').modal("show");
	}
	else if (SALEPRODUCTIDs.length == 0) 
	{
		event.stopPropagation();
		$('#modal-title-default2').text("Error!");
		$('#modalText').text("Please add products to the sale");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#modalCloseButton").attr("onclick","");
		$('#successfullyAdded').modal("show");
	}
	else if(SALEDELIVERYADD=="YES")
	{
		if(!checkDate())
		{
			event.stopPropagation();
			$('#modal-title-default2').text("Error!");
			$('#modalText').text("The selected date is before the current date.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
			doAjax=false;
		}
		else if(deliveryDate=="")
		{
			event.stopPropagation();
			$('#modal-title-default2').text("Error!");
			$('#modalText').text("Please select a date");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
			doAjax=false;
		}
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
		else if(placeProductQty[k]>validationQty[k])
		{
			event.stopPropagation();
			$('#modal-title-default2').text("Error!");
			$("#modalText").text("One or more quantities are too large, please check highlighted quantites.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("data-dismiss","modal");
			$("#successfullyAdded").modal("show");
			errors++;
			break;
		}
	}
});

$("button#confirmSalesManagerPassword").on('click', event => {
	console.log(SALEDELIVERYADD);
	var password = $("#salesManagerPassword").val().trim();
	$.ajax({
        url:'PHPcode/verifySalesManagerPassword.php',
        type:'post',
        data:{ 
        	password:password
        },
        beforeSend: function(){
            $('.loadingModal').modal('show');
        }
    })
    .done(response => {

    	console.log(response);
    	$("#salesManagerPassword").val("");
        if (response == "success")
		{
			SALEPRODUCTS = [];
			for (var i = SALEPRODUCTIDs.length - 1; i >= 0; i--) 
			{
				var thisProductID = SALEPRODUCTIDs[i];
				var thisProductQuantity = $('#quantity'+thisProductID).val();
				var thisSellingPrice = $('#unitPrice'+thisProductID).val();
				
				

				var productLine = {
				    'PRODUCT_ID': thisProductID,
				    'QUANTITY': thisProductQuantity,
				    'SELLING_PRICE': thisSellingPrice
				};
				SALEPRODUCTS.push(productLine);
			}

			$.getJSON("https://geocoder.api.here.com/6.2/geocode.json?searchtext="+INVOICE_CUSTOMER_ADDRESS+"&gen=9&app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw",{
			format:"json"
			})
			.done(data=>{
				coordinates=data;
				saleDeliveryLatitude = coordinates["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Latitude"];
				saleDeliveryLongitude = coordinates["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Longitude"];

				//console.log("Longitude Before => "+saleDeliveryLongitude+", Latitude Before => "+saleDeliveryLatitude);
				console.log(SALEDELIVERYADD);
				let dDate=$("#delDate").val();
				console.log(dDate);
				$.ajax({
			        url:'PHPcode/makeSale_.php',
			        type:'post',
			        data:{ 
			        	saleProducts : SALEPRODUCTS,
			        	customerID : SALECUSTOMERID,
			        	saleUserID : SALEUSERID,
			        	addSaleDelivery: SALEDELIVERYADD,
			        	addDeliveryDate:dDate,
			        	saleDeliveryID: SALEDELIVERYADDRESSID,
			        	deliveryLongitude_: saleDeliveryLongitude,
			        	deliveryLatitude_: saleDeliveryLatitude
			        },
			        beforeSend: function(){
			            $('.loadingModal').modal('show');
			            //console.log("Longitude => "+saleDeliveryLongitude+", Latitude => "+saleDeliveryLatitude);

			        }
	
			    })
			    .done(response => {
			    	closeModal();
			    	console.log(response);
			    	var reponseArray = response.split(',');
			    	INVOICE_SALE_ID = reponseArray[1];
			    	var responseText = reponseArray[0];
			    	console.log(reponseArray);

			        if (responseText == "success")
					{
						$('#modal-title-default2').text("Success!");
						$('#modalText').text("Correct Password. Sale is complete. Printing invoice...");
						$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
						$("#modalHeader").css("background-color", "#1ab394");
						$('#successfullyAdded').modal("show");
						setTimeout(function(){
							$('#successfullyAdded').modal("hide");
						    callTwo();
						}, 2000);
					}
					else if(response == "failed")
					{
						$('.loadingModal').modal('hide');
						$('#modal-title-default2').text("Error!");
						$('#modalText').text("Incorrect password entered");
						$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
						$("#btnClose").attr("onclick",'$("#modal-salesManagerPassword").modal("show");');
						$("#modalHeader").css("background-color", "red");
						$('#successfullyAdded').modal("show");
					}
					else
					{
						$('.loadingModal').modal('hide');
						$('#modal-title-default2').text("Database Error!");
						$('#modalText').text("Database error whilst verifying password");
						$("#modalCloseButton").attr("onclick","");
						$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
						$("#modalHeader").css("background-color", "red");
						$('#successfullyAdded').modal("show");
					}
					
					ajaxDone = true;
			    });
			});
	
		}
		else if(response == "failed")
		{
			$('.loadingModal').modal('hide');
			$('#modal-title-default2').text("Error!");
			$('#modalText').text("Incorrect password entered");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#btnClose").attr("onclick", '$("#modal-salesManagerPassword").modal("show")');
			$('#successfullyAdded').modal("show");
		}
		else if(response == "Password empty")
		{
			$('.loadingModal').modal('hide');
			$('#modal-title-default2').text("Error!");
			$('#modalText').text("Please enter a password");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		else
		{
			$('.loadingModal').modal('hide');
			$('#modal-title-default2').text("Database Error!");
			$('#modalText').text("Database error whilst verifying password");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		
		ajaxDone = true;
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
	$("#customerDropdownToggle").dropdown('toggle');
	$('#customerSearchInput').val("");
	filterCustomers("");
});

$('#addSaleDeliveryCheckbox').on('input', function()
{
	var makeDelivery = $('#addSaleDeliveryCheckbox').is(":checked");
	if (makeDelivery == true) 
	{
		SALEDELIVERYADD ="YES";
		console.log("Adding Delivery => "+makeDelivery);
	}
	else
	{
		SALEDELIVERYADD ="NO";
		console.log("Not adding Delivery => "+makeDelivery);
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

$('#customerSearchInput').on('input', function()
{
	var dropdownShown = $("#menuCust").hasClass("show");

	if(dropdownShown === false)
	{
		$("#customerDropdownToggle").dropdown('toggle');
	}
	let search2 = $("#customerSearchInput");
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

function buildCustomersDropDown(arrayOfCustomers) 
{
  let contents = []
  let ind = 0;
  for (let customer of arrayOfCustomers) 
  {
  	let customerName = "";
  	if (customer.SURNAME != null) 
  	{
  		customerName = customer.NAME+" "+customer.SURNAME+ " (ID : "+customer.CUSTOMER_ID+")";

  	}
  	else
  	{
  		customerName = customer.NAME+" (ID : "+customer.CUSTOMER_ID+")";
  	}
  	contents.push('<input type="button" class="dropdown-item customerDropdownMenuItem dropdownItemCust" id="dropdownItemCust'+ind+'" type="button" value="' + customerName + '" name="'+ind+'"/>');
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
	var form="<form target='_blank' action='invoice/invoice.php' id='sendSaleInfo' method='POST'><input type='hidden' name='CUSTOMER_NAME' value='"+INVOICE_CUSTOMER_NAME+"'>"+"<input type='hidden' name='ADDRESS' value='"+INVOICE_CUSTOMER_ADDRESS+"'>"+"<input type='hidden' name='SALE_ID' value='"+INVOICE_SALE_ID+"'>"+"<input type='hidden' name='SALESPERSON' value='"+SALEUSERNAME+"'>"+"<input type='hidden' name='EMAIL' value='"+INVOICE_CUSTOMER_EMAIL+"'>"+"<input type='hidden' name='SALE_PRODUCTS' value='"+JSON.stringify(SALEPRODUCTS)+"'>"+"</form>";

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
	var unitPrice = element.parentNode.parentNode.nextSibling.nextSibling.childNodes[0].childNodes[2].value;

	var rowTotal = thisQuantity * unitPrice;
	rowTotal = rowTotal.toFixed(2);
	rowTotal = numberWithSpaces(rowTotal);
	rowTotal = "R"+ rowTotal;

	element.parentNode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = rowTotal;
	calculateVATandTotal();
}

function calculateRowTotalUnitPrice(element)
{
	var thisUnitPrice = element.value;
	var quantity = element.parentNode.parentNode.previousSibling.previousSibling.childNodes[0].childNodes[0].value;

	var rowTotal2 = thisUnitPrice * quantity;
	rowTotal2 = rowTotal2.toFixed(2);
	rowTotal2 = numberWithSpaces(rowTotal2);
	rowTotal2 = "R"+ rowTotal2;

	element.parentNode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = rowTotal2;
	calculateVATandTotal();

	var costPrice = element.parentNode.parentNode.nextSibling.nextSibling.innerHTML.replace("R","").replace(/\s/g, "");
	console.log(costPrice);

	var newProfit = thisUnitPrice - costPrice;
	newProfit = newProfit.toFixed(2);
	newProfit = numberWithSpaces(newProfit);
	newProfit = "R"+ newProfit;

	element.parentNode.parentNode.nextSibling.nextSibling.nextSibling.innerHTML = newProfit;
	//console.log(element.parentNode.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling);

	setTwoNumberDecimal(element);
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
    SALEPRODUCTIDs = SALEPRODUCTIDs.remByVal(productID);

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
});
function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}

// calculateRowTotalUnitPrice(unitPriceElement);
// calculateRowTotalQuantity(quantityElement);
// calculateVATandTotal();