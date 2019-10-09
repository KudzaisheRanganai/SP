let getVals=function()
{
	let arr=[];
	arr["ID"]=$("#rTID").text();
	arr["registration"]=$("#registration").val();
	arr["name"]=$("#tName").val();
	arr["capacity"]=$("#tCapacity").val();
	if($("#activeStatus").prop("checked")==true)
	{
		arr["active"]=1;
	}
	else
	{
		arr["active"]=0;
	}
	return arr;
}
///////////////////////
$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});


	let active=$("#rActive").text();
	let truckName=$('#rTName').text();
	$("#tName").attr("value",truckName);
	if(active=="1")
	{
		$("#activeStatus").attr("checked","true");
	}
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
				url:'PHPcode/truckcode.php',
				type:'POST',
				data:{choice:2,ID:arr["ID"],registration:arr["registration"],name:arr["name"],capacity:arr["capacity"],active:arr["active"]},
				beforeSend:function(){
					$('.loadingModal').modal('show');
				},
				complete:function(){
					$('.loadingModal').modal('hide');
				}
			})
			.done(data=>{
				let doneData=data.split(",");
				if(doneData[0]=="T")
				{

					//place changes variable her and user id here
					//initialize changes
					let changes="";
					if(beforeVals["registration"]!=arr["registration"]){
						changes=changes+"Registration:"+beforeVals["registration"];
					}
					if(beforeVals["name"]!=arr["name"]){
						changes=changes+" name:"+beforeVals["name"];
					}
					if(beforeVals["capacity"]!=arr["capacity"]){
						change=changes+" capacity:"+beforeVals["capacity"];
					}
					if(beforeVals["active"]!=arr["active"]){
						change=changes+"status:"+beforeVals["active"];
					}

					createAudit(changes);

					$('#MHeader').text("Success!");
					$("#MMessage").text(doneData[1]);
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick","window.location='../../delivery_collection.php'");
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
	$("#btnDeleteTruck").on('click',function(e){
		e.preventDefault();
		let truckReg=$("#registration").val();
		$.ajax({
			url:'PHPcode/truckcode.php',
			type:'POST',
			data:{choice:4,REGISTRATION_NUMBER:truckReg},
			beforeSend:function(){
					$('.loadingModal').modal('show');
			},
			complete:function(){
				$('.loadingModal').modal('hide');
			}
		})
		.done(data=>{
			let doneData=data.split(",");
			if(doneData[0]=="T")
			{
				$('#MHeader').text("Success!");
				$("#MMessage").text(doneData[1]);
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$("#btnClose").attr("onclick","window.location='../../delivery_collection.php'");
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

	var beforeVals=getVals();
	

	function createAudit(changed){
		//make sure you change the subfuc id
		let Sub_Functionality_ID=10.8;
		$.ajax({
		url:'../admin/PHPcode/audit_log.php',
		type:'POST',
		data:{Sub_Functionality_ID:Sub_Functionality_ID,changes:changed} //functionality id needs to be included
		})
		.done(data=>{
			if(data=="success"){
				//alert("success");
			}
			else{
				//alert(data);
			}
		
		});
	}

});