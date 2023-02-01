<?php 
session_start();
$_SESSION['msg'] = '';
$_SESSION['state'] = '';

if (isset($_POST['cancel'])) {
    header("Location: attended.php");
}

if (isset($_POST['save'])) {
    $curl = curl_init();
    $data = array(
        'user_id' => $_POST['user_id'],
        'course_id' => $_POST['course_id'],
        'payment' => $_POST['payment'],
        'state' => $_POST['state']
        );
    $payload = json_encode(array("course" => $data));
    
    // Attach encoded JSON string to the POST fields
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($curl, CURLOPT_URL, "http://localhost/task23/admin/api/attended_courses/create.php");
    $ret_val = json_decode(curl_exec($curl), true)['message'];
    curl_close($curl);
    $_SESSION['state'] = $ret_val == 'Created.' ? 'success' : 'warning';
    $_SESSION['msg'] = $ret_val == 'Created.' ? 'Successfully created' : 'Error occurred';
}


$curl = curl_init('http://localhost/task23/admin/api/users/read.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$res = json_decode(curl_exec($curl), true)['data'];
curl_close($curl);


include "header.php";
?>
 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
              <?php if($_SESSION['msg'] && $_SESSION['state']) echo "<div class='alert alert-{$_SESSION['state']}' > {$_SESSION['msg']} </div>" ?>
                  <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Attended Course</h4>
                </div>
                <div class="card-body">

<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
<label>User</label>
    <select name="user_id" class="form-control mb-3">
        <option selected disabled >Select User</option>
        <?php for ($i=0; $i < count($res); $i++) : ?>
            <option value="<?php echo $res[$i]['id'] ?>" ><?php echo $res[$i]['full_name'] . ' - id(' . $res[$i]['id'] . ')' ?></option>
        <?php endfor ?>
        <?php
            $curl = curl_init('http://localhost/task23/admin/api/attended_courses/read.php');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $res = json_decode(curl_exec($curl), true)['data'];
            curl_close($curl);
        ?>
    </select>
    <label>Course</label>
    <select name="course_id" class="form-control mb-3">
        <option selected disabled >Select Course</option>
        <?php for ($i=0; $i < count($res); $i++) : ?>
            <option value="<?php echo $res[$i]['course_id'] ?>" ><?php echo $res[$i]['course_name'] . ' - id(' . $res[$i]['course_id'] . ')' ?></option>
        <?php endfor ?>
    </select>
    <label>Payment</label>
    <select name="payment" class="form-control mb-3">
        <option selected disabled >Select Payment</option>
        <option value="Cash">Cash</option>
        <option value="Online">Online</option>
    </select>
    <label>State</label>
    <select name="state" class="form-control mb-3">
        <option selected disabled >Select State</option>
        <option value="Registered">Registered</option>
        <option value="Paid">Paid</option>
        <option value="Cancelled">Cancelled</option>
    </select>
    
    <div class="mt-5">
        <button type="submit" name="save" value="save" class="btn btn-primary">Save changes</button>
        <button type="submit" name="cancel" value="cancel" class="btn btn-danger">Cancel</button>
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>





<?php include "footer.php" ?>