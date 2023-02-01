<?php 
include("db_config.php");
session_start();

include "header.php";
?>
<?php 
if (isset($_POST['id'])){
  $id = $_POST['id'];
  $_SESSION['id'] = $id;
  $result = $conn->query("SELECT * FROM about_us WHERE id='$id' ") or die($conn->error);
    while ($row = $result->fetch_assoc()){
    $_SESSION['description'] =  $row['description'];
    $_SESSION['experience'] = $row['experience'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['cv'] = $row['cv'];

     
  }}?>

 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                
                  <div class="card">
                <div class="card-header card-header-primary"  style="background:#6610f2;">
                  <h4 class="card-title">Edit About us</h4>
                </div>
                <div class="card-body">

<form action="" method="post" enctype="multipart/form-data">
    <label>Description</label>
    <input autocomplete="off" type="text" class="form-control" name="description" value="<?php echo $_SESSION['description']; ?>" >
    <label>Experience</label>
    <input autocomplete="off" type="text" class="form-control" name="experience" value="<?php echo $_SESSION['experience']; ?>" >
    <label>Phone</label>
    <input autocomplete="off" type="text" class="form-control" name="phone" value="<?php echo $_SESSION['phone']; ?>" >
    <label>CV file</label><br/>
    <?php $namepdf = $_SESSION['cv']; 
                        echo  ' <a href="../pdf/'.$namepdf.'.pdf" >My CV</a>';
                          ?>
    <input name="file" type="file" class="form-control">

    <div class="mt-5">
        <button type="submit" name="edit_about" value="save" class="btn btn-primary">Save changes</button>
        <a href="about.php" class="btn btn-danger">Cancel</a>
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>


<?php

if (isset($_POST['edit_about'])){

  $description = $_POST['description'];
  $experience = $_POST['experience'];
  $phone = $_POST['phone'];

  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('pdf');
  
      if (in_array($fileActualExt, $allowed)) {
          if ($fileError === 0) {
              if ($fileSize < 20000000) {
               
                  $fileNameDB= 'Mohammad'. uniqid();

                  $fileNameNew=  $fileNameDB.'.'.$fileActualExt;
              
                  $fileDestination = '../pdf/'.$fileNameNew;

                  move_uploaded_file($fileTmpName, $fileDestination);
          
                  $img_id = $_SESSION['id'];
                  //Now run update query
                  $query = $conn->query("UPDATE about_us SET description= '$description', cv='$fileNameDB', experience='$experience', phone='$phone'  WHERE id = $img_id");
                  echo "<script> alert('About us edited.') </script>";
               

}else {
    echo '<p style="position: absolute; top: 110px; margin-left: 680px; font-size: 30px; color: red;">';
    echo '
    ملفك كبير جدًا';
    echo '</p>';
}

}else {
    echo '<p style="position: absolute; top: 110px; margin-left: 680px; font-size: 30px; color: red;">';
    echo '
    كان هناك خطأ في تحميل الملف الخاص بك'; 
    echo '</p>';  }

}


        
}
?>




<?php include "footer.php" ?>