<?php
  include_once("connection.php");
  mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Sales Report - Stock Path</title>
    <link rel="stylesheet" href="sale_CSS/style.css" media="all" />
    <link href="sale_CSS/favicon.png" rel="icon" type="image/png">
    <!--script type="text/javascript" src="sale_CSS/Chart.bundle.js"></script>
     <script type="text/javascript" src="sale_CSS/Chart.min.js"></script-->
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="sale_CSS/logo.png">
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
          <div class="name"><b>Date Generated :</b> <?php echo date("Y/m/d")?></div>
          <div class="address"><b>Time Generated :</b> <?php echo date("H:i")?></div>
        </div>
        <div id="invoice">
          <h1>Sales Report</h1>
          <div class="date"><b>Sale Report Period:</b><span id="salePeriod"><?php echo $_POST["salePeriod"]?> </span></div>
        </div>
      </div>
      <div style="margin-bottom: 1rem;">
        <canvas id="line-chart" width="800" height="400"></canvas>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="desc-center" id="PeriodAttr"></th>
            <th class="desc">TOTAL SALES</th>
            <th class="desc" style="text-align: right;">TOTAL REVENUE</th>
          </tr>
        </thead>
        <tbody id="tBody">
        
        </tbody>
      </table>
      <table>
        <tfoot>   
          <tr id="total">
            <td colspan="2"></td>
            <td colspan="2"><b>TOTAL SALES AMOUNT</b></td>
            
          </tr>
        </tfoot>
      </table>
      <div id="notices">
        
      </div>
    </main>
    <footer>
      © 2019 Stock Path
    </footer>
    <script type="text/javascript">
     
    </script>
    <!-- Argon Scripts -->
  <!-- Core -->
  
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="../../assets/jqueryui/jquery-ui.js"></script>
  <!-- Moment JS -->
  <script src="../../assets/js/moment.js"></script>
  <script src="JS/saleReport.js"></script>
  </body>
  
</html>