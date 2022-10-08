<?php
require 'dbcon.php';

// $date = date('l, F j, Y'); 
// $time_in = date("h:i:sa");
// $time_out = date("h:i:sa", strtotime('+8 hour'));
// $date_created = date("Y-m-d");

extract($_POST);

if(isset($_POST['nameSend'])){

$name = $_POST['nameSend'];
$date = date('l, F j, Y'); 
$time = date("h:i:sa");
$date_created = date("Y-m-d");

$query = "SELECT * FROM attendance WHERE date_created='$date_created' AND name='$name'";
$result = mysqli_query($con, $query) or die("problem on query 1");

if(mysqli_num_rows($result) > 0) {

  // $query2 = "SELECT * FROM attendance WHERE date_created='$date_created' AND name='$name'";
  // $result2 = mysqli_query($con, $query2) or die("problem on query 2");
  
  while($row = mysqli_fetch_array($result)) {

    $teacher_id = $row["id"];
    $time_out = $row["time_out"];

    if($time_out == ''){

      $query = "UPDATE attendance SET time_out='$time' WHERE id='$teacher_id'";
      $query_run = mysqli_query($con, $query) or die("problem on query 3");

      $time = " Your time OUT is " . date("h:i:sa");
      $date = " on " . date('l, F j, Y'); 
      $msg = "Thank you " . $name . $time . $date;

      echo $msg;

    } else {

      $msg = "Sorry " . $name . " you already have time IN and time OUT";

      echo $msg;

    }

  }

} else {
  
  $query = "INSERT INTO attendance (name,time_in,time_out,date,date_created) VALUES ('$name','$time','','$date','$date_created')";
  $query_run = mysqli_query($con, $query) or die("problem on query 2");

  $time = " Your time IN is " . date("h:i:sa");
  $date = " on " . date('l, F j, Y'); 
  $msg = "Thank you " . $name . $time . $date;

  echo $msg;

} 



    // $query = "INSERT INTO attendance (name,time_in,time_out,date,date_created) VALUES ('$nameSend','$time_in','','$date','$date_created')";
    // $query_run = mysqli_query($con, $query) or die("problem on query 2");

    // echo "success";

}



?>