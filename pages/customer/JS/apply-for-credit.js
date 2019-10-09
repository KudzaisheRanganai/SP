$(document).on('change', '.custom-file-input', function (event) {
    $(this).next('.custom-file-label').html(event.target.files[0].name);

    myfile= $(this).val();
    var ext = myfile.split('.').pop();

    if(ext!="pdf")
    {
        event.preventDefault();
        //console.log("NOT PDF");
        $(this).next().attr("style","border-color: red;");
        $('#modal-title-default2').text("Error!");
        $('#modalText').text("Only PDF documents can be uploaded. Please check file uploads highlighted in red");
        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
        $("#btnClose").attr("onclick",'$("#modal-salesManagerPassword").modal("show");');
        $("#modalHeader").css("background-color", "red");
        $('#successfullyAdded').modal("show");
    } 
    else
    {
       //console.log("PDF");
       $(this).next().attr("style","border-color: #cad1d7;");

    }
})

$(document).ready(function(){

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    $("#uploadForm").on('submit',(function(e) {
        e.preventDefault();
        let form=$('#uploadForm');
        form.validate();
        //element.valid();78\6\\\\\\\\\\\\
        
        var fdata = new FormData(this);
        var fileErrors = 0;
        for (var file of fdata.values()) 
        {
            if (myfile= file["name"] != undefined) 
            {
                myfile= file["name"];
                var ext = myfile.split('.').pop();
                if(ext!="pdf")
                {
                   //console.log("NOT PDF");
                   fileErrors++;
                }    
            }
           
        }

        if(form.valid()===false)
        {
            e.stopPropagation();
        }
        else
        {

            if (fileErrors == 0) 
            {
                $.ajax({
                    url: "PHPcode/apply_for_credit_.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(){
                        $('.loadingModal').modal('show');
                    }
                })
                .done(data=>{
                    $('.loadingModal').modal('hide');
                    console.log(data);
                    if(data=="success")
                    {
                        $('#modal-title-default2').text("Success!");
                        $('#modalText').text("Credit account successfully created");
                        $('#animation').html('<div style="text-align:center;"><div class="checkmark-circle"><div class="background"></div><div class="checkmark draw" style="text-align:center;"></div></div></div>');
                        $("#modalHeader").css("background-color", "#1ab394");
                        $("#btnClose").attr("onclick","window.location='../../customer.php'");
                        $('#successfullyAdded').modal("show");
                    }
                    else if(data=="failed")
                    {
                        $('#modal-title-default2').text("Error!");
                        $('#modalText').text("Error adding customer account, please check all inputs");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#btnClose").attr("onclick","");
                        $("#modalHeader").css("background-color", "red");
                        $('#successfullyAdded').modal("show");
                    }
                    else
                    {
                        $('#modal-title-default2').text("Error!");
                        $('#modalText').text("Database Error");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#btnClose").attr("onclick","");
                        $("#modalHeader").css("background-color", "red");
                        $('#successfullyAdded').modal("show");
                    }
      
                });
            }
            else
            {
                $('#modal-title-default2').text("Error!");
                $('#modalText').text("Only PDF documents can be uploaded. Please check file uploads highlighted in red");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
                $("#btnClose").attr("onclick","");
                $('#successfullyAdded').modal("show");
            }
        }  
    }));
});

function PreviewBS() 
{
    pdffile=document.getElementById("bankStatement").files[0];
    pdffile_url=URL.createObjectURL(pdffile);
    $('#BSViewer').attr('src',pdffile_url);
}

function PreviewID() 
{
    pdffile=document.getElementById("idCopy").files[0];
    pdffile_url=URL.createObjectURL(pdffile);
    $('#IDViewer').attr('src',pdffile_url);
}

function PreviewRS() 
{
    pdffile=document.getElementById("proofOfResidence").files[0];
    pdffile_url=URL.createObjectURL(pdffile);
    $('#RSViewer').attr('src',pdffile_url);
}

