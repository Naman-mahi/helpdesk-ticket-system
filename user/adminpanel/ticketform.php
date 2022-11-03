<?php

@include '../include/dbconnection.php';

session_start();

if(!isset($_SESSION['admin_user_id'])){
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
 if($res = mysqli_fetch_array($findresult)){
  $username = $res['user_name'];
  $userrole = $res['user_role'];
  $avtar = $res['avtar'];
 }
?>
<?php
include '../include/dbconnection.php';
if (isset($_POST['submit'])){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$school = $_POST['school'];
$role = $_POST['role'];
$ticketsubject = $_POST['ticketsubject'];
$ticketsubject = htmlentities($ticketsubject);
$ticketsubject = addslashes($ticketsubject);
$ticketsubject = htmlentities($ticketsubject);
$description = $_POST['description'];
$description = htmlentities($description);
$description = addslashes($description);
$description = htmlentities($description);
$ticketattachment = $_POST['ticketattachment'];

    $sql = "insert into `generate_ticket`(firstname,lastname,email,school,role,ticketsubject,description,ticketattachment,ticket_status,ticket_importance,ticket_assign  ) 
     values('$firstname','$lastname','$email','$school','$role','$ticketsubject','$description','$ticketattachment',1,1,5)";
     $result = mysqli_query($con, $sql);
     if ($result)
     
    {
   
      echo "<script>alert(' HI USER! You have successfully entered your data,please click on OK! & Please check Your email ');</script>";
     echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } 
    else 
    {
        die(mysqli_error($con));
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
ON gt.ticket_assign = tec.ts_id");
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eed30e02d9.js" crossorigin="anonymous"></script>
      
  
      
              


     <link rel="stylesheet" href="css/sb-admin-2.min.css" > 
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
                <a class="nav-link" href="#">
                    <i class="fa-sharp fa-solid fa-ticket"></i>
                    <span>Ticket</span></a>
            </li>
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
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../logout.php">
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
                            <li class="breadcrumb-item active" aria-current="page">Helpdesk ticketing system</li>
                            <li>
                            </li>
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"></h1>

                                
                            </div>

                        </ol>
                       

                    </nav>
                    <div class="col-xl-12 col-lg-5">
              
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="OFF">
            <?php
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];           
                $subject = "HelpDesk Ticketing System";
                $message ="Hello, " . $firstname. $lastname."!";
                $message1 = "Thanks for using HelpDesk Ticketing System, we real appreciate you for choosing Helpdesk Ticketing system.\r\n\r\nThanks,\r\nTechnical Support,\r\nHelpDesk Ticketing System,\r\nFor any Queries Follow us @ http://intelcode.org/";

                if(empty($email) || empty($subject)|| empty($message1)|| empty($message))
                {
                    ?>
                    <div id="alert">All Inputs are required</div>
                    <?php
                }else
                {
                    if(mail($email,$subject,$message1,$message))
                    {
                        ?>
                        <div id="alert">Message Sent Successfully To <br> <?php echo $email ?></div>
                        <?php
                    }else
                    {
                        ?>
                        <div id="alert">Failed While Sending Your Mail<br>Please Check Your Connection.</div>
                        <?php
                    }
                }
            }
            ?>
    

        <div class=" text-center mt-6 ">

          
  <div class="a">

<p style="font-size:20px">Please provide the details of the problem</p>

  <hr>
</div>
    
<div class="shadow-lg p-5 mb-5 bg-body rounded">
       
            <div class = "container">
        
            <div class="controls">

            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <h5 class="text-left">Firstname</h5>
                            <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Enter Firstname " required="required">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <h5 class="text-left">Lastname</h5>
                            <input id="lastname" type="text" name="lastname" class="form-control" placeholder="Enter lastname" required="required" >
                                                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <h5 class="text-left">Email</h5>
                            <input id="email" type="email" name="email" class="form-control" placeholder="Enter email" required="required" >
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <h5 class="text-left">School</h5>
                            <input id="school" type="text" name="school" class="form-control" placeholder="Enter school " required="required">
                        </div>
</div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <h5 class="text-left">Role</h5>
                            <select id="role" name="role" class="form-control" required="required">
                                <option name="role" value="Select Your Role"selected disabled>Select Your Role</option>
                                <option name="role" value="Student">Student</option>
                                <option name="role" value="Teacher">Teacher</option>
                                <option name="role" value="Parent">Parent</option>
                                <option name="role" value="School">School</option>
                                </select>   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <h5 class="text-left">Ticketsubject</h5>
                            
                            <input id="ticketsubject" type="text" name="ticketsubject" class="form-control" placeholder="Enter Ticketsubject " required="required" data-error="Firstname is required.">

                                
                            </div>
                            <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <h5 class="text-left">Description</h5>
                            <textarea id="description" name="description" class="form-control" placeholder="Enter your comment/feedback." rows="4" required="required" data-error="Please, leave us a message."></textarea
                                >
                            </div>
                            
                            
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <h5 class="text-left">Ticketattachment</h5>
                            <input id="file" type="file" name="ticketattachment" class="form-control" >
                            
                        </div>

                        </div>

                    <div class="col-md-12">
                   <div>
                   
                
                   <button type="submit" class="btn btn-success btn-lg"name="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                     </div>
          
                </div>


        </div>
         </form>
        
       </div>
        </div>
        </div>
    <!-- /.row-->

</div>
</div>
         
                     
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