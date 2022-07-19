<link rel="stylesheet" href="orderTable.css" />
<link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
<?php

$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
$qu="select * from order_table";
$result=mysqli_query($conn,$qu) or die ("Error in querry" . mysqli_error($conn));
$row=mysqli_affected_rows($conn);
$items1 = array();
$items2 = array();
$items3 = array();

  if($row==0){
    print "
    <div class='main'>
      <div class='navbar'>
        <h1>DCJ Canteen</h1>
        <div class='navIcons'>
          <a href='http://localhost/dcj%20canteen/Admin/adminMain.html'
            ><span class='material-icons'>home</span></a
          >
          <a href='http://localhost/dcj%20canteen/Admin/adminLogin.php'
            ><span id='logout' class='material-icons'>logout</span></a
          >
        </div>
      </div>
      <div class='content'>
        <div class='tabla'>
          <table class='table1'>
            <tr>
              <th>Order Id</th>
              <th>Delivered</th>
              <th>Time Left</th>
            </tr> 
          </table>
        </div>
        <div class='popup'>
          <table class='table2'>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </table>
        </div>
    </div>
    ";
  }
  else{
    while($x=mysqli_fetch_array($result)){
       array_push($items1,$x[0]);
       array_push($items2,$x[1]);
       array_push($items3,$x[2]);
     }

    $items1 = implode("!",$items1);
    $items2 = implode("!",$items2);
    $items3 = implode("!",$items3);

    print "
    <div class='main'>
      <div class='navbar'>
        <h1>DCJ Canteen</h1>
        <div class='navIcons'>
          <a href='http://localhost/dcj%20canteen/Admin/adminMain.html'
            ><span class='material-icons'>home</span></a
          >
          <a href='http://localhost/dcj%20canteen/Admin/adminLogin.php'
            ><span id='logout' class='material-icons'>logout</span></a
          >
        </div>
      </div>
      <div class='content'>
        <div class='tabla'>
          <table class='table1' data-item-id='$items1' name='$items2' id='$items3'>
            <tr>
              <th>Order Id</th>
              <th>Delivered</th>
              <th>Time Left</th>
            </tr> 
          </table>
        </div>
        <div class='popup'>
          <table class='table2'>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </table>
        </div>
    </div>
    ";

  }

?>

<script src="orderTable.js"></script>