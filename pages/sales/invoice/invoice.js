var saleProductsArray;
var productsArray;
var saleTotal = 0;

function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

function remove_first_character(element) {
  return element.slice(1)
}

$(()=>{
	var saleProductsArrayString = $("#saleProductsArray").val();
	saleProductsArray = JSON.parse(saleProductsArrayString);
	console.log(saleProductsArray);
});

	$.ajax({
		url: '../PHPcode/getProducts_.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
			productsArray = JSON.parse(data);
			//console.log(productsArray);

			for (var i = 0; i < saleProductsArray.length; i++) 
			{
				var theProductID = saleProductsArray[i].PRODUCT_ID;
				var target = theProductID;
				var result = $.grep(productsArray, function(e){ return e.PRODUCT_ID == target; });			

				let pType="Individual";
				let pNumber= 1;
				if(result[0].PRODUCT_SIZE_TYPE==2)
				{
					pType="Case";
					pNumber=result[0].UNITS_PER_CASE;
				}
				else if(result[0].PRODUCT_SIZE_TYPE==3)
				{
					pType="Pallet";
					pNumber=result[0].CASES_PER_PALLET;
				}

				let theProductName = result[0].NAME+" ("+pNumber+" x "+result[0].PRODUCT_MEASUREMENT+result[0].PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;

				saleProductsArray[i].PRODUCT_NAME = theProductName;
			}
			//console.log(saleProductsArray);

			var tableEntries = "";
			for (var i = 0; i < saleProductsArray.length; i++) {
				var productLineTotal = saleProductsArray[i].SELLING_PRICE * saleProductsArray[i].QUANTITY;
				productLineTotal = parseFloat(productLineTotal).toFixed(2);
				saleTotal = parseFloat(saleTotal) + parseFloat(productLineTotal);
				
				productLineTotal = numberWithSpaces(productLineTotal);
				productLineTotal = "R"+ productLineTotal;

				var productLineSellingPrice = saleProductsArray[i].SELLING_PRICE;
				productLineSellingPrice = parseFloat(productLineSellingPrice).toFixed(2);
				productLineSellingPrice = numberWithSpaces(productLineSellingPrice);
				productLineSellingPrice = "R"+ productLineSellingPrice;

				tableEntries+="<tr><td class='no'>"+(i+1)+"</td><td class='desc'><h3>"+saleProductsArray[i].PRODUCT_NAME+"</h3></td><td class='unit'>"+productLineSellingPrice+"</td><td class='qty'>"+saleProductsArray[i].QUANTITY+"</td><td class='total'>"+productLineTotal+"</td></tr>";
			}
			$("#tBody").append(tableEntries);

			var saleVAT = saleTotal * 0.15;
			saleTotal * 1.00;
			saleTotal = saleTotal.toFixed(2);
			//saleTotal = Math.round(saleTotal * 100) / 100;
			
			console.log(saleTotal);
			saleTotal = numberWithSpaces(saleTotal);
			saleTotal = "R"+ saleTotal;
			$("#saleTotal").append(saleTotal);

			saleVAT = parseFloat(saleVAT).toFixed(2);
			saleVAT = numberWithSpaces(saleVAT);
			saleVAT = "R"+ saleVAT;
			$("#saleVAT").append(saleVAT);

			window.print();
			
		}
		else
		{
			alert("Error");
		}
	});