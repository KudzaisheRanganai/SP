var regex=/^\d{3}\d{3}\d{4}$/;
var idRegex=/^\d{3}\d{3}\d{7}$/;
var emailRegex =/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

let CheckValid = function(valArr)
{
    if(valArr["contact"].length!=10)
    {
        $("#MMessage").text("Contact Number must be 10 digits long.");
        $("#btnClose").attr("data-dismiss","modal");
        $("#displayModal").modal("show");
        return false;
    }
    else if (valArr["IDPASS"].length!=13)
    {
        $("#MMessage").text("ID number must be 13 digits long.");
        $("#btnClose").attr("data-dismiss","modal");
        $("#displayModal").modal("show");
        return false;
    }
    else if(regex.test(valArr["contact"])!=true)
    {
        $("#MMessage").text("Contact Number must only contain digits");
        $("#btnClose").attr("data-dismiss","modal");
        $("#displayModal").modal("show");
        return false;
    }
    else if(idRegex.test(valArr["IDPASS"])!=true)
    {
        $("#MMessage").text("ID Number must only contain digits");
        $("#btnClose").attr("data-dismiss","modal");
        $("#displayModal").modal("show");
        return false;
    }
    else if(emailRegex.test(valArr["email"])!=true)
    {
        $("#MMessage").text("Email is not valid");
        $("#btnClose").attr("data-dismiss","modal");
        $("#displayModal").modal("show");
        return false;

    }
    else
    {
        return true;
    }
    
}

let getVals = function()
{
    let name=$("#employeeName").val().trim();
    let surname=$("#employeeSurname").val().trim();
    let title=$("#eTitle option:selected").text();
    let titleID=1;
    if(title=="Ms")
    {
        titleID=2;
    }
    else if(title=="Mrs")
    {
        titleID=3;
    }
    let contact=$("#contactNumber").val().trim();
    let email=$("#employeeEmail").val().trim();
    let addressArr=$("#inputAddress").val().trim().split(",");
    let address=addressArr[0];
    let suburb=$("#inputSuburb").val().trim();
    let city=$("#inputCity").val().trim();
    let zip=$("#inputZip").val().trim();
    let employeeType=parseInt($("#eType option:selected").attr("name"));
    let employeeIDPass=$("#eID").val().trim();

    let addEmployeeArr=[];
    addEmployeeArr["name"]=name;
    addEmployeeArr["surname"]=surname;
    addEmployeeArr["title"]=titleID;
    addEmployeeArr["email"]=email;
    addEmployeeArr["contact"]=contact;
    addEmployeeArr["employeeType"]=employeeType;
    addEmployeeArr["IDPASS"]=employeeIDPass;
    addEmployeeArr["address"]=address;
    addEmployeeArr["suburb"]=suburb;
    addEmployeeArr["city"]=city;
    addEmployeeArr["zip"]=zip;
    addEmployeeArr["status"]=1;
    return addEmployeeArr;
}

