

<?php 
//Database Connection
include('../include/dbconnection.php');
include('function.php');
?>
<?php

session_start();

if(!isset($_SESSION['ts_user_id'] )){
    $ts_user_id = $_SESSION['ts_user_id'];

   header('location:../login_form.php');
}
?>
<?php

$id = $_SESSION['ts_user_id'];
      // $username = $_SESSION['user_name'];
       $findresult = mysqli_query($con, "select * from user where user_id = '$id'");
       if($res = mysqli_fetch_array($findresult)){
        $username = $res['user_name'];
        $userrole = $res['user_role'];
        $avtar = $res['avtar'];
       }
?>
<?php

if (isset($_POST['submit'])) {
    $ticket_id = $_POST['ticket_id'];
    //Getting Post Values
    $importance = $_POST['ticket_importance'];
    $status = $_POST['ticket_status'];

    //Query for data updation
    $query = mysqli_query($con, "update  generate_ticket set ticket_importance='$importance',ticket_status='$status'
	    where ticket_id='$ticket_id'");

    if ($query) {
        echo "<script>alert('You have successfully update the data');</script>";
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
?>


<?php

$res = mysqli_query($con, "SELECT * FROM generate_ticket AS gt
LEFT JOIN ticket_status AS ts
ON gt.ticket_status = ts.status_id
LEFT JOIN ticket_importance AS ti
ON gt.ticket_importance = ti.importance_id
LEFT JOIN technical_staff AS tec
ON gt.ticket_assign = tec.ts_id
ORDER BY gt.ticket_id desc ");
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
            <li class="nav-item active">
                <a class="nav-link" href="view-report.php">
                    <i class="fa-sharp fa-solid fa-file-chart-column"></i>
                <span>Ticket Report</span></a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline  text-lg danger text-danger"><?php echo ucfirst($username); ?></span>

<?php if($avtar==NULL)
{
echo '<img src="../assets/img/undraw_profile.svg">';
} else { echo '<img src="images/'.$avtar.'" img-profile rounded-circle" style="height:32px;width:32px;border-radius:50%;">';}?>

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
                        </ol>
                      </nav>



                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                OPEN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
$query = "SELECT * FROM generate_ticket where ticket_status=4";
$query_run = mysqli_query($con, $query);
$row = mysqli_num_rows($query_run);
echo $row;
?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                CLOSED</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
$query = "SELECT * FROM generate_ticket where ticket_status=1";
$query_run = mysqli_query($con, $query);
$row = mysqli_num_rows($query_run);
echo $row;
?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ONGOING
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
$query = "SELECT * FROM generate_ticket where ticket_status=2";
$query_run = mysqli_query($con, $query);
$row = mysqli_num_rows($query_run);
echo $row;
?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <!-- <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                ONHOLD</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
$query = "SELECT * FROM generate_ticket where ticket_status=3";
$query_run = mysqli_query($con, $query);
$row = mysqli_num_rows($query_run);
echo $row;
?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">


                        <!-- Pie Chart -->
                        <div class="col-xl-12 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">All Tickets</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                <div class="table-responsive">
                                <table style="text-align: center;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                        <th>NO</th>
                                        <th>TICKET ID</th>
                                        <th>FULL NAME</th>
                                        <th>ASSIGN TO</th>

                                        <th>SUBJECT</th>

                                        <th>ATTACHMENT</th>
                                        <th>IMPORTANCE</th>
                                        <th>STATUS</th>


                                        <th>DATE</th>
                                        <th>UPDATE</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

$cnt = 1;
while ($row = mysqli_fetch_assoc($res)) {

    ?>
                                        <tr>
                                        <form method="POST" action="">
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['ticket_id'] ?></td>
                                            <td><?php echo $row['firstname'] ?><?php echo " " . $row['lastname'] ?></td>



                                            <td><?php echo $row['ts_name'] ?></td>
                                            <td><?php echo $row['ticketsubject'] ?></td>
                                            <td><?php echo $row['ticketattachment'] ?></td>

                                            <td>
      <!-- <p class="fw-normal mb-1"><?php echo $row['ts_importance']; ?></p>      -->
      <select style="background-color:<?php
$ti = $row['ticket_importance'];

    if ($ti == 1) {
        echo "#EF7E2D";
    } elseif ($ti == 2) {
        echo "#EED241";
    } else {
        echo "#E90000";
    }
    ?>;
                                                                height: 30px;width:120px ; text-align: center; margin: auto; display: grid ;color:#F2F2F2 ;font-weight: bold;"
                                                                class="form-select rounded-pill" aria-label="Default select example" name="new_importance"<?php if ($row['ticket_status'] == '4') {?> disabled <?php }?>>
      <?php
$queryimportance = $con->query("SELECT * from ticket_importance");

    if (mysqli_num_rows($queryimportance) > 0) {
        while ($rowimportance = mysqli_fetch_array($queryimportance)) {
            ?>
                                                    <option style= "background-color:<?php
$imp = $rowimportance['importance_id'];

            if ($imp == 1) {
                echo "#EF7E2D";
            } elseif ($imp == 2) {
                echo "#EED241";
            } else {
                echo "#E90000";
            }
            ?>;"value="<?php echo $rowimportance['importance_id']; ?>" <?php
if ($row['ticket_importance'] == $rowimportance['importance_id']) {echo "selected";} else {}?>><?php echo $rowimportance['importance']; ?></option>


                                                 <?php }
    } else {
        ?>
                                                 <?php

    }?>
                                                </select>
                                                </td>


                                                <td>
                                                    <!-- <p class="fw-normal mb-1"><?php echo $row['ts_status']; ?></p>      -->


                                                    <select style="background-color:<?php
$st = $row['ticket_status'];

    if ($st == 1) {
        echo "#11BEF4";
    } elseif ($st == 2) {
        echo "#71B718";
    } elseif ($st == 3) {
        echo "#DA0000";
    } else {
        echo "#635D5D";
    }
    ?>;
                                                                height: 30px;width:120px ; text-align: center; margin: auto; display: grid; color:#F2F2F2 ;font-weight: bold; "
                                                                class="form-select rounded-pill" aria-label="Default select example" name="new_status"<?php if ($row['ticket_status'] == '4') {?> disabled <?php }?>>


                                                    <?php

    $queryStatus = $con->query("SELECT * from ticket_status");

    if (mysqli_num_rows($queryStatus) > 0) {
        while ($rowstatus = mysqli_fetch_array($queryStatus)) {
            ?>
                                                    <option style="background-color:<?php
$st = $rowstatus['status_id'];

            if ($st == 1) {
                echo "#11BEF4";
            } elseif ($st == 2) {
                echo "#71B718";
            } elseif ($st == 3) {
                echo "#DA0000";
            } else {
                echo "#635D5D";
            }
            ?>;"value="<?php echo $rowstatus['status_id']; ?>" <?php
if ($row['ticket_status'] == $rowstatus['status_id']) {echo "selected";} else {}?>><?php echo $rowstatus['ts_status']; ?></option>

                                                 <?php }
    } else {
        ?>
                                                 <?php
}?>
                                            </select>
                                            </td>

                                            <td><?php
$date = date_create(($row['datetime']));
    $finaldate = date_format($date, "d-m-y");
    echo $finaldate;
    #echo $row['datetime']
    ?></td>

                                        <td>

                                            <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id'] ?>">
                                            <button style="height: 30px;width:100px;text-align: center;margin: auto;display: grid ;color:#F2F2F2 ;font-weight: bold"
                                            type="submit" name="update_ticket" class="btn btn-success btn-rounded btn-sm fw-bold rounded-pill" data-mdb-ripple-color="dark"
                                            <?php if ($row['ticket_status'] == '4') {?> disabled <?php }?>  >UPDATE
                                        </button>
                                        </form>
                                        </td>

                                        </tr>
                                        <?php
$cnt = $cnt + 1;
}?>

                                    </tbody>

                                </table>
                            </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

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