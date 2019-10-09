$(()=>{

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    
    $("select#productType").change(function(){
        selectedProdType = $(this).children("option:selected").val();
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
                options+="<option value='"+arr[k]["SUB_FUNCTIONALITY_ID"]+"' >"+arr[k]["SUB_FUNCTIONALITY_ID"] + " - " + arr[k]["NAME"] + "</option>";
            }
            //console.log(options);
            $("#subFunctionalitites").append(options); 

            $('#subFunctionalitites').multiselect({
              nonSelectedText: 'Select Functionalities',
              enableFiltering: true,
              enableCaseInsensitiveFiltering: true,
              enableClickableOptGroups: true,
              buttonWidth:'100%'
             });
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

        $.ajax({
            url:"PHPcode/addUserRole_.php",
            type:'POST',
            data:{
                userRoleName_ : userRoleName,
                subFunctionalities_ : subFunctionalities
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
                $("#modalText").text("User role added successfully");
                $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                $("#modalHeader").css("background-color", "#1ab394");
                $("#btnClose").attr("onclick","window.location='../../user.php'");
                $("#displayModal").modal("show");
            }
            else if(response  == "User role exists")
            {
                console.log(response);
                $("#modal-title-default").text("Error!");
                $("#modalText").text("User exists! , press close and try again");
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
                $("#displayModal").modal("show");
            }
        });
    }  

});