<?php

@include '../include/dbconnection.php';

session_start();

if(!isset($_SESSION['ts_user_id'] )){
    $ts_user_id = $_SESSION['ts_user_id'];

   header('location:../login_form.php');
}

?>
<?php
/*------reset password 1----*/

if (isset($_POST['update_password'])) {
 
  $ts_user_id= $_SESSION['ts_user_id'];
  $user_name = $_POST['user_name'];
  $new_password = $_POST['newpassword'];
  $confirm_password = $_POST['confirmpassword'];

  $password = mysqli_real_escape_string($con, $confirm_password);

  $pass = md5($password);



  $changePassword = $con->query("UPDATE user,technical_staff SET user_password = '$pass',user.user_name='$user_name',technical_staff.ts_name='$user_name'

  WHERE user_id = '$ts_user_id'");


if ($new_password != $confirm_password)
 {
  echo "<script>alert('password do not match');

  location.href = '$_SERVER[HTTP_REFERER]';</script>";
 }
  if ($changePassword) {

      echo "<script>alert('Change password is successful');

              location.href = '$_SERVER[HTTP_REFERER]';</script>";

  } else {

      echo "<script>alert('Change password is not successful');

              location.href = '$_SERVER[HTTP_REFERER]';</script>";

  }
  

}

/*------reset password 1----*/
?>
<!DOCTYPE html>
<html lang="en"> 

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css">
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://kit.fontawesome.com/eed30e02d9.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../assets/css/sb-admin-2.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
    </div>
    <div class="sidebar-brand-text mx-3">Online Helpdesk<sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="view-report.php">
        <i class="fa-sharp fa-solid fa-file-chart-column"></i>
    <span>View Report</span></a>
</li>





<!-- Nav Item - Pages Collapse Menu -->


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


</ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                 

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    <?php
      $id = $_SESSION['ts_user_id'];
      // $username = $_SESSION['user_name'];
       $findresult = mysqli_query($con, "select * from user where user_id = '$id'");
       if($res = mysqli_fetch_array($findresult)){
        $username = $res['user_name'];
        $userrole = $res['user_role'];
        $avtar = $res['avtar'];
       }
#SELECT * FROM user LEFT JOIN user_role AS ur ON user.user_role = ur.user_role
    ?>
                      
                    

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucfirst($username); ?></span>
                                <?php if($avtar==NULL)
                {
                 echo '<img src="../assets/img/undraw_profile.svg">';
                } else { echo '<img src="images/'.$avtar.'" img-profile rounded-circle" style="height:32px;width:32px;border-radius:50%;">';}?>
               
                               
                                <!-- <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile.svg"> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                 <!-- Begin Page Content -->
                 <div class="container-fluid">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    
                        </ol>
                      </nav> 
                      
                    <!-- DataTales Example -->
                 
  <section >
  <div class="container py-5"style="background-image:url('');">
   

  <div class="row" >
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
          <?php if($avtar==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="images/'.$avtar.'" style="height:100px;width:100px;border-radius:50%;">';}?>
            <!-- <img src="/upload/<?php $avtar ?>" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;"> -->
            <h5 class="my-3"><?php echo $username;?></h5>
            <form method="post" enctype='multipart/form-data' action="profile.php">
            
            <div class="mb-3">
            <label >Profile Picture</label>
            <input class="form-control" type="file" id="formFile" name="avtar">
          </div>
            <input type="hidden" name="user_id" value="<?= $id ?>">
            <button type="submit" class="btn btn-success" name="update_profile">Update Profile</button>
          </form>
          </div>
        </div>
      </div>

        <?php
  $msg = "";
  $msg_class = "";
  if (isset($_POST['update_profile'])) {
    // for the database
    $user_id = $_POST['user_id'];
    $profileImageName = time() . '-' . $_FILES["avtar"]["name"];
    // For image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['avtar']['size'] > 200000) {
      $msg = "Image size should not be greated than 200Kb";
      $msg_class = "alert-danger";
    }
    // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["avtar"]["tmp_name"], $target_file)) {
        $sql = "update user, technical_staff set user.avtar='$profileImageName', technical_staff.avtar='$profileImageName' WHERE user_id = '$user_id'";
        if(mysqli_query($con, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
          echo ("<script>location.href='$_SERVER[HTTP_REFERER]';</script>");
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger";
        }
      } else {
        $error = "There was an erro uploading the file";
        $msg = "alert-danger";
      }
    }
  }

?>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
          <form method="post" enctype='multipart/form-data' action="profile.php">
          <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label"> Name</label>
              <input type="text" name="user_name" value="<?php echo $username;?>"class="form-control" id="exampleInputPassword1"required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">New Password</label>
              <input type="password" name="newpassword" class="form-control" id="exampleInputPassword1"placeholder="Enter new password"required>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
              <input type="password" name="confirmpassword" class="form-control" id="exampleInputPassword1"placeholder="Enter confirm"required>
            </div>
           
            <input type="hidden" name="user_id" value="<?= $id ?>">
            <button type="submit" class="btn btn-success" name="update_password">Update password</button>
           
          </form>
      </div>
      </div>
      </div>
      </div>
    </div>
  </div>
      </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Intelocde 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

</body>

</html>

