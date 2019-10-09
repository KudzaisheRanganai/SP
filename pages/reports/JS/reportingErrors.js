$(()=>{
    
    console.log("Reporting Errors Work");

        
            //var URL = "invoice/invoice.php";
            //window.open(URL, '_blank');
            var form='<p>Please enter the timeframe for which the report should be generated?</p><form target="_blank" action="pages/reports/product-trends-report.php" id="sendProdInfo" method="POST" class="d-inline"><div class="form-group col-6"><label for="exampleInputPassword1">Date From</label><input type="date" class="form-control" id="DATEFROM" name="DATEFROM" placeholder="Enter Date of Sale From"></div><div class="form-group col-6"><label for="exampleInputPassword1">Date To</label><input type="date" class="form-control" id="DATETO" name="DATETO" placeholder="Enter Date of Sale To"></div><input type="button" class="btn btn-success" id="ReportError" value="Generate Report"></input><button type="button" class="btn btn-danger" data-dismiss="modal">No</button></form>';
            $("#SubmitReport").append(form);
           
        
	$("#ReportError").on('click',function(e){
        e.preventDefault();
        var dateFrom = $('#DATEFROM').val();
        var dateTo = $('#DATETO').val();
        console.log(dateFrom);
        console.log(dateTo);

        /*let comDateFrom = new Date(dateFrom);
        let comDateTo = new Date(dateTo);

        console.log(comDateFrom);
        console.log(comDateTo);*/
        if(dateFrom > dateTo)
        {
            $("#modal-title-default2").text("Error!");
            $("#MMessage").text("Date Period Is Incorrect!");
            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
            $("#modalHeader").css("background-color", "red");
           
            $("#displayModal").modal("show");
        }
        else if(dateTo=="" || dateFrom=="")
        {
            $("#modal-title-default2").text("Warning!");
            $("#MMessage").text("Please Enter Dates For Both Fields!");
            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
            $("#modalHeader").css("background-color", "red");
           
            $("#displayModal").modal("show");
        }
        else
        {
            $.ajax({
                url: 'pages/reports/PHPcode/productTrends.php',
                type: 'POST',
                data: {DATEFROM:dateFrom ,DATETO:dateTo} ,
                beforeSend: function(){
                    $('.loadingModal').modal('show');
                }
            })
            .done(data=>{

                $('.loadingModal').modal('hide');
                if(data!="Empty")
               {


                        $("#sendProdInfo" ).submit();
                        location.reload();
               }
               else
               {
                    $("#modal-title-default2").text("Error!");
                    $("#MMessage").text("No Sales Were Made For This Date Period");
                    $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                    $("#modalHeader").css("background-color", "red");
                
                    $("#displayModal").modal("show");
               }
            });
        }

     
       
       
        // $("#SubAttForm" ).submit();
        /*if(dateFrom > dateTo)
        {
            $("#modal-title-default").text("Error!");
            $("#MMessage").text("Date Period Is Incorrect!");
            $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
            $("#modalHeader").css("background-color", "red");
           
            $("#displayModal").modal("show");
        }*/
		
    });
    

    $("#SubAttButt").on('click',function(e){
        
                    e.preventDefault();
                    var date= $('#DATE').val();
                  
                    console.log(date);
            
                    /*let comDateFrom = new Date(dateFrom);
                    let comDateTo = new Date(dateTo);
            
                    console.log(comDateFrom);
                    console.log(comDateTo);*/
            
                    var today = new Date();
                    today = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    

                    if(date > today)
                    {
                        console.log(today);
                        $("#modal-title-default2").text("Warning!");
                        $("#MMessage").text("We Cannot See Into The Future , Try Todays' Or A Date Before Today");
                        $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                        $("#modalHeader").css("background-color", "red");
                       
                        $("#displayModal").modal("show");
                    }
                    else
                    {
                        $("#SubAttForm").submit();
                        //location.reload();
                    }
                });

});