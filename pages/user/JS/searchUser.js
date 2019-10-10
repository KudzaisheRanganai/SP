$(()=>{
	$.ajax({
		url: 'PHPcode/searchUser-SQL.php',
		type: 'POST',
		data: {choice:2}
	})
	.done(data=>{	
		console.log(data);
		if(data!="False")
		{
			let arr=JSON.parse(data);
			console.log(arr);
			let tableEntries="";
			let formView="";
			//let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				
				formView="<form action='maintain-user.php' method='POST'><input type='hidden' name='USER_ID' value='"+arr[k]["USER_ID"]+"'>"+"<input type='hidden' name='EMPLOYEE_ID' value='"+arr[k]["EMPLOYEE_ID"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='SURNAME' value='"+arr[k]["SURNAME"]+"'>"+"<input type='hidden' name='ROLE_NAME' value='"+arr[k]["ROLE_NAME"]+"'>"+"<input type='hidden' name='USERNAME' value='"+arr[k]["USERNAME"]+"'>"+"<input type='hidden' name='USER_PASSWORD' value='"+arr[k]["USER_PASSWORD"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>Edit</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["USER_ID"]+"</td><td>"+arr[k]["EMPLOYEE_ID"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["SURNAME"]+"</td><td>" + arr[k]["ROLE_NAME"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});
});