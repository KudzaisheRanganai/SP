var arr;
var cArr;
var eArr;
$(()=>{
	$.ajax({
		url:'PHPcode/salecode.php',
		type:'POST',
		data:{choice:3}
	})
	.done(data=>{
		if(data!="False")
		{
			arr=JSON.parse(data);
			$.ajax({
				url:'PHPcode/salecode.php',
				type:'POST',
				data:{choice:4}

			})
			.done(cData=>{
				cArr=JSON.parse(cData);
				$.ajax({
					url:'PHPcode/salecode.php',
					type:'POST',
					data:{choice:5}
				})
				.done(eData=>{
					if(eData!="False")
					{
						eArr=JSON.parse(eData);
						let tableEntries="";
						let formView="";
						let cfound="";
						let efound="";
						let jCFound="";
						let jEFound="";
						for(let k=0;k<arr.length;k++)
						{
							cfound=cArr.find(function(element){
								if(element["CUSTOMER_ID"]==arr[k][
									"CUSTOMER_ID"])
								{
									return element;
								}
							});
							efound=eArr.find(function(element){
								if(element["EMPLOYEE_ID"]==arr[k][
									"EMPLOYEE_ID"])
								{
									return element;
								}
							});
							//console.log(cfound);
							//console.log(efound);
							jCFound=JSON.stringify(cfound);
							jEFound=JSON.stringify(efound);
							var formattedTime = moment(arr[k]["SALE_DATE"]).format('L - LT');
							formView="<form action='view-sale.php' method='POST'><input type='hidden' name='SALE_ID' value='"+arr[k]["SALE_ID"]+"'>"+"<input type='hidden' name='USER_ID' value='"+arr[k]["USER_ID"]+"'>"+"<input type='hidden' name='EMPLOYEE_ID' value='"+arr[k]["EMPLOYEE_ID"]+"'>"+"<input type='hidden' name='CUSTOMER_ID' value='"+arr[k]["CUSTOMER_ID"]+"'>"+"<input type='hidden' name='SALE_DATE' value='"+arr[k]["SALE_DATE"]+"'>"+"<input type='hidden' name='SALE_AMOUNT' value='"+arr[k]["SALE_AMOUNT"]+"'>"+"<input type='hidden' name='SALE_STATUS_ID' value='"+arr[k]["SALE_STATUS_ID"]+"'>"+"<input type='hidden' name='CUSTOMER_DATA' value='"+jCFound+"'>"+"<input type='hidden' name='EMPLOYEE_DATA' value='"+jEFound+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-eye'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
							tableEntries+="<tr><td>"+arr[k]["SALE_ID"]+"</td><td>"+formattedTime+"</td><td>"+cfound["NAME"]+"</td><td>"+efound["NAME"]+"</td><td>R"+arr[k]["SALE_AMOUNT"]+"</td><td>"+formView+"</td></tr>";
						}
						$("#tBody").append(tableEntries);
					}
					else
					{
						alert("Error");
					}

				});
			});
		}
		else
		{
			alert("Error");
		}
		
	});
});