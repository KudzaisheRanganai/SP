<?php  ini_set('post_max_size', '1000000000'); ini_set('upload_max_filesize', '100M'); ini_set('memory_limit', '1000M'); ini_set('max_execution_time', '1920'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> Order Invoice - Stock Path</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link href="../../../assets/img/brand/favicon.png" rel="icon" type="image/png">
    <script src="assets/jquery.min.js"></script>
    <script src="assets/dom-to-image.min.js"></script>
    <script src="assets/jspdf.min.js"></script>
    <script src="assets/html2canvas.min.js"></script>
    <script type="text/javascript">

      var ORDER_ID = eval('(<?php echo json_encode($_POST["ORDER_ID"]); ?>)');
      var SUPPLIER_NAME = eval('(<?php echo json_encode($_POST["SUPPLIER_NAME"]); ?>)');
      var SUPPLIER_EMAIL = eval('(<?php echo json_encode($_POST["EMAIL"]); ?>)');
      var ORDER_DATE = eval('(<?php echo json_encode(date("d/m/Y")); ?>)');
    </script>
  </head>
  <body id="content">
    <div id="sendHTML">
      <header class="clearfix" id="prod" style="margin-bottom: 10px;">
        <div id="logo">
          <img src="http://dithulaganyo.co.za/stockpath/assets/img/brand/blue.png">
        </div>
        <div id="company">

          <h2 class="name">Greens Supermarket</h2>
          <div>Plot 80 Poprtion 2,
                Bethanie Road,
                Brits, 0250</div>
          <div>+27 12 254 0224</div>
          <div><a class="link">info@greens.co.za</a></div>
        </div>
      </header>
      <main>
        <td>
        <div id="details" class="clearfix">
          <div id="client" align="left">
            <h2 class="name"><b>ORDER TO:</b></h2>
            <h2 class="name"><?php echo $_POST['SUPPLIER_NAME']; ?></h2>
            <div class="address"><?php echo $_POST['ADDRESS']; ?></div>
            <div class="email"><a class="link"><?php echo $_POST['EMAIL']; ?></a></div>
          </div>
          <div id="invoice">
            <h1>ORDER #<?php echo $_POST['ORDER_ID']; ?></h1>
            <div class="date"><b>Date of Invoice: &nbsp;</b><?php echo(date('d/m/Y')); ?></div>
            <div class="date"><b>Time of Invoice: &nbsp;</b><?php echo(date('g:ia')); ?></div>
            <div class="date"><b>Salesperson: &nbsp;</b> <?php echo $_POST['ORDERED_BY']; ?></div>
          </div>
        </div>
        </td>
        <table border="0" cellspacing="0" cellpadding="0" id="productsTable">
          <thead>
            <tr>
              <th class="">#</th>
              <th class="desc">ITEM NAME</th>
              <th class="">COST PRICE</th>
              <th class="qty">QUANTITY</th>
              <th class="">SUBTOTAL</th>
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
        <div id="thanks"></div>
        <div id="notices">
        </div>
         <input type="hidden" id="orderProductsArray" value='<?php echo( $_POST['ORDER_PRODUCTS']); ?>'>
      </main>
      <input type="hidden" id="ORDER_ID" value="<?php echo $_POST['ORDER_ID']; ?>">
      <footer id="prodFoot">
        Invoice was created on a computer and is valid without the signature and seal.
      </footer>
    </div>
      <style type="text/css" id="styleDiv">
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
          }

          .clearfix:after {
            content: "";
            display: table;
            clear: both;
          }

          a.link {
            color: #7cbf56;
            text-decoration: none;
          }

          body#sendHTML {
            color: #555555;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: SourceSansPro;
          }

          header#prod {
            padding: 10px 0;
            margin-bottom: 8px;
            border-bottom: 1px solid #AAAAAA;
          }

          #logo {
            float: left;
            margin-top: 15px;
          }

          #logo img {
            height: 70px;
          }

          #company {
            float: right;
            text-align: right;
          }


          #details {
            margin-bottom: 40px;
          }

          #client {
            margin-top: 16px;
            padding-left: 6px;
            border-left: 6px solid #7cbf56;
            float: left;
          }

          #client .to {
            color: #777777;
          }

          h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
          }

          #invoice {
            float: right;
            text-align: right;
          }

          #invoice h1 {
            color: #7cbf56;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
          }

          #invoice .date {
            font-size: 1.1em;
            color: #777777;
          }

          table#productsTable {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
          }

          table#productsTable th,
          table#productsTable td {
            padding: 20px;

          }

          table#productsTable th {
            white-space: nowrap;        
            font-weight: normal;
          }

          table#productsTable td {
            text-align: right;
          }

          table#productsTable td h3{
            
            font-size: 1rem;
            color: black;
            font-weight: normal;
            margin: 0 0 0.2em 0;
          }

          table#productsTable .no {
            color: #FFFFFF;
            font-size: 0.9em;
            background: #7cbf56;
          }

          table#productsTable .desc {
            text-align: left;
          }

          table#productsTable .unit {
            background: #DDDDDD;
          }

          table#productsTable .qty {
          }

          table#productsTable .total {
            background: #7cbf56;
            color: #FFFFFF;
          }

          table#productsTable td.unit,
          table#productsTable td.qty,
          table#productsTable td.total {
            font-size: 1.2em;
          }

          table#productsTable tbody tr:last-child td {
            border: none;
          }

          table#productsTable tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap; 
            border-top: 1px solid #AAAAAA; 
          }

          table#productsTable tfoot tr:first-child td {
            border-top: none; 
          }

          table#productsTable tfoot tr:last-child td {
            color: #7cbf56;
            font-size: 1.1em;
            border-top: 1px solid #7cbf56; 

          }

          table#productsTable tfoot tr td:first-child {
            border: none;
          }

          #thanks{
            font-size: 2em;
            margin-bottom: 50px;
          }

          #notices{
            padding-left: 6px;
            border-left: 6px solid #7cbf56;  
          }

          #notices .notice {
            font-size: 1.2em;
          }

          footer#prodFoot {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
          }


      </style>
  </body>
  <!-- Core -->
  <script src="../../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Make Sale JS -->
  <script src="invoice.js"></script>
</html>

