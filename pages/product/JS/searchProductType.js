$(()=>{
	$.ajax({
		url: 'PHPcode/searchProductType_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			let arr = JSON.parse(data);
			let tableEntries="";
			let formView="";
			let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				formView="<form action='maintain_type.php' method='POST'><input type='hidden' name='TYPE_NAME' value='"+arr[k]["TYPE_NAME"]+"'>"+"<input type='hidden' name='DESCRIPTION' value='"+arr[k]["DESCRIPTION"]+"'>"+"<input type='hidden' name='PRODUCT_TYPE_ID' value='"+arr[k]["PRODUCT_TYPE_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-primary btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-wrench'/></i></span><span class='btn-inner--text'>Maintain</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["TYPE_NAME"]+"</td><td>"+arr[k]["DESCRIPTION"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});

});