$(document).ready(function()
{
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $.ajax({
        url:"PHPcode/employeecode.php",
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
               let entry=$("<option></option>").attr("name",arr[k]["EMPLOYEE_TYPE_ID"]);
               entry.text(arr[k]["NAME"]); 
               $("#eType").append(entry);
            }   
        }
        else
        {
            alert("Error");
        }
    });
    ///////////////////////////////////////////
    $("#inputAddress").on('keyup',function(e){
        e.preventDefault();
        $.getJSON("http://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=4ubUBkg0ecyvqIcmRpJw&app_code=R1S3qwnTFxK3FbiK1ucSqw&query="+$(this).val()+"&country=ZAF",{
            format:"json",
            delay:100
        })
        .done(data=>{
            //console.log(data.suggestions);
            let viewArr=[];
            let obj={label:"",index:""};
            //console.log(data.suggestions);
            for(k=0;k<data.suggestions.length;k++)
            {
                obj={label:"",index:""};
                obj.label=data.suggestions[k].label.split(', ').reverse().join(', ');
                obj.index=data.suggestions[k].locationId;
                viewArr.push(obj);
            }
            let useArr=data.suggestions;
            $("#inputAddress").autocomplete({
                source:viewArr,
                select: function(event,ui){
                let finalObj=useArr.filter(element=>element.locationId==ui.item.index);
                $("#inputSuburb").val(finalObj[0].address.district);
                $("#inputCity").val(finalObj[0].address.city);
                $("#inputZip").val(finalObj[0].address.postalCode);
            }
            });

        });

    });


    
    ///////////////////////////////////////////////////////
    
    
      

    ///////////////////////////////////////////////////////
    let size = 0;
    $(document).on('change', '.custom-file-input', function (event) {
        $(this).next('.custom-file-label').html(event.target.files[0].name);
        console.log(event.target.files[0].name);
    
        myfile= $(this).val();
       
        console.log(this);
        var ext = myfile.split('.').pop();
        size = event.target.files[0].size;
        console.log(size);
       
        console.log(ext);
        if((ext!="jpg") && (ext!="jpeg"))
        {
            event.preventDefault();
            //console.log("NOT PDF");
            $(this).next().attr("style","border-color: red;");
            $('#modal-title-default').text("Error!");
            $('#MMessage').text("Only JPEG images can be uploaded. Please check file uploads highlighted in red");
            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
            $("#btnClose").attr("onclick",'$("#modal-salesManagerPassword").modal("show");');
            $("#modalHeader").css("background-color", "red");
            $('#displayModal').modal("show");
        } 
        else if(size > 20971520)
        {

            $(this).next().attr("style","border-color: red;");
            $('#modal-title-default').text("Error!");
            $('#MMessage').text("Only Images Less than 20MB can be uploaded. Please check file uploads highlighted in red");
            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
            $("#btnClose").attr("onclick",'$("#modal-salesManagerPassword").modal("show");');
            $("#modalHeader").css("background-color", "red");
            $('#displayModal').modal("show");
        }
        else
        {
           //console.log("PDF");
           $(this).next().attr("style","border-color: #cad1d7;");
    
        }
    });

    /*$(document).ready(function() {
        $.uploadPreview({
          input_field: "#fileUpload",   // Default: .image-upload
          preview_box: "#UploadsPic",  // Default: .image-preview
          label_field: "#ImageUploadLabel",    // Default: .image-label
          label_default: "Choose File",   // Default: Choose File
          label_selected: "Change File",  // Default: Change File
          no_label: false,                // Default: false
          success_callback: null          // Default: null
        });
      });*/
   

    $("#picToUpload").on("submit",function(e)
    {//use ID of the form
        e.preventDefault();




        var fdata = new FormData(this);
        var fileErrors = 0;
        var filSizeErrors= 0;
        for (var file of fdata.values()) 
        {
            if (myfile= file["name"] != undefined) 
            {
                myfile= file["name"];
                var ext = myfile.split('.').pop();
                if((ext!="jpg") && (ext!="jpeg"))
                {
                   //console.log("NOT PDF");
                   fileErrors++;
                }    
            }
           
        }

      

        let mainform=$("#picToUpload");
        mainform.validate();
        if(mainform.valid()===false)
        {
            e.stopPropagation();
        }
        else
        {
            let arr=getVals();
            if(CheckValid(arr)!=true)
            {
                e.stopPropagation();
            } 
            else
            {
                if((fileErrors==0) && (size < 20971520))
                {

                    let form=new FormData();
                    let pics=$("#fileUpload").get(0).files[0];
                    //$("#fileUpload").prop('files')[0]
                    form.append("file",pics);
                    form.append("name",arr["name"]);
                    form.append("surname",arr["surname"]);
                    form.append("title",arr["title"]);
                    form.append("email",arr["email"]);
                    form.append("contact",arr["contact"]);
                    form.append("employeeType",arr["employeeType"]);
                    form.append("IDPASS",arr["IDPASS"]);
                    form.append("address",arr["address"]);
                    form.append("suburb",arr["suburb"]);
                    form.append("city",arr["city"]);
                    form.append("zip",arr["zip"]);
                    form.append("status",arr["status"]);
                    console.log(pics);
                    $.ajax({
                        url:'PHPcode/addEmployee-SQL.php',
                        type:'POST',
                        data: form,
                        processData: false,
                        contentType: false,
                        cache: false,
                        beforeSend: function(){
                            $('.loadingModal').modal('show');
                        }
                    })
                    .done(data=>{
                        $('.loadingModal').modal('hide');
                        console.log(data);
                        let confirmation = data.trim();
                        if(confirmation.includes("success") && !confirmation.includes("Employee does not earn wage"))
                        {
                            let id = confirmation.split(",");
                            let employeeID = parseInt(id[0]);
                            
                            console.log(id[0]);
                            $("#modal-title-default").text("Success!");
                            $("#MMessage").text("Employee added successfully");
                            $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                            $("#modalHeader").css("background-color", "#1ab394");
                            //$("#btnClose").attr("onclick","window.location='../../employee.php'");
                            $("#displayModal").modal("show");
    
    
                            $("#btnClose").click(function(e) {
    
                                        e.preventDefault();
                                       
                                        window.open(`PHPcode/showGeneratedQRCode.php?employeeID=${employeeID}`, '_blank');
                                        window.location='../../employee.php';
                                    });
    
                            setTimeout(function(){
                                $('#displayModal').modal("hide");
                                 window.open(`PHPcode/showGeneratedQRCode.php?employeeID=${employeeID}`, '_blank');
                                 window.location='../../employee.php';
                                 
                            }, 2000);
    
                            
                                       
                                    
                        }
                        else if(confirmation.includes("success") && confirmation.includes("Employee does not earn wage"))
                        {
                            let id = confirmation.split(",");
                            let employeeID = parseInt(id[1]);
                            console.log(id[1]);
                            $("#modal-title-default").text("Success!");
                            $("#MMessage").text("Employee added successfully but employee does not earn wage ,thus employee tag not generated.");
                            $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                            $("#modalHeader").css("background-color", "#1ab394");
                            //$("#btnClose").attr("onclick","window.location='../../employee.php'");
                            $("#displayModal").modal("show");
    
    
                             $("#btnClose").click(function(e) {
    
                                        e.preventDefault();
                                       
                                        window.location=`view.php?employeeID=${employeeID}`;
                                    });
                                    setTimeout(function(){
                                        $('#displayModal').modal("hide");
                                         window.open(`view.php?employeeID=${employeeID}`);
                                        
                                    }, 2000);
                        }
                        else if(confirmation.includes("Employee Exists"))
                        {
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text("Employee Exists! , press close and try again");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                           
                            $("#displayModal").modal("show");
                        }
                        else if(confirmation == "City found suburb added but address not added.")
                        {
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text("City found suburb added but address not added.");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
                        }
                        else if(confirmation == "error in saving employee pic or generated employee tag")
                        {
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text("error in saving employee pic or generated employee tag , generate employee tag or upload picture in mainatain");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
    
                            
                        }
                        else if(confirmation == "Couldnt get ID of employee details")
                        {
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text("Couldnt get ID of employee details , generate employee tag or upload picture in mainatain");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
                        }
                        else if(confirmation.includes("There was an error within the picture upload"))
                        {
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text("Incorrect picture size or format , upload picture in maintain");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
                        }
                        else if(confirmation.includes("Employee QR code could not be generated"))
                        {
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text("Employee QR code could not be generated, go to regenerate employee tag , to make one!");
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
                        }
                        else
                        {
                            
                            $("#modal-title-default").text("Error!");
                            $("#MMessage").text(confirmation);
                            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                            $("#modalHeader").css("background-color", "red");
                            $("#displayModal").modal("show");
    
                            
                        }
                      
                    });
                }
                else if(size >20971520)
                {
                    $('#modal-title-default').text("Error!");
                    $('#MMessage').text("Only Images Less than 20MB can be uploaded. Please check file uploads highlighted in red");
                    $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                  
                    $("#modalHeader").css("background-color", "red");
                    $('#displayModal').modal("show");   
                }
                else if(fileErrors >0)
                {
                    $('#modal-title-default').text("Error!");
                    $('#MMessage').text("Only JPEG images can be uploaded. Please check file uploads highlighted in red");
                    $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');

                    $("#modalHeader").css("background-color", "red");
                    $('#displayModal').modal("show");   
                }

               
            }
        }
    });
    

});

function PreviewPic() 
{
    pdffile=document.getElementById("fileUpload").files[0];
    pdffile_url=URL.createObjectURL(pdffile);
    $('#IDViewer').attr('src',pdffile_url);
}