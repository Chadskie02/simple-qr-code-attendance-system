<?php
require 'dbcon.php';

if(isset($_POST['updateid']))
{
    $user_id=$_POST['updateid'];

    $query = "SELECT * FROM attendance WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);   
    $response = array();
    while($row = mysqli_fetch_assoc($query_run)){
        $response = $row;
    } 
    echo json_encode($response);

}else{
    $response['status']=200;
    $response['message']="Invalid or data not found";
}


// update query
if(isset($_POST['hiddendata']))
{
    $user_id=$_POST['hiddendata'];
    $name=$_POST['updatename'];
    $time_in=$_POST['updatetime_in'];
    $time_out=$_POST['updatetime_out'];
    $date=$_POST['updatedate'];
    $date_created=$_POST['updatedate_created'];

    $query = "UPDATE attendance SET name='$name', time_in='$time_in', time_out='$time_out', date='$date', date_created='$date_created' WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query) or die("problem on query 2");

}
?>