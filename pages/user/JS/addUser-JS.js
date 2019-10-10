$(document).ready(function()
{
            /*jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });*/

            
            $.ajax({
                url:"PHPcode/addUser-SQL.php",
                type:'POST',
                data:{choice:0}
            })
            .done(data=>{
                if(data!="False")
                {
                    let arr=JSON.parse(data);
                    let tableEntries="";
                    for(let k=0;k<arr.length;k++)
                    {
                    let entry=$("<option></option>").attr("name",arr[k]["ACCESS_LEVEL_ID"]);
                    entry.text(arr[k]["ROLE_NAME"]); 
                    $("#aLevel").append(entry);
                    }   
                }
                else
                {
                    alert("Error");
                }
            });

            $('#inputPassword1, #inputPassword2').on('keyup', function () {

                if($('#inputPassword2').val() != null)
                {

                        if ($('#inputPassword1').val() != $('#inputPassword2').val()) 
                        {
                            // $('#alert-message').html('Passwords match').css('color', 'green');
                            $('#alert-message').html(" <div class='alert alert-danger' role='alert' ><span class='alert-inner--text' ><strong>Passwords do not match</strong></span></div>");
                        } 
                        else 
                        {
                            $('#alert-message').html(" <div class='alert alert-success' role='alert' ><span class='alert-inner--text' ><strong>Passwords match</strong></span></div>");
                        }
                }
                  
              });

            $("#addUserSave").on("click",function(e)
                {

                    e.preventDefault();
                    //alert("Yeyi");
                    let accessLevelID = parseInt($("#aLevel option:selected").attr("name"));;
                    let username = $("#inputUsername").val();
                    let password = $("#inputPassword1").val();
                    let employeeID = $("#employee_ID").val();
                
    
                    let userStatus = 1;//Active

                    console.log(accessLevelID);

                    console.log(username);
                    $.ajax({
                        url:"PHPcode/addUser-SQL.php",
                        type:'POST',
                        data:{choice:1 , accessLevel:accessLevelID , email:username , pass:password , userStatusID :userStatus , employee_ID :employeeID}
                    })
                    .done(data=>{
                        console.log(data);
                        let confirmation = data.trim();
                        if(confirmation== "success")
                        {
                            $("#modal-title-default").text("Success!");
                            $("#modalText").text("User added successfully");
                            $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                            $("#modalHeader").css("background-color", "#1ab394");
                            $("#btnClose").attr("onclick","window.location='../../user.php'");
                            $("#displayModal").modal("show");
                        }
                        else if(confirmation == "User exists!")
                        {
                            $("#modal-title-default").text("Error!");
                            $("#modalText").text("User exists! , press close and try again");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
                            $("#btnClose").attr("onclick","window.location='../../user.php'");

                        }
                        else
                        {
                            $("#modal-title-default").text("Error!");
                            $("#modalText").text("Database error");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
                        }
                    });

                });


});