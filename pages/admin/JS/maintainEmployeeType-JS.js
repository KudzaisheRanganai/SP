$(document).ready(function()
{
console.log("Early");
        let alreadySetWageID = $("#WAGE_EARNING").val();
        console.log(alreadySetWageID);
        let flag = false;
        if(alreadySetWageID == '1')
        {
            console.log("Inside");
            $("#toggle-two").prop('checked');
            flag = true;
        }


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

     

        $("#maintainEmployeeTypeSave").on("click",function(e)
            {

                e.preventDefault();
                //alert("Yeyi");
                let accessLevelID = parseInt($("#aLevel option:selected").attr("name")) || -1;
                let postionName = $("#posName").val();
                let wageEarningID;
                let employeeTypeID = $("#EMPLOYEE_TYPE_ID").val();
                //if()
                    if(switchStatus)
                    {
                        wageEarningID = 1;
                    }
                    else
                    {
                        wageEarningID = 0;
                    }
                

                if(accessLevelID == -1)
                {
                    console.log("Its NaN");
                    accessLevelID = "";
                }
                else
                {
                    console.log("Does not go to Nan");
                }

                console.log(wageEarningID);

                console.log(accessLevelID);

                //console.log(username);
                $.ajax({
                    url:"PHPcode/maintainEmployeeType-SQL.php",
                    type:'POST',
                    data:{choice:1 , accessLevel:accessLevelID , position:postionName , wage_earner:wageEarningID , employee_type_id:employeeTypeID},
                    beforeSend:function(){
                        $('.loadingModal').modal('show');
                    }
                })
                .done(data=>{
                    closeModal();
                    console.log(data);
                    let confirmation = data.trim();
                    if(confirmation== "success")
                    {
                        $("#modal-title-default").text("Success!");
                        $("#modalText").text("Employee type successfully updated");
                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                        $("#modalHeader").css("background-color", "#1ab394");
                        $("#btnClose").attr("onclick","window.location='search-employee-type.php'");
                        $("#changeTimeSuccess").modal("show");
                    }
                    else if(confirmation == "Nothing is maintained")
                    {
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("No changes made, data capture is identical");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                       
                        $("#changeTimeSuccess").modal("show");
                    }
                    else
                    {
                        $("#modal-title-default").text("Error!");
                        $("#modalText").text("Database erro");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                       
                        $("#changeTimeSuccess").modal("show");
                    }
                });

            });

});

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}