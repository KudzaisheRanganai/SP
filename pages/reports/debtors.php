<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Debtors Report - Stock Path</title>
    <link rel="stylesheet" href="debtors_CSS/style.css" media="all" />
    <link href="debtors_CSS/favicon.png" rel="icon" type="image/png">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="debtors_CSS/logo.png">
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
          <div class="name"><b>Date Generated :</b><?=date("d/m/y")?></div>
          <div class="address"><b>Time Generated :</b> <?=date("h:i:sa")?></div>
        </div>
        <div id="invoice">
          <h1>Debtors Report</h1>
          <div class="date"></div>
          <div class="date"></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="desc-center" >CUSTOMER ID</th>
            <th class="desc">ACCOUNT NUMBER</th>
            <th class="desc">CUSTOMER NAME</th>
            <th class="desc" style="text-align: right;">BALANCE</th>
          </tr>
        </thead>
        <tbody>
  
          
        </tbody>
      </table>
      <table id="tbody">
        <tfoot>   
          <tr id="total">
            <td colspan="2"></td>
            <td colspan="2"><b>TOTAL AMOUNT OUTSTANDING</b></td>
            
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
  <script type="text/javascript" src="JS/debtorsCode.js"></script>
</html>