var dctStatus=[];
dctStatus[1]="Not Delivered";
dctStatus[2]="Truck Assigned";
dctStatus[3]="Final Assignment";
dctStatus[4]="On Delivery";
dctStatus[5]="Delivered";
var orderProducts;
var collectionData;
let buildTable=function(tmp)
{
	let tableEntry=$("<tr></tr>");
	pName=orderProducts[tmp]["PRODUCT_NAME"];
	let productQuantityEntry=$("<td></td>").addClass("py-3 text-center").text(orderProducts[tmp]["QUANTITY"]);
	let productNameEntry=$("<td></td>").addClass("py-3").text(pName);
	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text("R"+orderProducts[tmp]["PRICE"]);
	let productTotal=parseFloat(orderProducts[tmp]["QUANTITY"]).toFixed(2)*parseFloat(orderProducts[tmp]["PRICE"]).toFixed(2);
	productTotal=productTotal.toFixed(2);
	productTotal=numberWithSpaces(productTotal);
	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text("R"+productTotal);
	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	tableEntry.append(productUnitPriceEntry);
	tableEntry.append(productTotalEntry);
	$("#tBody").append(tableEntry);

}
function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}
$(()=>{
	orderProducts=JSON.parse($("#pData").text());
	collectionData=JSON.parse($("#colData").text());
	console.log(orderProducts);
	console.log(collectionData);
	let dctData=collectionData["COLLECTION_STATUS_ID"];
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
	for(let k=0;k<orderProducts.length;k++)
	{
		buildTable(k);
	}
	let totalAmount=0;
	for(let k=0;k<orderProducts.length;k++)
	{
		totalAmount=totalAmount+parseFloat(orderProducts[k]["PRICE"]);
	}
	let vat=totalAmount*0.15;
	totalAmount=totalAmount.toFixed(2);
	totalAmount=numberWithSpaces(totalAmount);
	vat=vat.toFixed(2);
	vat=numberWithSpaces(vat);
	$("#TOTAL").text("R"+totalAmount);
	$("#VAT").text("R"+vat);
});