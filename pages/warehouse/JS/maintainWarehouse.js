let getVals=function()
{
	let arr=[];
	arr["ID"]=$("#wID").text();
	arr["name"]=$("#warehouseName").val();
	arr["des"]=$("#wDes").val();
	arr["max"]=$("#wMax").val();
	return arr;
}
///////////////////////
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
	let wName=$('#wName').text();
	let wDes=$("#des").text();
	$("#wDes").attr("value",wDes);
	$("#warehouseName").attr("value",wName);
	$("#btnSave").on('click',function(e){
		e.preventDefault();
		let form=$("#mainf");
		form.validate();
		if(form.valid()===false)
		{
			e.stopPropagation();
		}
		else
		{
			let arr=getVals();
			$.ajax({
				url:'PHPcode/warehousecode.php',
				type:'POST',
				data:{choice:2,ID:arr["ID"],name:arr["name"],description:arr["des"],max:arr["max"]}
			})
			.done(data=>{
				let doneData=data.split(",");
				if(doneData[0]=="T")
				{
					$('#MHeader').text("Success!");
					$("#MMessage").text(doneData[1]);
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick","window.location='../../warehouse.php'");
					$("#displayModal").modal("show");
				}
				else
				{
					$('#MHeader').text("Error!");
					$("#MMessage").text(doneData[1]);
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
				}

			});
		}
	});
	$("#btnDeleteWarehouse").on('click',function(e){
		e.preventDefault();
		let warehouseID=parseInt($("#wID").text());
		$.ajax({
			url:'PHPcode/warehousecode.php',
			type:'POST',
			data:{choice:4,WAREHOUSE_ID:warehouseID}
		})
		.done(data=>{
			let doneData=data.split(",");
			if(doneData[0]=="T")
			{
				$('#MHeader').text("Success!");
				$("#MMessage").text(doneData[1]);
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$("#btnClose").attr("onclick","window.location='search.php'");
				$("#displayModal").modal("show");
			}
			else
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text(doneData[1]);
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
		});
	});


});