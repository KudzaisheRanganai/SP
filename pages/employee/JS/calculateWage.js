$(document).ready(function(){
    let   employeeID = $("#employee_ID").val();
    let totalPay = 0;
    let rate  = 0;
     $("#payRate").change(function (){

      console.log("works");
      rate = $(this).val();
      totalPay = 0;
      let arrayOfCheckIns 
      let today= "2019-08-11";
    //   let arrayOfCheckIns =   $("tr#rows").find('#checkInTime').each(function(rowIndex,r){
    //     console.log(r[rowIndex]);

    //   });
    let hoursWorked = [];
      $("#wagesBody").find('tr').each(function(rowIndex,r){
		// if ($(this).find(">:nth-child(2)>:first-child>:first-child").val() != undefined) 
		// {
			let checkInTime = $(this).find(">:nth-child(2)").text();
            //console.log($(this).find(">:nth-child(2)").text());

            let checkOutTime = $(this).find(">:nth-child(3)").text();
            //console.log($(this).find(">:nth-child(3)").text());
            
            let timesIn = new Date(today + " " + checkInTime);
          
            let timesOut = new Date(today + " " + checkOutTime);

            let diff = (timesIn.getHours() % 12) - (timesOut.getHours() % 12); 
            
            
          
            
            hoursWorked.push(diff);
           
            console.log(diff);

			// var chackoutTime = parseInt($(this).find(">:nth-child(2)>:first-child>:first-child").val());
			// console.log($(this).find(">:nth-child(2)>:first-child>:first-child").attr("max"));
		// }
	});
     
     
    for(let i=0;i<hoursWorked.length;i++)
    {
        $("#EHourWorked"+i).text(hoursWorked[i]);
        let ratePerHour = rate * hoursWorked[i];
        
         $("#RateMoney"+i).text(`R${ratePerHour}`)
         //console.log("This is the index of " + i + " and the value a that index is: " +currentVal + "and that rate will be: "+ ratePerHour  );
        
        totalPay +=  ratePerHour;
        
    }
   
   
                console.log(hoursWorked);
   
     
                $("#totalAmountPayable").html(`<b> R${totalPay}</b>`);
              

        });

        console.log(totalPay);
      console.log(rate);
    console.log(employeeID);


       $("#submitWagePayment").click(function (e){
            
                e.preventDefault();
                console.log("inside");
                $.ajax({
                            type: 'post',
                            url:'PHPcode/collect_wage-SQL.php',
                            data: {wageRate: rate, totalDue :totalPay , employee_ID:employeeID},
                            beforeSend: function(){
                                $('.loadingModal').modal('show');
                            },
                            success: function(data)
                                {
                                    $('.loadingModal').modal('hide');
                                    console.log(data);
                                    let confirm = data.trim();
                                    if(confirm == "success")
                                    {
                                        $("#modal-title-default").text("Success!");
                                        $("#modalText").text("Wage successfully collected.");
                                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                                        $("#modalHeader").css("background-color", "#1ab394");    
                                        $("#finaliseWage").modal('show');

                                        $("#closeWage").click(function(e){
                                            e.preventDefault();
                                            window.location='../../employee.php';
                                        });

                                        setTimeout(function(){
                                            $('#finaliseWage').modal("hide");
                                            window.location='../../employee.php';
                                        }, 2000);
                                    }
                                    else
                                    {
                                        $("#modal-title-default").text("Error!");
                                        $("#modalText").text("Employee either not applicable to earn wage or system error.");  
                                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                                        $("#modalHeader").css("background-color", "red");   
                                        $("#finaliseWage").modal('show');
                                    }
                                },
                            });
        });


    });   