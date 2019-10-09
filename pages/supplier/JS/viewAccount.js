var orderAmounts;
var orderPayments;
var amountDue=0;
function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}
let buildTable=function(arr1,arr2)
{
	for(let k=0;k<arr1.length;k++)
	{
		let tdAP=$("<td></td>").addClass("text-right").text("");
		let tableEntry=$("<tr></tr>");
		let tdDate=$("<td></td>").text(arr1[k]["ORDER_DATE"]);
		tableEntry.append(tdDate);
		let tdRef=$("<td></td>").text("ORD"+arr1[k]["ORDER_ID"]);
		tableEntry.append(tdRef);
		let tdDescription=$("<td></td>").text("Order");
		tableEntry.append(tdDescription);
		amountDue=amountDue+parseFloat(arr1[k]["ORDER_AMOUNT"]);
		let tdAmount=$("<td></td>").addClass("text-right").text("R"+numberWithSpaces(arr1[k]["ORDER_AMOUNT"]));
		console.log(tdAmount.text());
		tableEntry.append(tdAmount);
		tableEntry.append(tdAP);
		let tdAmountDue=$("<td></td>").addClass("text-right").text("R"+numberWithSpaces(amountDue.toFixed(2)));
		tableEntry.append(tdAmountDue);
		$("#tBody").append(tableEntry);
	}
	for(let k=0;k<arr2.length;k++)
	{
		let tdAP=$("<td></td>").addClass("text-right").text("");
		let tableEntry=$("<tr></tr>");
		let tdDate=$("<td></td>").text(arr2[k]["PAYMENT_DATE"]);
		tableEntry.append(tdDate);
		let tdRef=$("<td></td>").text("PAY"+arr2[k]["ORDER_ID"]);
		tableEntry.append(tdRef);
		let tdDescription=$("<td></td>").text("Payment");
		tableEntry.append(tdDescription);
		amountDue=amountDue-parseFloat(arr2[k]["AMOUNT_PAID"]);
		let tdAmount=$("<td></td>").addClass("text-right").text("R"+numberWithSpaces(arr2[k]["AMOUNT_PAID"]));
		tableEntry.append(tdAP);
		tableEntry.append(tdAmount);
		let tdAmountDue=$("<td></td>").addClass("text-right").text("R"+numberWithSpaces(amountDue.toFixed(2)));
		tableEntry.append(tdAmountDue);
		$("#tBody").append(tableEntry);
	}
}
$(()=>{
	orderAmounts=JSON.parse($("#ordTrans").text());
	orderPayments=JSON.parse($("#ordPay").text());
	console.log(orderAmounts);
	console.log(orderPayments);
	buildTable(orderAmounts,orderPayments);
});