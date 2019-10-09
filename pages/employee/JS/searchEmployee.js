let scanSound = new Audio('../../assets/sounds/qr_scan-sound.mp3');
let checkinSuccessfulSound = new Audio('../../assets/sounds/checkin-sound.mp3');
let checkinErrorSound = new Audio('../../assets/sounds/error.mp3');

$(()=>{
	$.ajax({
		url: 'PHPcode/employeecode.php',
		type: 'POST',
		data: {choice:2},

	})
	.done(data=>{
		
		if(data!="False")
		{
			let arr=JSON.parse(data);
			//console.log(arr);
			let tableEntries="";
			let formView="";
			//let formEdit="1"
			for(let k=0;k<arr.length;k++)
			{
				
				formView="<form action='view.php' method='POST'><input type='hidden' name='EMPLOYEE_ID' value='"+arr[k]["EMPLOYEE_ID"]+"'>"+"<input type='hidden' name='NAME' value='"+arr[k]["NAME"]+"'>"+"<input type='hidden' name='IDENTITY_NUMBER' value='"+arr[k]["IDENTITY_NUMBER"]+"'>"+"<input type='hidden' name='SURNAME' value='"+arr[k]["SURNAME"]+"'>"+"<input type='hidden' name='CONTACT_NUMBER' value='"+arr[k]["CONTACT_NUMBER"]+"'>"+"<input type='hidden' name='EMAIL' value='"+arr[k]["EMAIL"]+"'>"+"<input type='hidden' name='ADDRESS_ID' value='"+arr[k]["ADDRESS_ID"]+"'>"+"<input type='hidden' name='TITLE_ID' value='"+arr[k]["TITLE_ID"]+"'>"+"<input type='hidden' name='EMPLOYEE_TYPE_ID' value='"+arr[k]["EMPLOYEE_TYPE_ID"]+"'>"+"<input type='hidden' name='EMPLOYEE_STATUS_ID' value='"+arr[k]["EMPLOYEE_STATUS_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
				tableEntries+="<tr><td>"+arr[k]["EMPLOYEE_ID"]+"</td><td>"+arr[k]["NAME"]+"</td><td>"+arr[k]["SURNAME"]+"</td><td>"+arr[k]["IDENTITY_NUMBER"]+"</td><td>"+formView+"</td></tr>";
			}
			$("#tBody").append(tableEntries);
			
		}
		else
		{
			alert("Error");
		}
	});

	let scanner = new Instascan.Scanner(
	  	{
	    	video: document.getElementById('videoElement')
	  	}
	);

    scanner.addListener('scan', function(content) {
    	scanSound.play();

      	console.log(content);
	    let savedID = content;
	    
	    $.ajax({
	      	type: 'POST',
	      	url: 'PHPcode/searchScanner-SQL.php',
	      	data: {qrCode : content},
	      	beforeSend: function(){
	        	$('.loadingModal').modal('show');
	        }
	     })
	      .done(data => {
	      // do something with data
	      $('.loadingModal').modal('hide');
            console.log(data);
            let confirmation = data.trim();
            
            if(confirmation == "success")
            {
            	checkinSuccessfulSound.play();
                window.location=`view.php?employeeID='${savedID}'`;

            }
            else if(confirmation != "success")
            {
            	checkinErrorSound.play();
                $('#modal-title-default').text("Error!");
                $('#modalText').text("Employee not found , please try again or search employee");
                $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
                $("#modalHeader").css("background-color", "red");
                $('#scannerSearch').modal("show");
            }
        })
        .fail(()=>
        {
            console.log("ajax failed");
        });              
    });
    


	Instascan.Camera.getCameras().then(cameras => 
	{
	  	if(cameras.length > 0)
	  	{
	      	scanner.start(cameras[0]);
	  	} 
	  	else 
	  	{
	      	console.error("No Camera Device");
	  	}
	});
});

 function myFunction() 
{
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  var showCount = 0;
  for (i = 0; i < tr.length; i++) 
  {
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[3];
    if (td || td2) 
    {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      if ((txtValue.toUpperCase().indexOf(filter)> -1)|| txtValue2.replace(/\s/g, '').toUpperCase().indexOf(filter)> -1) 
      {
        tr[i].style.display = "";
        showCount += 1;
      } 
      else 
      {
        tr[i].style.display = "none";
      }
    }       
  }

  if (showCount === 0)
  {
    $("#emptySearch").show();
  } 
  else
  {
    $("#emptySearch").hide();
  }
}