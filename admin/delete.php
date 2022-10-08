<?php
require 'dbcon.php';

if(isset($_POST['deleteSend'])){
    $unique=$_POST['deleteSend'];

    $query = "DELETE FROM attendance WHERE id='$unique'";
    $query_run = mysqli_query($con, $query);    

}

?>