<?php

$data = $_GET['order'];

$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
$qu="DELETE FROM `order_table` WHERE order_id = '$data';";
$result=mysqli_query($conn,$qu) or die ("Error in querry" . mysqli_error($conn));

?>