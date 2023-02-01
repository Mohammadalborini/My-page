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
            <h4 class="card-title">Business summary</h4>
          </div>
          <div class="card-body">
            <a href="add_portfolio.php" class="btn btn-primary" style="background:#6610f2;">Add</a>
            <?php
            $result = $conn->query("SELECT * FROM portfolio") or die($conn->error);
            ?>
            <table class="table table-hover">
              <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Sub Title</th>
                <th>Image</th>
                <th></th>
              </thead>
              <tbody>
                <?php
                $i = 1;
                ?>
                <?php while ($row = $result->fetch_assoc()) : ?>

                  <tr>
                    <td> <?php echo $i; ?></td>
                    <td> <?php echo $row['title']; ?></td>
                    <td> <?php echo $row['sub_title']; ?></td>
                    <td> <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width="100px" height="100px" alt=""></td>
                    <td>
                      <form action="edit_portfolio.php" method="post" style="display:inline">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      </form>
                      <form action="" method="post" style="display:inline">
                        <input type="hidden" name="del" value="<?php echo $row['id']; ?>">
                        <button type="submit" onclick="javascript: return confirm('Are you sure?');" name="del_contact" value="" class="btn btn-danger">Delete</button>
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
<?php include('footer.php') ?>



<?php

if (isset($_POST['del_contact'])) {
  $id = $_POST['del'];
  $result = $conn->query("SELECT * FROM portfolio WHERE id='$id' ") or die($conn->error);
  while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $sql = "DELETE FROM portfolio WHERE id='$id' ";
    mysqli_query($conn, $sql);
    echo "<script> alert('portfolio Deleted.') </script>";
  }
}
?>