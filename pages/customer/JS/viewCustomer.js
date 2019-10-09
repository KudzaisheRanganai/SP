var addressInfo;
var suburbInfo;
var cityInfo;
var changedAddressInfo;
var chnagedSuburbInfo;
var changedCityInfo;
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
	let accountCheck=$("#cAccountCheck").text();
	let accountButton="";
	if(accountCheck=="True")
	{
		accountButton=$("<button></button>").addClass("btn btn-icon btn-2 btn-default btn-sm").css("width", "10rem");
		accountButton.attr("type","submit");
		accountButton.append("<span class='btn-inner--icon'><i class='fas fa-eye'></i></span>");
		let innerButtonText=$("<span></span>").addClass("btn-inner--text");
		innerButtonText.text("View Credit Account");
		accountButton.append(innerButtonText);
		$("#formAccount").append(accountButton);
		$("#formAccount").attr("action","view-credit-account.php");
	}
	else
	{
		accountButton=$("<button></button>").addClass("btn btn-icon btn-2 btn-default btn-sm").css("width", "10rem");
		accountButton.attr("type","submit");
		accountButton.append("<span class='btn-inner--icon'><i class='fas fa-eye'></i></span>");
		let innerButtonText=$("<span></span>").addClass("btn-inner--text");
		innerButtonText.text("Apply For Credit");
		accountButton.append(innerButtonText);
		$("#formAccount").append(accountButton);
		$("#formAccount").attr("action","apply-for-credit.php");
	}
	let customerName=$("#cName").text();
	let changedName=customerName.replace(" ","/");
	$("#NAME").val(changedName);
	addressInfo=JSON.parse($("#addresses").text());
	suburbInfo=JSON.parse($("#suburbs").text());
	cityInfo=JSON.parse($("#cities").text());
	changedAddressInfo=addressInfo;
	chnagedSuburbInfo=suburbInfo;
	changedCityInfo=cityInfo;
	for(let k=0;k<addressInfo.length;k++)
	{
		changedAddressInfo[k]["ADDRESS_LINE_1"]=changedAddressInfo[k]["ADDRESS_LINE_1"].replace(" ","/");
		chnagedSuburbInfo[k]["NAME"]=chnagedSuburbInfo[k]["NAME"].replace(" ","/");
		changedCityInfo[k]["CITY_NAME"]=changedCityInfo[k]["CITY_NAME"].replace(" ","/");
	}
	$("#ADDR").val(JSON.stringify(changedAddressInfo));
	$("#SUBURB").val(JSON.stringify(chnagedSuburbInfo));
	$("#CITY").val(JSON.stringify(changedCityInfo));
	$("#accountADDR").val(JSON.stringify(changedAddressInfo));
	$("#accountSUBURB").val(JSON.stringify(chnagedSuburbInfo));
	$("#accountCITY").val(JSON.stringify(changedCityInfo));
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



	  $("#formDelete").on('submit',(function(e) {
        e.preventDefault();
        console.log("delete");
        $.ajax({
            url: "PHPcode/delete.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                console.log(data);
                if(data=="success"){
                	console.log("success");
	    			$('#modal-title-default2').text("Success!");
					$('#modalText').text("Customer deleted successfully");
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$('#successfullyAdded').modal("show");
					$("#btnClose").attr("onclick","window.location='search.php'");
					$("#displayModal").modal("show");
										
                }
                else{
               
                	console.log("failed");
					$('#modal-title-default2').text("Error!");
					$('#modalText').text("Customer has a transaction(s) , customer not deleted");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$('#successfullyAdded').modal("show");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
                }
       
              }           
        });
    }));
    

});