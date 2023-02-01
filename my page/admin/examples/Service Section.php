<?php 
include("db_config.php");
session_start();

include('header.php');
?>
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary" style="background:#6610f2;">
              <h4 class="card-title">Service Section</h4>
            </div>
            <div class="card-body">
              <div id="typography">
                <div class="table-responsive">
                <a href="add_service.php" class="btn btn-primary" style="background:#6610f2;">Add</a>
                <?php
                     $result = $conn->query("SELECT * FROM service") or die($conn->error);
                   ?>
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                        Title 
                        </th>
                        <th>
                       Description
                        </th>
                        <th>
                        Icon
                        </th>
                        <th>

                        </th>
                      </thead>
                      <tbody>

                        <?php $i = 1; ?>
                      <?php while ($row = $result->fetch_assoc()):?> 
                          <tr>
                            <td>
                            <?php echo $i; ?>
                            </td>
                            <td>
                            <?php echo $row['title']; ?>
                            </td>
                            <td>
                            <?php echo $row['description']; ?>
                            </td>
                            <td>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['icon']); ?>" width="100px" height="100px"  alt="">
                            </td>
                            <td>
                              <form action="edit_service.php" method="post" style="display: inline">
                                <button type="submit" class="btn btn-primary">Edit</button>
                                <input  type="hidden" name="id" value="<?php echo $row['id'];?>">
                              </form>
                              <form action="" method="post" style="display: inline">
                              <input  type="hidden" name="del_image" value="<?php echo $row['id'];?>">
                                <button onclick="javascript: return confirm('Are you sure?');" type="submit" name="del_about_image" value="" class="btn btn-danger">Delete</button>
                              </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                      </tbody>
                      <?php endwhile; ?>
                    </table>
                  </div>
              </div>
            </div>
          </div>           
        </div>
      </div>

<?php

if (isset($_POST['del_about_image'])){
  $id = $_POST['del_image'];
  $result = $conn->query("SELECT * FROM service WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
      $id = $row['id'];
    $sql = "DELETE FROM service WHERE id='$id' ";
            mysqli_query($conn, $sql); 
            echo "<script> alert('service Deleted.') </script>";
}

}
?>
 
<?php include "footer.php" ?>
      