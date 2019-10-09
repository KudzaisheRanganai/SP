$(()=>{
    
        var salePeriod = "Weekly";
        //var dateTo = $('#dateTo').text().trim();
        let tableHeader;
        //console.log(salePeriod);
        
        //console.log(dateTo);
    
        $.ajax({
            url: 'pages/sales/PHPcode/salesGraphDashboard.php',
            type: 'POST',
            data: {SALEPERIOD:salePeriod} 
        })
        .done(data=>{
            
            if(data!="False")
            {
                //console.log(data);
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
               
               if(arr != "Empty")
               {
                    for(let k=0;k<arr.length;k++)
                    {
                        if(salePeriod=="Weekly"  || salePeriod == "Daily")
                        {
                            daysOfTheWeek= arr[k]["SALE_DATE"];
                            saleDates.push(daysOfTheWeek);
                         
                             
                              
                             totalSales = arr[k]["TOTAL_SALES"];
                             //console.log(totalSales);
                             formattedTime = daysOfTheWeek;
                             staticTotalSales =  parseFloat(arr[k]["SALE_AMOUNT"]);
                             saleTotalArray.push(parseFloat(arr[k]["SALE_AMOUNT"]).toFixed(2));
                             if(salePeriod=="Weekly"  || salePeriod == "Daily")
                             {
                                 formattedTime = moment(daysOfTheWeek).format('dddd');
                             }
                             saleGraphDays.push(formattedTime);
                             
                                 tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSales.toFixed(2)+"</td></tr>";
                                 
                        }
                        else if(salePeriod=="Monthly")
                        {
                            daysOfTheWeek= arr[k]["SALE_DATE"];
                            saleDates.push(daysOfTheWeek);
                         
                             
                              
                             totalSales = arr[k]["TOTAL_SALES"];
                             //console.log(totalSales);
                             formattedTime = daysOfTheWeek;
                             staticTotalSales =  parseFloat(arr[k]["SALE_AMOUNT"]);
                             saleTotalArray.push(parseFloat(arr[k]["SALE_AMOUNT"]).toFixed(2));
                             if(salePeriod=="Weekly"  || salePeriod == "Daily")
                             {
                                 formattedTime = moment(daysOfTheWeek).format('dddd');
                             }
                             saleGraphDays.push(formattedTime);
                             
                                 tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSales.toFixed(2)+"</td></tr>";
                                 
                        }
                        


                        
                    
                    }
                

            
                
               // $("#tBody").append(tableEntries);
             


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
                   // console.log(saleTotalArray);
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
                          // console.log(comDate);
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
                    console.log(saleDates.length-1 + ": Number of total Sales");
                    console.log(weekCounter + ": Number of Elements that we went over in the saleDates array" );
                            count=0;
                            while(count <7)
                            {

                                if(saleDates.length-1 >= countArr)
                                {
                                    arraComparer = new Date(saleDates[countArr]);
                                    arraComparer = arraComparer.getFullYear()+'-'+(arraComparer.getMonth()+1)+'-'+(arraComparer.getDate());
                                   
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
                                //console.log(comDate);
                                //console.log(moment(comDate).format('dddd'));
            
                                }
                                else
                                {
                                    break;
                                }
                                console.log("End Of Week and weeks are:" + noOfWeeks);
                            
                            }
                            weekCounter = countArr;
                            noOfWeeks += 1; 
                            
                            tempVal = sumAdd(acc,tempSaleArray);
                            acc = tempSaleArray.length;
                            
                            weeklySales.push(tempVal);
                           
                            weekArray.push("Week: " + noOfWeeks + ".");
                            console.log("Week: " + noOfWeeks + ".");
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
                    $("#PeriodAttr").html("Monthly Sales Revenue<h3 class='text-white mb-0'><i class='far fa-calendar-alt mr-2'></i>" +dateSaleFrom+ " : " + dateSaleTo +"</h3>");
                    tableHeader = "SALES FOR A MONTH";
                
                }
                if(salePeriod=="Weekly")
                {
                    $("#PeriodAttr").html("Weekly Sales Revenue<h3 class='text-white mb-0'><i class='far fa-calendar-alt mr-2'></i>" +dateSaleFrom+ " : " + dateSaleTo +"</h3>");
                        tableHeader = "SALES FOR THE WEEK";
                }   
                if(salePeriod=="Daily")
                {
                    $("#PeriodAttr").html("Daily Sales Revenue<h3 class='text-white mb-0'><i class='far fa-calendar-alt mr-2'></i>" +dateSaleTo +"</h3>");
                    tableHeader = "SALES FOR A DAY";
            
                }  
               
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
                              labelString: 'DAYS OF THE WEEK'
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
                              labelString: 'REVENUE (RANDS)'
                            }
                          } ]
                        }
                    }
                });
                   /* options: {
                      title: {
                        display: true,
                        text: ''
                      }
                    }
                  });*/

                  //chart.options.scales.yAxes[ 0 ].scaleLabel.labelString = "New Label";


               
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
   