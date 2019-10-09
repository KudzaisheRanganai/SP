$(()=>{
	$.ajax({
		url:'PHPcode/warehousecode.php',
		type:'POST',
		data:{choice:3}

	})
	.done(data=>{
		if(data!="False")
		{
			let arr=JSON.parse(data);
			let tableEntries="";
			let formView="";
			for(let k=0;k<arr.length;k++)
			{
				formView="<form action='maintain.php' method='POST'><input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='DESCRIPTION' value='"+arr[k]["DESCRIPTION"]+"'>"+"<input type='hidden' name='WAREHOUSE_ID' value='"+arr[k]["WAREHOUSE_ID"]+"'>"+"<input type='hidden' name='MAX_PALLETS' value='"+arr[k]["MAX_PALLETS"]+"'>"+"<button class='btn btn-icon btn-2 btn-primary btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-wrench'></i></span><span class='btn-inner--text'>Maintain</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["DESCRIPTION"]+"</td><td>"+arr[k]["MAX_PALLETS"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
		}
		else
		{
			alert("Error");
		}
	});
});