<?php
$m = $_GET['m'];

$conn =
 $conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());

$sql = "SELECT `avail` FROM `inventory_table` WHERE `item_id` = $m";
$result=mysqli_query($conn,$sql);
$row=mysqli_affected_rows($conn);
$x=(int)mysqli_fetch_array($result)[0];
$toChangeTo = $x==1?0:1;
$q2 = "UPDATE `inventory_table` SET `avail`= '$toChangeTo' WHERE `item_id` = $m";
$res2 = mysqli_query($conn,$q2);
if (mysqli_query($conn,$q2)==0) {
    echo 0;
} else {
    echo 1;
}
?>