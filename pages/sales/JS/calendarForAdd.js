$(()=>{
  $.ajax({
    url:'PHPcode/calendar.php',
    type:'POST',
    data:{}
  })
  .done(data=>{
      if(data!="False")
      {
        let arr=JSON.parse(data);
        console.log(arr);
        let calArr=[];
        for(let k=0;k<arr.length;k++)
        {
          calArr[k]={id:arr[k]["SALE_ID"],title:'Delivery: '+arr[k]["SALE_ID"],start:arr[k]["EXPECTED_DATE"]};
        }
        console.log(calArr);
        var calendarEl = document.getElementById('calender');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid','timeGrid','list','bootstrap' ],
          themeSystem:'bootstrap',
          defaultView: 'dayGridMonth',
          header: {
              left: 'prev,next',
              center: 'title',
              right: 'dayGridMonth,dayGridWeek,dayGridDay,listMonth'
          },
          events:calArr,
          eventClick: function(info) {
            info.jsEvent.preventDefault();
            let saleid=parseInt(info.event.id);
            $.ajax({
              url:'PHPcode/calendardelivery.php',
              type:'POST',
              data:{SALE_ID:saleid}
            })
            .done(data=>{
              $("#delID").val(saleid);
              $("#delInfo").val(data);
              $("#delView").submit();
            });
            
            //window.open("assign-truck-view-delivery.php");
            // alert('Event: ' + info.event.title);
            // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            // alert('View: ' + info.view.type);

            // change the border color just for fun
            // info.el.style.borderColor = 'red';
          }
        });
        calendar.render();
      }
      else
      {
        alert("Error");
      }
  });
  
 });