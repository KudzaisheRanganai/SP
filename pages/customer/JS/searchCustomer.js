$(()=>{
	$.ajax({
		url: 'PHPcode/customercode.php',
		type: 'POST',
		data: {choice:3} 
	})
	.done(data=>{
		if(data!="False")
		{

			let arr=JSON.parse(data);
			console.log(arr);
			let tableEntries="";
			let formView="";
			let surname="";
			//let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				
				if(arr[k]["SURNAME"]==null)
				{
					surname="Organisation";
				}
				else
				{
					surname=arr[k]["SURNAME"];
				}
				formView="<form action='view.php' method='POST'><input type='hidden' name='ID' value='"+arr[k]["CUSTOMER_ID"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='SURNAME' value='"+arr[k]["SURNAME"]+"'>"+"<input type='hidden' name='CONTACT_NUMBER' value='"+arr[k]["CONTACT_NUMBER"]+"'>"+"<input type='hidden' name='EMAIL' value='"+arr[k]["EMAIL"]+"'>"+"<input type='hidden' name='VAT' value='"+arr[k]["VAT_NUMBER"]+"'>"+"<input type='hidden' name='TITLE_ID' value='"+arr[k]["TITLE_ID"]+"'>"+"<input type='hidden' name='CUSTOMER_TYPE_ID' value='"+arr[k]["CUSTOMER_TYPE_ID"]+"'>"+"<input type='hidden' name='STATUS_ID' value='"+arr[k]["STATUS_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["CUSTOMER_ID"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+surname+"</td><td>"+arr[k]["CONTACT_NUMBER"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});
});