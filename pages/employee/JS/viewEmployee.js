$(()=>{


	let eAddr=$("#eAddress").text();
	let changedAddress=eAddr.replace(" ","/");
	let changedSuburb=$("#eSuburb").text().replace(" ","/");
    let changedCity=$("#eCity").text().replace(" ","/");
	/*$("#ADDR").val(changedAddress);
    $("#SUBURB").val(changedSuburb);
    $("#CITY").val(changedCity);*/
    $("#EMPLOYEE_TYPE_NAME").val($("#eEmployeeTypeName").text().replace(" ","/"));

    let wageEarning=$("#wager").val();
    console.log(wageEarning);
    if(wageEarning)
    {
        $("#ShowDiv").attr("hidden",false);
    }
    else
    {
        $("#ShowDiv").attr("hidden",true);
    }

	$("#btnClick").click(function(e)
    {//use ID of the form
        e.preventDefault();
		let id = $("#employee_ID").text().trim();
		let employeeID=parseInt(id);
		
        console.log(employeeID);
        $.ajax({
            url:'PHPcode/regenerateEmployeeTag-SQL.php',
            type:'POST',
            data: {employee_ID:employeeID},
            beforeSend: function(){
                $('.loadingModal').modal('show');
            }
        })
        .done(data=>{
            closeModal();
            console.log(data);
            let confirmation = data.trim();
            $("#displayModal").modal("hide");
            
            if(confirmation.includes("Employee does not earn wage"))
            {
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Employee does not earn wage , thus an employee tag is not generated.");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
               
                $("#displayModal").modal("show");

                $("#btnClose").click(function(e) {

                                    e.preventDefault();
                                   
                                    window.location=`../../employee.php`;
                                });

            }
            else if(confirmation.includes("success") && !confirmation.includes("Employee does not earn wage"))
            {
                let id = confirmation.split(",");
                let employeeID = parseInt(id[0]);
                console.log(id[0]);

                $("#modal-title-default").text("Success!");
                $("#modalText").text("Generating empoyee tag...");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
                $("#displayModal").modal("show");

                setTimeout(function(){
                    $('#displayModal').modal("hide");
                    callTwo(employeeID);
                }, 2000);

                  

                
               // window.open(`PHPcode/showGeneratedQRCode.php?employeeID=${employeeID}`, '_blank');
            }
            else if(confirmation.includes("Couldnt regenerate employee tag!"))
            {
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Couldnt regenerate employee tag! , press close and try again");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
               
                $("#displayModal").modal("show");
            }
            else if(confirmation.includes("Could not find name and surname of worker"))
            {
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Database Error.");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
                $("#displayModal").modal("show");
            }
            else
            {
                
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Database Error");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
                $("#displayModal").modal("show");
            }
          
        });
    });




    $("#checkIn").click(function(e)
    {//use ID of the form
        e.preventDefault();
		let id = $("#employee_ID").text().trim();
		let employeeID=parseInt(id);
		
        console.log(employeeID);
        $.ajax({
            url:'PHPcode/verifyQRcode.php',
            type:'POST',
            data: {qrCode:employeeID},
            beforeSend: function(){
                $('.loadingModal').modal('show');
            }
        })
        .done(data=>{
            closeModal();
            console.log(data);
            let confirmation = data.trim();
            if(confirmation.includes("success"))
            {
                $("#modal-title-default").text("Success!");
                $("#modalText").text("Employee Successfully checked-in");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
               //$("#btnClose").attr("onclick","window.location='../../employee.php'");
                $("#displayModal").modal("show");
            }
            else if(confirmation.includes("Over checkout time"))
            {
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Cannot check-in , checkout time has passed");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
               
                $("#displayModal").modal("show");
            }
            else if(confirmation.includes("Already Checked-in!"))
            {
              $('#modal-title-default').text("Warning!");
              $('#modalText').text("Already Checked-in!!");
              $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
              $("#modalHeader").css("background-color", "red");
              $('#displayModal').modal("show");
            }
            else
            {
              $('#modal-title-default').text("Error!");
              $('#modalText').text("Database Error!");
              $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
              $("#modalHeader").css("background-color", "red");
              $('#displayModal').modal("show");
            }
           
        });
    });




    $("#checkOUT").click(function(e)
    {//use ID of the form
        e.preventDefault();
		let id = $("#employee_ID").text().trim();
		let employeeID=parseInt(id);
		
        console.log(employeeID);
        $.ajax({
            url:'PHPcode/checkOut-SQL.php',
            type:'POST',
            data: {qrCode:employeeID},
            beforeSend: function(){
                $('.loadingModal').modal('show');
            }
        })
        .done(data=>{
            closeModal();
            console.log(data);
            let confirmation = data.trim();
            if(confirmation.includes("success") && !confirmation.includes("Already CheckedOut!"))
            {
                $("#modal-title-default").text("Success!");
                $("#modalText").text("Employee Successfully checked out");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
                //$("#btnClose").attr("onclick","window.location='../../employee.php'");
                $("#displayModal").modal("show");
            }
            else if(confirmation.includes("Too early to checkout"))
            {
              $('#modal-title-default').text("Error!");
              $('#modalText').text("Check in first");
              $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
              $("#modalHeader").css("background-color", "red");
              $('#displayModal').modal("show");
            }
            else if(confirmation.includes("Already CheckedOut!"))
            {
              $('#modal-title-default').text("Error!");
              $('#modalText').text("Employee Has Already Checked Out , Check-In First");
              $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
              $("#modalHeader").css("background-color", "red");
              $('#displayModal').modal("show");
            }
            else 
            {
              $('#modal-title-default').text("Error!");
              $('#modalText').text("Database Error!");
              $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
              $("#modalHeader").css("background-color", "red");
              $('#displayModal').modal("show");
            }
           
        });
    });



    $("#wageCalc").click(function(e)
    {//use ID of the form
        e.preventDefault();
		let id = $("#employee_ID").text().trim();
		let employeeID=parseInt(id);
		
        console.log(employeeID);
        $.ajax({
            url:'PHPcode/collect_wage_scanner.php',
            type:'POST',
            data: {qrCode:employeeID},
            beforeSend: function(){
                $('.loadingModal').modal('show');
            }
        })
        .done(data=>{
            closeModal();
            console.log(data);
            let confirmation = data.trim();
            if(confirmation.includes("success"))
            {
                $("#modal-title-default").text("Success!");
                $("#modalText").text("Employee found , wage will be calculated on next screen...");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
                //$("#btnClose").attr("onclick",`window.location=wage_calc.php?employeeID='${employeeID}'`);
                $("#displayModal").modal("show");

                setTimeout(function(){
                    $('#displayModal').modal("hide");
                    window.location=`wage_calc.php?employeeID='${employeeID}'`;
                }, 2000);
                  
            }
            else if(confirmation != "success")
            {
              $('#modal-title-default').text("Error!");
              $('#modalText').text(confirmation);
              $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
              $("#modalHeader").css("background-color", "red");
              $('#scannerSearch').modal("show");
            }
           
        });
    });
    



function callTwo(EMPLOYEE_ID){
    
        //var URL = "invoice/invoice.php";
        //window.open(URL, '_blank');
        var form="<form target='_blank' action='PHPcode/showGeneratedQRCode.php' id='sendTagInfo' method='GET'><input type='hidden' name='employeeID' value='"+EMPLOYEE_ID+"'>"+"</form>";
    
        $("body").append(form);
        $( "#sendTagInfo" ).submit();
        location.reload();

      
    }


});

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}


