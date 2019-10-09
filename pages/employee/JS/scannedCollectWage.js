$(document).ready(function(){
    //$("#login_button").click(function(e){
       // e.preventDefault();

        //var email = $("#email").val().trim();
        //var password = $("#password").val().trim();
        console.log("Works");
        
        var  tempVar = "fromJs";
            $.ajax({
                url:'pages/employee/PHPcode/retrieveNoOfWorkers.php',
                type:'post',
                data:{exampleVariable:tempVar},
                success:function(response)
                {

                    console.log(response);
                   /* if(response=="success")
                    {
                        window.location = "dashboard.php"; 
                    }
                    else
                    {
                        $('#alert-login').empty();
                        $('#alert-login').append("<div class='alert alert-danger' role='alert'><span class='alert-inner--text'><strong>Login failed!</strong> </span></div>");    
                    }*/
                },
            });
       

    //});
});