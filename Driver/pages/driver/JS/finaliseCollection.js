var assignments;
var assignmentProducts;
$(()=>{
	assignments=JSON.parse($("#aData").text());
	assignmentProducts=JSON.parse($("#apData").text());
	console.log(assignments);
	console.log(assignmentProducts);
	console.log(assignments[0]["ORDER_ID"]);
	$("#invNo").text("Order #"+assignments[0]["ORDER_ID"]);
	$("#delA").text(" "+assignments[0]["ADDRESS_NAME"]);
	$("#a1").val(JSON.stringify(assignments));
	$("#a2").val(JSON.stringify(assignmentProducts));
});