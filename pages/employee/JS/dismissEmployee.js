$(document).ready(function(){
    console.log("Catch all these errors");
    $("#deleteButton").click(function(e){
        e.preventDefault();


            let employeeID = $("#EMPLOYEE_ID").val();
            let dismissalReason = $("#reasonOFDismissal").val();
      
            $.ajax({
                url:'PHPcode/dismissEmployee-SQL.php',
                type:'post',
                data:{employee_ID:employeeID, reason:dismissalReason}
                })
                .done(data=>
                {
                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation=="success")
                    {
                        $("#modal-title-default").text("Success!");
                        $("#modalText").text("Employee successfully dismissed");
                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                        $("#modalHeader").css("background-color", "#1ab394");
                        $("#displayModal").modal("show");


                          $("#btnCloseDismiss").click(function(e) {

                                    e.preventDefault();
                                   
                                    //window.open(`PHPcode/showGeneratedQRCode.php?employeeID=${employeeID}`, '_blank');
                                    window.location='../../employee.php';
                                });

                        setTimeout(function(){
                            $('#displayModal').modal("hide");
                             //window.open(`PHPcode/showGeneratedQRCode.php?employeeID=${employeeID}`, '_blank');
                             window.location='../../employee.php';
                             
                        }, 2000);
                    }
                    else if(confirmation == "Could not change employee status")
                    {
                        
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("Employee could not be dismissed , due to error in system , please try again");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                    
                        $("#displayModal").modal("show");
                    }
                    else
                    {
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("Employee could not be dismissed , due to error in system , please try again");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                        $("#displayModal").modal("show");

                       
                    }
                
            });
        
        

    });
});