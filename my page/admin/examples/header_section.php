<?php 
   include("db_config.php");
   session_start();

  include "header.php";
?>
<style>
  .table .text-primary th{
    color:#6610f2;
  }
  </style>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary" style="background:#6610f2;">
                  <h4 class="card-title">Header Section</h4>
                </div>
                <div class="card-body">
                <?php
                     $result = $conn->query("SELECT * FROM header") or die($conn->error);
                   ?>
                <table class="table">
                      <thead class=" text-primary" >
                        <th>
                          ID
                        </th>
                        <th>
                        Icon
                        </th>
                        <th>
                        </th>
                      </thead>
                      <tbody>
                      <?php $i =1; ?>
                      <?php while ($row = $result->fetch_assoc()):?> 
                        <tr>
                          <td>
                          <?php echo $row['id']; ?>
                          </td>
                          <td>
                          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['icon']); ?>" width="100px" height="100px" alt="#"/>
                          </td>
                          <td>
                            <form action="edit_header_section.php" method="post" style="display: inline">
                              <button type="sumbit" name="edit_btn" value="edit_btn" class="btn btn-primary">Edit</button>
                              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            </form>
                            <form action="" method="post" style="display: inline">
                               <input type="hidden" name="del" value="<?php echo $row['id']; ?>">
                              <button type="submit" class="btn btn-danger" name="del_footer" value="">Delete</button>
                            </form>
                          </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endwhile;?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
       
          </div>
        </div>
      </div>

      <?php

if (isset($_POST['del_footer'])){
  $id = $_POST['del'];
  $result = $conn->query("SELECT * FROM header WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
      $id = $row['id'];
    $sql = "DELETE FROM header WHERE id='$id' ";
            mysqli_query($conn, $sql); 
            echo "<script> alert('Icon Deleted.') </script>";
}

}
?>
      <?php include('footer.php') ?>
