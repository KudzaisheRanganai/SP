var productData;
let buildTable=function(tmp)
{
	let tableEntry=$("<tr></tr>");
	let productQuantityEntry=$("<td></td>").addClass("py-3 text-center").text(productData[tmp]["QUANTITY"]);
	let productNameEntry=$("<td></td>").addClass("py-3").text(productData[tmp]["PRODUCT_NAME"]);
	let productUnitPriceEntry=$("<td></td>").addClass("text-right py-3").text("R"+productData[tmp]["SELLING_PRICE"]);
	let productTotal=parseFloat(productData[tmp]["QUANTITY"]).toFixed(2)*parseFloat(productData[tmp]["SELLING_PRICE"]).toFixed(2);
	let productTotalEntry=$("<td></td>").addClass("text-right py-3").text("R"+productTotal);
	tableEntry.append(productQuantityEntry);
	tableEntry.append(productNameEntry);
	tableEntry.append(productUnitPriceEntry);
	tableEntry.append(productTotalEntry);
	$("#tBody").append(tableEntry);

}
$(()=>{
	productData=JSON.parse($("#pData").text());
	let dctData=2;
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
	for(let k=0;k<productData.length;k++)
	{
		buildTable(k);
	}


});