$(()=>{
    
        var salePeriod = $('#salePeriod').text().trim();
        //var dateTo = $('#dateTo').text().trim();
        let tableHeader;
        console.log(salePeriod);
        if(salePeriod=="Weekly")
        {
            $("#PeriodAttr").text("DAYS OF THE WEEK");
                tableHeader = "SALES FOR A WEEK";
        }   
        if(salePeriod=="Monthly")
        {
            $("#PeriodAttr").text("DAYS OF THE MONTH");
            tableHeader = "SALES FOR A MONTH";
        
        }   
        if(salePeriod=="Daily")
        {
            $("#PeriodAttr").text("DAY");
            tableHeader = "SALES FOR A DAY";
    
        }  
        //console.log(dateTo);
    
        $.ajax({
            url: 'PHPcode/saleReport.php',
            type: 'POST',
            data: {SALEPERIOD:salePeriod} 
        })
        .done(data=>{
            
            if(data!="False")
            {
                console.log(data);
                let arr=JSON.parse(data);
                //console.log(arr);
                let dateSaleFrom;
                let dateSaleTo;

                //console.log(arr[0]["SALE_DATE"]);
                //console.log( moment(arr[0]["SALE_DATE"]).format('dddd'));
                let tableEntries="";
                let formView="";
                let totalSales = 0;
                //[1, 2, 3, 4].reduce((a, b) => a + b, 0)
                let saleTotalArray=[];
                let daysOfTheWeek;
                let previousDay;
                let staticTotalSales = 0;
                let futureDay;
                //let arrLength = arr.length;
                //console.log(arrLength);

                let saleGraphDays = [];

             
                var formattedTime;
                let saleDates = [];
               let total = 0;
               if(arr != "Empty")
               {
                    for(let k=0;k<arr.length;k++)
                    {
                        if(salePeriod=="Weekly"  || salePeriod == "Daily")
                        {
                            daysOfTheWeek= arr[k]["SALE_DATE"];
                            saleDates.push(daysOfTheWeek);
                         
                             
                            total=total+parseFloat(arr[k]["SALE_AMOUNT"]);
                              totalSales = arr[k]["TOTAL_SALES"];
                             //console.log(totalSales);
                             formattedTime = daysOfTheWeek;
                             staticTotalSales =  parseFloat(arr[k]["SALE_AMOUNT"]);

                            let staticTotalSalesFormatted = parseFloat(arr[k]["SALE_AMOUNT"]);
                            staticTotalSalesFormatted = totalSales.toFixed(2);
                            staticTotalSalesFormatted = numberWithSpaces(staticTotalSalesFormatted);
                            staticTotalSalesFormatted = "R"+ staticTotalSalesFormatted;

                             saleTotalArray.push(parseFloat(arr[k]["SALE_AMOUNT"]).toFixed(2));

                             if(salePeriod=="Weekly"  || salePeriod == "Daily")
                             {
                                 formattedTime = moment(daysOfTheWeek).format('Do MMMM YYYY');
                             }
                             saleGraphDays.push(formattedTime);
                             
                                 tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSalesFormatted+"</td></tr>";
                                 
                        }
                        else if(salePeriod=="Monthly")
                        {
                            daysOfTheWeek= arr[k]["SALE_DATE"];
                            saleDates.push(daysOfTheWeek);
                         
                             
                            total=total+parseFloat(arr[k]["SALE_AMOUNT"]); 
                             totalSales = arr[k]["TOTAL_SALES"];
                             //console.log(totalSales);
                             formattedTime = daysOfTheWeek;
                             staticTotalSales =  parseFloat(arr[k]["SALE_AMOUNT"]);

                            let staticTotalSalesFormatted = parseFloat(arr[k]["SALE_AMOUNT"]);
                            staticTotalSalesFormatted = totalSales.toFixed(2);
                            staticTotalSalesFormatted = numberWithSpaces(staticTotalSalesFormatted);
                            staticTotalSalesFormatted = "R"+ staticTotalSalesFormatted;

                             saleTotalArray.push(parseFloat(arr[k]["SALE_AMOUNT"]).toFixed(2));
                            
                                 formattedTime = moment(daysOfTheWeek).format('Do MMMM YYYY');
                             
                             saleGraphDays.push(formattedTime);
                             
                                 tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSalesFormatted+"</td></tr>";
                                 
                        }
                        


                        
                    
                    }
                
                var totalSalesAll = parseFloat(total);
                totalSalesAll = totalSalesAll.toFixed(2);
                totalSalesAll = numberWithSpaces(totalSalesAll);
                totalSalesAll = "R"+ totalSalesAll;

            
                
               $("#tBody").append(tableEntries);
               $('#total').append('<td>'+totalSalesAll+'</td>');


               //Display Graph
                //console.log(saleGraphDays);
                saleTotalArray.reverse();
                //console.log(saleTotalArray);
                saleDates.reverse();
                //console.log(saleDates);
                var day = new Date();

               
                var prevDay = new Date(day);
                dateSaleTo = moment(prevDay).format("Do MMMM YYYY");
                console.log(dateSaleTo);
                prevDay.setDate(day.getDate());
                let comDate;
                comDate = prevDay.getFullYear()+'-'+(prevDay.getMonth()+1)+'-'+(prevDay.getDate());
                console.log(saleDates);
                console.log(comDate);
                let newWeek = [];
                let count = 0;
                day = prevDay;
                let tempSaleArray = [];
                let arraComparer;
                    console.log(saleTotalArray);
                let noOfWeeks = 0;
                let weeklySales = [];
                let newDatesArray = [];
                let tempVal;
                let weekArray = [];
                if(comDate == arraComparer)
                {
                    console.log("Compare Works!");
                }
                let countArr = 0;
                let acc = 0;
                if(salePeriod=="Weekly" || salePeriod=="Daily")
                {

                    if(salePeriod=="Weekly")
                    {
                        while(count <7)
                        {

                            arraComparer = new Date(saleDates[countArr]);
                            arraComparer = arraComparer.getFullYear()+'-'+(arraComparer.getMonth()+1)+'-'+(arraComparer.getDate());
                            console.log(arraComparer);
                            console.log(comDate);
                           if(comDate==arraComparer)
                           {
                                //formattedTime = moment(saleDates[count]).format('dddd');
                                newWeek.push(arraComparer);
                                tempSaleArray.push(saleTotalArray[countArr]);
                                console.log("Works: " + countArr);
                                //count++;
                                countArr +=1;

                           }
                           else
                           {
                                //formattedTime = moment(comDate).format('dddd');
                                newWeek.push(comDate);
                               
                                tempSaleArray.push(0);
                                

                           }
                           count +=1;
                          
                           
                           day = new Date(prevDay);
                           //prevDay = prevDay.getFullYear()+'-'+(prevDay.getMonth())+'-'+(prevDay.getDate()-1);
                           prevDay.setDate(day.getDate()-1);
                           comDate = prevDay.getFullYear()+'-'+(prevDay.getMonth()+1)+'-'+prevDay.getDate();
                           console.log(comDate);
                           //console.log(moment(comDate).format('dddd'));

                        }
                    }
                   

                    if(salePeriod=="Daily")
                    {
                        newDatesArray.push(saleGraphDays[0]);
                        tempSaleArray.push(saleTotalArray[0]);
                    }
                }
                else if(salePeriod=="Monthly")
                {
                    let weekCounter = 0;
                  while(saleDates.length-1 >= weekCounter )
                   {
                      
                            count=0;
                            while(count <7)
                            {

                                if(saleDates.length-1 >= countArr)
                                {
                                    arraComparer = new Date(saleDates[countArr]);
                                    arraComparer = arraComparer.getFullYear()+'-'+(arraComparer.getMonth()+1)+'-'+(arraComparer.getDate());
                                    //console.log(arraComparer);
                                    //console.log(comDate);
                                
                                        if(comDate==arraComparer)
                                        {
                                                //formattedTime = moment(saleDates[count]).format('dddd');
                                                newWeek.push(arraComparer);
                                                tempSaleArray.push(parseFloat(saleTotalArray[countArr]).toFixed(2));
                                                
                                                //count++;
                                                countArr +=1;
                    
                                        }
                                        else
                                        {
                                                //formattedTime = moment(comDate).format('dddd');
                                                newWeek.push(comDate);
                                            
                                                tempSaleArray.push(parseFloat(0).toFixed(2));
                                                
                    
                                        }
                                        count +=1;
                                        
                                        
                                        day = new Date(prevDay);
                                        //prevDay = prevDay.getFullYear()+'-'+(prevDay.getMonth())+'-'+(prevDay.getDate()-1);
                                        prevDay.setDate(day.getDate()-1);
                                        comDate = prevDay.getFullYear()+'-'+(prevDay.getMonth()+1)+'-'+prevDay.getDate();
                               
            
                                }
                                else
                                {
                                    break;
                                }
                            
                            }
                            weekCounter = countArr;
                            noOfWeeks += 1; 
                            
                            tempVal = sumAdd(acc,tempSaleArray);
                            acc = tempSaleArray.length;
                           
                            weeklySales.push(tempVal);
                           
                            weekArray.push("Week: " + noOfWeeks + ".");
                   } 
                   
                }
               
               
              function sumAdd(index,array)
              {
                let sum =0;
                while(index < array.length)
                {
                    sum += parseFloat(array[index]);
                    index+= 1;
                }
                return parseFloat(sum).toFixed(2);
              }
               
                for(let i =0;i<newWeek.length;i++)
                {
                    day = new Date(newWeek[i]);
                    formattedTime = moment(day).format('dddd');
                    newDatesArray.push(formattedTime);

                }
               
                if(salePeriod=="Daily" || salePeriod=="Weekly")
                {
                    newDatesArray.reverse();
                    tempSaleArray.reverse();
                }
                else if(salePeriod=="Monthly")
                {
                    weeklySales.reverse();//monthly sales
                    tempSaleArray = weeklySales;
                    newDatesArray = weekArray;
                }
                console.log(formattedTime);
                console.log(tempSaleArray);
                console.log(newDatesArray);

                let endDay = new Date(newWeek[newWeek.length-1]);
                dateSaleFrom = moment(endDay).format("Do MMMM YYYY");
                console.log(dateSaleFrom);

                if(salePeriod=="Monthly")
                {
                    $("#PeriodAttr").html("Monthly Sales<h4 class='text-white mb-0'><i class='far fa-calendar-alt mr-2'></i>" +dateSaleFrom+ " : " + dateSaleTo +"</h4>");
                    tableHeader = "SALES FOR A MONTH";
                
                }
                if(salePeriod=="Weekly")
                {
                    $("#PeriodAttr").html("Weekly Sales<h4 class='text-white mb-0'><i class='far fa-calendar-alt mr-2'></i>" +dateSaleFrom+ " : " + dateSaleTo +"</h4>");
                        tableHeader = "SALES FOR THE WEEK";
                }   
                if(salePeriod=="Daily")
                {
                    $("#PeriodAttr").html("Daily Sale<h4 class='text-white mb-0'><i class='far fa-calendar-alt mr-2'></i>" +dateSaleTo +"</h4>");
                    tableHeader = "SALES FOR A DAY";
            
                }  
                // new Chart(document.getElementById("line-chart"), {
                //     type: 'line',
                //     data: {
                //         labels: newDatesArray,
                //         datasets: [{ 
                //             data: tempSaleArray,
                //           label: "Sales",
                //           borderColor: "#3e95cd",
                //           fill: false
                //         }
                //       ]
                //     },
                //     options: {
                //       title: {
                //         display: true,
                //         text: tableHeader
                //       }
                //     }
                //   });


                let chart =new Chart(document.getElementById("line-chart"), {
                    type: 'line',
                    data: {
                      labels: newDatesArray,
                      datasets: [{ 
                          data: tempSaleArray,
                          label: "Sales",
                          borderColor: "#3e95cd",
                          fill: false
                        }
                      ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                          xAxes: [ {
                            display: true,
                            scaleLabel: {
                              display: true,
                              labelString: tableHeader
                            },
                            ticks: {
                              major: {
                                fontStyle: 'bold',
                                fontColor: '#FF0000'
                              }
                            }
                          } ],
                          yAxes: [ {
                            display: true,
                            scaleLabel: {
                              display: true,
                              labelString: 'Revene (Rands)'
                            }
                          } ]
                        }
                    }
                });



                /*, { 
                    data: [454,786,675,786,635,809,655],
                    label: "2018",
                    borderColor: "#8e5ea2",
                    fill: false
                  }, { 
                    data: [678,787,745,876,956,1046,986],
                    label: "2019",
                    borderColor: "#7cbf56",
                    fill: false
                  }*/
               }
               else
               {
                   
                   if(salePeriod=="Weekly")
                   {
                    new Chart(document.getElementById("line-chart"), {
                        type: 'line',
                        data: {
                          labels: ["DAYS"],
                          datasets: [{ 
                              data: [0],
                              label: "Sales",
                              borderColor: "#3e95cd",
                              fill: false
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: tableHeader
                          }
                        }
                      });

                    salePeriod = salePeriod.toUpperCase();
                    $("#tBody").append("<tr></tr>").text(`NO SALES HAVE BEEN MADE ,IN THE LAST WEEK,IN ORDER TO MAKE A ${salePeriod} SALES REPORT`);
                   }
                   else if(salePeriod=="Monthly")
                   {
                    new Chart(document.getElementById("line-chart"), {
                        type: 'line',
                        data: {
                          labels: ["DAYS"],
                          datasets: [{ 
                              data: [0],
                              label: "Sales",
                              borderColor: "#3e95cd",
                              fill: false
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: tableHeader
                          }
                        }
                      });

                    salePeriod = salePeriod.toUpperCase();
                    $("#tBody").append("<tr></tr>").text(`NO SALES HAVE BEEN MADE ,IN THE LAST MONTH, IN ORDER TO MAKE A ${salePeriod} SALES REPORT`);
                   }
                   else
                   {

                    new Chart(document.getElementById("line-chart"), {
                        type: 'line',
                        data: {
                          labels: ["DAYS"],
                          datasets: [{ 
                              data: [0],
                              label: "Sales",
                              borderColor: "#3e95cd",
                              fill: false
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: tableHeader
                          }
                        }
                      });
                      
                    salePeriod = salePeriod.toUpperCase();
                    $("#tBody").append("<tr></tr>").text(`NO SALES HAVE BEEN MADE TODAY IN ORDER TO MAKE A ${salePeriod} SALES REPORT`);
                   }
               
               } 
               

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
    /* let redCount=0;
                let greenCount=0;
                let arrayOfProdNames = [];
                let arrayOfProdTotals = [];
                let arrayOfProdTypes = [];
                let arrayOfProdTypesTotal = [];
                let arrayOfIDs = [];
                let prodTypeNamesArray = [];                
                let idCount =0;

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
                let sortedProductTypesArray=sortProductTypes(arrayOfIDs); //sortedProductTypes
                console.log(sortedProductTypesArray);
                
                let countOfProdTypes = 0;
                //Loop for second graph
                for(let k=0;k<arr.length;k++)
                {	
                   if(k<5)
                   {
                    if(sortedProductTypesArray[k]==arr[k].PRODUCT_TYPE_ID)
                    {
                       
                        if(!prodTypeNamesArray.includes(arr[k].TYPE_NAME))
                        {
                            prodTypeNamesArray.push(arr[k].TYPE_NAME);

                        }
                    }
                   }
                }


                //Get the quantity of product types
                for(let k=0;k<prodTypeNamesArray.length;k++)
                {	
                   
                        for(let t=0;t<arr.length;t++)
                        {
                        
                            if(prodTypeNamesArray[k] ==arr[t].TYPE_NAME )
                            {
                                countOfProdTypes += parseInt(arr[t].TOTAL_PRODUCT_QUANTITY);
                                console.log(arr[t].TOTAL_PRODUCT_QUANTITY);

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
                

  <tr>
            <td class="no">January 2019</td>
            <td class="desc">678</td>
            <td class="unit-right">R123 567.00</td>
          </tr>
 */