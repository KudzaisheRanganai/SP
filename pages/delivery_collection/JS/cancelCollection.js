var dctStatus=[];
dctStatus[1]="Not Delivered";
dctStatus[2]="Truck Assigned";
dctStatus[3]="Final Assignment";
dctStatus[4]="On Delivery";
dctStatus[5]="Delivered";
function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}
$(()=>{
	let collectionData=JSON.parse($("#collectionData").text());
	console.log(collectionData);
	$("#cColID").text("Supplier Order No. #"+collectionData["ORDER_ID"]+" : ");
	$("#cColSupName").text(collectionData["SUPPLIER_NAME"]);
	$("#cColDate").text(collectionData["EXPECTED_DATE"])
	$("#cCollectionAddress").text(collectionData["ADDRESS_LINE_1"]);
	$("#cColSuburb").text(collectionData["SUBURB_NAME"]);
	$("#cColCity").text(collectionData["CITY_NAME"]);
	$("#cColZip").text(collectionData["ZIPCODE"]);
	$("#cColStatus").text(dctStatus[collectionData["COLLECTION_STATUS_ID"]]);
	$("#btnYes").on('click',function(e){
		e.preventDefault();
		$("#warnModal").modal("hide");
			$.ajax({
			url:'PHPcode/collectioncode.php',
			type:'POST',
			data:{choice:2,collectionID:collectionData["COLLECTION_ID"]},
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
})