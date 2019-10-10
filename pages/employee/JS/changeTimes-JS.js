$(document).ready(function(){
    $("#saveChangedTime").click(function(e){
        e.preventDefault();


            let user_id = $("#user_id").val();
            let arrival = $("#checkin").val();
            let depature = $("#checkout").val();

            console.log(arrival);
            console.log(depature);
        
            
            $.ajax({
                url:'PHPcode/changeTime-SQL.php',
                type:'post',
                data:{userID:user_id,checkin:arrival,checkout:depature},
                success:function(data)
                {
                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation != "Failure")
                    {
                        $("#modal-title-default").text("Success!");
                        $("#modalText").text(confirmation);
                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
						$("#modalHeader").css("background-color", "#1ab394");
                        //$("#btnClose").attr("onclick","window.location='../../employee.php'");
                        $("#changeTimeSuccess").modal("show");

                         $("#btnClose").click(function(e) {

                                    e.preventDefault();
                                   
                                    window.location=`../../employee.php`;
                                });

                                setTimeout(function(){
                                    $('#changeTimeSuccess').modal("hide");
                                    window.location=`../../employee.php`;
                                }, 2000);
                
                    }
                    else
                    {
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("Database Error , please try again or contact help");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                       
                        $("#changeTimeSuccess").modal("show");
                    }
                },
            });
      

    });
});
