<?php
require 'dbcon.php';
date_default_timezone_set('Asia/Singapore');

// Including the autoload file
require('vendor/autoload.php');

use Zxing\QrReader;

$msg = "";
if (isset($_POST['upload'])) {
  $filename = $_FILES["qrCode"]["name"];
  $filetype = $_FILES["qrCode"]["type"];
  $filetemp = $_FILES["qrCode"]["tmp_name"];
  $filesize = $_FILES["qrCode"]["size"];

  $filetype = explode("/", $filetype);
  if ($filetype[0] !== "image") {
    $msg = "File type is invalid: " . $filetype[1];
  } elseif ($filesize > 5242880) {
    $msg = "File size is too big. Maximum size is 5 MB.";
  } else {
    $newfilename = md5(rand() . time()) . $filename;
    move_uploaded_file($filetemp, "uploads/" . $newfilename);

    $qrScan = new QrReader("uploads/" . $newfilename);
    //$msg = "QR Code is scanned the result is: " . $qrScan->text();
    

    $name = $qrScan->text();
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
          $msg = "Thank you " . $qrScan->text() . $time . $date;

        } else {

          $msg = "Sorry " . $qrScan->text() . " you already have time IN and time OUT";

        }

      }

    } else {
      
      $query = "INSERT INTO attendance (name,time_in,time_out,date,date_created) VALUES ('$name','$time','','$date','$date_created')";
      $query_run = mysqli_query($con, $query) or die("problem on query 2");

      $time = " Your time IN is " . date("h:i:sa");
      $date = " on " . date('l, F j, Y'); 
      $msg = "Thank you " . $qrScan->text() . $time . $date;

    }  

  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

  <title>QR Code Scanner PHP</title>
</head>

<body class="bg-light">
  
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-5 mx-auto">
        <p><?= $msg; ?></p>
        <div id="displayDataTable"></div>
        <div class="card card-body p-5 rounded border bg-white">
          <h1 class="mb-4 text-center">QR Code Scanner</h1>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="qrCode" class="form-label">Upload your QR Code Image</label>
              <input class="form-control" type="file" accept="image/*" name="qrCode" id="qrCode">
            </div>
            <button type="submit" name="upload" class="btn btn-primary">
              Submit
            </button>
            <!-- <div id="view"></div> -->

            <video id="preview" width="350px" height="350px"></video>
          </form>
        </div>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
      var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        //alert(content);

        //var nameAdd = $('#view').html(content);
        //var nameAdd = $('#displayDataTable').attr(content);

        var nameAdd = (content);
        //var nameAdd = 'test';
        //$('#view').html(content);

        (function(nameAdd){
            $.ajax({
                url: 'json-receive.php',
                type: 'post',
                data: {nameSend: nameAdd},
                success: function(data){
                    //return the variable here
                    
                    $('#displayDataTable').html(data);
                    
                }
            });
        })(nameAdd);

        // $.ajax({
        //     url: 'json-receive.php',
        //     type: 'post',
        //     data: {nameSend: nameAdd},
        //     success: function(data){
        //         //do whatever.
        //         console.log('Done');
        //         $('#displayDataTable').html(data);
        //     }
        // });

      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

    // var user = {
    //     'name': 'Wayne',
    //     'country': 'Ireland',
    //     'selected': new Array(1, 5, 9)
    // };

    //var userStr = JSON.stringify(user);
    //var nameAdd=$('#view').html(content);

    // $(document).ready(function(){
    //     $.ajax({
    //         url: 'json-receive.php',
    //         type: 'post',
    //         data: {name: nameAdd},
    //         success: function(data){
    //             //do whatever.
    //             $('#displayDataTable').html(data);
    //         }
    //     });
    // });

        // $.ajax({
        //     url: 'json-receive.php',
        //     type: 'post',
        //     data: {nameSend: nameAdd},
        //     success: function(data){
        //         //do whatever.
        //         console.log('Done');
        //         $('#displayDataTable').html(data);
        //     }
        // });
    </script>

</body>
</html>