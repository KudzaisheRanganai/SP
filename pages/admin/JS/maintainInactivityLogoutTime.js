$(document).ready(function()
{
    $.ajax({
        url: '../../InactivityLogoutLanding/getInactivityLogoutTime.php',
        type: 'POST',
        data: ''
    })
    .done(response => {
        console.log(response);

        if (response != "failed") 
        {
            var maxMinutes  = response;
            $("#minutesTillLogout").val(maxMinutes); 
        
        }
        ajaxDone = true;
    });


    $("#updateLogoutTime").on("click",function(e)
    {
        e.preventDefault();

        let newMinutesTillCheckout = $("#minutesTillLogout").val();
        //console.log(newMinutesTillCheckout)

        //console.log(username);
        $.ajax({
            url:"PHPcode/maintainInactivityLogoutTime.php",
            type:'POST',
            data:{minutes: newMinutesTillCheckout},
            beforeSend: function(){
                $('.loadingModal').modal('show');
            }
        })
        .done(data=>{
            $('.loadingModal').modal('hide');
            console.log(data);
            let confirmation = data.trim();
            if(confirmation != "Failure")
            {
                $("#modal-title-default").text("Success!");
                $("#modalText").text("Inactivity logout time maintained successfully");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
                $("#btnClose").attr("onclick","window.location='../../admin.php'");
                $("#changeTimeSuccess").modal("show");
        
            }
            else
            {
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Error maintaining inactivity logout time, please try again or contact help");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
               
                $("#changeTimeSuccess").modal("show");
            }
        });

    });

});