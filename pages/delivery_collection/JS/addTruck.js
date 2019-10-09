
let getVals=function()
{
	let arr=[];
	arr["registration"]=$("#registration").val();
	arr["name"]=$("#tName").val();
	arr["capacity"]=$("#tCapacity").val();
	return arr;
}

$(()=>{
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
	$("#btnSave").on('click',function(e){
		e.preventDefault();
		let form=$('#mainf');
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
			data:{choice:1,registration:arr["registration"],name:arr["name"],capacity:arr["capacity"]},
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
					
					let changes="Registration:"+arr["registration"]+" | name:"+arr["name"]+" | capacity:"+arr["capacity"];
					let Sub_Functionality_ID=10.7;
					$.ajax({
					url:'../admin/PHPcode/audit_log.php',
					type:'POST',
					data:{Sub_Functionality_ID:Sub_Functionality_ID,changes:changes} //functionality id needs to be included
					})
					.done(data=>{
						if(data=="success"){
							//alert("success");
						}
						else{
							//alert(data);
						}
					
					});

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
});