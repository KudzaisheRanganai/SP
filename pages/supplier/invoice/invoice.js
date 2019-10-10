var orderProductsArray;
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
	var orderProductsArrayString = $("#orderProductsArray").val();
	orderProductsArray = JSON.parse(orderProductsArrayString);
	console.log(orderProductsArray);
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

			for (var i = 0; i < orderProductsArray.length; i++) 
			{
				var theProductID = orderProductsArray[i].PRODUCT_ID;
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

				orderProductsArray[i].PRODUCT_NAME = theProductName;
			}
			//console.log(orderProductsArray);

			var tableEntries = "";
			for (var i = 0; i < orderProductsArray.length; i++) {
				var productLineTotal = orderProductsArray[i].COST_PRICE * orderProductsArray[i].QUANTITY;
				productLineTotal = parseFloat(productLineTotal).toFixed(2);
				saleTotal = parseFloat(saleTotal) + parseFloat(productLineTotal);
				
				productLineTotal = numberWithSpaces(productLineTotal);
				productLineTotal = "R"+ productLineTotal;

				var productLineSellingPrice = orderProductsArray[i].COST_PRICE;
				productLineSellingPrice = parseFloat(productLineSellingPrice).toFixed(2);
				productLineSellingPrice = numberWithSpaces(productLineSellingPrice);
				productLineSellingPrice = "R"+ productLineSellingPrice;

				tableEntries+="<tr><td class='no'>"+(i+1)+"</td><td class='desc'><h3>"+orderProductsArray[i].PRODUCT_NAME+"</h3></td><td class='unit'>"+productLineSellingPrice+"</td><td class='qty'>"+orderProductsArray[i].QUANTITY+"</td><td class='total'>"+productLineTotal+"</td></tr>";
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

			var orderID = $("#ORDER_ID").val();

			var target = document.getElementById('sendHTML');
			var wrap = document.createElement('div');
			wrap.appendChild(target.cloneNode(true));
			console.log(wrap.innerHTML);

			var target2 = document.getElementById('styleDiv');
			var wrap2 = document.createElement('div');
			wrap2.appendChild(target2.cloneNode(true));
			console.log(wrap2.innerHTML);

			var dataJSON = {
				name: SUPPLIER_NAME,
				email: SUPPLIER_EMAIL,
				orderNumber: ORDER_ID,
				orderDate : ORDER_DATE,
				orderHTML : wrap.innerHTML,
				styleDiv : wrap2.innerHTML
			};

			console.log(dataJSON);


			$.ajax({
				url: '../../mailjet/mail_placeOrder.php',
				type: 'POST',
				data:{
					name: SUPPLIER_NAME,
					email: SUPPLIER_EMAIL,
					orderNumber: ORDER_ID,
					orderDate : ORDER_DATE,
					orderHTML : wrap.innerHTML,
					styleDiv : wrap2.innerHTML
				},
				beforeSend: function() {
					//$('.loadingModal').modal('show');
		    	}
			})
			.done(data=>{
				console.log(data);
				$('.loadingModal').modal('hide');
				
				if(data=="success")
				{
					$('#modal-title-default2').text("Success!");
					$('#modalText').text("Order cancellation request successful. An email has been sent to the supplier");
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$('#successfullyAdded').modal("show");
					$("#btnClose").attr("data-dismiss","modal");
					//$("#displayModal").modal("show");
				}
				else
				{

					$('#modal-title-default2').text("Error!");
					$('#modalText').text("Email Failed Sent, Please check email credits");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$('#successfullyAdded').modal("show");
					$("#btnClose").attr("data-dismiss","modal");
					//$("#displayModal").modal("show");
				}
			});


			
			var divHeight = $('body').height();
			var divWidth = $('body').width();
			var ratio = divHeight / divWidth;
			html2canvas(document.getElementById("content"), {
			    height: divHeight,
			    width: divWidth,
			    onrendered: function(canvas) {
					var image = canvas.toDataURL("image/png",0.1);
					var pdf = new jsPDF('p','pt','a4'); // using defaults: orientation=portrait, unit=mm, size=A4
					var width = pdf.internal.pageSize.getWidth();    
					var height = pdf.internal.pageSize.getHeight();

					height = ratio * width;
					pdf.addImage(image, 'PNG', -150, 20, width+300, height-70);
					pdf.save('order#/'+orderNumber+'.pdf'); //Download the rendered PDF.

					var doc = btoa(pdf.output());
					var data = new FormData();
					data.append("data", doc);
					var xhr = new XMLHttpRequest();
					xhr.open( 'post', 'upload.php?name=' + orderID , true );
					// console.log(data);
					xhr.send(data);

					xhr.onreadystatechange = function() {
					   	if (this.readyState == 4 && this.status == 200) {
					        // Typical action to be performed when the document is ready:
					        console.log(xhr.responseText);
					   	}
					};
			    }
			});
		}
		else
		{
			alert("Error");
		}
	});