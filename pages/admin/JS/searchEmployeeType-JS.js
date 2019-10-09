$(()=>{
	$.ajax({
		url: 'PHPcode/searchEmployeeType-SQL.php',
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
                let status;
                if(arr[k]["WAGE_EARNING"]==1)
                {
                    status = "Yes";
                }
                else
                {
                    status ="No";
                }
				formView="<form action='maintain-employee-type.php' method='POST'><input type='hidden' name='EMPLOYEE_TYPE_ID' value='"+arr[k]["EMPLOYEE_TYPE_ID"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='WAGE_EARNING' value='"+arr[k]["WAGE_EARNING"]+"'>"+"<input type='hidden' name='ROLE_NAME' value='"+arr[k]["ROLE_NAME"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>Edit</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["NAME"]+"</td><td>"+status+"</td><td>" + arr[k]["ROLE_NAME"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});
});