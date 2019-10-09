$(document).ready(function(){
    $("#setPassword").on("submit",function(e){
        e.preventDefault();

        let newPassword = $("#newPassword").val();
        let confirmPassword = $("#confirmPassword").val();
        let userkey = $("#key").val();
        let user_ID = $("#userID").val();
        let user_action= $("#actionToTake").val();
        console.log(user_ID);
        console.log(newPassword);
        console.log(userkey);
        let changeInfo = {newpass:newPassword,confirmpass:confirmPassword,key:userkey, userID:user_ID,action:user_action};

        //console.log(emailSent);
            $.ajax({
                url:'PHPcode/resetPassword-SQL.php',
                type:'post',
                data:changeInfo
            })
            .done(function(data)
                {

                    console.log(data);
                    if(data=="successful reset password")
                    {
                        $("#modal-title-default").text("Success!");
                        $("#modalText").text("Password reset successfully");
                        $("#successfullyChanged").modal("show");
                       //window.location = "../../login.php"; 
                    }
                    else
                    {
                        $('#alert-password').empty();
                        $('#alert-password').append(`<div class='alert alert-danger' role='alert'><span class='alert-inner--text'><strong>The link is expired. You are trying to use the expired link which 
                        as valid only 1 minute after request. </strong> </span></div>`);    
                    }
                
            });
     
    });
});