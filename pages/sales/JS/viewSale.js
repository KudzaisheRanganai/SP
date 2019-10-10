var productsArr;
var sProductsArr;
var saleTotal;
var THESALETOTAL;
var returnsArray;

function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

let buildTable=function(tmp)
{
	let tableEntry=$("<tr></tr>");
	let quantityArr=productsArr.find(function(element){
		if(element["PRODUCT_ID"]==sProductsArr[tmp]["PRODUCT_ID"])
		{
			return element;
		}
	});
	let pType="Individual";
	let pNumber= "1";
	if(quantityArr["PRODUCT_SIZE_TYPE"]==2)
	{
		pType="Case";
		pNumber=quantityArr["UNITS_PER_CASE"];
	}
	else if(quantityArr["PRODUCT_SIZE_TYPE"]==3)
	{
		pType="Pallet";
		pNumber=quantityArr["CASES_PER_PALLET"];
	}
	pName=quantityArr["NAME"]+" ("+pNumber+" x "+quantityArr["PRODUCT_MEASUREMENT"]+quantityArr["PRODUCT_MEASUREMENT_UNIT"]+")"+" "+pType;
	let productQuantityEntry=$("<td></td>").addClass("py-3 text-center").text(sProductsArr[tmp]["QUANTITY"]);
	let productNameEntry=$("<td></td>").addClass("py-3").text(pName);

	let productUnitPrice = parseFloat(sProductsArr[tmp]["SELLING_PRICE"]);
	productUnitPrice = productUnitPrice.toFixed(2);
	productUnitPrice = numberWithSpaces(productUnitPrice);
	productUnitPrice = "R"+ productUnitPrice;

	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text(productUnitPrice);

	let productTotalPrice = parseFloat(sProductsArr[tmp]["QUANTITY"]).toFixed(2)*parseFloat(sProductsArr[tmp]["SELLING_PRICE"]).toFixed(2);
	productTotalPrice = productTotalPrice.toFixed(2);
	productTotalPrice = numberWithSpaces(productTotalPrice);
	productTotalPrice = "R"+ productTotalPrice;

	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text(productTotalPrice);
	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	tableEntry.append(productUnitPriceEntry);
	tableEntry.append(productTotalEntry);
	$("#tBody").append(tableEntry);

}

