<?php

    $data = $_GET['p'];
    $id = $_GET['id'];
    $time = $_GET['time'];
    
        $conn = mysqli_connect("localhost","root","","dcj_canteen") or die ("error in connection". mysqli_connect_error());
        $sql = "INSERT INTO `order_table`(`order_id`, `product`, `time`) VALUES ('$id','$data','$time')";
        mysqli_query($conn,$sql);
        array_push($oid,$id);
?>
