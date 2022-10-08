  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  <script>
        // display function
        $(document).ready(function(){
            displayData();
        });

        function displayData(){
            var displayData="true";
            $.ajax({
                url:"display.php",
                type:'post',
                data:{
                    displaySend:displayData
                },
                success:function(data,status){
                    $('#displayDataTable').html(data);
                }
            })
            
        }

        // add function

        function addUser(){
            var nameAdd=$('#completename').val();
            var time_inAdd=$('#completetime_in').val();
            var time_outAdd=$('#completetime_out').val();
            var dateAdd=$('#completedate').val();
            var date_createdAdd=$('#completedate_created').val();

            $.ajax({
                url:"insert.php",
                type:"post",
                data:{
                    nameSend:nameAdd,
                    time_inSend:time_inAdd,
                    time_outSend:time_outAdd,
                    dateSend:dateAdd,
                    date_createdSend:date_createdAdd,
                },
                success:function(data,status){
                    // function to display data
                    //console.log(status);
                    $('#addModal').modal("hide");
                    displayData();
                }

            })
            
        }

        // delete function
        function deleteUser(deleteid){
            $.ajax({
                url:"delete.php",
                type:"post",
                data:{
                    deleteSend:deleteid,
                },
                success:function(data,status){
                    // function to display data
                    displayData();
                }
            });
        }

        // update function

        function editUser(updateid){
            $('#hiddendata').val(updateid);

            $.post("update.php",{updateid:updateid}, function(data, status){
                 var userid=JSON.parse(data);
                 $('#updatename').val(userid.name);
                 $('#updatetime_in').val(userid.time_in);
                 $('#updatetime_out').val(userid.time_out);
                 $('#updatedate').val(userid.date);
                 $('#updatedate_created').val(userid.date_created);
            });

            $('#updateModal').modal("show");
        }

        // onclick update event function

        function updateUser(){
            var updatename=$('#updatename').val();
            var updatetime_in=$('#updatetime_in').val();
            var updatetime_out=$('#updatetime_out').val();
            var updatedate=$('#updatedate').val();
            var updatedate_created=$('#updatedate_created').val();
            var hiddendata=$('#hiddendata').val();

            $.post("update.php",{
                updatename:updatename,
                updatetime_in:updatetime_in,
                updatetime_out:updatetime_out,
                updatedate:updatedate,
                updatedate_created:updatedate_created,
                hiddendata:hiddendata
            }, function(data, status){
                $('#updateModal').modal("hide");
                displayData();
            });
        }
        
    </script>
</body>
</html>