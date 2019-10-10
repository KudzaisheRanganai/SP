var indcount=1;
var orgcount=1;
// let CheckValid = function(valArr)
// {
// 	if(valArr["con"].length!=10)
// 	{
// 		$("#MMessage").text("Contact Number must be 10 digits");
// 		$("#btnClose").attr("data-dismiss","modal");
// 		$("#displayModal").modal("show");
// 		return false;
// 	}
// 	else if (valArr["vat"].length!=10)
// 	{
// 		$("#MMessage").text("VAT Number must be 10 digits.");
// 		$("#btnClose").attr("data-dismiss","modal");
// 		$("#displayModal").modal("show");
// 		return false;
// 	}
// 	else
// 	{
// 		return true;
// 	}
	
// }
let getIndInput= function()
{
	let name=$("#name-indi").val().trim();
	let surname=$("#surname-indi").val().trim();
	let title=$("#titleSelect option:selected").text();
	let titleID=1;
	if(title=="Ms")
	{
		titleID=2;
	}
	else if(title=="Mrs")
	{
		titleID=3
	}
	//let VatNum=$("#VATNumber").val().trim();
	let contact=$("#number-indi").val().trim();
	let email=$("#email-indi").val().trim();
	addressArr=[];
	suburbArr=[];
	zipArr=[];
	cityArr=[];
	$(".indinputAddress").each(function(index,item){
		let addr=$(item).val().trim().split(",");
		let a=addr[0];
		addressArr[index]=a;
	});
	$(".indinputSuburb").each(function(index,item){
		suburbArr[index]=$(item).val().trim();
	});
	$(".indinputCity").each(function(index,item){
		cityArr[index]=$(item).val().trim();
	});
	$(".indinputZip").each(function(index,item){
		zipArr[index]=$(item).val().trim();
	});

	let addSupplierArr=[];
	addSupplierArr["title"]=titleID;
	addSupplierArr["customer_type"]=1;
	addSupplierArr["status"]=1;
	addSupplierArr["name"]=name;
	addSupplierArr["surname"]=surname;
	addSupplierArr["con"]=contact;
	addSupplierArr["email"]=email;
	addSupplierArr["address"]=addressArr;
	addSupplierArr["suburb"]=suburbArr;
	addSupplierArr["city"]=cityArr;
	addSupplierArr["zip"]=zipArr;
	return addSupplierArr;
}
/////////////////////////////////////////////////////////////
let getOrgInput= function()
{
	let name=$("#name-org").val().trim();
	//let surname=$("#surname-indi").val().trim();
	//let title=1; //To add later
	let VatNum=$("#vat-org").val().trim();
	let contact=$("#number-org").val().trim();
	let email=$("#email-org").val().trim();
	addressArr=[];
	suburbArr=[];
	zipArr=[];
	cityArr=[];
	$(".orginputAddress").each(function(index,item){
		let addr=$(item).val().trim().split(",");
		let a=addr[0];
		addressArr[index]=a;
	});
	$(".orginputSuburb").each(function(index,item){
		suburbArr[index]=$(item).val().trim();
	});
	$(".orginputCity").each(function(index,item){
		cityArr[index]=$(item).val().trim();
	});
	$(".orginputZip").each(function(index,item){
		zipArr[index]=$(item).val().trim();
	});

	let addSupplierArr=[];
	//addSupplierArr["title"]=title;
	addSupplierArr["name"]=name;
	addSupplierArr["customer_type"]=2;
	addSupplierArr["status"]=1;
	addSupplierArr["vat"]=VatNum;
	addSupplierArr["con"]=contact;
	addSupplierArr["email"]=email;
	addSupplierArr["address"]=addressArr;
	addSupplierArr["suburb"]=suburbArr;
	addSupplierArr["city"]=cityArr;
	addSupplierArr["zip"]=zipArr;
	return addSupplierArr;
}
/////////////////////////////////////////////////////////////
let createIndAddress= function(tmp){
		let formgroup = $('<div></div>').addClass('form-group col').attr('id', 'indaddress'+tmp);;
		formgroup.append($("<hr>").addClass('my-4'));
		let form_row1= $('<div></div>').addClass('form-row');
		let input_group=$('<div></div>').addClass('input-group');
		input_group.append( $('<input>').addClass('form-control indinputAddress').attr('id', 'indinputAddress'+tmp).attr('type', 'text').attr('required','') );
		input_group.append( $('<span class="input-group-btn"><button class="btn btn-danger btn-remove-address-ind" type="button"><span class="btn-inner--icon"><i class="ni ni-fat-delete"></i></span></button>'))
		let formgroup2 = $('<div></div>').addClass('form-group col');
		formgroup2.append( $('<label></label>').attr('for', 'inputAddress'+tmp).html('Address '+tmp));
		formgroup2.append(input_group);
		form_row1.append(formgroup2);
		let form_row2=$('<div></div>').addClass('form-row');

		let suburb=$('<div></div>').addClass('form-group col-md-6');
		suburb.append( $('<label></label>').attr('for', 'inputSuburb'+tmp).html('Suburb'));
		suburb.append( $('<input></input>').addClass('form-control indinputSuburb').attr('id', 'indinputSuburb'+tmp));
		
		let city=$('<div></div>').addClass('form-group col-md-4');
		city.append( $('<label></label>').attr('for', 'inputCity'+tmp).html('City'));
		city.append( $('<input></input>').addClass('form-control indinputCity').attr('id', 'indinputCity'+tmp).attr('readonly',''));

		let zip=$('<div></div>').addClass('form-group col-md-2');
		zip.append( $('<label></label>').attr('for', 'inputZip'+tmp).html('Zip'));
		zip.append( $('<input></input>').addClass('form-control indinputZip').attr('id', 'indinputZip'+tmp).attr('readonly',''));

		form_row2.append(suburb);
		form_row2.append(city);
		form_row2.append(zip);
		formgroup.append(form_row1);
		formgroup.append(form_row2);
		return formgroup;
	}
