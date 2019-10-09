$(document).ready(function(){
    //$("#login_button").click(function(e){
       // e.preventDefault();

        //var email = $("#email").val().trim();
        //var password = $("#password").val().trim();
        console.log("Works");
        
        var  tempVar = "fromJs";
            $.ajax({
                url:'pages/customer/PHPcode/retrieveNoOfCustomers.php',
                type:'post',
                data:{exampleVariable:tempVar},
                success:function(response)
                {

                    console.log(response);
                    let confirmation = response;
                   if(confirmation.includes("Total n.o of credit customers is:"))
                    {
                        let numberOfCustomers = confirmation.split(":");
                        let percent = (numberOfCustomers[1]/numberOfCustomers[2]) * 100;
                        $("#NoOfCustomers").text(numberOfCustomers[1]);
                        $("#percentageOfCustomers").text(percent.toFixed(2)+"%");
                    }
                    else
                    {
                        $("#NoOfCustomers").text("0");
                        $("#percentageOfCustomers").text("0%");
                    }
                },
            });
       

    //});
});