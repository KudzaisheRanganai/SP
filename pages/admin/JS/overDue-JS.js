$(document).ready(function(){
    console.log("Catch all these errors");
    $("#overButton").click(function(e){
        e.preventDefault();


            let userID = $("#USER_ID").val();
            let days = $("#numOfDays").val();
           console.log(userID);
           console.log(days);
      
            $.ajax({
                url:'pages/admin/PHPcode/overDue-SQL.php',
                type:'post',
                data:{user_ID:userID, overdueTime:days},
                success:function(data)
                {

                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation.includes("success"))
                    {
                        $("#modal-title-defaultOverdue").text("Success!");
                        $("#modalTextOverdue").text("Overdue status successfully maintained");
                        $("#btnCloseOverdue").attr('onclick',"window.location='admin.php'");
                        $("#overdueStatusSet").modal("show");
                    }
                    else if(confirmation.includes("Could not change overdue delivery status"))
                    {
                        $("#modal-title-defaultOverdue").text("Error!");
                        $("#modalTextOverdue").text("Could not change overdue delivery status");
                        
                        $("#overdueStatusSet").modal("show");
                    }
                    else
                    {
                        $("#modal-title-defaultOverdue").text("Error!");
                        $("#modalTextOverdue").text("User ID is not set OR Days the delivery is overdue by is not set");
                      
                        $("#overdueStatusSet").modal("show");
                    }
                },
            });
        
        

    });
});

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}