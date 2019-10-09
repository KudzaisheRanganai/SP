$(()=>{
	$.ajax({
		url: 'PHPcode/searchProduct_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let arr = JSON.parse(data);
			//console.log(arr);
			let tableEntries="";
			let formView="";
			let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				formView="<form action='view.php' method='POST'><input type='hidden' name='CASES_PER_PALLET' value='"+arr[k]["CASES_PER_PALLET"]+"'>"+"<input type='hidden' name='CASES_QUANTITY' value='"+arr[k]["CASES_QUANTITY"]+"'>"+"<input type='hidden' name='COST_PRICE' value='"+arr[k]["COST_PRICE"]+"'>"+"<input type='hidden' name='GUIDE_DISCOUNT' value='"+arr[k]["GUIDE_DISCOUNT"]+"'>"+"<input type='hidden' name='INDIVIDUAL_QUANTITY' value='"+arr[k]["INDIVIDUAL_QUANTITY"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='PALLETS_QUANTITY' value='"+arr[k]["PALLETS_QUANTITY"]+"'>"+"<input type='hidden' name='PRODUCT_GROUP_ID' value='"+arr[k]["PRODUCT_GROUP_ID"]+"'>"+"<input type='hidden' name='PRODUCT_MEASUREMENT' value='"+arr[k]["PRODUCT_MEASUREMENT"]+"'>"+"<input type='hidden' name='PRODUCT_MEASUREMENT_UNIT' value='"+arr[k]["PRODUCT_MEASUREMENT_UNIT"]+"'>"+"<input type='hidden' name='SELLING_PRICE' value='"+arr[k]["SELLING_PRICE"]+"'>"+"<input type='hidden' name='TYPE_NAME' value='"+arr[k]["TYPE_NAME"]+"'>"+"<input type='hidden' name='PRODUCT_TYPE_ID' value='"+arr[k]["PRODUCT_TYPE_ID"]+"'>"+"<input type='hidden' name='UNITS_PER_CASE' value='"+arr[k]["UNITS_PER_CASE"]+"'>"+"<input type='hidden' name='PRODUCT_DESCR' value='"+arr[k]["PRODUCT_DESCR"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-eye'/></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["NAME"]+" ("+arr[k]["PRODUCT_MEASUREMENT"]+arr[k]["PRODUCT_MEASUREMENT_UNIT"]+")</td><td>"+arr[k]["TYPE_NAME"]+"</td><td>"+arr[k]["PALLETS_QUANTITY"]+"</td><td>"+arr[k]["CASES_QUANTITY"]+"</td><td>"+arr[k]["INDIVIDUAL_QUANTITY"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});

});