let buildReturnsTable=function(tmp)
{
	let tableEntry=$("<tr></tr>");
	let quantityArr2=productsArr.find(function(element){
		if(element["PRODUCT_ID"]==returnsArray[tmp]["PRODUCT_ID"])
		{
			return element;
		}
	});
	let pType="Individual";
	let pNumber= "1";
	if(quantityArr2["PRODUCT_SIZE_TYPE"]==2)
	{
		pType="Case";
		pNumber=quantityArr2["UNITS_PER_CASE"];
	}
	else if(quantityArr2["PRODUCT_SIZE_TYPE"]==3)
	{
		pType="Pallet";
		pNumber=quantityArr2["CASES_PER_PALLET"];
	}
	pName=quantityArr2["NAME"]+" ("+pNumber+" x "+quantityArr2["PRODUCT_MEASUREMENT"]+quantityArr2["PRODUCT_MEASUREMENT_UNIT"]+")"+" "+pType;
	let productQuantityEntry=$("<td></td>").addClass("py-3 text-center").text(returnsArray[tmp]["QUANTITY"]);
	let productNameEntry=$("<td></td>").addClass("py-3").text(pName);

	let productUnitPrice = parseFloat(returnsArray[tmp]["SELLING_PRICE"]);
	productUnitPrice = productUnitPrice.toFixed(2);
	productUnitPrice = numberWithSpaces(productUnitPrice);
	productUnitPrice = "R"+ productUnitPrice;

	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text(productUnitPrice);

	let productTotalPrice = parseFloat(returnsArray[tmp]["QUANTITY"]).toFixed(2)*parseFloat(returnsArray[tmp]["SELLING_PRICE"]).toFixed(2);
	productTotalPrice = productTotalPrice.toFixed(2);
	productTotalPrice = numberWithSpaces(productTotalPrice);
	productTotalPrice = "R"+ productTotalPrice;

	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text(productTotalPrice);
	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	$("#tBodyReturns").append(tableEntry);

}
///////////////////////////////////////
$(()=>{
	let deliveryCheck=$("#deliveryCheck").text();
	
	console.log(deliveryCheck);
	let saleCheck =$("#SALE_STATUS_ID").val();
	console.log(saleCheck);
	if(deliveryCheck=="")
	{
		console.log("Here");
		$("#btnAddDelivery").attr("disabled",false);
	}
	else
	{
		$("#btnAddDelivery").attr("disabled",true);
	}
	if(saleCheck >= 2)
	{
		console.log("EQUAL");
		$("#makePaymentButton").attr("disabled",true);
		$("#collectSaleButton").attr("disabled",false);
	}
	else
	{
		$("#makePaymentButton").attr("disabled",false);
		$("#btnAddDelivery").attr("disabled",true);
		$("#collectSaleButton").attr("disabled",true);
		$("#btnMakeReturn").attr("disabled",true);
	}


	if(saleCheck == 3)
	{
		console.log("EQUAL");
		$("#collectSaleButton").attr("disabled",true);
		$("#btnAddDelivery").attr("disabled",true);
		$("#btnMakeReturn").attr("disabled",false);
	}
	if(parseInt(deliveryCheck)==1&&saleCheck==2)
	{
		$("#collectSaleButton").attr("disabled",true);
	}

	let customerData=JSON.parse($("#cData").text());
	let employeeData=JSON.parse($("#eData").text());
	productsArr=JSON.parse($("#productsArr").text());
	sProductsArr=JSON.parse($("#saleproductsArr").text());
	console.log(customerData);
	console.log(employeeData);
	console.log(productsArr);
	console.log(sProductsArr);
	$("#customerName").text(customerData["NAME"]);
	if(customerData["SURNAME"]==null)
	{
		$("#customerSurname").text("Organisation");
	}
	else
	{
		$("#customerSurname").text(customerData["SURNAME"]);
	}
	$("#customerContact").text(customerData["CONTACT_NUMBER"]);
	//////////////////////
	$("#eSalesPerson").text(employeeData["NAME"]);
	for(let k=0;k<sProductsArr.length;k++)
	{
		buildTable(k);
	}
	let total=parseFloat($("#sTotal").text());
	let vat=total*0.15;

	console.log(total);
	total = total.toFixed(2);
	THESALETOTAL = total;
	total = numberWithSpaces(total);
	saleTotal = total;
	$("#sTotal").text(total);

	vat = vat.toFixed(2);
	vat = numberWithSpaces(vat);

	$("#sTotal").text("R"+total);
	$("#sVAT").text("R"+vat);

	let customerID = $("#CUSTOMER_ID").val();

	$.ajax({
		url: 'PHPcode/getCreditAccount.php',
		type: 'POST',
		data: { 
			customerID : customerID
		}
	})
	.done(response => {
		console.log(response);
		if (response == "true")
		{

		}
		else if(response == "false")
		{
			$("#accountPaymentButton").attr("hidden",true);
		}
		else if(response == "Database error")
		{
			$('#modal-title-default2').text("Database Error!");
			$('#modalText').text("Database error whilst verifying password");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		
		ajaxDone = true;
	});	

	let saleIDForSale = $("#SALE_ID").val();

	$.ajax({
		url: 'PHPcode/getReturns_.php',
		type: 'POST',
		data: { 
			saleID : saleIDForSale
		}
	})
	.done(response => {
		
		returnsArray=JSON.parse(response);
		console.log("RETURNS");
		console.log(returnsArray);

		if (response != "false")
		{
			for(let k=0;k<returnsArray.length;k++)
			{
				buildReturnsTable(k);
			}
		}
		else if(response == "false")
		{
			$("#tBodyReturns").append("<tr><td class='py-3 text-left'><b>No Returns</b></td></tr>");
		}
		else if(response == "Database error")
		{
			$('#modal-title-default2').text("Database Error!");
			$('#modalText').text("Database error whilst verifying password");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		
		ajaxDone = true;
	});	
});

$("button#updateSaleStatus").on('click', event => {
	let saleID = $("#SALE_ID").val();

	$.ajax({
		url: 'PHPcode/collectSale_.php',
		type: 'POST',
		data: { 
			saleID : saleID,
			saleProducts : sProductsArr
		}
	})
	.done(response => {
		console.log(response);
		if (response == "success")
		{
			$('#modal-title-default2').text("Success!");
			$('#modalText').text("Sale status successfully updated to collected");
			$("#modalCloseButton").attr("onclick","window.location='../../sales.php'");
			$('#successfullyAdded').modal("show");
		}
		else if(response == "failed")
		{
			$('#modal-title-default2').text("Error!");
			$('#modalText').text("Sale could not be updated");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		else if(response == "Database error")
		{
			$('#modal-title-default2').text("Database Error!");
			$('#modalText').text("Database error whilst verifying password");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		
		ajaxDone = true;
	});	
});  

$("button#calculateChangeButton").on('click', function(event){
	event.preventDefault();
	let amountReceived = $("#amountReceived").val();
	let saleID = $("#SALE_ID").val();
	console.log(amountReceived);
	

	if(parseFloat(amountReceived)<parseFloat(THESALETOTAL))
	{
		console.log("Here");
		$('#MHeader').text("Error!");
		$("#MMessage").text("The amount received is smaller than the Sale Total, Please Enter a Larger Amount");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#btnClose").attr("data-target","#modal-creditlimit");
		$("#displayModal").modal("show");
	}
	else
	{
		amountReceived = parseFloat(amountReceived).toFixed(2);
		
		let change =  parseFloat(amountReceived).toFixed(2) - parseFloat(THESALETOTAL).toFixed(2);
		console.log(change);

		amountReceived = numberWithSpaces(amountReceived);
		amountReceived = "R"+amountReceived;
		console.log(amountReceived);
		$("#saleAmountReceived").text(amountReceived);

		var paymentSaleTotal = "R"+saleTotal;
		$("#saleTotalOutstanding").text(paymentSaleTotal);
		$("#saleAmountReceived").text(amountReceived);

		change = parseFloat(change).toFixed(2);
		change = numberWithSpaces(change);
		change = "R"+change;
		console.log(change);
		
		$("#saleChange").text(change);
		$.ajax({
			url: 'PHPcode/makeCashPayment_.php',
			type: 'POST',
			data: { 
				saleID : saleID,AMOUNT:THESALETOTAL
			}
		})
		.done(response => {

			console.log(response);
			if (response == "success")
			{
				$("#modal-succ").modal("show");
				// $('#modal-title-default2').text("Success!");
				// $('#modalText').text("Sale payment successful");
				// $("#modalCloseButton").attr("onclick","window.location='../../sales.php'");
				// $('#successfullyAdded').modal("show");
			}
			else if(response == "failed")
			{
				$('#modal-title-default2').text("Error!");
				$('#modalText').text("Sale payment unsuccessful");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			else if(response == "Database error")
			{
				$('#modal-title-default2').text("Database Error!");
				$('#modalText').text("Database error whilst verifying password");
				$("#modalCloseButton").attr("onclick","");
				$('#successfullyAdded').modal("show");
			}
			
			ajaxDone = true;
		});	
	}

});  

$("button#makeAccountPaymentButton").on('click', event => {
	let amountReceived = $("#amountReceived").val();
	
	let saleID = $("#SALE_ID").val();
	let customerID = $("#CUSTOMER_ID").val();

	$.ajax({
		url: 'PHPcode/makeCreditPayment_.php',
		type: 'POST',
		data: { 
			saleID : saleID,
			customerID : customerID,
			saleTotalAmount: THESALETOTAL
		}
	})
	.done(response => {
		console.log(response);
		if (response == "success")
		{
			$('#modal-title-default2').text("Success!");
			$('#modalText').text("Sale payment on account successful");
			$("#modalCloseButton").attr("onclick","window.location='../../sales.php'");
			$('#successfullyAdded').modal("show");
		}
		else if(response == "failed")
		{
			$('#modal-title-default2').text("Error!");
			$('#modalText').text("Sale payment unsuccessful");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		else if(response == "Database error")
		{
			$('#modal-title-default2').text("Database Error!");
			$('#modalText').text("Database error whilst verifying password");
			$("#modalCloseButton").attr("onclick","");
			$('#successfullyAdded').modal("show");
		}
		
		ajaxDone = true;
	});	
});