$(()=>{
    
        var salePeriod = "Weekly";
        //var dateTo = $('#dateTo').text().trim();
        let tableHeader;
        //console.log(salePeriod);
        if(salePeriod=="Weekly")
        {
            $("#PeriodAttrOrder").text("Weekly Total Orders");
                tableHeader = "SALES FOR THE WEEK";
        }   
     
    
        $.ajax({
            url: 'pages/supplier/PHPcode/orderGraph.php',
            type: 'POST',
            data: {SALEPERIOD:salePeriod} 
        })
        .done(data=>{
            
            if(data!="False")
            {
               // console.log(data);
                let arr=JSON.parse(data);
                //console.log(arr);


               // console.log(arr[0]["ORDER_DATE"]);
                //console.log( moment(arr[0]["ORDER_DATE"]).format('dddd'));
                let tableEntries="";
                let formView="";
                let totalOrders = 0;
                //[1, 2, 3, 4].reduce((a, b) => a + b, 0)
                let orderTotalArray=[];
                let daysOfTheWeek;
                let previousDay;
                let statictotalOrders = 0;
                let futureDay;
                let arrLength = arr.length;
                //console.log(arrLength);
                let  orderDates = [];
                let orderGraphDays = [];


               if(arr != "Empty")
               {
                
                    for(let k=0;k<arr.length;k++)
                    {
                        daysOfTheWeek= arr[k]["ORDER_DATE"];
                       orderDates.push(daysOfTheWeek);
                    
                        
                         
                        totalOrders = arr[k]["TOTAL_ORDERS"];
                        //console.log(totalOrders);
                        formattedTime = daysOfTheWeek;
                        statictotalOrders =  parseFloat(arr[k]["SALE_AMOUNT"]);
                       orderTotalArray.push(totalOrders);
                        if(salePeriod=="Weekly"  || salePeriod == "Daily")
                        {
                            formattedTime = moment(daysOfTheWeek).format('dddd');
                        }
                        orderGraphDays.push(formattedTime);
                        
                            tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='totalOrders'>"+totalOrders +"</td><td class='unit-right' id='SaleTotal'>"+statictotalOrders.toFixed(2)+"</td></tr>";
                            


                        
                    
                    }
                

            
                
               // $("#tBody").append(tableEntries);
             


               //Display Graph
                //console.log(orderGraphDays);
               orderTotalArray.reverse();
                //console.log( orderTotalArray);
                orderDates.reverse();
                //console.log(orderDates);
                var day = new Date();

               
                var prevDay = new Date(day);
                prevDay.setDate(day.getDate());
                let comDate;
                comDate = prevDay.getFullYear()+'-'+(prevDay.getMonth()+1)+'-'+(prevDay.getDate());
                console.log(orderDates);
                console.log(comDate);
                let newWeek = [];
                let count = 0;
                day = prevDay;
                let tempOrderArray = [];
                let arraComparer;
                let newDatesArray = [];
                    console.log( orderTotalArray);
                if(comDate == arraComparer)
                {
                    console.log("Compare Works!");
                }
                let countArr = 0;
                if(salePeriod=="Weekly" || salePeriod=="Daily")
                {

                    if(salePeriod=="Weekly")
                    {
                        while(count <7)
                        {

                            arraComparer = new Date(orderDates[countArr]);
                            arraComparer = arraComparer.getFullYear()+'-'+(arraComparer.getMonth()+1)+'-'+(arraComparer.getDate());
                            //console.log(arraComparer);
                            //console.log(comDate);
                           if(comDate==arraComparer)
                           {
                                //formattedTime = moment(orderDates[count]).format('dddd');
                                newWeek.push(arraComparer);
                                tempOrderArray.push( orderTotalArray[countArr]);
                                //console.log("Works: " + countArr);
                                //count++;
                                countArr +=1;

                           }
                           else
                           {
                                //formattedTime = moment(comDate).format('dddd');
                                newWeek.push(comDate);
                               
                                tempOrderArray.push(0);
                                

                           }
                           count +=1;
                          
                           
                           day = new Date(prevDay);
                           //prevDay = prevDay.getFullYear()+'-'+(prevDay.getMonth())+'-'+(prevDay.getDate()-1);
                           prevDay.setDate(day.getDate()-1);
                           comDate = prevDay.getFullYear()+'-'+(prevDay.getMonth()+1)+'-'+prevDay.getDate();
                           //console.log(comDate);
                           //console.log(moment(comDate).format('dddd'));

                        }


                        for(let i =0;i<newWeek.length;i++)
                        {
                            day = new Date(newWeek[i]);
                            formattedTime = moment(day).format('dddd');
                            newDatesArray.push(formattedTime);
        
                        }
                       
                    }
                   

                    if(salePeriod=="Daily")
                    {
                        newWeek.push(orderGraphDays[0]);
                        tempOrderArray.push( orderTotalArray[0]);
                    }
                }
                
                //console.log(tempOrderArray);
                //console.log(newWeek);
              
                newDatesArray.reverse();
               tempOrderArray.reverse();
                
               let maxValue = Math.max(...tempOrderArray);
               let chartMax = maxValue;
               if((chartMax % 10 )>0)
               {
                    chartMax=chartMax + 10;
               }
              
              
               console.log(maxValue);
                new Chart(document.getElementById("bar-chart"), {
                    type: 'bar',
                    data: {
                      labels: newDatesArray,
                      datasets: [{ 
                          data: tempOrderArray,
                          label: "Orders",
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
                              labelString: "DAYS OF THE WEEK"
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
                            ticks: {
                                beginAtZero: true,
                                step:4,
                                stepValue:2,
                                max: chartMax 
                            },
                            scaleLabel: {
                              display: true,
                              labelString: 'NUMBER OF ORDERS',
                              
                            }
                          } ]
                        }
                    }
                });




                  
                   /* data: [454,786,675,786,635,809,655],
                    label: "2018",
                    borderColor: "#8e5ea2",
                    fill: false
                  }, { 
                    data: [678,787,745,876,956,1046,986],
                    label: "2019",
                    borderColor: "#7cbf56",
                    fill: false
                  }*/
              /* }
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
                   }*/
               
               } 
               

            }
            else
            {
                alert("Error");
            }
        });
    });
 