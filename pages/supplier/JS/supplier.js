var count=1;
let CheckValid = function(valArr)
{
	if(valArr["con"].length!=10)
	{
		$('#MHeader').text("Error!");
		$("#MMessage").text("Contact Number must be 10 digits");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#btnClose").attr("data-dismiss","modal");
		$("#displayModal").modal("show");
		return false;
	}
	else if (valArr["VATNumber"].length!=10)
	{
		$('#MHeader').text("Error!");
		$("#MMessage").text("VAT Number must be 10 digits");
		$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		$("#modalHeader").css("background-color", "red");
		$("#btnClose").attr("data-dismiss","modal");
		$("#displayModal").modal("show");
		return false;
	}
	else
	{
		return true;
	}
	
}

let getInput= function()
{
	let name=$("#supplierName").val().trim();
	let VatNum=$("#VATNumber").val().trim();
	let contact=$("#ContactNo").val().trim();
	let email=$("#supplierEmail").val().trim();
	// let address1=$("#inputAddress").val().trim();
	// let suburb=$("#inputSuburb").val().trim();
	// let city=$("#inputCity").val().trim();
	// let zip=$("#inputZip").val().trim();
	// let address2=$("#inputAddress2").val().trim();
	// let suburb2=$("#inputSuburb2").val().trim();
	// let city2=$("#inputCity2").val().trim();
	// let zip2=$("#inputZip2").val().trim();
	// let address3=$("#inputAddress3").val().trim();
	// let suburb3=$("#inputSuburb3").val().trim();
	// let city3=$("#inputCity3").val().trim();
	// let zip3=$("#inputZip3").val().trim();
	addressArr=[];
	suburbArr=[];
	zipArr=[];
	cityArr=[];
	$(".inputAddress").each(function(index,item){
		let addr=$(item).val().trim().split(",");
		let a=addr[0];
		addressArr[index]=a;
	});
	$(".inputSuburb").each(function(index,item){
		suburbArr[index]=$(item).val().trim();
	});
	$(".inputCity").each(function(index,item){
		cityArr[index]=$(item).val().trim();
	});
	$(".inputZip").each(function(index,item){
		zipArr[index]=$(item).val().trim();
	});
	// for(let k=0;k<count;k++)
	// {
	// 	let a="#inputAddress"+k;
	// 	let s="#inputSuburb"+k;
	// 	let c="#inputCity"+k;
	// 	let z="#inputZip"+k;
	// 	addressArr[k]=$(a).val().trim();
	// 	suburbArr[k]=$(s).val().trim();
	// 	cityArr[k]=$(c).val().trim();
	// 	zipArr[k]=$(z).val().trim();
	// }

	let addSupplierArr=[];
	addSupplierArr["name"]=name;
	addSupplierArr["VATNumber"]=VatNum;
	addSupplierArr["con"]=contact;
	addSupplierArr["email"]=email;
	addSupplierArr["address"]=addressArr;
	addSupplierArr["suburb"]=suburbArr;
	addSupplierArr["city"]=cityArr;
	addSupplierArr["zip"]=zipArr;
	return addSupplierArr;


}

	let createAddress= function(tmp){
		let formgroup = $('<div></div>').attr('id', 'address'+tmp);;
		formgroup.append($("<hr>").addClass('my-4'));
		let form_row1= $('<div></div>').addClass('form-row');
		let input_group=$('<div></div>').addClass('input-group');
		input_group.append( $('<input>').addClass('form-control inputAddress').attr('id', 'inputAddress'+tmp).attr('type', 'text').attr('required','') );
		input_group.append( $('<span class="input-group-btn"><button class="btn btn-danger btn-remove-address" type="button"><span class="btn-inner--icon"><i class="ni ni-fat-delete"></i></span></button>'))
		let formgroup2 = $('<div></div>').addClass('form-group col');
		formgroup2.append( $('<label></label>').attr('for', 'inputAddress'+tmp).html('Address '+tmp));
		formgroup2.append(input_group);
		form_row1.append(formgroup2);
		let form_row2=$('<div></div>').addClass('form-row');

		let suburb=$('<div></div>').addClass('form-group col-md-6');
		suburb.append( $('<label></label>').attr('for', 'inputSuburb'+tmp).html('Suburb'));
		suburb.append( $('<input></input>').addClass('form-control inputSuburb').attr('id', 'inputSuburb'+tmp));
		
		let city=$('<div></div>').addClass('form-group col-md-4');
		city.append( $('<label></label>').attr('for', 'inputCity'+tmp).html('City'));
		city.append( $('<input></input>').addClass('form-control inputCity').attr('id', 'inputCity'+tmp).attr('readonly',''));

		let zip=$('<div></div>').addClass('form-group col-md-2');
		zip.append( $('<label></label>').attr('for', 'inputZip'+tmp).html('Zip'));
		zip.append( $('<input></input>').addClass('form-control inputZip').attr('id', 'inputZip'+tmp).attr('readonly',''));

		form_row2.append(suburb);
		form_row2.append(city);
		form_row2.append(zip);
		formgroup.append(form_row1);
		formgroup.append(form_row2);
		return formgroup;
	}

