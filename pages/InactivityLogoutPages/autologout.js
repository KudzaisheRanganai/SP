var maxMinutes;

$(function()
{
    $.ajax({
            url: '../InactivityLogoutPages/getInactivityLogoutTime.php',
            type: 'POST',
            data: ''
        })
        .done(response => {
            //console.log(response);

            if (response != "failed") 
            {
                var maxMinutes  = response;  //GREATER THEN 1 MIN.
                function timeChecker()
                {
                    setInterval(function()
                    {
                        var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");  
                        timeCompare(storedTimeStamp);
                    },3000);
                }


                function timeCompare(timeString)
                {
                    var currentTime = new Date();
                    var pastTime    = new Date(timeString);
                    var timeDiff    = currentTime - pastTime;
                    var minPast     = Math.floor( (timeDiff/60000) );

                    if( minPast >= maxMinutes)
                    {
                        //console.log(" must logout now");
                        sessionStorage.removeItem("lastTimeStamp");
                        window.location = "../../assets/logout/PHPcode/logoutInactivity.php";
                        return false;
                    }
                    else
                    {
                        //JUST ADDED AS A VISUAL CONFIRMATION
                        //console.log(currentTime +" - "+ pastTime+" - "+minPast+" min past");
                    }
                }

                if(typeof(Storage) !== "undefined") 
                {
                    $(document).mousemove(function()
                    {
                        var timeStamp = new Date();
                        sessionStorage.setItem("lastTimeStamp",timeStamp);
                    });

                    timeChecker();
                }  
            }
            
            
            ajaxDone = true;
        });

    
});//END JQUERY


