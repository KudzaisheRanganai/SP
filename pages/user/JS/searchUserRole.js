$(()=>{
    $.ajax({
        url: 'PHPcode/searchUserRole_.php',
        type: 'POST',
        data: {choice:2},
        beforeSend: function(){
            $('.loadingModal').modal('show');
        }
    })
    .done(data=>{
        //console.log(data);


            $('.loadingModal').modal('hide');
       
        if(data!="False")
        {
            let arr=JSON.parse(data);
            console.log(arr);
            let tableEntries="";
            let formView="";
            //let formEdit="1"
            let count= 0;
            for(let k=0;k<arr.length;k++)
            {
                
                formView="<form action='maintain-user-role.php' method='POST'><input type='hidden' name='ACCESS_LEVEL_NAME' value='"+arr[k]["ACCESS_LEVEL_NAME"]+"'>"+"<input type='hidden' name='ACCESS_LEVEL_ID' value='"+arr[k]["ACCESS_LEVEL_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-user'></i></span><span class='btn-inner--text'>Edit</span></button>"+"</form>";
                tableEntries+="<tr><td>"+arr[k]["ACCESS_LEVEL_NAME"]+"</td><td style='overflow-y: hidden !important;'>";
                let arr2 = arr[k]["FUNTIONALITY"];

               if(!(arr2.length >0) )
               {
                tableEntries+= " None </td><td>"+formView+"</td></tr>";
               }
               else
               {
                    for(let i =0;i<arr2.length;i++)
                    {
                        count =i;
                        if(i != arr2.length-1)
                        {
                            tableEntries+= arr2[i] + ", " ;
                        }
                        else
                        {
                            break;
                        }
                        
                    }
                    tableEntries+= arr2[count] +"</td><td>"+formView+"</td></tr>";
                }
                
                
               
            }
            $("#tBody").append(tableEntries);
            
        }
        else
        {
            alert("Error");
        }
    });
});