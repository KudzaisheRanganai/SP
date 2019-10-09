$(()=>{
    
        var dateFrom = $('#dateFrom').text().trim();
        var dateTo = $('#dateTo').text().trim();

        console.log(dateFrom);
        console.log(dateTo);
        

        $.ajax({
            url: 'PHPcode/productTrends.php',
            type: 'POST',
            data: {DATEFROM:dateFrom ,DATETO:dateTo} ,
            beforeSend: function(){
               
            }
        })
        .done(data=>{
            

            if(data!="Empty")
            {
                let arr=JSON.parse(data);
                console.log(arr);
                let tableEntries="";
                let formView="";
                //let formEdit="1"
                let redCount=0;
                let greenCount=0;
                let arrayOfProdNames = [];
                let arrayOfProdTotals = [];
                let arrayOfProdTypes = [];
                let arrayOfProdTypesTotal = [];
                let arrayOfIDs = [];
                let prodTypeNamesArray = [];                
                let idCount =0;
                let tempArrayProds = arr;
                let arrayTempProdIDs  = []; 
               
                //Group same IDs
            function groupProductTypes(array)
                    {
                        for(let i=0;i<array.length;i++)
                        {

                            for(let b=0;b<array.length;b++)
                            {
                                if(array[i] == array[b])
                                {
                                    arrayOfIDs.push(array[b]);
                                
                                }
                            

                            }
                        }
                    }
                

                //Sort occurance of IDs from High to Low
                

               


                function sortProductTypes(array) {
                    var howMany = {};
                
                    array.forEach(function(value) { howMany[value] = 0; });
                
                    var uniques = array.filter(function(value) {
                        return ++howMany[value] == 1;
                    });
                
                    return uniques.sort(function(a, b) {
                        return howMany[b] - howMany[a];
                    });
                }
                    console.log(arr[0].PRODUCT_SIZE_TYPE);
               

                

              for(let k=0;k<arr.length;k++)
                {	
                   if(k<5)
                   {
                   
                        let pType="Individual";
                        let pNumber= 1;
                        if(arr[k].PRODUCT_SIZE_TYPE==2)
                        {
                            pType="Case";
                            pNumber=arr[k].UNITS_PER_CASE;
                        }
                        else if(arr[k].PRODUCT_SIZE_TYPE==3)
                        {
                            pType="Pallet";
                            pNumber=arr[k].CASES_PER_PALLET;
                        }
    
                        let theProductName = arr[k].NAME+" ("+pNumber+" x "+arr[k].PRODUCT_MEASUREMENT+arr[k].PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;
                        arrayOfProdNames.push(theProductName);
                        arrayOfProdTotals.push(arr[k].TOTAL_PRODUCT_QUANTITY);
                        arrayOfProdTypes.push(arr[k].PRODUCT_TYPE_ID);
                        
                        //let theUnitPrice = productsArray[productIndex].SELLING_PRICE;
                    }
                    
                   
                    
                    
                }

                groupProductTypes(arrayOfProdTypes); // Group product types
                console.log(arrayOfIDs);
                let sortedProductTypesArray=sortProductTypes(arrayOfIDs); //sortedProductTypes
                console.log(sortedProductTypesArray);
                
                let countOfProdTypes = 0;
                //Loop for second graph
                for(let k=0;k<arr.length;k++)
                {	
                   if(k<5)
                   {
                        
                        for(let i=0;i<sortedProductTypesArray.length;i++)
                        {
                            if(sortedProductTypesArray[i]==arr[k].PRODUCT_TYPE_ID)
                            {
                            
                                  
                                if(!prodTypeNamesArray.includes(arr[k].TYPE_NAME))
                                {
                                    prodTypeNamesArray.push(arr[k].TYPE_NAME);
                                    
        
                                }
                            }
                        }
                   
                   }
                }

                console.log(prodTypeNamesArray);
                //Get the quantity of product types
                for(let k=0;k<prodTypeNamesArray.length;k++)
                {	
                   
                        for(let t=0;t<arr.length;t++)
                        {
                        
                            if(prodTypeNamesArray[k] ==arr[t].TYPE_NAME )
                            {
                                countOfProdTypes += parseInt(arr[t].TOTAL_PRODUCT_QUANTITY);
                                

                            }
                        }
                        arrayOfProdTypesTotal.push(countOfProdTypes);
                }
              console.log(arrayOfProdTypesTotal);
              console.log(prodTypeNamesArray);

                let newLabels =  ["All Gold Tomato Sauce (6x700ml) Case", "Coca Cola (6x2l) Case", "Kingsley Ginger Bear (6x2l) Case", "Dragon Energy Drink (24x500ml) Case", "Monster Energy Drink (24x500ml) Case"];

               new Chart(document.getElementById("pie-chart"), {
                    type: 'pie',
                    data: {
                      labels:arrayOfProdNames,
                      datasets: [{
                        label: "No Of Sales",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: arrayOfProdTotals
                      }]
                    },
                    options: {
                      title: {
                        display: true,
                        text: 'TOP 5 MOST SOLD PRODUCTS'
                      }
                    }
                });
          
                new Chart(document.getElementById("pie-chart2"), {
                    type: 'pie',
                    data: {
                      labels: prodTypeNamesArray,
                      datasets: [{
                        label: "No Of Sales",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: arrayOfProdTypesTotal
                      }]
                    },
                    options: {
                      title: {
                        display: true,
                        text: 'TOP 5 MOST SOLD PRODUCT TYPES'
                      }
                    }
                });


                //Get Max
                let maxQuantity = Math.max(...arrayOfProdTotals);
                let MaxProductName = "";
                for(var i=0;i<arrayOfProdTotals.length;i++)
                {
                    if(arrayOfProdTotals[i] == maxQuantity )
                    {
                         MaxProductName = arrayOfProdNames[i];
                      
                    }
                }
              
             
                 console.log(MaxProductName);
             

                let MaxQuantityTypeSold = Math.max(...arrayOfProdTypesTotal);
            
                let MaxProductType= prodTypeNamesArray[arrayOfProdTypesTotal.indexOf(MaxQuantityTypeSold)];
                $("#MaxProductName").text(MaxProductName);
                $("#MaxQuantitySold").text(`${maxQuantity} Sold.`);
                $("#MaxProductType").text(MaxProductType);
                $("#MaxQuantityTypeSold").text(`${MaxQuantityTypeSold} Sold.`);

                //Get Min

                let minQuantity = Math.min(...arrayOfProdTotals);
                let MinProductName = "";
                for(var i=0;i<arrayOfProdTotals.length;i++)
                {
                    if(arrayOfProdTotals[i] == minQuantity )
                    {
                        MinProductName = arrayOfProdNames[i];
                      
                    }
                }

                let MinQuantityTypeSold = Math.min(...arrayOfProdTypesTotal);
                let MinProductType= prodTypeNamesArray[arrayOfProdTypesTotal.indexOf(MinQuantityTypeSold)];

                $("#MinProductName").text(MinProductName);
                $("#MinQuantitySold").text(`${minQuantity} Sold.`);
                $("#MinProductType").text(MinProductType);
                $("#MinQuantityTypeSold").text(`${MinQuantityTypeSold} Sold.`);
                





               /* $("#tBody").append(tableEntries);
                $('#totalAbsent').append('<td>'+redCount+'</td>');
                $('#totalPresent').append('<td>'+greenCount+'</td>');*/
            }
            else
            {
                alert("No Sales Were Made In This Date Period!");
            }
        });
    });