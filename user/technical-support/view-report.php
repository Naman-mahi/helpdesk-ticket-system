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


$res=mysqli_query($con,"SELECT * FROM generate_ticket AS gt
LEFT JOIN ticket_status AS ts
ON gt.ticket_status = ts.status_id
LEFT JOIN ticket_importance AS ti
ON gt.ticket_importance = ti.importance_id
LEFT JOIN technical_staff AS tec
ON gt.ticket_assign = tec.ts_id 
LEFT JOIN assign_ticket AS at
ON gt.ticket_assign=at.at_assign_to

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

    <title>View Report</title>

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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
   

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 large"><?php echo ucfirst($username);?></span>


                                <?php if($avtar==NULL)
                {
                 echo '<img src="../assets/img/undraw_profile.svg">';
                } else { echo '<img src="images/'.$avtar.'" img-profile rounded-circle" style="height:40px;width:40px;border-radius:50%;">';}?>
               
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
                        <li class="breadcrumb-item"><a href="view-report-v1.php">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Ticket Report</li>
                    
                        </ol>
                      </nav>
                        <!-- Page Heading -->
                  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">TICKET REPORT</h6>
                           
                        </div>
                        <div class="card-body">
                        <div class="row">
           
                        <div class="col-12">
                      <div class="data_table">
                     <table id="example" class="table table-striped  table-bordered">
                        
                        <thead class="table">

                        <tr>
                                        <th>Sr No</th>
                                        <th>Ticket ID</th>
                                        <th>Full Name</th>
                                       
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Subject</th>
                                        <th>Attachment</th>
                                        <th>Status</th>
                                        <th>Importance</th>
                                        <th>Date </th>
                                        </tr>
                                        
                        </thead>
                       
                        <tbody>
                        <?php 
                                        $cnt=1;
                                        while($row=mysqli_fetch_assoc($res)){
                                            
                                        ?>
                        <tr>
                                            <td><?php echo $cnt;;?></td>
                                            <td><?php echo $row['ticket_id']?></td>
                                            <td><?php echo $row['firstname']?><?php echo " ". $row['lastname']?></td>
                                           
                                            <td><?php echo $row['email']?></td>
                                            <td><?php echo $row['role']?></td>
                                            <td><?php echo $row['ticketsubject']?></td>
                                            <td><?php echo $row['ticketattachment']?></td>
                                            <td><?php echo $row['ts_status']?></td>
                                            <td><?php echo $row['importance']?></td>
                                            <td><?php echo $row['datetime']?></td>
                                            
                                        </tr>
                                      
                                        <?php 
                                    $cnt=$cnt+1;
                                    } ?>
                           
                        </tbody>
                       
                    </table>
                   
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/custom.js"></script>



</body>

</html>