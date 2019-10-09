<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Stock Take Report - Stock Path</title>
    <link rel="stylesheet" href="stock_CSS/style.css" media="all" />
    <link href="stock_CSS/favicon.png" rel="icon" type="image/png">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="stock_CSS/logo.png">
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
          <h1>Stock Take Report</h1>
          <div class="date"></div>
          <div class="date"></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th colspan="5" id="warehouse"></th>
          </tr>
          <tr>
          <label hidden="true" id="WareHouseName"><?php echo $_POST["WAREHOUSE_NAME"]?></label>
            <label hidden="true" id="prodName"><?php echo $_POST["PRODUCT_NAMES"];?></label>
            <label hidden="true" id="qty"><?php echo $_POST["QTY"];?></label>
            <label hidden="true" id="qtyCounted"><?php echo $_POST["QTY_COUNTED"];?></label>
            <label hidden="true" id="diffQty"><?php echo $_POST["QTY_DIFF"];?></label>

            <th class="desc-center">PRODUCT NAME</th>
            <th class="desc">QTY</th>
            <th class="desc">QTY COUNTED</th>
            <th class="desc">SURPLUS/DEFICIT</th>
          </tr>
        </thead>
        <tbody id="tBody">
         
        </tbody>
      </table>

      <table>
        <tfoot>
          
        </tfoot>
      </table>
      <div id="notices">
        <div><b>NOTICE:</b></div>
        <div class="notice">Products that are in <span style="color: red">DEFICT</span> are highlighted in red.</div>
        <div class="notice">Products that are in <span style="color: green">SURPLUS</span> are highlighted in green.</div>
      </div>
    </main>
    <footer>
      © 2019 Stock Path
    </footer>

     <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
  <!-- Search Product JS -->
  <script src="JS/stockTakeReport.js" type="text/javascript"></script>
  <script src="../InactivityLogoutPages/autologout.js"></script>
  </body>
</html>