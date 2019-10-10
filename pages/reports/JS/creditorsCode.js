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
                    let amountOwed = parseFloat(arr[k]["AMOUNT_OWED"]);
                    amountOwed = amountOwed.toFixed(2);
                    amountOwed = numberWithSpaces(amountOwed);
                    amountOwed = "R"+ amountOwed;


                    total=total+parseFloat(arr[k]["AMOUNT_OWED"]);
                    tableEntries+="<tr><td class='no' colspan='3'>"+arr[k]["SUPPLIER_ID"]+"</td><td class='desc'>"+arr[k]["VAT_NUMBER"]+"</td><td class='unit'>"+arr[k]["NAME"]+"</td><td class='total'>"+amountOwed+"</td></tr>";
                    
                }
                $("#tbody").append(tableEntries);

                let totalOwed = parseFloat(total);
                totalOwed = totalOwed.toFixed(2);
                totalOwed = numberWithSpaces(totalOwed);
                totalOwed = "R"+ totalOwed;
                $('#TotalAmountOwed').append('<td>'+totalOwed+'</td>');
                
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
};

function numberWithSpaces(x) 
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}