let getVals=function()
{
	let arr=[];
	arr["name"]=$("#wName").val();
	arr["des"]=$("#wDes").val();
	arr["max"]=$("#wMax").val();
	return arr;
}
function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
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
			url:'PHPcode/warehousecode.php',
			type:'POST',
			data:{choice:1,name:arr["name"],description:arr["des"],max:arr["max"]},
			beforeSend:function(){
					$('.loadingModal').modal('show');
			}
			})
			.done(data=>{
				closeModal();
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
		}
		
	});

});


