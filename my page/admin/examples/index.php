<?php 
 include("db_config.php");
 session_start();
  include('header.php');
?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card"> 
                <div class="card-header card-header-primary" style="background:#6610f2;">
                  <h4 class="card-title">Home section</h4>
                </div>
                <div class="card-body">
                  <?php
                     $result = $conn->query("SELECT * FROM home") or die($conn->error);
                   ?>
                  <table class="table table-hover">
                    <thead>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Jop</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Picture</th>
                      <th></th>
                    </thead>
                    <tbody>
                    <?php $i =1; ?>
                    <?php while ($row = $result->fetch_assoc()):?> 
                      <?php
                         $_SESSION['id'] = $row['id'];
                         $_SESSION['title'] = $row['name'];
                         $_SESSION['image'] = $row['image'];
                        ?>
                        <tr>
                          <td>  <?php echo $i; ?>   </td>
                          <td>  <?php echo $row['name']; ?>   </td>
                          <td>  <?php echo $row['jop']; ?>   </td>
                          <td>  <?php echo $row['email']; ?>   </td>
                          <td>  <?php echo $row['phone']; ?>   </td>
                          <td>    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width="100px" height="100px" alt="#"/> </td>
                          <td>
                            <form action="edit_home _section.php" method="post" style="display: inline">
                              <button type="submit" class="btn btn-primary">Edit</button>
                              <input  type="hidden" name="id" value="<?php echo $row['id'];?>">
                            </form>
                            <form action="" method="POST" style="display: inline">
                              <input  type="hidden" name="del" value="<?php echo $row['id'];?>">
                              <button onclick="javascript: return confirm('Are you sure?');"  type="submit" name="del_slide" class="btn btn-danger">Delete</button>
                            </form>
                          </td>
                        </tr>
              <?php $i++ ?>
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
      
        include('footer.php');
        
      ?>

      <?php

if (isset($_POST['del_slide'])){
  $id = $_POST['del'];
  $result = $conn->query("SELECT * FROM home WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
      $id = $row['id'];
    $sql = "DELETE FROM home WHERE id='$id' ";
            mysqli_query($conn, $sql); 
            echo "<script> alert('Homer Deleted.') </script>";
}

}
?>


     

