
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Employee Attendance Roll - Stock Path</title>
    <link rel="stylesheet" href="attendance_CSS/style.css" media="all" />
    <link href="attendance_CSS/favicon.png" rel="icon" type="image/png">
  </head>

  <body>
   
    <header class="clearfix">
      <div id="logo">
        <img src="attendance_CSS/logo.png">
      </div>
      <div id="company">

        <h2 class="name">Greens Supermarket</h2>
        <div>Plot 80 Poprtion 2,
              Bethanie Road,
              Brits, 0250</div>
        <div>+27 12 254 0224</div>
        <div><a>info@greens.co.za</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="name"><b>Date Generated for:</b> <p id="DATE" ><?php echo $_POST["DATE"]?></p></div>
          <div class="address"><b>Time Generated :</b> <?php echo date("H:i")?></div>
        </div>
        <div id="invoice">
          <h1>Employee Attendance Roll</h1>
          <div class="date"></div>
          <div class="date"></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="desc-center">EMPLOYEE ID</th>
            <th class="desc">NAME & SURNAME</th>
            <th class="desc">TIME IN</th>
            <th class="desc">TIME OUT</th>
            <!-- <th class="desc">HOURS</th> -->
            <th class="desc-center">PRESENT</th>
          </tr>
        </thead>
        <tbody id="tBody">


        </tbody>
      </table>

      <table>
        <tfoot>
          
          <tr id="totalPresent">
            <td colspan="2"></td>
            <td colspan="2">NUMBER OF EMPLOYEES PRESENT</td>
           
          </tr>
          <tr id="totalAbsent">
            <td colspan="2"></td>
            <td colspan="2">NUMBER OF EMPLOYEES ABSENT</td>
        
          </tr>
        </tfoot>
      </table>
      <div id="notices">
        
      </div>
    </main>
    <footer>
      © 2019 Stock Path
    </footer>
  </body>
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="JS/employeeAttendanceCode.js"></script>
</html>

