$(()=>{
	$.ajax({
		url: 'PHPcode/addSuppliercode.php',
		type: 'POST',
		data: {choice:3}
	})
	.done(data=>{
		if(data!="False")
		{
			let arr=JSON.parse(data);
			//console.log(arr);
			let tableEntries="";
			let formView="";
			//let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				
				formView="<form action='view-supplier.php' method='POST'><input type='hidden' name='ID' value='"+arr[k]["SUPPLIER_ID"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='VAT' value='"+arr[k]["VAT_NUMBER"]+"'>"+"<input type='hidden' name='PHONE' value='"+arr[k]["CONTACT_NUMBER"]+"'>"+"<input type='hidden' name='EMAIL' value='"+arr[k]["EMAIL"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["SUPPLIER_ID"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["CONTACT_NUMBER"]+"</td><td>"+arr[k]["EMAIL"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});
});