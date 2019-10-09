var addressData;
var chooseAddressID;
var coordinates=[];
var lat;
var long;
let preLoadAddress=function(arr)
{
	let dW=$("#inputAddress");
	for(let k=0;k<addressData.length;k++)
	{
		let wOption=$("<option></option>").addClass("classAddress");
		let id="d"+addressData[k]["ADDRESS_ID"];
		wOption.attr("id",id);
		wOption.attr("name",addressData[k]["ADDRESS_ID"]);
		let final=addressData[k]["ADDRESS_LINE_1"]+","+addressData[k]["NAME"]+","+addressData[k]["ZIPCODE"]+","+addressData[k]["CITY_NAME"]+",South Africa";
		wOption.text(final);
		dW.append(wOption);
	}
	
}
let checkDate=function()
{
   var selectedText =$("#delDate").val() //document.getElementById('datepicker').value;
   var selectedDate = new Date(selectedText);
   var now = new Date();
   if (selectedDate.getDate() < now.getDate()) {
    return false;
   }
   else
   {
   	return true;
   }
}
$(()=>{
	let customerData=JSON.parse($("#cData").text());
	let saleID=$("#sID").text();
	$("#saleID").text("Sale No. #"+saleID+": ");
	$("#CustomerName").text(customerData["NAME"]+" "+customerData["SURNAME"]);
	$("#delDate").val($("#sDate").text());
	//customerAddress=JSON.parse($("#cAddress").text());
	addressData=JSON.parse($("#addData").text());
	//suburbData=JSON.parse($("#subData").text());
	//cityData=JSON.parse($("#citData").text());
	preLoadAddress(addressData);

	chooseAddressID=$("#inputAddress option:selected").attr("name");

	$("#inputAddress").on('change',function(e){
		e.preventDefault();
		chooseAddressID=$(this).children(":selected").attr("name");
	});

	$("#btnSave").on('click',function(e){
		e.preventDefault();
		let deliveryDate=$("#delDate").val();
		console.log(deliveryDate);
		console.log(chooseAddressID);
		let chooseAddress=addressData.find(function(element){
			if(element["ADDRESS_ID"]==chooseAddressID)
			{
				return element;
			}
		});
		let chooseAddressName=chooseAddress["ADDRESS_LINE_1"]+", "+chooseAddress["CITY_NAME"]+", "+chooseAddress["ZIPCODE"]+", South Africa";
		console.log(chooseAddressName);
		if(deliveryDate!="")
		{
			if(checkDate())
			{
				$.getJSON("https://geocoder.api.here.com/6.2/geocode.json?searchtext="+chooseAddressName+"&gen=9&app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw",{
					format:"json"
				})
				.done(data=>{
					coordinates=data;
					lat=coordinates["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Latitude"];
					long=coordinates["Response"]["View"][0]["Result"][0]["Location"]["DisplayPosition"]["Longitude"];
					$.ajax({
						url: 'PHPcode/deliverycode.php',
						type: 'POST',
						data:{choice:1,SALE_ID:saleID,ADDRESS_ID:chooseAddressID,dDate:deliveryDate,latitude:lat,longitude:long},
						beforeSend:function(){
							$('.loadingModal').modal('show');
						}
						})
						.done(data=>{
							$('.loadingModal').modal('hide');
							let doneData=data.split(",");
							console.log(doneData);
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

			}
			else
			{
				$('#MHeader').text("Error!");
				$("#MMessage").text("The Selected date is before today. Please select a date from today onwards.");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$("#displayModal").modal("show");
			}
		}
		else
		{
			$('#MHeader').text("Error!");
			$("#MMessage").text("Date not selected. Please select a date.");
			$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
			$("#modalHeader").css("background-color", "red");
			$("#btnClose").attr("data-dismiss","modal");
			$("#displayModal").modal("show");
		}			
	});


});