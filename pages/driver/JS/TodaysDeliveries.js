$(document).ready(function(){
    //$("#login_button").click(function(e){
       // e.preventDefault();

        //var email = $("#email").val().trim();
        //var password = $("#password").val().trim();
        console.log("Works");
        
        var  tempVar = "fromJs";
            $.ajax({
                url:'pages/driver/PHPcode/TodaysDeliveries.php',
                type:'post',
                data:{exampleVariable:tempVar},
                success:function(response)
                {

                    console.log(response);
                    let confirmation = response;
                    if(confirmation.includes("Total number of daily deliveries is:"))
                    {
                        let numberOfEmployees = confirmation.split(":");
                        let num1 = numberOfEmployees[1].trim();
                        num1 = parseInt(numberOfEmployees[1]);
                        let num2 = numberOfEmployees[2].trim();
                        num2 = parseInt(numberOfEmployees[2]);
                        let percent = (num1/num2) * 100;
                        percent = percent.toFixed(2);
                        $("#noOfDailyDeliveries").text(num1);
                        $("#percentageOfDailyDeliveries").text(percent+"%");
                    }
                    else
                    {
                        $("#noOfDailyDeliveries").text("0");
                        $("#percentageOfDailyDeliveries").text("0%");
                    }
                },
            });
       

    //});
});