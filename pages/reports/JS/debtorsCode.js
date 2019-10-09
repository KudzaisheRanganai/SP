$(()=>{

	
	var d="";
	$.ajax({
		url: 'PHPcode/debtorsCode.php',
		type: 'POST',
		data: {d:d} 
	})
	.done(data=>{
		console.log(data);
		if(data!="False")
		{
			let arr=JSON.parse(data);
			let total=0;
			let tableEntries="";
	
			for(let k=0;k<arr.length;k++)
			{	
				total=total+parseFloat(arr[k]["BALANCE"]);
				tableEntries+="<tr><td class='no' colspan='2'>"+arr[k]["CUSTOMER_ID"]+"</td><td class='desc'>"+arr[k]["ACCOUNT_NO"]+"</td><td class='unit'>"+arr[k]["NAME"]+" "+arr[k]["SURNAME"]+"</td><td class='total'>"+arr[k]["BALANCE"]+"</td></tr>";
				
			}
			$("#tbody").append(tableEntries);
			$('#total').append('<td>'+total.toFixed(2)+'</td>');
			
		}
		else
		{
			alert("Error");
		}
	});
});