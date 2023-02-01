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
        'payment' => $_POST['payment'],
        'state' => $_POST['state'],
        'id' => $_POST['id']
    );
    $payload = json_encode(array("course" => $data));
    
    // Attach encoded JSON string to the POST fields
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    curl_setopt($curl, CURLOPT_URL, "http://localhost/task23/admin/api/attended_courses/update.php");
    $ret_val = json_decode(curl_exec($curl), true)['message'];
    curl_close($curl);
    $_SESSION['state'] = $ret_val == 'Updated.' ? 'success' : 'warning';
    $_SESSION['msg'] = $ret_val == 'Updated.' ? 'Successfully updated' : 'Error occurred';

}

   
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $curl = curl_init("http://localhost/task23/admin/api/attended_courses/read_single.php?id=". $id);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $res = json_decode(curl_exec($curl), true);
    curl_close($curl);
} else {
    header("Location: attended.php");
}


include "header.php";
?>
 <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <?php if($_SESSION['msg'] && $_SESSION['state']) echo "<div class='alert alert-{$_SESSION['state']}' > {$_SESSION['msg']} </div>" ?>
                  <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Feedback</h4>
                </div>
                <div class="card-body">

<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <label>Payment</label>
    <select name="payment" class="form-control">
        <option value="Cash" <?php echo $res['payment'] == 'Cash' ? ' selected ' : ''; ?> >Cash</option>
        <option value="Online" <?php echo $res['payment'] == 'Online' ? ' selected ' : ''; ?>>Online</option>
    </select>
    <label>State</label>
    <select name="state" class="form-control">
        <option value="Registered" <?php echo $res['state'] == 'Registered' ? ' selected ' : ''; ?> >Registered</option>
        <option value="Paid" <?php echo $res['state'] == 'Paid' ? ' selected ' : ''; ?> >Paid</option>
        <option value="Cancelled" <?php echo $res['state'] == 'Cancelled' ? ' selected ' : ''; ?> >Cancelled</option>
    </select>
    <div class="mt-5">
        <button type="submit" name="save" value="save" class="btn btn-primary">Save changes</button>
        <button type="submit" name="cancel" value="cancel" class="btn btn-danger">Cancel</button>
        <input  type="hidden" name="id" value="<?php echo $res['id'] ?>">
    </div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>





<?php include "footer.php" ?>