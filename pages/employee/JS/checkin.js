let scanSound = new Audio('../../assets/sounds/qr_scan-sound.mp3');
let checkinSuccessfulSound = new Audio('../../assets/sounds/checkin-sound.mp3');
let checkinErrorSound = new Audio('../../assets/sounds/error.mp3');

$(document).ready(function(){

  let scanner = new Instascan.Scanner({
      video: document.getElementById('videoElement')
    });

  Instascan.Camera.getCameras().then(cameras => 
  {
      if(cameras.length > 0){
          scanner.start(cameras[0]);
      } else {
          console.error("No Camera Device");
      }
  });

  scanner.addListener('scan', function(content) {
    console.log(content);
    scanSound.play();
    

      $.ajax({
        type: 'POST',
        url: 'PHPcode/verifyQRcode.php',
        data: {qrCode : content}
      })
      .done(response => {
      // do something with data
        console.log(response);
        var reponseArray = response.split(',');
        var responseText = reponseArray[0];

        if(responseText.includes("success"))
        {
          checkinSuccessfulSound.play();
          var employeeID = reponseArray[1];
          var nameSurname = reponseArray[2];
          var timeCheckedIn = reponseArray[3];
          var formattedTime = moment(timeCheckedIn).format('h:mm a');
            //Add this when fully done.
            
          $.notify({
            icon: '../employee/images/ProfilePic/'+ employeeID +'.jpg',
            title: nameSurname,
            message: ' checked-in successfully',
            
          },{
            //settings
            placement: {
              from: "bottom",
              align: "right"
            },
            animate: {
              enter: 'animated fadeInUp',
              exit: 'animated fadeOutDown'
            },
            type: 'minimalist',
            delay: 20000,
            icon_type: 'image',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<img data-notify="icon" class="rounded-circle pull-left d-inline" onerror="imgError(this)">'+
              '<span data-notify="title" class="d-inline">{1}</span>' +
              '<span data-notify="message" class="d-inline">{2}</span>' +
              '<span data-notify="footer">'+formattedTime+'</span>'+
            '</div>'
          });
        }
        else if(responseText.includes("not wage earning"))
        {
          checkinErrorSound.play();

          var nameSurname = reponseArray[2];
          var employeeID = reponseArray[1];

          $.notify({
            icon: '../employee/images/ProfilePic/'+ employeeID +'.jpg',
            title: nameSurname,
            message: ' you are not wage earning!',
            
          },{
            //settings
            placement: {
              from: "bottom",
              align: "right"
            },
            animate: {
              enter: 'animated fadeInUp',
              exit: 'animated fadeOutDown'
            },
            type: 'minimalist2',
            delay: 20000,
            icon_type: 'image',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<img data-notify="icon" class="rounded-circle pull-left d-inline" onerror="imgError(this)">'+
              '<span data-notify="title" class="d-inline">{1}</span>' +
              '<span data-notify="message" class="d-inline">{2}</span>' +
            '</div>'
          });
        }
        else if(responseText.includes("Over checkin time"))
        {
          checkinErrorSound.play();

          var nameSurname = reponseArray[2];
          var employeeID = reponseArray[1];

          $.notify({
            icon: '../employee/images/ProfilePic/'+ employeeID +'.jpg',
            title: nameSurname,
            message: ' you cannot check-in at this time!',
            
          },{
            //settings
            placement: {
              from: "bottom",
              align: "right"
            },
            animate: {
              enter: 'animated fadeInUp',
              exit: 'animated fadeOutDown'
            },
            type: 'minimalist2',
            delay: 20000,
            icon_type: 'image',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<img data-notify="icon" class="rounded-circle pull-left d-inline" onerror="imgError(this)">'+
              '<span data-notify="title" class="d-inline">{1}</span>' +
              '<span data-notify="message" class="d-inline">{2}</span>' +
            '</div>'
          });
        }
        else if(responseText.includes("Already Checked-in!"))
        {
          checkinErrorSound.play();

          var nameSurname = reponseArray[2];
          var employeeID = reponseArray[1];

          $.notify({
            icon: '../employee/images/ProfilePic/'+ employeeID +'.jpg',
            title: nameSurname,
            message: ' already checked-in !',
            
          },{
            //settings
            placement: {
              from: "bottom",
              align: "right"
            },
            animate: {
              enter: 'animated fadeInUp',
              exit: 'animated fadeOutDown'
            },
            type: 'minimalist2',
            delay: 20000,
            icon_type: 'image',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
              '<img data-notify="icon" class="rounded-circle pull-left d-inline" onerror="imgError(this)">'+
              '<span data-notify="title" class="d-inline">{1}</span>' +
              '<span data-notify="message" class="d-inline">{2}</span>' +
            '</div>'
          });

        }
        else if(responseText.includes("DATABASE ERROR"))
        {
          $('#modal-title-default').text("Error!");
          $('#modalText').text("Database Error!");
          $('#animation').html('<div class="crossx-circle"><div class="background"></div><div style="position: relative;"><div class="crossx draw" style="text-align:center; position: absolute !important;"></div><div class="crossx2 draw2" style="text-align:center; position: absolute !important;"></div></div></div>');
          $("#modalHeader").css("background-color", "red");
          $('#checkedIn').modal("show");
        }
        
    })
    .fail(()=>
    {
        console.log("ajax failed");
    });       
  });

});

function imgError(element)
{
  element.src="../../assets/img/theme/admin.jpg"; 
  element.style.width = "50px"; 
  element.style.height = "50px";
}

function formatDate(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

var d = new Date();
var e = formatDate(d);

