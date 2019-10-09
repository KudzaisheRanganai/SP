$(document).ready(function(){
    $("#login_button").click(function(e){
        e.preventDefault();

        var email = $("#email").val().trim();
        var password = $("#password").val().trim();

        
        if( email != "" && password != "" ){
           
            $.ajax({
                url:'assets/login/PHPcode/login.php',
                type:'post',
                data:{email:email,password:password},
                success:function(response){
                    if(response=="success"){
                        window.location = "dashboard.html"; 
                    }
                    else{
                         //$("<tr></tr>").append($("<td></td>").html(`Assignment ${element['number']}`),($("<td></td>").html(element["mark"])));
                        $('#alert-login').append("<div class='alert alert-danger' role='alert'><span class='alert-inner--text'><strong>Login failed!</strong> </span></div>"); 
                        
                    }
                       
              
                },
             

            });
        }
        else{
            $('#alert-login').empty();
            if(password=="" && email==""){
                $('#alert-login').append("<div class='alert alert-sm alert-danger' role='alert'><span class='alert-inner--text'><strong>Please enter email & password!</strong> </span></div>"); 
            }
            else if(password==""){
                $('#alert-login').append("<div class='alert alert-sm alert-danger' role='alert'><span class='alert-inner--text'><strong>Please enter password!</strong> </span></div>"); 
            }
            else if(email==""){
                $('#alert-login').append("<div class='alert alert-danger' role='alert'><span class='alert-inner--text'><strong>Please enter email!</strong> </span></div>");
            }
           //_549!d.TQi%9
                       
        }

    });
});