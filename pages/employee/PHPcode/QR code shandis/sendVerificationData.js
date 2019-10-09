
$(()=>
{
  

    //$(window).load(messages);

   
  
   
    $("button#submit").on("click",event =>
    {
       // event.prevenDefault();
       event.preventDefault();
       let convo = {info: $("input#chatss").val(), receiver: $("input#receiver").val(), sender: $("input#sender").val() };
       console.log(convo);
        console.log(convo.info);
       $.ajax({
            type: 'POST',
            url: 'chat.php',
            data: convo,
            beforeSend:()=>
                        {
                            $("div.box#boxChat ul").empty();
                        }
            })
            .done(data => {
            // do something with data
                let holder = JSON.parse(data);
                console.log(holder);
                let sent = $("input#sender").val();
                let reception = $("input#receiver").val();
                holder.forEach(ele=>
                {
                     if(ele.sender_id==sent)
                     {
                         
                    
                       //  let divs = ;

                        $('div.box#boxChat ul').append($('<li></li>').html('<div class="bubbleBox2"><p>'+ele.chat +'</p></div>'));
                     }
                     else
                     {
                        $('div.box#boxChat ul').append($('<li></li>').html('<div class="bubbleBox"><p>'+ele.chat +'</p></div>'));
                     }
                });
            })
            .fail(()=>
                {
                    console.log("ajax failed");
                });
        
    });
//alert("ready");
 /* let divs2 = $('<div class="row"></div>').html('<div class="col-4 col-md-4 col-sm-4 col-lg-4"></div>');
                        let divs3 = $('<div class="row"></div>').html('<div class="col-4 col-md-4 col-sm-4 col-lg-4"></div>');*/
});