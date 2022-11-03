<?php

@include 'include/dbconnection.php';

session_start();

if (isset($_POST['submit'])) {

   
   $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
   $user_password = md5($_POST['user_password']);
  
   $select = " SELECT * FROM user WHERE user_name = '$user_name' && user_password = '$user_password' ";

   $result = mysqli_query($con, $select);

   if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result);

      if ($row['user_role'] == '1') {

         $_SESSION['admin_user_id'] = $row['user_id'];
         header('location:adminpanel/dashboard.php');
      } elseif ($row['user_role'] == '2') {

         $_SESSION['ts_user_id'] = $row['user_id'];
         
         header('location:technical-suport/dashboard.php');
      }
   } else {
      $error[] = 'incorrect Username or password!';
   }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
   <header>
      <div class="card text-white  bg-primary mb-10">
         <div class="card-body">
            <h2 class="card-title text-center" style="color:beige"><b>HELPDESK TICKETING SYSTEM</b></h2>
         </div>
      </div>
   </header>
   <div class="form-container">

      <form action="" method="post">
         <h3>login</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            };
         };
         ?>
         <input type="text" name="user_name" required placeholder="enter your username">
         <input type="password" name="user_password" required placeholder="enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
         <!-- <p>don't have an account? <a href="register_form.php">register now</a></p> -->
      </form>

   </div>

</body>

</html>