$(()=>{
    
        
        var d="";
        $.ajax({
            url: 'PHPcode/creditorsCode.php',
            type: 'POST',
            data: {d:d} 
        })
        .done(data=>{
            console.log(data);
            if(data!="False")
            {
                let arr=JSON.parse(data);
                let total=0;
                let tableEntries="";
        
                for(let k=0;k<arr.length;k++)
                {	
                    total=total+parseFloat(arr[k]["AMOUNT_OWED"]);
                    tableEntries+="<tr><td class='no' colspan='3'>"+arr[k]["SUPPLIER_ID"]+"</td><td class='desc'>"+arr[k]["VAT_NUMBER"]+"</td><td class='unit'>"+arr[k]["NAME"]+"</td><td class='total'>"+arr[k]["AMOUNT_OWED"]+"</td></tr>";
                    
                }
                $("#tbody").append(tableEntries);
                $('#TotalAmountOwed').append(`<td>${total.toFixed(2)}</td>`);
                
            }
            else
            {
                alert("Error");
            }
        });
    });