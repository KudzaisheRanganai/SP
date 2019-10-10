var amountDue=0;
function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}
let buildTable=function(tmp,arr)
{
	let tableEntry=$("<tr></tr>");
	let tdDate=$("<td></td>").text(arr[tmp]["PAYMENT_DATE"]);
	tableEntry.append(tdDate);
	let transactionType="";
	let trans="";
	let tdAP=$("<td></td>").addClass("text-right").text("");
	if(parseInt(arr[tmp]["PAYMENT_TYPE_ID"])==2)
	{
		transactionType="Sale";
		trans="S";
		amountDue=amountDue+parseFloat(arr[tmp]["AMOUNT_PAID"]);
	}
	else
	{
		transactionType="Payment";
		trans="P";
		amountDue=amountDue-parseFloat(arr[tmp]["AMOUNT_PAID"]);
	}
	let tdRef=$("<td></td>").text(trans+arr[tmp]["TRANSACTION_ID"]);
	tableEntry.append(tdRef);
	tdDescription=$("<td></td>").text(transactionType);
	tableEntry.append(tdDescription);
	let tdAmount=$("<td></td>").addClass("text-right").text("R"+numberWithSpaces(arr[tmp]["AMOUNT_PAID"]));
	console.log(parseInt(arr[tmp]["PAYMENT_TYPE_ID"]));
	if(parseInt(arr[tmp]["PAYMENT_TYPE_ID"])!=3)
	{
		console.log("here");
		tableEntry.append(tdAmount);
		tableEntry.append(tdAP);
	}
	else
	{
		console.log("here2");
		tableEntry.append(tdAP);
		tableEntry.append(tdAmount);
	}
	let tdAmountDue=$("<td></td>").addClass("text-right").text(numberWithSpaces(amountDue.toFixed(2)));
	tableEntry.append(tdAmountDue);
	$("#tBody").append(tableEntry);
	
}
$(()=>{

	var CUSTOMER_ID=$('#ID').attr('value');
	console.log(CUSTOMER_ID);
	$.ajax({
		url: 'PHPcode/customerAccount.php',
		type: 'POST',
		data: {customerID:CUSTOMER_ID},
		beforeSend:function(){
			$('.loadingModal').modal('show');
		} 
	})
	.done(data=>{
		if(data!="False")
		{
			let arr=JSON.parse(data);
			console.log(arr);
			$('#acc').append("<td>"+arr["ACCOUNT_NO"]+"</td>");
			$('#balance').append("<td class='text-right'>"+arr["BALANCE"]+"</td>");
			$('#limit').append("<td class='text-right'>"+arr["CREDIT_LIMIT"]+"</td>");
			$.ajax({
				url: 'PHPcode/accounttransactions.php',
				type: 'POST',
				data: {customerID:CUSTOMER_ID}
			})
			.done(data=>{
				closeModal();
				let transactions=JSON.parse(data);
				console.log(transactions);
				for(let k=0;k<transactions.length;k++)
				{
					buildTable(k,transactions);
				}
				$("#total").text("R"+numberWithSpaces(amountDue.toFixed(2)));
			});			
		}
		else
		{
			alert("Error");
		}
	});
	$("#btnPay").on('click',function(e){
		e.preventDefault();
		$("#modal-pay").modal("show");
	});
	$("#btnPayOff").on('click',function(e){
		e.preventDefault();
		let payAmount=$("#amount").val();
		let change=0;
		$("#modal-pay").modal("hide");
		if(payAmount>amountDue)
		{
			change=payAmount-amountDue;
			payAmount=amountDue;
		}
		$.ajax({
			url: 'PHPcode/payCustomerAccount.php',
			type: 'POST',
			data: {customerID:CUSTOMER_ID,amount:payAmount},
			beforeSend:function(){
				$('.loadingModal').modal('show');
			}
		})
		.done(data=>{
			closeModal();
			console.log(data);
			console.log(change);
			if(data=="T")
			{
				if(change==0)
				{
					$('#modal-title-default2').text("Success!");
					$('#modalText').text("Account Payment Recorded Successfully.");
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick",location.reload());
					$('#successfullyAdded').modal("show");	
				}
				else
				{
					$('#modal-title-default2').text("Success!");
					$('#modalText').text("Account Payment Recorded Successfully. Change is "+change);
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$("#btnClose").attr("onclick",location.reload());
					$('#successfullyAdded').modal("show");
				}
				
			}
			else
			{
				$('#modal-title-default2').text("Error!");
				$('#modalText').text("Record Payment Failed");
				$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
				$("#modalHeader").css("background-color", "red");
				$("#btnClose").attr("data-dismiss","modal");
				$('#successfullyAdded').modal("show");
			}
		});
	});
    $("#limit-form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "PHPcode/updateLimit.php",
            type: "POST",
            data:  new FormData(this),
		    beforeSend: function(){
		            $('.loadingModal').modal('show');
		     },
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                console.log(data);
                closeModal();
                if(data=="success"){
                	console.log("success");
            		$('#modal-title-default2').text("Success!");
					$('#modalText').text("Customer credit limit successfully updated");
					$('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
					$("#modalHeader").css("background-color", "#1ab394");
					$('#successfullyAdded').modal("show");
					$("#btnClose").attr("onclick","window.location='search.php'");
					$("#displayModal").modal("show");
                }
                else{
					$('#modal-title-default2').text("Error!");
					$('#modalText').text("Email Failed Sent, Please check email credits");
					$('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
					$("#modalHeader").css("background-color", "red");
					$('#successfullyAdded').modal("show");
					$("#btnClose").attr("data-dismiss","modal");
					$("#displayModal").modal("show");
                	console.log("failed");
                }
       
              }           
        });
    }));
});

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}