$(()=>{
	//APP ID: 4ubUBkg0ecyvqIcmRpJw
	//APP CODE : R1S3qwnTFxK3FbiK1ucSqw
	jQuery.validator.setDefaults({
  		debug: true,
  		success: "valid"
	});
	$("#inputAddress").on('keyup',function(e){
		e.preventDefault();
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:100
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
			$("#inputAddress").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#inputSuburb").val(finalObj[0].address.district);
				$("#inputCity").val(finalObj[0].address.city);
				$("#inputZip").val(finalObj[0].address.postalCode);
			}
			});

		});

	});

	$(document).on('keyup','#inputAddress2',function(e){
		e.preventDefault();
		console.log('test');
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:100
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
			$("#inputAddress2").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#inputSuburb2").val(finalObj[0].address.district);
				$("#inputCity2").val(finalObj[0].address.city);
				$("#inputZip2").val(finalObj[0].address.postalCode);
			}
			});

		});

	});

	$(document).on('keyup','#inputAddress3',function(e){
		e.preventDefault();
		console.log('test');
		$.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
			format:"json",
			delay:100
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
			$("#inputAddress3").autocomplete({
				source:viewArr,
				select: function(event,ui){
				// alert(ui.item.index);
				let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
				//console.log(finalObj);
				$("#inputSuburb3").val(finalObj[0].address.district);
				$("#inputCity3").val(finalObj[0].address.city);
				$("#inputZip3").val(finalObj[0].address.postalCode);
			}
			});

		});

	});




	$("#btn-add-address").on('click',function(e){
		e.preventDefault();
		count++;
		
		if(count<=3)
		{
			let el= createAddress(count);
			$('#mainf').append(el);
			 
			if(count==3)
			{
				$("#btn-add-address").attr('disabled','');
			}
		}

		

	});

	$('#mainf').on('click','.btn-remove-address', function(event) {
		event.preventDefault();
		/* Act on the event */
		
		console.log('test');
		$('#address'+count).remove();
		count--;
		$("#btn-add-address").removeAttr('disabled','');
	
	});

	$("#addSave").on('click',function(e){
		e.preventDefault();
		console.log(count);
		let form=$('#mainf');
		form.validate();
		//element.valid();78\6\\\\\\\\\\\\
		if(form.valid()===false)
		{
			e.stopPropagation();
		}
		else
		{
			
			
			let arr=getInput();
			console.log(arr);
			if(CheckValid(arr)!=true)
			{
				e.stopPropagation();
			}
			else
			{
				$.ajax({
				url: 'PHPcode/addSupplierCode.php',
				type: 'POST',
				data:{choice:1,num:count,name:arr["name"],vat:arr["VATNumber"],contact:arr["con"],email:arr["email"],address:arr["address"],suburb:arr["suburb"],city:arr["city"],zip:arr["zip"]},
				beforeSend:function(){
					$('.loadingModal').modal('show');
				},
				complete:function(){
					$('.loadingModal').modal('hide');
				} 
				})
				.done(data=>{
					//alert(data);
					let doneData=data.split(",");
					console.log(doneData);
					if(doneData[0]=="T")
					{
						$('#MHeader').text("Success!");
						$("#MMessage").text(doneData[1]);
						$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
						$("#modalHeader").css("background-color", "#1ab394");
						$("#btnClose").attr("onclick","window.location='../../supplier.php'");
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
			
		}
	});
	/////////////////////////////////////////////////
	

});