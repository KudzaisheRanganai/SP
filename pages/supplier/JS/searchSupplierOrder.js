$(()=>{
	$.ajax({
		url:'PHPcode/searchSupplierOrder.php',
		type:'POST',
		data:''
	})
	.done(response=>{
		if(response!="False")
		{
			let ordersArray = JSON.parse(response);
			console.log(ordersArray);
			let tableEntries="";
			let formView="";

			for(let k=0;k<ordersArray.length;k++)
			{
				var formattedTime = moment(ordersArray[k]["ORDER_DATE"]).format('L - LT');

				formView="<form action='view-order.php' method='POST'><input type='hidden' name='ORDER_ID' value='"+ordersArray[k]["ORDER_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-eye'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
				tableEntries+="<tr><td>"+ordersArray[k]["ORDER_ID"]+"</td><td>"+formattedTime+"</td><td>"+ordersArray[k]["SUPPLIER_NAME"]+"</td><td>"+ordersArray[k]["ORDER_STATUS"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
		}
		else
		{
			alert("Error");
		}

	});
});

function filterOrders() 
{
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");
	var showCount = 0;
	for (i = 0; i < tr.length; i++) 
	{
		td = tr[i].getElementsByTagName("td")[0];
		if (td) 
		{
			txtValue = td.textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter)> -1) 
			{
				tr[i].style.display = "";
				showCount += 1;
			} 
			else 
			{
			    tr[i].style.display = "none";
		  	}
		}       
	}

	if (showCount === 0)
	{
		$("#emptySearch").show();
	} 
	else
	{
		$("#emptySearch").hide();
	}
}