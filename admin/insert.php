<?php
require 'dbcon.php';

extract($_POST);

if(isset($_POST['nameSend']) && isset($_POST['time_inSend']) && isset($_POST['time_outSend']) && isset($_POST['dateSend']) && isset($_POST['date_createdSend'])){

    $query = "INSERT INTO attendance (name,time_in,time_out,date,date_created) VALUES ('$nameSend','$time_inSend','$time_outSend','$dateSend','$date_createdSend')";
    $query_run = mysqli_query($con, $query) or die("problem on query 2");

}
?>