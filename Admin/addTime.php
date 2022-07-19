<?php

$id = $_GET['id'];
$time = $_GET['time'];

$conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
$qu= "UPDATE `order_table` SET `time`='$time' WHERE order_id='$id';";
$result=mysqli_query($conn,$qu) or die ("Error in querry" . mysqli_error($conn));

echo $time;
?>