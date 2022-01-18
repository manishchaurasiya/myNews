<?php
include "header.php";
include "conn.php";
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
$roles = mysqli_query($conn,"SELECT * FROM roles");
if(isset($_POST['save'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];

    $check = mysqli_query($conn,"SELECT email FROM user WHERE email = '$_POST[email]'");
    if (mysqli_num_rows($check) > 0) {
        print_r($check);
        $msg = "User already Exist";
    } else {
        $result = mysqli_query($conn, "INSERT INTO user(first_name,last_name,email,password,role) VALUES('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[password]','$_POST[role]')");
        if (!$result) {
            echo mysqli_error($conn);
        }
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <?php 
                if(isset($msg))
                {
                  echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>{$msg}</strong>
                    </div>";

                }
                ?>
                  <form  action="" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>Email Address</label>
                          <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option >Select Role</option>
                              <?php 
                              while($row = mysqli_fetch_assoc($roles))
                              {
                                  echo"<option value='$row[id]'> $row[role]</option>";
                              }
                              ?>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
