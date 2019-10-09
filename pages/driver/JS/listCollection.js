var assignments;
var assignmentProduct;
let buildTable=function(tmp,assArr,assPArr)
{
	let tableEntry=$("<tr></tr>");
	let form=$("<td></td>");
	let saleID=assArr[tmp]["ORDER_ID"];
	let saleArr=assArr.filter(element=>element["ORDER_ID"]==saleID);
	let saleProductsArr=assPArr.filter(element=>element["ORDER_ID"]==saleID);
	console.log(saleArr[0]["ADDRESS_NAME"]);
	console.log(saleProductsArr);
	let formEntry="<form action='finalise_collection.php' method='POST'><input type='hidden' name='ass' value='"+JSON.stringify(saleArr)+"'>"+"<input type='hidden' name='assP' value='"+JSON.stringify(saleProductsArr)+"'>"+"<input type='hidden' name='address' value='"+saleArr[0]["ADDRESS_NAME"]+"'>"+"<button class='btn btn-icon btn-2 btn-primary btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-truck'></i></span><span class='btn-inner--text'>Make Collection</span></button>";
	form.append(formEntry);
	tableEntry.append(form);
	let saleEntry=$("<td></td>").text(assArr[tmp]["ORDER_ID"]);
	tableEntry.append(saleEntry);
	$("#tBody").append(tableEntry);
}
$(()=>{
	assignments=JSON.parse($("#aData").text());
	assignmentProduct=JSON.parse($("#apData").text());
	for(let k=0;k<assignments.length;k++)
	{
		buildTable(k,assignments,assignmentProduct);
	}

});