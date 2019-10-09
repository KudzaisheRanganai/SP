<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Sale Invoice - Stock Path</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link href="../../../assets/img/brand/favicon.png" rel="icon" type="image/png">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">

        <h2 class="name">Greens Supermarket</h2>
        <div>Plot 80 Poprtion 2,
              Bethanie Road,
              Brits, 0250</div>
        <div>+27 12 254 0224</div>
        <div><a href="mailto:company@example.com">info@greens.co.za</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <h2 class="name"><b>INVOICE TO:</b></h2>
          <h2 class="name"><?php echo $_POST['CUSTOMER_NAME']; ?></h2>
          <div class="address"><?php echo $_POST['ADDRESS']; ?></div>
          <div class="email"><a><?php echo $_POST['EMAIL']; ?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #<?php echo $_POST['SALE_ID']; ?></h1>
          <div class="date"><b>Date of Invoice: &nbsp;</b><?php echo(date('d/m/Y')); ?></div>
          <div class="date"><b>Time of Invoice: &nbsp;</b><?php echo(date('g:ia')); ?></div>
          <div class="date"><b>Salesperson: &nbsp;</b> <?php echo $_POST['SALESPERSON']; ?></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="">#</th>
            <th class="desc">ITEM NAME</th>
            <th class="">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="">TOTAL</th>
            

          </tr>
        </thead>
        <tbody id="tBody">
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td id="saleTotal"></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 15%</td>
            <td id="saleVAT"></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
      </div>
       <input type="hidden" id="saleProductsArray" value='<?php echo( $_POST['SALE_PRODUCTS']); ?>'>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>

    <!-- Core -->
  <script src="../../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Make Sale JS -->
  <script src="invoice.js"></script>
  </body>
</html>