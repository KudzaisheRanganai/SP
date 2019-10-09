var collectionData;
var dctStatus=[];
dctStatus[1]="Not Collected";
dctStatus[2]="Truck Assigned";
dctStatus[3]="Final Assignment";
dctStatus[4]="On Collection";
dctStatus[5]="Collected";
dctStatus[6]="Truck Assigned";
$(()=>{
	collectionData=JSON.parse($("#cData").text());
	console.log(collectionData);
	let tableEntries="";
	let formView="";
	let formCancel="";
	let formCancel2="";
	for(let k=0;k<collectionData.length;k++)
	{

		formView="<form action='assign-truck-view-collection.php' method='POST'><input type='hidden' name='COLLECTION_DATA' value='"+JSON.stringify(collectionData[k])+"'>"+"<input type='hidden' name='ORDER_ID' value='"+collectionData[k]["ORDER_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-eye'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
		tableEntries+="<tr><td>"+collectionData[k]["ORDER_ID"]+"</td><td>"+collectionData[k]["EXPECTED_DATE"]+"</td><td>"+collectionData[k]["CITY_NAME"]+"</td><td>"+collectionData[k]["SUPPLIER_NAME"]+"</td><td>"+dctStatus[collectionData[k]["COLLECTION_STATUS_ID"]]+"</td><td>"+formView+"</td>";
		formCancel="<form action='cancel_collection.php' method='POST'><input type='hidden' name='COLLECTION_DATA' value='"+JSON.stringify(collectionData[k])+"'>"+"<button class='btn btn-icon btn-2 btn-danger btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-times-circle'></i></span><span class='btn-inner--text'>Cancel</span></button>"+"</form>";
		formCancel2="<form action='cancel_collection.php' method='POST'><input type='hidden' name='COLLECTION_DATA' value='"+JSON.stringify(collectionData[k])+"'>"+"<button class='btn btn-icon btn-2 btn-danger btn-sm' type='submit' disabled='true'><span class='btn-inner--icon'><i class='fas fa-times-circle'></i></span><span class='btn-inner--text'>Cancel</span></button>"+"</form>";
		if(collectionData[k]["COLLECTION_STATUS_ID"]==1)
		{
			tableEntries+="<td>"+formCancel+"</td></tr>";
		}
		else
		{
			tableEntries+="<td>"+formCancel2+"</td></tr>";
		}

	}
	$("#tBody").append(tableEntries);
})

function myFunction() 
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