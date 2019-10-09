$(()=>{

	var date=$('#DATE').html();

	$.ajax({
		url: 'PHPcode/employeeAttendenceCode.php',
		type: 'POST',
		data: {DATE:date} 
	})
	.done(data=>{
		if(data!="False")
		{
			let arr=JSON.parse(data);
			console.log(arr);
			let tableEntries="";
			let formView="";
			//let formEdit="1"
			let redCount=0;
			let greenCount=0;
			for(let k=0;k<arr.length;k++)
			{	
				let check_time;
				let check_out;
				let red="";
				let pres="NO";
				console.log(arr[k]["DATE"]);
				console.log(date);
				if(arr[k]["DATE"]!=date){
					arr[k]["CHECK_IN_TIME"]=null;
					arr[k]["CHECK_OUT_TIME"]=null;
				}

				if(arr[k]["CHECK_IN_TIME"]==null){
					check_time="00:00:00";
					red="-red";
					redCount++;
				}
				else{
					
					check_time = arr[k]["CHECK_IN_TIME"].slice(-8);
					pres="YES";
					greenCount++;
				}
				
				if(arr[k]["CHECK_OUT_TIME"]==null){
					check_out="00:00:00";

				}
				else{
					check_out=arr[k]["CHECK_OUT_TIME"].slice(-8);
					
				}
				
			
				
				tableEntries+="<tr><td class='no'>"+arr[k]["EMPLOYEE_ID"]+"</td><td class='unit'>"+arr[k]["NAME"]+"</td><td class='desc'>"+check_time+"</td><td>"+check_out+"</td><td class='total"+red+"'>"+pres+"</td></tr>";
				
			}
			$("#tBody").append(tableEntries);
			$('#totalAbsent').append('<td>'+redCount+'</td>');
			$('#totalPresent').append('<td>'+greenCount+'</td>');
		}
		else
		{
			alert("Error");
		}
	});
});