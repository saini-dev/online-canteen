<?php
header('Access-Control-Allow-Origin: *');
$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
$orderId =$_GET['orderid'];
$qu="select time from order_table where order_id='$orderId'";
$result=mysqli_query($conn,$qu) or die ("Error in querry" . mysqli_error($conn));
$row=mysqli_affected_rows($conn);


if($row==0){
  print "none";
}
else{
  while($x=mysqli_fetch_array($result)){
    echo $x[0];
}
}

?>