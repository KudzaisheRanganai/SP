var addressInfo;
var suburbInfo;
var cityInfo;
var accountCheck;
let createListItem=function(val)
{
	let listItem=$("<li></li>").addClass("nav-item");
	let item=$("<a></a>").addClass("nav-link");
	if(val==0)
	{
		item.addClass("active");
	}
	plusVal=val+1;
	let=itemID="address"+plusVal;
	item.attr("id",itemID);
	item.attr("data-toggle","pill");
	item.attr("href","#pills-home");
	item.text("Address"+plusVal);
	if(val==0)
	{
		item.attr("aria-selected",true);
	}
	else
	{
		item.attr("aria-selected",false);
	}
	item.attr("role","tab");
	item.attr("aria-controls","pills-home");
	listItem.append(item);
	$("#listAddress").append(listItem);
	let itemInfoId="inputAddressInfo"+plusVal;
	let listInfo=$("<div></div>").addClass("tab-pane fade");
	if(val==0)
	{
		listInfo.addClass("show active");
	}
	listInfo.attr("id",itemInfoId);
	listInfo.attr("role","tab-panel");
	listInfo.attr("aria-labelledby",itemID);
	listInfo.append($("<i></i>").addClass("ni location_pin mr-2 text-center"));
	listInfo.append($("<h3></h3>").addClass("text-center pt-0 mt-0").append($("<b>Address :</b>")));
	listInfo.append($("<p></p>").addClass("mb-0").text(addressInfo[val]["ADDRESS_LINE_1"]));
	listInfo.append($("<p></p>").addClass("mb-0").text(suburbInfo[val]["NAME"]+", "+suburbInfo[val]["ZIPCODE"]));
	listInfo.append($("<p></p>").addClass("mb-0").text(cityInfo[val]["CITY_NAME"]));
	listInfo.append($("<p></p>").addClass("mb-0").text("South Africa"));
	$("#listAddress").append(listItem);
	$("#pills-tabContent").append(listInfo);


}
$(()=>{
	addressInfo=JSON.parse($("#addresses").text());
	suburbInfo=JSON.parse($("#suburbs").text());
	cityInfo=JSON.parse($("#cities").text());
	// let testArr=JSON.parse($("#test").val());
	console.log(addressInfo);
	// console.log($("#supName").text());
	let supplierName=$("#supName").text().trim();
	console.log(supplierName);
	let changedName=supplierName.replace(" ","/");
	let changedAddressInfo=addressInfo;
	let chnagedSuburbInfo=suburbInfo;
	let changedCityInfo=cityInfo;
	accountCheck=$("#accCheck").val();
	console.log(accountCheck);
	$("#accName").val(supplierName);
	if(accountCheck=="")
	{
		$("#btnViewAccount").attr("disabled",true);
	}
	else
	{
		$("#btnViewAccount").attr("disabled",false);
	}
	for(let k=0;k<addressInfo.length;k++)
	{
		changedAddressInfo[k]["ADDRESS_LINE_1"]=changedAddressInfo[k]["ADDRESS_LINE_1"].replace(" ","/");
		chnagedSuburbInfo[k]["NAME"]=chnagedSuburbInfo[k]["NAME"].replace(" ","/");
		changedCityInfo[k]["CITY_NAME"]=changedCityInfo[k]["CITY_NAME"].replace(" ","/");
	}
	$("#ADDR").val(JSON.stringify(changedAddressInfo));
	$("#SUBURB").val(JSON.stringify(chnagedSuburbInfo));
	$("#CITY").val(JSON.stringify(changedCityInfo));
	$("#NAME").val(changedName);
	let list=$("#listAddress");
	let listElement="";
	let num=0
	for(let k=0;k<addressInfo.length;k++)
	{
			createListItem(k);
	}

	$(document).on('click',"#address1",function(e){
		e.preventDefault();
		$(".show").removeClass("show");
		$(".active").removeClass("active");
		$("#address1").addClass("show active");
		$("#inputAddressInfo1").addClass("show active");

	});
	$(document).on('click',"#address2",function(e){
		e.preventDefault();
		$(".show").removeClass("show");
		$(".active").removeClass("active");
		$("#address2").addClass("show active");
		$("#inputAddressInfo2").addClass("show active");

	});
	$(document).on('click',"#address3",function(e){
		e.preventDefault();
		$(".show").removeClass("show");
		$(".active").removeClass("active");
		$("#address3").addClass("show active");
		$("#inputAddressInfo3").addClass("show active");

	});

	$("#btnDelete").on('click',function(e){
		e.preventDefault();
		console.log("Hello");
		let supplierID=parseInt($("#sID").text());
		console.log(supplierID);
		$.ajax({
			url:'PHPcode/deletesuppliercode.php',
			type:'POST',
			data:{SUPPLIER_ID:supplierID}
		})
		.done(data=>{
			let doneData=data.split(",");
			console.log(doneData);
			if(doneData[0]=="T")
			{
				$('#MHeader').text("Success!");
				$("#MMessage").text(doneData[1]);
				$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
				$("#modalHeader").css("background-color", "#1ab394");
				$("#btnClose").attr("onclick","window.location='search-supplier.php'");
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