let createOrgAddress= function(tmp){
		let formgroup = $('<div></div>').addClass('form-group col').attr('id', 'orgaddress'+tmp);;
		formgroup.append($("<hr>").addClass('my-4'));
		let form_row1= $('<div></div>').addClass('form-row');
		let input_group=$('<div></div>').addClass('input-group');
		input_group.append( $('<input>').addClass('form-control orginputAddress').attr('id', 'orginputAddress'+tmp).attr('type', 'text').attr('required','') );
		input_group.append( $('<span class="input-group-btn"><button class="btn btn-danger btn-remove-address-org" type="button"><span class="btn-inner--icon"><i class="ni ni-fat-delete"></i></span></button>'))
		let formgroup2 = $('<div></div>').addClass('form-group col');
		formgroup2.append( $('<label></label>').attr('for', 'inputAddress'+tmp).html('Address '+tmp));
		formgroup2.append(input_group);
		form_row1.append(formgroup2);
		let form_row2=$('<div></div>').addClass('form-row');

		let suburb=$('<div></div>').addClass('form-group col-md-6');
		suburb.append( $('<label></label>').attr('for', 'inputSuburb'+tmp).html('Suburb'));
		suburb.append( $('<input></input>').addClass('form-control orginputSuburb').attr('id', 'orginputSuburb'+tmp));
		
		let city=$('<div></div>').addClass('form-group col-md-4');
		city.append( $('<label></label>').attr('for', 'inputCity'+tmp).html('City'));
		city.append( $('<input></input>').addClass('form-control orginputCity').attr('id', 'orginputCity'+tmp).attr('readonly',''));

		let zip=$('<div></div>').addClass('form-group col-md-2');
		zip.append( $('<label></label>').attr('for', 'inputZip'+tmp).html('Zip'));
		zip.append( $('<input></input>').addClass('form-control orginputZip').attr('id', 'orginputZip'+tmp).attr('readonly',''));

		form_row2.append(suburb);
		form_row2.append(city);
		form_row2.append(zip);
		formgroup.append(form_row1);
		formgroup.append(form_row2);
		return formgroup;
	}
