<?php
$limit = 2;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM attendance ORDER BY name ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($con, $sql);  
?>
<table class="table table-bordered table-striped">  
<thead>  
<tr>  
<th>Name</th>  
<th>Email</th>  
</tr>  
</thead>  
  <tbody>  
  <?php  
  while ($row = mysqli_fetch_array($rs_result)) {  
  ?>  
              <tr>  
                <td><?php echo $row["name"]; ?></td>  
                <td><?php echo $row["time_in"]; ?></td>  
                <td><?php echo $row["time_out"]; ?></td>  
                <td><?php echo $row["date"]; ?></td>  
                <td>
                    <button class="btn btn-dark" onclick="editUser('.$id.')">Update</button>
                    <button class="btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
                </td>
              </tr>  
  <?php  
  };  
  ?>  
  </tbody>  
</table>   