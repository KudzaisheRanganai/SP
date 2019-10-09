$(document).ready(function(){
    let user_role_id = $("#userRoleID").val();
    
     console.log(user_role_id);
    $("#deleteButton").click(function(e){
        e.preventDefault();


            let user_role_id = $("#userRoleID").val();
           
            console.log(user_role_id);
            $.ajax({
                url:'PHPcode/deleteUserRole.php',
                type:'post',
                data:{userRoleID:user_role_id},
                success:function(data)
                {

                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation=="success")
                    {
                        $("#modal-title-defaultDismiss").text("Success!");
                        $("#modalTextDismiss").text("User Role successfully deleted");
                        $("#btnCloseDismiss").attr('onclick',"window.location='../../user.php'");
                        $("#dismissEmployeeSuccess").modal("show");
                    }
                    else
                    {
                        $("#modal-title-defaultDismiss").text("Error!");
                        $("#modalTextDismiss").text(confirmation);
                        $("#dismissEmployeeSuccess").modal("show");
                    }
                },
            });
        
        

    });
});
