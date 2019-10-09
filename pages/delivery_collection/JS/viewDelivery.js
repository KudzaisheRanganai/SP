var dctStatus=[];
dctStatus[1]="Not Delivered";
dctStatus[2]="Truck Assigned";
dctStatus[3]="Final Assignment";
dctStatus[4]="On Delivery";
dctStatus[5]="Delivered";
var productsArr;
var sProductsArr;
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
	let pNumber="";
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
	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text("R"+sProductsArr[tmp]["SELLING_PRICE"]);
	let productTotal=parseFloat(sProductsArr[tmp]["QUANTITY"]).toFixed(2)*parseFloat(sProductsArr[tmp]["SELLING_PRICE"]).toFixed(2);
	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text("R"+productTotal);
	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	tableEntry.append(productUnitPriceEntry);
	tableEntry.append(productTotalEntry);
	$("#tBody").append(tableEntry);

}
$(()=>{
	let choice=$("#delChoice").text();
	if(parseInt(choice)==2)
	{
		let delInfo=JSON.parse($("#delInfo").text());
		let dctData=parseInt(delInfo[0]["DCT_STATUS_ID"]);
		sProductsArr=JSON.parse($("#sproductData").text());
		productsArr=JSON.parse($("#prdData").text());
		$("#vCustomerID").text(delInfo[0]["CUSTOMER_ID"]);
		if(delInfo["CUSTOMER_SURNAME"]==null)
		{
			delInfo["CUSTOMER_SURNAME"]="Organisation";
		}
		$("#vCustomerName").text(delInfo[0]["CUSTOMER_NAME"]+" "+delInfo[0]["CUSTOMER_SURNAME"]);
		$("#vCustomerEmail").text(delInfo[0]["EMAIL"]);
		$("#vContact").text(delInfo[0]["CONTACT_NUMBER"]);
		$("#vAddress").text(delInfo[0]["ADDRESS_NAME"]);
		$("#vDelDate").text(delInfo[0]["SALE_DATE"]);
		$("#vEmployeeName").text(delInfo[0]["EMPLOYEE_NAME"]);
		if(dctData==5)
		{
			let sigPath="../deliveryImages/"+delInfo[0]["SALE_ID"]+".png";
			console.log(sigPath);
			$("#imgSignature").attr("src",sigPath);
		}
		else
		{
			$("#divSign").attr("hidden",true);
		}
		if(dctData==6)
		{
			dctData=2;
		}
		for(let k=1;k<=5;k++)
		{
			if(dctData!=k)
			{
				$("#"+k).removeClass("progtrckr-todo");
				$("#"+k).addClass("progtrckr-done");
			}
			else
			{
				$("#"+k).removeClass("progtrckr-todo");
				$("#"+k).addClass("progtrckr-done");
				break;
			}
		}
		for(let k=0;k<sProductsArr.length;k++)
		{
			buildTable(k);
		}
		let total=delInfo[0]["SALE_AMOUNT"];
		let vat=total*0.15;
		$("#sTotal").text("R"+total);
		$("#sVAT").text("R"+vat);
	}
	else
	{
		let addressData=JSON.parse($("#aData").text());
		let saleData=JSON.parse($("#sData").text());
		let employeeData=JSON.parse($("#eData").text());
		sProductsArr=JSON.parse($("#sproductData").text());
		productsArr=JSON.parse($("#prdData").text());
		let customerData=JSON.parse($("#cData").text());
		let suburbData=JSON.parse($("#subData").text());
		let cityData=JSON.parse($("#citData").text());
		let dctData=parseInt($("#dctData").text());
		console.log(addressData);
		console.log(saleData);
		console.log(employeeData);
		console.log(customerData);
		console.log(suburbData);
		console.log(cityData);
		console.log(dctData);
		$("#vCustomerID").text(customerData["CUSTOMER_ID"]);
		if(customerData["SURNAME"]==null)
		{
			customerData["SURNAME"]="Organisation";
		}
		$("#vCustomerName").text(customerData["NAME"]+" "+customerData["SURNAME"]);
		$("#vCustomerEmail").text(customerData["EMAIL"]);
		$("#vContact").text(customerData["CONTACT_NUMBER"]);
		let address=addressData["ADDRESS_LINE_1"]+","+suburbData["NAME"]+","+suburbData["ZIPCODE"]+","+cityData["CITY_NAME"];
		$("#vAddress").text(address);
		let employee=employeeData.find(function(element){
			if(element["EMPLOYEE_ID"]==saleData["EMPLOYEE_ID"])
			{
				return element;
			}
		});
		$("#vEmployeeName").text(employee["NAME"]);
		if(dctData==5)
		{
			let sigPath="../deliveryImages/"+saleData["SALE_ID"]+".png";
			console.log(sigPath);
			$("#imgSignature").attr("src",sigPath);
		}
		else
		{
			$("#divSign").attr("hidden",true);
		}
		if(dctData==6)
		{
			dctData=2;
		}
		for(let k=1;k<=5;k++)
		{
			if(dctData!=k)
			{
				$("#"+k).removeClass("progtrckr-todo");
				$("#"+k).addClass("progtrckr-done");
			}
			else
			{
				$("#"+k).removeClass("progtrckr-todo");
				$("#"+k).addClass("progtrckr-done");
				break;
			}
		}
		for(let k=0;k<sProductsArr.length;k++)
		{
			buildTable(k);
		}
		let total=saleData["SALE_AMOUNT"];
		let vat=total*0.15;
		$("#sTotal").text("R"+total);
		$("#sVAT").text("R"+vat);
	}
	

});