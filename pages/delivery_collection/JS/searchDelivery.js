var deliveryData;
var addressData;
var suburbData;
var cityData;
var customerData;
var saleData;
var dctStatus=[];
dctStatus[1]="Not Delivered";
dctStatus[2]="Truck Assigned";
dctStatus[3]="Final Assignment";
dctStatus[4]="On Delivery";
dctStatus[5]="Delivered";
dctStatus[6]="Truck Assigned";
$(()=>{
	deliveryData=JSON.parse($("#dData").text());
	addressData=JSON.parse($("#aData").text());
	suburbData=JSON.parse($("#sData").text());
	cityData=JSON.parse($("#citData").text());
	customerData=JSON.parse($("#cData").text());
	saleData=JSON.parse($("#salData").text());
	console.log(deliveryData);
	console.log(addressData);
	console.log(suburbData);
	console.log(cityData);
	console.log(customerData);
	console.log(dctStatus[1]);
	let tableEntries="";
	let formView="";
	let formCancel="";
	let formCancel2=""
	let searchAddress="";
	let searchSuburb="";
	let searchCity="";
	let searchCustomer="";
	let searchSale="";
	for(let k=0;k<deliveryData.length;k++)
	{
		searchAddress=addressData.find(function(element){
			if(element["ADDRESS_ID"]==deliveryData[k]["ADDRESS_ID"])
			{
				return element;
			}
		});
		searchSuburb=suburbData.find(function(element){
			if(element["SUBURB_ID"]==searchAddress["SUBURB_ID"])
			{
				return element;
			}
		});
		searchCity=cityData.find(function(element){
			if(element["CITY_ID"]==searchSuburb["CITY_ID"])
			{
				return element;
			}
		});
		searchSale=saleData.find(function(element){
			if(element["SALE_ID"]==deliveryData[k]["SALE_ID"])
			{
				return element;
			}
		});
		searchCustomer=customerData.find(function(element){
			if(element["CUSTOMER_ID"]==searchSale["CUSTOMER_ID"])
			{
				return element;
			}
		});
		if(searchCustomer["CUSTOMER_TYPE_ID"]==2)
		{
			searchCustomer["SURNAME"]="Organisation";
		}
		formView="<form action='assign-truck-view-delivery.php' method='POST'><input type='hidden' name='DELIVERY_ID' value='"+deliveryData[k]["DELIVERY_ID"]+"'>"+"<input type='hidden' name='choice' value='"+1+"'>"+"<input type='hidden' name='SALE_ID' value='"+deliveryData[k]["SALE_ID"]+"'>"+"<input type='hidden' name='EXPECTED_DATE' value='"+deliveryData[k]["EXPECTED_DATE"]+"'>"+"<input type='hidden' name='CUSTOMER_DATA' value='"+JSON.stringify(searchCustomer)+"'>"+"<input type='hidden' name='SALE_DATA' value='"+JSON.stringify(searchSale)+"'>"+"<input type='hidden' name='ADDRESS_DATA' value='"+JSON.stringify(searchAddress)+"'>"+"<input type='hidden' name='SUBURB_DATA' value='"+JSON.stringify(searchSuburb)+"'>"+"<input type='hidden' name='CITY_DATA' value='"+JSON.stringify(searchCity)+"'>"+"<input type='hidden' name='DCT_STATUS_ID' value='"+deliveryData[k]["DCT_STATUS_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-eye'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
		tableEntries+="<tr><td>"+deliveryData[k]["SALE_ID"]+"</td><td>"+deliveryData[k]["EXPECTED_DATE"]+"</td><td>"+searchCity["CITY_NAME"]+"</td><td>"+searchCustomer["NAME"]+" "+searchCustomer["SURNAME"]+"</td><td>"+dctStatus[deliveryData[k]["DCT_STATUS_ID"]]+"</td><td>"+formView+"</td>";
		formCancel="<form action='cancel_delivery.php' method='POST'><input type='hidden' name='DELIVERY_ID' value='"+deliveryData[k]["DELIVERY_ID"]+"'>"+"<input type='hidden' name='SALE_ID' value='"+deliveryData[k]["SALE_ID"]+"'>"+"<input type='hidden' name='EXPECTED_DATE' value='"+deliveryData[k]["EXPECTED_DATE"]+"'>"+"<input type='hidden' name='CUSTOMER_DATA' value='"+JSON.stringify(searchCustomer)+"'>"+"<input type='hidden' name='SALE_DATA' value='"+JSON.stringify(searchSale)+"'>"+"<input type='hidden' name='ADDRESS_DATA' value='"+JSON.stringify(searchAddress)+"'>"+"<input type='hidden' name='SUBURB_DATA' value='"+JSON.stringify(searchSuburb)+"'>"+"<input type='hidden' name='CITY_DATA' value='"+JSON.stringify(searchCity)+"'>"+"<input type='hidden' name='DCT_STATUS' value='"+deliveryData[k]["DCT_STATUS_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-danger btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-times-circle'></i></span><span class='btn-inner--text'>Cancel</span></button>"+"</form>";
		formCancel2="<form action='cancel_delivery.php' method='POST'><input type='hidden' name='DELIVERY_ID' value='"+deliveryData[k]["DELIVERY_ID"]+"'>"+"<input type='hidden' name='SALE_ID' value='"+deliveryData[k]["SALE_ID"]+"'>"+"<input type='hidden' name='EXPECTED_DATE' value='"+deliveryData[k]["EXPECTED_DATE"]+"'>"+"<input type='hidden' name='CUSTOMER_DATA' value='"+JSON.stringify(searchCustomer)+"'>"+"<input type='hidden' name='SALE_DATA' value='"+JSON.stringify(searchSale)+"'>"+"<input type='hidden' name='ADDRESS_DATA' value='"+JSON.stringify(searchAddress)+"'>"+"<input type='hidden' name='SUBURB_DATA' value='"+JSON.stringify(searchSuburb)+"'>"+"<input type='hidden' name='CITY_DATA' value='"+JSON.stringify(searchCity)+"'>"+"<input type='hidden' name='DCT_STATUS' value='"+deliveryData[k]["DCT_STATUS_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-danger btn-sm' type='submit' disabled='true'><span class='btn-inner--icon'><i class='fas fa-times-circle'></i></span><span class='btn-inner--text'>Cancel</span></button>"+"</form>";
		if(deliveryData[k]["DCT_STATUS_ID"]==1)
		{
			tableEntries+="<td>"+formCancel+"</td></tr>";
		}
		else
		{
			tableEntries+="<td>"+formCancel2+"</td></tr>";
		}
	}
	$("#tBody").append(tableEntries);
});