$(()=>{
	$.ajax({
      url: "JS/makeSale.js",
      dataType: "script",
      success: "success"
    });

	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
	$("#indinputAddress").on('keyup',function(e){
		e.preventDefault();
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:50
		})
		.done(data=>{
			//console.log(data.suggestions);
			let viewArr=[];
			let obj={label:"",index:""};
			//console.log(data.suggestions);
			for(k=0;k<data.suggestions.length;k++)
			{
				obj={label:"",index:""};
				obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
				obj.index=data.suggestions[k].locationId;
				viewArr.push(obj);
			}
			console.log(viewArr);
			let useArr=data.suggestions;
			$("#indinputAddress").autocomplete({
				source:viewArr,
				select: function(event,ui){
				//alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				console.log(finalObj);
				$("#indinputSuburb").val(finalObj[0].address.district);
				$("#indinputCity").val(finalObj[0].address.city);
				$("#indinputZip").val(finalObj[0].address.postalCode);
			}
			});

		});
	});
	///////////////////////////////////////////
	$("#orginputAddress").on('keyup',function(e){
			e.preventDefault();
			$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
				format:"json",
				delay:50
			})
			.done(data=>{
				//console.log(data.suggestions);
				let viewArr=[];
				let obj={label:"",index:""};
				//console.log(data.suggestions);
				for(k=0;k<data.suggestions.length;k++)
				{
					obj={label:"",index:""};
					obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
					obj.index=data.suggestions[k].locationId;
					viewArr.push(obj);
				}
				console.log(viewArr);
				let useArr=data.suggestions;
				$("#orginputAddress").autocomplete({
					source:viewArr,
					select: function(event,ui){
					// alert(ui.item.index);
					let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
					//console.log(finalObj);
					$("#orginputSuburb").val(finalObj[0].address.district);
					$("#orginputCity").val(finalObj[0].address.city);
					$("#orginputZip").val(finalObj[0].address.postalCode);
				}
				});

			});
	});
	/////////////////////////////////////////////////////////
	$(document).on('keyup','#indinputAddress2',function(e){
		e.preventDefault();
		console.log('test');
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:50
		})
		.done(data=>{
			console.log(data.suggestions);
			let viewArr=[];
			let obj={label:"",index:""};
			//console.log(data.suggestions);
			for(k=0;k<data.suggestions.length;k++)
			{
				obj={label:"",index:""};
				obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
				obj.index=data.suggestions[k].locationId;
				viewArr.push(obj);
			}
			console.log(viewArr);
			let useArr=data.suggestions;
			$("#indinputAddress2").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#indinputSuburb2").val(finalObj[0].address.district);
				$("#indinputCity2").val(finalObj[0].address.city);
				$("#indinputZip2").val(finalObj[0].address.postalCode);
			}
			});

		});

	});
	///////////////////////////////////////////////////////////////
	$(document).on('keyup','#orginputAddress2',function(e){
		e.preventDefault();
		console.log('test');
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:50
		})
		.done(data=>{
			console.log(data.suggestions);
			let viewArr=[];
			let obj={label:"",index:""};
			//console.log(data.suggestions);
			for(k=0;k<data.suggestions.length;k++)
			{
				obj={label:"",index:""};
				obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
				obj.index=data.suggestions[k].locationId;
				viewArr.push(obj);
			}
			console.log(viewArr);
			let useArr=data.suggestions;
			$("#orginputAddress2").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#orginputSuburb2").val(finalObj[0].address.district);
				$("#orginputCity2").val(finalObj[0].address.city);
				$("#orginputZip2").val(finalObj[0].address.postalCode);
			}
			});

		});
	});
	///////////////////////////////////////////////////////////////////
	$(document).on('keyup','#indinputAddress3',function(e){
		e.preventDefault();
		console.log('test');
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:50
		})
		.done(data=>{
			console.log(data.suggestions);
			let viewArr=[];
			let obj={label:"",index:""};
			//console.log(data.suggestions);
			for(k=0;k<data.suggestions.length;k++)
			{
				obj={label:"",index:""};
				obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
				obj.index=data.suggestions[k].locationId;
				viewArr.push(obj);
			}
			console.log(viewArr);
			let useArr=data.suggestions;
			$("#indinputAddress3").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#indinputSuburb3").val(finalObj[0].address.district);
				$("#indinputCity3").val(finalObj[0].address.city);
				$("#indinputZip3").val(finalObj[0].address.postalCode);
			}
			});

		});

	});
	//////////////////////////////////////////////////////////////////
	$(document).on('keyup','#orginputAddress3',function(e){
		e.preventDefault();
		console.log('test');
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:50
		})
		.done(data=>{
			console.log(data.suggestions);
			let viewArr=[];
			let obj={label:"",index:""};
			//console.log(data.suggestions);
			for(k=0;k<data.suggestions.length;k++)
			{
				obj={label:"",index:""};
				obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
				obj.index=data.suggestions[k].locationId;
				viewArr.push(obj);
			}
			console.log(viewArr);
			let useArr=data.suggestions;
			$("#orginputAddress3").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#orginputSuburb3").val(finalObj[0].address.district);
				$("#orginputCity3").val(finalObj[0].address.city);
				$("#orginputZip3").val(finalObj[0].address.postalCode);
			}
			});

		});

	});
	/////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////
	$("#btn-add-address-ind").on('click',function(e){
		e.preventDefault();
		indcount++;
		
		if(indcount<=3)
		{
			let el= createIndAddress(indcount);
			$('#mainfind').append(el);
			 
			if(indcount==3)
			{
				$("#btn-add-address-ind").attr('disabled','');
			}
		}
	});
	///////////////////////////////////////////////////////////
	$("#btn-add-address-org").on('click',function(e){
		e.preventDefault();
		orgcount++;
		
		if(orgcount<=3)
		{
			let el= createOrgAddress(orgcount);
			$('#mainforg').append(el);
			 
			if(orgcount==3)
			{
				$("#btn-add-address-org").attr('disabled','');
			}
		}
	});
	//////////////////////////////////////////////////////////////
	$('#mainfind').on('click','.btn-remove-address-ind', function(event) {
		event.preventDefault();
		/* Act on the event */
		
		console.log('test');
		$('#indaddress'+indcount).remove();
		indcount--;
		$("#btn-add-address-ind").removeAttr('disabled','');
	
	});
	////////////////////////////////////////////////////////////
	$('#mainforg').on('click','.btn-remove-address-org', function(event) {
		event.preventDefault();
		/* Act on the event */
		
		console.log('test');
		$('#orgaddress'+orgcount).remove();
		orgcount--;
		$("#btn-add-address-org").removeAttr('disabled','');
	
	});
	////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////
	$("#btnSaveind").on('click',function(e){
		e.preventDefault();
		console.log(indcount);
		let form=$('#mainfind');
		form.validate();
		//element.valid();78\6\\\\\\\\\\\\
		if(form.valid()===false)
		{
			e.stopPropagation();
		}
		else
		{
			
			
			let arr=getIndInput();
			console.log(arr);
			// if(CheckValid(arr)!=true)
			// {
			// 	e.stopPropagation();
			// }
			// else
			// {
				$.ajax({
					url: 'PHPcode/customercode.php',
					type: 'POST',
					data:{choice:4,num:indcount,name:arr["name"],title:arr["title"],surname:arr["surname"],contact:arr["con"],email:arr["email"],address:arr["address"],suburb:arr["suburb"],city:arr["city"],zip:arr["zip"],customer_type:arr["customer_type"],status:arr["status"]}
				})
				.done(data=>{
					let doneData=data.split(",");
					console.log(doneData);
					if(doneData[0]=="T")
					{
						//alert("True");
						$('#registerCustomerModal').modal('hide');
						$("#MMessage").text(doneData[1]);
						$('#modal-title-default2').text("Success!");
						$('#animation2').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
						$("#modalHeader2").css("background-color", "#1ab394");
						$("#btnClose").attr("onclick","window.location='../../customer.php'");
						$("#displayModal").modal("show");

						$.ajax({
							url: 'PHPcode/getCustomers.php',
							type: 'POST',
							data: '' 
						})
						.done(data=>{
							if(data!="False")
							{
								let customersArray = JSON.parse(data);
								console.log(customersArray);
								$('#menuOfCustomers').empty();
								buildCustomersDropDown(customersArray);

								$("input[id*='dropdownItemCust']").on('click', function(){
									let customerIndex = this.name;


									SALECUSTOMERID = customersArray[customerIndex].CUSTOMER_ID;
									//console.log(SALECUSTOMERID);
									$('#customerSearchInput').val("");
									let custtomerID = $('#customerSearchInput').val();
									let customerCard = $('#customerCard');
									let customerInfo = '<tr><th class="py-1">Customer ID</th><td class="py-1">'+customersArray[customerIndex].CUSTOMER_ID+'</td></tr><tr><th class="py-1">Name</th><td class="py-1">'+customersArray[customerIndex].NAME+'</td></tr>';
									INVOICE_CUSTOMER_NAME = customersArray[customerIndex].NAME;
									INVOICE_CUSTOMER_EMAIL = customersArray[customerIndex].EMAIL;
									if (customersArray[customerIndex].SURNAME != null) 
									{
										customerInfo +='<tr><th class="py-1">Surname</th><td class="py-1">'+customersArray[customerIndex].SURNAME+'</td></tr>';
										INVOICE_CUSTOMER_NAME += " ";
										INVOICE_CUSTOMER_NAME += customersArray[customerIndex].SURNAME;
									}
									else
									{
										customerInfo +='<tr><th class="py-1">VAT Number</th><td class="py-1">'+customersArray[customerIndex].VAT_NUMBER+'</td></tr>';
									}
									customerInfo +='<tr><th class="py-1">Contact No</th><td class="py-1">'+customersArray[customerIndex].CONTACT_NUMBER+'</td></tr>'
									customerCard.html(customerInfo);

									$.ajax({
										url: 'PHPcode/getSaleDeliveryAddress.php',
										type: 'POST',
										data: { 
											customerID : SALECUSTOMERID,
										}
									})
									.done(response => {
										let customerAddressDetails = JSON.parse(response);
										
										if (response != "false") 
										{
											var addresses = "";
											for (var i = 0; i < customerAddressDetails.length; i++) {
												//console.log(customerAddressDetails[i].ADDRESS_ID);
												var checked = "";
												if (i == 0) 
												{
													checked = "checked";
													INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;

												}
												addresses +='<div class="custom-control custom-radio mb-3 col"><input name="custom-radio-2" class="custom-control-input deliveryAddressSelect" array-index="'+i+'" id="addressSelect'+i+'" type="radio" value="'+customerAddressDetails[i].ADDRESS_ID+'"'+checked+'><label class="custom-control-label" for="addressSelect'+i+'">'+customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE+'</label></div>';
											}
											let addressesDiv = $('#customerAddresses');
											addressesDiv.html(addresses);

											SALEDELIVERYADDRESSID = $('.deliveryAddressSelect:checked').val();
											//console.log(SALEDELIVERYADDRESSID);

											$('.deliveryAddressSelect').on('input', function()
											{
												//console.log(this.value);
												if (this.checked) 
												{
													SALEDELIVERYADDRESSID = this.value;
													i = this.getAttribute("array-index");;
													INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;
													//console.log(INVOICE_CUSTOMER_ADDRESS);
													//console.log(SALEDELIVERYADDRESSID);
													

												}
												else
												{
													console.log(SALEDELIVERYADDRESSID);
												}
											});	
										}
										else
										{
											var addresses = "";
											let addressesDiv = $('#customerAddresses');
											addressesDiv.html(addresses);
										}
										
										ajaxDone = true;
									});
									
								});
							}
							else
							{
								alert("Error retrieving customers");
							}
						});
					}
					else
					{
						//alert(doneData[1]);
						$('#modal-title-default2').text("Error!");
						$('#modalText').text("Database error");
						$('#animation2').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
						$("#modalHeader2").css("background-color", "red");
						$('#successfullyAdded').modal("show");
						$("#btnClose").attr("data-dismiss","modal");
						$("#displayModal").modal("show");
					}
				});	
			// }
			
		}
	});


	////////////////////////////////////////////////////////////////////
	$("#btnSaveorg").on('click',function(e){
		e.preventDefault();
		console.log(orgcount);
		let form=$('#mainforg');
		form.validate();
		//element.valid();78\6\\\\\\\\\\\\
		if(form.valid()===false)
		{
			e.stopPropagation();
		}
		else
		{
			
			
			let arr=getOrgInput();

				$.ajax({
					url: 'PHPcode/customercode.php',
					type: 'POST',
					data:{choice:1,num:orgcount,name:arr["name"],vat:arr["vat"],contact:arr["con"],email:arr["email"],address:arr["address"],suburb:arr["suburb"],city:arr["city"],zip:arr["zip"],customer_type:arr["customer_type"],status:arr["status"]}
					,beforeSend: function(){
				        $('.loadingModal').modal('show');
				    }
				})
				.done(data=>{
					//alert(data);
					$('.loadingModal').modal('hide');
					let doneData=data.split(",");
					console.log(doneData);
					if(doneData[0]=="T")
					{
						//alert("True");
						$('#registerCustomerModal').modal('hide');
						$("#MMessage").text(doneData[1]);
						$('#modal-title-default2').text("Success!");
						$('#animation2').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
						$("#modalHeader2").css("background-color", "#1ab394");
						$("#btnClose").attr("onclick","window.location='../../customer.php'");
						$("#displayModal").modal("show");

						$.ajax({
							url: 'PHPcode/getCustomers.php',
							type: 'POST',
							data: '' 
						})
						.done(data=>{
							if(data!="False")
							{
								let customersArray = JSON.parse(data);
								console.log(customersArray);
								$('#menuOfCustomers').empty();
								buildCustomersDropDown(customersArray);

								$("input[id*='dropdownItemCust']").on('click', function(){
									let customerIndex = this.name;


									SALECUSTOMERID = customersArray[customerIndex].CUSTOMER_ID;
									//console.log(SALECUSTOMERID);
									$('#customerSearchInput').val("");
									let custtomerID = $('#customerSearchInput').val();
									let customerCard = $('#customerCard');
									let customerInfo = '<tr><th class="py-1">Customer ID</th><td class="py-1">'+customersArray[customerIndex].CUSTOMER_ID+'</td></tr><tr><th class="py-1">Name</th><td class="py-1">'+customersArray[customerIndex].NAME+'</td></tr>';
									INVOICE_CUSTOMER_NAME = customersArray[customerIndex].NAME;
									INVOICE_CUSTOMER_EMAIL = customersArray[customerIndex].EMAIL;
									if (customersArray[customerIndex].SURNAME != null) 
									{
										customerInfo +='<tr><th class="py-1">Surname</th><td class="py-1">'+customersArray[customerIndex].SURNAME+'</td></tr>';
										INVOICE_CUSTOMER_NAME += " ";
										INVOICE_CUSTOMER_NAME += customersArray[customerIndex].SURNAME;
									}
									else
									{
										customerInfo +='<tr><th class="py-1">VAT Number</th><td class="py-1">'+customersArray[customerIndex].VAT_NUMBER+'</td></tr>';
									}
									customerInfo +='<tr><th class="py-1">Contact No</th><td class="py-1">'+customersArray[customerIndex].CONTACT_NUMBER+'</td></tr>'
									customerCard.html(customerInfo);

									$.ajax({
										url: 'PHPcode/getSaleDeliveryAddress.php',
										type: 'POST',
										data: { 
											customerID : SALECUSTOMERID,
										}
									})
									.done(response => {
										let customerAddressDetails = JSON.parse(response);
										
										if (response != "false") 
										{
											var addresses = "";
											for (var i = 0; i < customerAddressDetails.length; i++) {
												//console.log(customerAddressDetails[i].ADDRESS_ID);
												var checked = "";
												if (i == 0) 
												{
													checked = "checked";
													INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;

												}
												addresses +='<div class="custom-control custom-radio mb-3 col"><input name="custom-radio-2" class="custom-control-input deliveryAddressSelect" array-index="'+i+'" id="addressSelect'+i+'" type="radio" value="'+customerAddressDetails[i].ADDRESS_ID+'"'+checked+'><label class="custom-control-label" for="addressSelect'+i+'">'+customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE+'</label></div>';
											}
											let addressesDiv = $('#customerAddresses');
											addressesDiv.html(addresses);

											SALEDELIVERYADDRESSID = $('.deliveryAddressSelect:checked').val();
											//console.log(SALEDELIVERYADDRESSID);

											$('.deliveryAddressSelect').on('input', function()
											{
												//console.log(this.value);
												if (this.checked) 
												{
													SALEDELIVERYADDRESSID = this.value;
													i = this.getAttribute("array-index");;
													INVOICE_CUSTOMER_ADDRESS = customerAddressDetails[i].ADDRESS_LINE_1+', '+customerAddressDetails[i].NAME+', '+customerAddressDetails[i].CITY_NAME+', '+customerAddressDetails[i].ZIPCODE;
													//console.log(INVOICE_CUSTOMER_ADDRESS);
													//console.log(SALEDELIVERYADDRESSID);
													

												}
												else
												{
													console.log(SALEDELIVERYADDRESSID);
												}
											});	
										}
										else
										{
											var addresses = "";
											let addressesDiv = $('#customerAddresses');
											addressesDiv.html(addresses);
										}
										
										ajaxDone = true;
									});
									
								});
							}
							else
							{
								alert("Error retrieving customers");
							}
						});
					}
					else
					{
						//alert(doneData[1]);
						$('#modal-title-default2').text("Error!");
						$('#modalText').text("Database error");
						$('#animation2').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
						$("#modalHeader2").css("background-color", "red");
						$('#successfullyAdded').modal("show");
						$("#btnClose").attr("data-dismiss","modal");
						$("#displayModal").modal("show");
					}
				});
		}
	});

});