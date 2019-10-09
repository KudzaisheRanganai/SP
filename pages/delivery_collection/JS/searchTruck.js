$(()=>{
	$.ajax({
		url:'PHPcode/truckcode.php',
		type:'POST',
		data:{choice:3},
		beforeSend:function(){
			$('.loadingModal').modal('show');
		}
	})
	.done(data=>{
		$('.loadingModal').modal('hide');
		if(data!="False")
		{
			let arr=JSON.parse(data);
			let tableEntries="";
			let formView="";
			for(let k=0;k<arr.length;k++)
			{
				let activeStatus="";
				if(arr[k]["ACTIVE"]==1)
				{
					activeStatus="Yes";
				}
				else
				{
					activeStatus="No";
				}
				formView="<form action='maintain_truck.php' method='POST'><input type='hidden' name='REGISTRATION' value='"+arr[k]["REGISTRATION_NUMBER"]+"'>"+"<input type='hidden' name='TRUCK_NAME' value='"+arr[k]["TRUCK_NAME"]+"'>"+"<input type='hidden' name='TRUCK_ID' value='"+arr[k]["TRUCK_ID"]+"'>"+"<input type='hidden' name='CAPACITY' value='"+arr[k]["CAPACITY"]+"'>"+"<input type='hidden' name='ACTIVE' value='"+arr[k]["ACTIVE"]+"'>"+"<button class='btn btn-icon btn-2 btn-primary btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-wrench'></i></span><span class='btn-inner--text'>Maintain</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["REGISTRATION_NUMBER"]+"</td><td>"+arr[k]["TRUCK_NAME"]+"</td><td>"+arr[k]["CAPACITY"]+" tonnes"+"</td><td>"+activeStatus+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
		}
		else
		{
			alert("Error");
		}
	});
});