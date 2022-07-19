
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="home.css" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald&display=swap"
      rel="stylesheet"
    />
    <title>Document</title>
  </head>
  <body>
    <div id="cart">
      <h2>Your Cart</h2>
      <table>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Remove</th>
        </tr>
      </table>
      <h3 style="text-align:right; margin-bottom:10px; margin-right:24px; font-size: 18px; font-weight:500" id="subTotal"></h3>
      <div style="text-align: center;">
      <button id="buy">Proceed To Buy</button>
      </div>
    </div>
    <div id="main">
      <div class="navbar">
        <h2>DCJ Canteen</h2>
        <div class="navIcons">
          <a href="searchOrder.html"><span class="material-icons">manage_search </span></a>
          <span id="navCart" class="material-icons">shopping_cart</span>
        </div>
      </div>
      <div class="content">
        <div id="sidebar"></div>
        <div id="menu">
          <h1>Menu</h1>
          <div id="products">
            <?php
$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());

  $qu="select * from inventory_table";
  $result=mysqli_query($conn,$qu) or die ("Error in querry" . mysqli_error($conn));
	$row=mysqli_affected_rows($conn);
  if($row==0){
    print "No Result Found";
  }
  else{
    while($x=mysqli_fetch_array($result)){
              if($x[5]==0){
              //   print "<div class='productCard' id='tooltip' data-item-id='$x[0]'>
              //   <span class='tooltiptext'>Currently Unavailable</span>  
              //   <img
              //        class='img'
              //        src='$x[3]'
              //        alt='item_pic'/>
              //    <div class='productSubtext'>
              //        <h3>$x[1]</h3>
              //        <div>
              //        <span class='material-icons addToCartBtn' name='atc'></span>
              //      </div>
              //    </div>
              //  </div>";
              }
              else{
                if ($x[4]=='EATABLES') {
                  print "<div id='snacks' class='productCard' data-item-id='$x[0]'>
                    <img
                       class='img'
                       src='$x[3]'
                       alt='item_pic'/>
                   <div class='productSubtext'>
                       <h3>$x[1]</h3>
                       <div>
                       <span>₹$x[2]</span>
                       <span class='material-icons addToCartBtn' name='atc'>add_shopping_cart</span>
                     </div>
                   </div>
                 </div>";
                }
                elseif ($x[4]=='SHAKES') {
                  print "<div id='shakes' class='productCard' data-item-id='$x[0]'>
                    <img
                       class='img'
                       src='$x[3]'
                       alt='item_pic'/>
                   <div class='productSubtext'>
                       <h3>$x[1]</h3>
                       <div>
                       <span>₹$x[2]</span>
                       <span class='material-icons addToCartBtn' name='atc'>add_shopping_cart</span>
                     </div>
                   </div>
                 </div>";
                }
                else{
                  print "<div id='drinks' class='productCard' data-item-id='$x[0]'>
                    <img
                       class='img'
                       src='$x[3]'
                       alt='item_pic'/>
                   <div class='productSubtext'>
                       <h3>$x[1]</h3>
                       <div>
                       <span>₹$x[2]</span>
                       <span class='material-icons addToCartBtn' name='atc'>add_shopping_cart</span>
                     </div>
                   </div>
                 </div>";
                }
              }
            }
           
    }   

            ?>
          </div>
        </div>
      </div>
    </div>
    <div id="snackbar">Added to cart</div>
    <script src="home.js"></script>
  </body>
</html>
