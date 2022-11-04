<?php

@include '../include/dbconnection.php';

session_start();

if (!isset($_SESSION['admin_user_id'])) {
    header('location:../login_form.php');
}

?>
<?php
include 'function.php';
?>


<?php
$id = $_SESSION['admin_user_id'];
// $username = $_SESSION['user_name'];
$findresult = mysqli_query($con, "select * from user where user_id = '$id'");
if ($res = mysqli_fetch_array($findresult)) {
    $username = $res['user_name'];
    $userrole = $res['user_role'];
    $avtar = $res['avtar'];
}
?>
<?php

if (isset($_POST['submit'])) {

    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $user_password = md5($_POST['user_password']);
    $cpass = md5($_POST['cpassword']);
    $user_role = $_POST['user_role'];

    $select = " SELECT * FROM user WHERE user_name = '$user_name' && user_password = '$user_password' ";

    $result = mysqli_query($con, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';
    } else {

        if ($user_password != $cpass) {
            $error[] = 'password not matched!';
        } else {
            if ($user_role == 1) {
                $insert = "INSERT INTO user (user_name, user_password, user_role) VALUES('$user_name','$user_password','$user_role')";
                $insert2 = "INSERT INTO admin (admin_user_id,admin_name) VALUES((select user_id from user where user_name='$user_name'),'$user_name')";
                mysqli_query($con, $insert);
                mysqli_query($con, $insert2);

                $error[] = 'Your account has been created successfully!';} else {
                $insert = "INSERT INTO user (user_name, user_password, user_role) VALUES('$user_name','$user_password','$user_role')";
                $insert3 = "INSERT INTO technical_staff (ts_user_id,ts_name) VALUES((select user_id from user where user_name='$user_name'),'$user_name')";
                mysqli_query($con, $insert);
                mysqli_query($con, $insert3);

                $error[] = 'Your account has been created successfully!';
            }
            // header('location:dashboard.php');
            // header("Location: register_form.php?");

        }
    }
}
;
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
    <!-- <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css"> -->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://kit.fontawesome.com/eed30e02d9.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/sb-admin-2.min.css">
   <link rel="stylesheet" href="../css/style.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
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
<!-- <li class="nav-item active">
    <a class="nav-link" href="#">
        <i class="fa-sharp fa-solid fa-ticket"></i>
        <span>Ticket</span></a>
</li> -->
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="manage-report.php">
        <i class="fa-sharp fa-solid fa-file-chart-column"></i>
    <span>Manage Report</span></a>
</li>





<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">

        <i class="fa-solid fa-user-group"></i>
        <span>Technical Support</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

            <a class="collapse-item" href="view-tech-team.php">Manage Tech Team</a>
            <a class="collapse-item" href="register_form.php">Register User</a>

        </div>
    </div>
</li>

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




                        <!-- Nav Item - Alerts -->




                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large"><?php echo $username ?></span>
                                <?php if ($avtar == null) {
                                    echo '<img src="../assets/img/undraw_profile.svg">';
                                } else {
                                    echo '<img src="images/' . $avtar . '" img-profile rounded-circle" style="height:40px;width:40px;border-radius:62px;">';
                                } ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal" >
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
                          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Add User</li>
                        </ol>
                      </nav>



                </div>
                <!-- /.container-fluid -->

   <div class="form-container">

<form action="" method="post">
   <h3>register now</h3>
   <?php
if (isset($error)) {
    foreach ($error as $error) {
        echo '<span class="error-msg">' . $error . '</span>';
    }
    ;
}
;
?>
   <!-- <input type="text" name="name" required placeholder="enter your name"> -->
   <input type="text" name="user_name" required placeholder="enter your username">
   <input type="password" name="user_password" required placeholder="enter your password">
   <input type="password" name="cpassword" required placeholder="confirm your password">
   <select name="user_role">
      <option value="2">Technical Team</option>
      <option value="1">admin</option>
   </select>
   <form action="register_form.php" method="post" class="border shadow p-3 rounded">

      <input type="submit" name="submit" value="register now" class="form-btn">

      <!-- <p>already have an account? <a href="login_form.php">login now</a></p> -->
   </form>

</div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div>
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