<?php
require 'dbcon.php';
error_reporting (E_ALL ^ E_NOTICE);

if(isset($_POST['displaySend'])){
    
    $table.='<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">SL No.</th>
        <th scope="col">Name</th>
        <th scope="col">Time IN</th>
        <th scope="col">Time OUT</th>
        <th scope="col">Date</th>
        <th scope="col">Manage</th>
      </tr>
    </thead>';

    $query = "SELECT * FROM attendance";
    $query_run = mysqli_query($con, $query);
    $number=1;
    while($row = mysqli_fetch_assoc($query_run)){
        $id = $row['id'];
        $name = $row['name'];
        $time_in = $row['time_in'];
        $time_out = $row['time_out'];
        $date = $row['date'];
        //$date_created = $row['date_created'];
        $table.='<tr>
        <td scope="row">'.$number.'</td>
        <td>'.$name.'</td>
        <td>'.$time_in.'</td>
        <td>'.$time_out.'</td>
        <td>'.$date.'</td>
        <td>
            <button class="btn btn-dark" onclick="editUser('.$id.')">Update</button>
            <button class="btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
        </td>
      </tr>';
      $number++;
    }

    $table.='</table>';

    echo $table;


}