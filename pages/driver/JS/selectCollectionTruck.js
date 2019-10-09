var assignments;
var assignmentProducts;
var truckID;
var trucks=[];
let buildTruck=function()
{
	if(assignments==false)
	{
		let dW=$("#truckSelect");
		let wOption=$("<option></option>").addClass("classDestination");
		wOption.text("No Delivery Assignments");
		dW.append(wOption);
		$("#btnSelectTruck").attr("disabled",true);
	}
	for(let k=0;k<assignments.length;k++)
	{
		let found=trucks.includes(assignments[k]["TRUCK_ID"]);
		if(k==0)
		{
			truckID=assignments[k]["TRUCK_ID"];
		}
		let dW=$("#truckSelect");
		let wOption=$("<option></option>").addClass("classDestination");
		// let id="d"+num;
		// wOption.attr("id",id);
		if(!found)
		{
			trucks.push(assignments[k]["TRUCK_ID"]);
			wOption.attr("name",assignments[k]["TRUCK_ID"]);
			wOption.text(assignments[k]["REGISTRATION_NUMBER"]+"|"+assignments[k]["TRUCK_NAME"]+"|"+assignments[k]["CAPACITY"]+" Pallets");
			dW.append(wOption);	
		}
	}
}
$(()=>{
	assignments=JSON.parse($("#mTrucks").text());
	assignmentProducts=JSON.parse($("#pTrucks").text());
	console.log(assignments);
	console.log(assignmentProducts);
	buildTruck();
	let filterArr=assignmentProducts.filter(element=>element["TRUCK_ID"]==truckID);
	let filterAssignmentArr=assignments.filter(element=>element["TRUCK_ID"]==truckID);
	$("#a1").val(JSON.stringify(filterAssignmentArr));
	$("#a2").val(JSON.stringify(filterArr));
	$("#truckSelect").on('change',function(e){
		e.preventDefault();
		truckID=$(this).children(":selected").attr("name");
		filterArr=assignmentProducts.filter(element=>element["TRUCK_ID"]==truckID);
		filterAssignmentArr=assignments.filter(element=>element["TRUCK_ID"]==truckID);
		$("#a1").val(JSON.stringify(filterAssignmentArr));
		$("#a2").val(JSON.stringify(filterArr));
	});
});