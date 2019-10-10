$(document).ready(function(){

    $("#login_button").click(function(e){
        e.preventDefault();
        $('#alert-login').empty();

        var email = $("#email").val().trim();
        var password = $("#password").val().trim();

        
        if( email != "" && password != "" )
        {
            $.ajax({
                url:'assets/login/PHPcode/login.php',
                type:'post',
                data:{email:email, password:password}
            })
            .done(response => {

                console.log(response);
                if(response=="success")
                {
                    window.location = "dashboard.php"; 
                }
                else if(response == "user does not exist")
                {
                    $('#alert-login').append("<div class='alert alert-danger py-2' role='alert'><span class='alert-inner--text'>User does not exist, please re-enter email!</span></div>");    
                }
                else if(response == "password incorrect")
                {
                    $('#alert-login').append("<div class='alert alert-danger py-2' role='alert'><span class='alert-inner--text'>Password incorrect!</span></div>");    
                }
                else if(response == "no access")
                {
                    $('#alert-login').append("<div class='alert alert-danger py-2' role='alert'><span class='alert-inner--text'>You have been suspended. Please contact the Admin Manager!</span></div>");    
                }
                else
                {
                    $('#alert-login').append("<div class='alert alert-danger py-2' role='alert'><span class='alert-inner--text'>Login failed! </span></div>");    
                }
            })
            .always(function() {
                $('.loadingModal').modal('hide');
            });
        }
        else
        {
            if(password=="" && email==""){
                $('#alert-login').append("<div class='alert alert-sm alert-danger py-2' role='alert'><span class='alert-inner--text'>Please enter email & password! </span></div>"); 
            }
            else if(password==""){
                $('#alert-login').append("<div class='alert alert-sm alert-danger py-2' role='alert'><span class='alert-inner--text'>Please enter password! </span></div>"); 
            }
            else if(email==""){
                $('#alert-login').append("<div class='alert alert-danger py-2' role='alert'><span class='alert-inner--text'>Please enter email! </span></div>");
            }          
        }

    });
});