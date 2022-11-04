<?php

@include 'dbconnection.php';

session_start();

if (!isset($_SESSION['user_name'])) {
  header('location:../login_form.php');
}
?>
<?php
include 'dbconnection.php';
$res = mysqli_query($con, "select * from generate_ticket");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>manage report</title>
  <link rel="stylesheet" href="../assets/navabr.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <header class="py-3 mb-4 border-bottom shadow">
    <div class="container-fluid align-items-center d-flex">
      <div class="flex-shrink-1">
        <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none">
          <!-- <i class="bi bi-bootstrap fs-2 text-dark"></i> -->
        </a>
      </div>
      <div class="flex-grow-1 d-flex align-items-center">
        <div class="w-100 me-3">
          <h1><b>HELPDESK</b></h1>
        </div>
        <a href="logout.php" class="btn btn-dark">Logout</a>


        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <div class="container-fluid pb-3 flex-grow-1 d-flex flex-column flex-sm-row overflow-auto">
    <div class="row flex-grow-sm-1 flex-grow-0">
      <aside class="col-sm-1 flex-grow-sm-1 flex-shrink-1 flex-grow-0 sticky-top pb-sm-0 ">
        <div class="bg-light border rounded-3  h-100 sticky-top">
          <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link px-2 text-truncate">
                <!-- <i class="bi bi-house fs-5"></i> --><img src="https://img.icons8.com/fluency-systems-filled/48/000000/dashboard-layout.png" />
                <img src="assets/img/dashboard.png" alt="">
                <span class="d-none d-sm-inline"></span>
              </a>
            </li>

            <li>
              <a href="view-report.php" class="nav-link px-2 text-truncate">
                <img src="https://img.icons8.com/glyph-neue/64/000000/health-graph.png" />
                <span class="d-none d-sm-inline"></span> </a>
            </li>

          </ul>
        </div>
      </aside>
      <main class="col-2 overflow-auto h-100">

        <div class="container">
          <div class="container-fluid">
            <p>All Tickets</p>
            <hr>
            <button type="button" class="btn  mb-4">
              Unassigned tickets
              <span class="badge badge-danger ms-2 btn-primary"><?php
                                                                $query = "SELECT * FROM assign_ticket where assign_id=0";
                                                                $query_run = mysqli_query($con, $query);
                                                                $row = mysqli_num_rows($query_run);
                                                                echo $row;
                                                                ?></span>
            </button>
            <button type="button" class="btn  mb-4">
              Open Tickets<span class="badge badge-danger ms-2 btn-primary">
                <?php
                $query = "SELECT * FROM generate_ticket ";
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo $row;
                ?>
              </span>
            </button>
            <hr>
            <button type="button" class="btn  mb-4">
              Open<span class="badge badge-danger ms-2 btn-primary">
                <?php
                $query = "SELECT * FROM generate_ticket where ticket_status=4";
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo $row;
                ?>
              </span>
            </button>
            <button type="button" class="btn  mb-4">
              On going<span class="badge badge-danger ms-2 btn-primary"><?php
                                                                        $query = "SELECT * FROM generate_ticket where ticket_status=2";
                                                                        $query_run = mysqli_query($con, $query);
                                                                        $row = mysqli_num_rows($query_run);
                                                                        echo $row;
                                                                        ?></span>
            </button>
            <button type="button" class="btn  mb-4">
              On hold<span class="badge badge-danger ms-2 btn-primary">
                <?php
                $query = "SELECT * FROM generate_ticket where ticket_status=3";
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo $row;
                ?>
              </span>
            </button>
            <button type="button" class="btn  mb-4">
              Closed<span class="badge badge-danger ms-2 btn-primary">
                <?php
                $query = "SELECT * FROM generate_ticket where ticket_status=1";
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo $row;
                ?>
              </span>
            </button>


          </div>


      </main>
      <main class="col-9 overflow-auto h-100">

        <div class="container">
          <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <div class="col">
                <div class="card h-100">

                  <div class="card-body">
                    <h5 class="card-title">Total Tickets</h5>

                    <span class="badge badge-danger ms-2 btn-primary">
                      <?php
                      $query = "SELECT * FROM generate_ticket ORDER BY ticket_id";
                      $query_run = mysqli_query($con, $query);
                      $row = mysqli_num_rows($query_run);
                      echo $row;
                      ?></span>

                  </div>

                </div>
              </div>
              <div class="col">
                <div class="card h-100">

                  <div class="card-body">
                    <h5 class="card-title">Total Closed</h5>
                    <span class="badge badge-danger ms-2 btn-primary">
                      <?php
                      $query = "SELECT * FROM generate_ticket where ticket_status=1";
                      $query_run = mysqli_query($con, $query);
                      $row = mysqli_num_rows($query_run);
                      echo $row;
                      ?>

                    </span>

                  </div>

                </div>
              </div>
              <div class="col">
                <div class="card h-100">

                  <div class="card-body">
                    <h5 class="card-title">Total Pending</h5>
                    <span class="badge badge-danger ms-2 btn-primary">
                      <?php
                      $query = "SELECT * FROM generate_ticket where ticket_status=2";
                      $query_run = mysqli_query($con, $query);
                      $row = mysqli_num_rows($query_run);
                      echo $row;
                      ?>
                    </span>


                  </div>

                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">

                <div class="card-body">
                  <h5 class="card-title">Total open</h5>
                  <span class="badge badge-danger ms-2 btn-primary">
                    <?php
                    $query = "SELECT * FROM generate_ticket where ticket_status=4";
                    $query_run = mysqli_query($con, $query);
                    $row = mysqli_num_rows($query_run);
                    echo $row;
                    ?>
                  </span>


                </div>

              </div>
            </div>
          </div>



        </div>
        <div class="container" style="margin-top:50px;">

          <table class="table table-striped">

            <thead>

              <tr>
                <th>Ticket_id</th>
                <th>FisrtName</th>
                <!-- <th>LastName</th> -->
                <th>email</th>
                <th>School</th>
                <th>Role</th>
                <th>TicketSubject</th>
                <th>Description</th>
                <!-- <th>TicketAttachment</th> -->
                <th>TicketStatus</th>
                <th>TicketImportance</th>
                <th>TicketAssign</th>
                <!-- <th>datetime</th> -->
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                <tr>
                  <td><?php echo $row['ticket_id'] ?></td>
                  <td><?php echo $row['firstname'] ?></td>
                  <!-- <td><?php echo $row['lastname'] ?></td> -->
                  <td><?php echo $row['email'] ?></td>
                  <td><?php echo $row['school'] ?></td>
                  <td><?php echo $row['role'] ?></td>
                  <td><?php echo $row['ticketsubject'] ?></td>
                  <td><?php echo $row['description'] ?></td>
                  <!-- <td><?php echo $row['ticketattachment'] ?></td> -->
                  <td><?php echo $row['ticket_status'] ?></td>
                  <td><?php echo $row['ticket_importance'] ?></td>
                  <td><?php echo $row['ticket_assign'] ?></td>
                  <!-- <td><?php echo $row['datetime'] ?></td> -->
                </tr>
              <?php } ?>
              </thead>

          </table>

        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.table').DataTable();
    });
  </script>
</body>

</html>