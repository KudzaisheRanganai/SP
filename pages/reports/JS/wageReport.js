$(()=>{
	$.ajax({
		url: 'PHPcode/wageReport.php',
		type: 'POST',
		data: '' 
	})
	.done(data=>{
		if(data!="False")
		{
           
			let arr = JSON.parse(data);
		    console.log(arr);
      let tableEntries="";
      let formView="";
      //let formEdit="1"
      let count= 0;
      let totalWageAmount = 0;
      let hours = 0;
      for(let k=0;k<arr.length;k++)
      {
        let arr2 = arr[k]["HOURS"];
          
        if(!(arr2.length >0) )
        {
            hours = 0;
        }
        else
        {
          for(let i =0;i<arr2.length;i++)
          {
            hours += parseInt(arr2[i]);   
          }
            
        }

        let wageDueFormatted = parseFloat(arr[k]["EMPLOYEE_WAGE_DUE"]);
        wageDueFormatted = wageDueFormatted.toFixed(2);
        wageDueFormatted = numberWithSpaces(wageDueFormatted);
        wageDueFormatted = "R"+ wageDueFormatted;
          
        tableEntries+="<tr><td class='no'>"+arr[k]["EMPLOYEE_ID"]+"</td><td class='desc'>"+arr[k]["EMPLOYEE_NAME"]+"</td><td class='unit'>"+hours+"</td><td class='total'>"+wageDueFormatted+"</td></tr>";
        totalWageAmount +=  parseFloat(arr[k]["EMPLOYEE_WAGE_DUE"]);
        hours = 0;
          
         
      }
      $("#tBody").append(tableEntries);

      let totalWagesFormatted = totalWageAmount.toFixed(2);
      totalWagesFormatted = numberWithSpaces(totalWagesFormatted);
      totalWagesFormatted = "R"+ totalWagesFormatted;
			$("#WageTotal").text(totalWagesFormatted);
		}
		else
		{
			alert("Error");
		}
	});

});

function setTwoNumberDecimal(el) 
{
    el.value = parseFloat(el.value).toFixed(2);     
}

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

/* <tr>
            <td class="no">02/07/2019</td>
            <td class="desc">08:00</td>
            
            <td class="unit">8.50</td>
            <td class="total">R255.00</td>
          </tr>
          */