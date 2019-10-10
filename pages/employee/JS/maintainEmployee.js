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
    let employeeID=parseInt($("#employeeID").text());
    let name=$("#inputName").val().trim();
    let surname=$("#inputSurname").val().trim();
    let title=$("#tit option:selected").text();
    let titleID=1;
    if(title=="Ms")
    {
        titleID=2;
    }
    else if(title=="Mrs")
    {
        titleID=3;
    }
    let contact=$("#inputContact").val().trim();
    let email=$("#inputEmail").val().trim();
    let addressArr=$("#inputAddress").val().trim().split(",");
    let address=addressArr[0];
    let suburb=$("#inputSuburb").val().trim();
    let city=$("#inputCity").val().trim();
    let zip=$("#inputZip").val().trim();
    let employeeType=parseInt($("#eType option:selected").attr("name"));
    let employeeIDPass=$("#inputPassport").val().trim();

    let addEmployeeArr=[];
    addEmployeeArr["ID"]=employeeID;
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
/////////////////////////////
$(()=>{
	jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
	let changedAddress=$("#eAddress").text().replace("/"," ");
	let changedSuburb=$("#eSuburb").text().replace("/"," ");
	let changedCity=$("#eCity").text().replace("/"," ");
	let preTitle=$("#eTitle").text();
	let preETypeName=$("#eEmployeeTypeName").text().replace("/"," ");
	console.log(preETypeName);
	////////////////////////////////////////////
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
               if(preETypeName==arr[k]["NAME"])
               {
               	entry.attr("selected",true);
               }
               entry.text(arr[k]["NAME"]); 
               $("#eType").append(entry);
            }   
        }
        else
        {
            alert("Error");
        }
    });
	////////////////////////////////////////////
	$("#tit").val(preTitle);
    $("#inputAddress").val(changedAddress);
    console.log(changedAddress);
	$("#inputSuburb").val(changedSuburb);
	$("#inputCity").val(changedCity);
	/////////////////////////////////////////
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
    ////////////////////////////////////////////////////
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


    let emID= $("#employeeID").text();
    $("#mainf").on("submit",function(e)
    {//use ID of the form
        e.preventDefault();
        let mainform =$("#mainf");
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



            var fdata = new FormData(this);
            var fileErrors = 0;
            var filSizeErrors= 0;
            
            if($(".custom-file-input").val() != "") {

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
            }


            if((fileErrors==0) && (size < 20971520))
            {
                let form=new FormData();
                let pics=$("#fileUpload").get(0).files[0];
                //$("#fileUpload").prop('files')[0]
                form.append("file",pics);
                form.append("choice",1);
                form.append("employeeID",arr["ID"]);
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
                $.ajax({
                    url:'PHPcode/employeecode.php',
                    type:'POST',
                    data: form,
                    processData: false,
                    contentType: false,
                    cache: false
                })
                .done(data=>
                {
                    console.log(data);
                    let doneData=data.split(",");
                    if(doneData[0]=="T")
                    {           
                        
                        console.log(emID);
                        $('#modal-title-default').text("Success!");
                        $("#MMessage").text(doneData[1]);
                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                        $("#modalHeader").css("background-color", "#1ab394");
                       // $("#btnClose").attr("onclick","window.location='../../view.php?employeeID = '");
                        $("#displayModal").modal("show");
    
    
                          $("#btnClose").click(function(e) {
    
                                        e.preventDefault();
                                       
                                        window.location=`view.php?employeeID=${emID}`;
                                    });
                                    setTimeout(function(){
                                        $('#displayModal').modal("hide");
                                         window.open(`view.php?employeeID=${emID}`, '_blank');
                                    }, 2000);
                    }
                    else
                    {
                        $('#modal-title-default').text("Error!");
                        $("#MMessage").text(doneData[1]);
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                        $("#btnClose").attr("data-dismiss","modal");
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