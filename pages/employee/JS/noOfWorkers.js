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
                    let confirmation = response;
                   if(confirmation.includes("Total number of present employees is:"))
                    {
                        let numberOfEmployees = confirmation.split(":");
                        let percent = (numberOfEmployees[1]/numberOfEmployees[2]) * 100;
                        percent = percent.toFixed(2);
                        $("#NoOfEmployees").text(numberOfEmployees[1]);
                        $("#percentageOfEmployees").text(percent+"%");
                    }
                    else
                    {
                        $("#NoOfEmployees").text("0");
                        $("#percentageOfEmployees").text("0%");
                    }
                },
            });
       

    //});
});