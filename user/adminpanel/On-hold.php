<?php

@include '../include/dbconnection.php';

session_start();

if(!isset($_SESSION['admin_user_id'])){
   header('location:../login_form.php');
}
?>
<?php 
include('function.php');
?>


<?php
$id = $_SESSION['admin_user_id'];
// $username = $_SESSION['user_name'];
 $findresult = mysqli_query($con, "select * from user where user_id = '$id'");
 if($res = mysqli_fetch_array($findresult)){
  $username = $res['user_name'];
  $userrole = $res['user_role'];
  $avtar = $res['avtar'];
 }

$res = mysqli_query($con, "SELECT * FROM generate_ticket AS gt
LEFT JOIN ticket_status AS ts
ON gt.ticket_status = ts.status_id
LEFT JOIN ticket_importance AS ti
ON gt.ticket_importance = ti.importance_id
LEFT JOIN technical_staff AS tec
ON gt.ticket_assign = tec.ts_id
WHERE gt.ticket_status=3");
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

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
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username ?></span>
                                <?php if($avtar==NULL)
                {
                 echo '<img src="../assets/img/undraw_profile.svg">';
                } else { echo '<img src="images/'.$avtar.'" img-profile rounded-circle" style="height:32px;width:32px;border-radius:62px;">';}?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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


                <!-- Content Row -->


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ticket Report</li>

                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"></h1>

                            </div>
                        </ol>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"></h1>
                            <a href="ticketform.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas  fa-sm text-white-50"></i> Generate Ticket</a>
                        </div>
                    </nav>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-2 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><a class="nav-link" href="dashboard.php">All Ticket</a></h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body ">
                                    <ul class="list-group list-group-flush">

                                        <li class="list-group-item d-flex justify-content-between align-items-center" style="font-weight:bold;color:rgba(0, 0, 0, 1)">
                                        <a href="dashboard.php">Total Tickets</a>
                                            <span class="badge bg-danger text-light rounded-pill"><?php
                                                                                                    $query = "SELECT * FROM generate_ticket ";
                                                                                                    $query_run = mysqli_query($con, $query);
                                                                                                    $row = mysqli_num_rows($query_run);
                                                                                                    echo $row;
                                                                                                    ?></span>
                                        </li>
                                        <hr class="solid">
                                        <li class="list-group-item d-flex justify-content-between align-items-center rounded-pill">
                                           
                                        <a href="open.php">open</a>
                                            <span class="badge text-light rounded-pill" style="background: rgba(17, 190, 244, 1);color:rgba(242, 242, 242, 1)"><?php
                                                                                                                                                                $query = "SELECT * FROM generate_ticket where ticket_status=4";
                                                                                                                                                                $query_run = mysqli_query($con, $query);
                                                                                                                                                                $row = mysqli_num_rows($query_run);
                                                                                                                                                                echo $row;
                                                                                                                                                                ?></span>
                                        </li>
                                        <hr class="solid">
                                        <li class="list-group-item d-flex justify-content-between align-items-center rounded-pill">
                                        <a href="On-going.php">On going</a>
                                            <span class="badge text-light rounded-pill" style="background: rgba(113, 183, 24, 1);color:rgba(242, 242, 242, 1)"><?php
                                                                                                                                                                $query = "SELECT * FROM generate_ticket where ticket_status=2";
                                                                                                                                                                $query_run = mysqli_query($con, $query);
                                                                                                                                                                $row = mysqli_num_rows($query_run);
                                                                                                                                                                echo $row;
                                                                                                                                                                ?>
                                            </span>
                                        </li>
                                        <hr class="solid">
                                        <li class="list-group-item d-flex justify-content-between align-items-center rounded-pill">
                                            On hold
                                            <span class="badge text-light rounded-pill" style="background: rgba(218, 0, 0, 1);color:rgba(242, 242, 242, 1)"><?php
                                                                                                                                                            $query = "SELECT * FROM generate_ticket where ticket_status=3";
                                                                                                                                                            $query_run = mysqli_query($con, $query);
                                                                                                                                                            $row = mysqli_num_rows($query_run);
                                                                                                                                                            echo $row;
                                                                                                                                                            ?></span>
                                        </li>
                                        <hr class="solid">
                                        <li class="list-group-item d-flex justify-content-between align-items-center rounded-pill">
                                        <a href="close.php">Close</a>
                                            <span class="badge text-light rounded-pill" style="background: rgba(99, 93, 93, 1);color:rgba(242, 242, 242, 1)"><?php
                                                                                                                                                                $query = "SELECT * FROM generate_ticket where ticket_status=1";
                                                                                                                                                                $query_run = mysqli_query($con, $query);
                                                                                                                                                                $row = mysqli_num_rows($query_run);
                                                                                                                                                                echo $row;
                                                                                                                                                                ?></span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- DataTales Example -->
                        <div class="col-xl-10 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">TICKET REPORT</h6>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table style="text-align: center;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <!-- <form method="POST"> -->
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>TICKET-ID</th>
                                                    <th>FULL NAME</th>
                                                    <th>EMAIL-ID</th>
                                                    <th>SUBJECT</th>
                                                    <th>IMPORTANCE</th>
                                                    <th>STATUS</th>
                                                    <th>ASSIGN</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tfoot>

                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                    <tr>
                                                        <form method="POST" action="" id="myselect">
                                                            <td><?php echo $cnt; ?></td>
                                                            <td><?php echo $row['ticket_id'] ?></td>
                                                            <td><?php echo $row['firstname'] ?><?php echo " " . $row['lastname'] ?></td>
                                                            <td><?php echo $row['email'] ?></td>
                                                            <td><?php echo $row['ticketsubject'] ?></td>
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
                                                                height: 30px;width:120px ; text-align: center; margin: auto; display: grid ;color:#F2F2F2 ;font-weight: bold;" class="form-select rounded-pill" aria-label="Default select example" name="new_importance">
                                                                    <?php
                                                                    $queryimportance = $con->query("SELECT * from ticket_importance");

                                                                    if (mysqli_num_rows($queryimportance) > 0) {
                                                                        while ($rowimportance = mysqli_fetch_array($queryimportance)) {
                                                                    ?>
                                                                            <option style="background-color:<?php
                                                                                                            $imp = $rowimportance['importance_id'];

                                                                                                            if ($imp == 1) {
                                                                                                                echo "#EF7E2D";
                                                                                                            } elseif ($imp == 2) {
                                                                                                                echo "#EED241";
                                                                                                            } else {
                                                                                                                echo "#E90000";
                                                                                                            }
                                                                                                            ?>;" value="<?php echo $rowimportance['importance_id']; ?>" <?php
                                                                            if ($row['ticket_importance'] == $rowimportance['importance_id']) {
                                                                                echo "selected";
                                                                            } else {
                                                                            } ?>><?php echo $rowimportance['importance']; ?></option>


                                                                        <?php }
                                                                    } else {
                                                                        ?>
                                                                    <?php

                                                                    } ?>
                                                                </select>
                                                            </td>
                                                            <td><?php echo $row['ts_status'] ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <select style="height: 30px;width:120px ;text-align: center;margin: auto;display: grid;font-weight: bold " class="rounded-pill" id="myselect" aria-label="Default select example" name="new_assign">
                                                                        <?php
                                                                        $queryassign = $con->query("SELECT * from technical_staff");
                                                                        if (mysqli_num_rows($queryassign) > 0) {
                                                                            while ($rowassign = mysqli_fetch_array($queryassign)) {
                                                                        ?>
                                                                                <option value="<?php echo $rowassign['ts_id']; ?>" <?php
                                                                                                                                    if ($row['ticket_assign'] == $rowassign['ts_id']) {
                                                                                                                                        echo "selected";
                                                                                                                                    } else {
                                                                                                                                    } ?>><?php echo $rowassign['ts_name']; ?>

                                                                                </option>
                                                                                <?php
                                                                                ?>

                                                                            <?php }
                                                                        } else {
                                                                            ?>
                                                                        <?php
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            <td>
                                                                <input type="hidden" name="ticket_id" value="<?php echo $row['ticket_id'] ?>">
                                                                <button type="submit" style="height: 30px;width:100px;text-align: center;margin: auto;display: grid;color:#F2F2F2 ;font-weight: bold" name="update_ticket" <?php if ($row['ticket_assign'] == '6') { ?> disabled <?php } ?> class="btn btn-success btn-rounded btn-sm fw-bold rounded-pill " data-mdb-ripple-color="dark">ASSIGN
                                                                </button>
                                                        </form>
                                                        </td>

                                                    </tr>
                                                <?php
                                                    $cnt = $cnt + 1;
                                                } ?>

                                            </tbody>
                                            </form>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Content Row -->
                    </div>
                    <!-- /.container-fluid -->

                </div>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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