$(document).ready(function()
{
        let switchStatus = false;
        $("#toggle-two").on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                console.log(switchStatus + "first if" );// To verify
            }
            else {
            switchStatus = $(this).is(':checked');
            console.log(switchStatus + "else statement" );// To verify
            }
        });


        $.ajax({
            url:"PHPcode/addEmployeeType-SQL.php",
            type:'POST',
            data:{choice:0}
        })
        .done(data=>{
            if(data!="False")
            {
                console.log(data);
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

     

        $("#addEmployeeTypeSave").on("click",function(e)
            {

                e.preventDefault();
                //alert("Yeyi");
                let accessLevelID = parseInt($("#aLevel option:selected").attr("name"));;
                let postionName = $("#posName").val();
                let wageEarningID;
                if(switchStatus)
                {
                    wageEarningID = 1;
                }
                else
                {
                    wageEarningID = 0;
                }
            

             

                console.log(accessLevelID);

                //console.log(username);
                $.ajax({
                    url:"PHPcode/addEmployeeType-SQL.php",
                    type:'POST',
                    data:{choice:1 , accessLevel:accessLevelID , position:postionName , wage_earner:wageEarningID}
                })
                .done(data=>{

                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation== "success")
                    {
		                $("#modal-title-default").text("Success!");
		                $("#modalText").text("Employee Type added successfully");
		                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
		                $("#modalHeader").css("background-color", "#1ab394");
		                $("#btnClose").attr("onclick","window.location='search-employee-type.php'");
		                $("#changeTimeSuccess").modal("show");
                    }
                    else if(confirmation == "Employee Type exists!")
                    {
		                $("#modal-title-default").text("Error!");
		                $("#modalText").text("Employee Type exists! , press close and try again");
		                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		                $("#modalHeader").css("background-color", "red");
		                $("#changeTimeSuccess").modal("show");
                    }
                    else
                    {

		                $("#modal-title-default").text("Error!");
		                $("#modalText").text("Database Error");
		                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
		                $("#modalHeader").css("background-color", "red");
		                $("#changeTimeSuccess").modal("show");
                    }
                });

            });


});