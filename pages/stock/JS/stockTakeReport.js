$(()=>{
    
    let warehouse = $("#WareHouseName").text();
    $("#warehouse").html("<b>" + warehouse.toUpperCase() + "</b>");
    let prodName =$("#prodName").text().split(",");
    let sysQty =$("#qty").text().split(",");
    let inputtedQty =$("#qtyCounted").text().split(",");
    let diffOfQty =$("#diffQty").text().split(",");

    console.log(prodName);
		if(prodName)
		{
			
			let tableEntries="";
			let formView="";
            let formEdit="1"


            for(let k=0;k<prodName.length;k++)
            {
                if(diffOfQty[k] > 0)
                {
                    stockLevel = "no-red";
                }
                else
                {
                    stockLevel = "no";
                }
                let surplusOrDeficit = Math.abs(diffOfQty[k]);
                tableEntries+="<tr><td class='no'>"+prodName[k]+"</td><td class='desc'>"+ sysQty[k] +"</td><td class='desc'>"+inputtedQty[k]+"</td><td class='"+stockLevel+"'>"+surplusOrDeficit+"</td></tr>";
                

                
            }
            $("#tBody").append(tableEntries);
            
			
			
		}
		else
		{
			alert("Error");
		}


});
