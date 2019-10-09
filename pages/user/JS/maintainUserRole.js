let userRoleID;
let subFunctionalitiesArray;

$(()=>{

    userRoleID = $('#userRoleID').val();

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    
    $("select#productType").change(function(){
        selectedProdType = $(this).children("option:selected").val();
    });

        $.ajax({
        url:"PHPcode/getSubfunctionalitiesArray_.php",
        type:'POST',
        data:{
            accessLevelID: userRoleID
        }
    })
    .done(data=>{
        
           
       

        if(data!="False")
        {
            let arr=JSON.parse(data);
            subFunctionalitiesArray = arr;
            //let arr=JSON.stringify(data);
            //console.log(subFunctionalitiesArray);  
        }
        else
        {
            alert("Error");
        }
    });

    $.ajax({
        url:"PHPcode/getUserSubfunctionalities_.php",
        type:'POST',
        data:''
    })
    .done(data=>{
        if(data!="False")
        {
            let arr=JSON.parse(data);
            //let arr=JSON.stringify(data);
            //console.log(arr);  

            let options="";
            let previousFunctionality = "";
            let addFuncEnd = false;
            for(let k=0;k<arr.length;k++)
            {
                if (previousFunctionality != arr[k]["FUNCTIONALITY_NAME"]) 
                {
                    if (k != 0) 
                    {
                        options+="<optgroup>";
                    }
                    
                    options+="<optgroup label='"+arr[k]["FUNCTIONALITY_NAME"]+" Subsystem'>";
                    previousFunctionality = arr[k]["FUNCTIONALITY_NAME"];
                }
                options+="<option checked value='"+arr[k]["SUB_FUNCTIONALITY_ID"]+"' >"+arr[k]["SUB_FUNCTIONALITY_ID"] + " - " + arr[k]["NAME"] + "</option>";
            }
            //console.log(options);
            $("#subFunctionalitites").append(options); 

            $('#subFunctionalitites').multiselect({
              nonSelectedText: 'Select Functionalities',
              enableFiltering: true,
              enableCaseInsensitiveFiltering: true,
              enableClickableOptGroups: true,
              buttonWidth:'100%',
              onChange: function(element, checked) {
                    //console.log($('#subFunctionalitites').val());
                }
             });

            for (var i = 0; i < subFunctionalitiesArray.length; i++) 
            {
                $("input[value='"+subFunctionalitiesArray[i]+"']").click();
            }
        }
        else
        {
            alert("Error");
        }
    });

});

$("#addUserRole").on("click",function(event)
{
    event.preventDefault();
    let form=$('#addUserRoleForm');
    form.validate();
    if(form.valid() === false)
    {
        event.stopPropagation();
    }
    else
    {
        let subFunctionalities =  $('#subFunctionalitites').val();
        let userRoleName = $("#userRoleName").val();
        let oldRoleName = $("#oldRoleName").val();

        $.ajax({
            url:"PHPcode/maintainUserRole_.php",
            type:'POST',
            data:{
                userRoleName_ : userRoleName,
                subFunctionalities_ : subFunctionalities,
                userRoleID:userRoleID,
                oldRoleName:oldRoleName
            },
            beforeSend: function(){
                $('.loadingModal').modal('show');
            }
        })
        .done(response =>{
            $('.loadingModal').modal('hide');
            console.log(response);
            if(response == "success")
            {
                $("#modal-title-default").text("Success!");
                $("#modalText").text("User role updated successfully");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
                $("#modalCloseButton").attr("onclick","window.location='../../user.php'");
                $("#displayModal").modal("show");
            }
            else if(response  == "User role exists")
            {
                console.log(response);
                $("#modal-title-default").text("Error!");
                $("#modalText").text("A user role with the changed name exists! , press close and try again");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
                $("#displayModal").modal("show");
            }
            else
            {
                $("#modal-title-default").text("Error!");
                $("#modalText").text("Database error");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
                $("#btnClose").attr("onclick","");
                $("#displayModal").modal("show");
            }
        });
    }  

});