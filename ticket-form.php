
<?php
include 'include/dbconnection.php';
if (isset($_POST['submit'])) 
{

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $role = $_POST['role'];
    $ticketsubject = $_POST['ticketsubject'];
    $description = $_POST['description'];
    $ticketattachment = $_POST['ticketattachment'];

    $sql = "insert into `generate_ticket`(firstname,lastname,email,school,role,ticketsubject,description,ticketattachment,ticket_status,ticket_importance,ticket_assign  ) 
     values('$firstname','$lastname','$email','$school','$role','$ticketsubject','$description','$ticketattachment',2,1,5)";
        $result = mysqli_query($con, $sql);
    if ($result)
    {
   
      echo "<script>alert('You have successfully update the data');</script>";
     echo "<script type='text/javascript'> document.location ='success.php'; </script>";
    } 
    else 
    {
        die(mysqli_error($con));
    }
}
?>
<!doctype html>
        <html>
      <head>
       <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
     <title>HelpDesk ServiceTicket</title>
      <!-- <link href='https://maxcdn.bootstrapcdn.com/bootstrap/5/css/bootstrap.min.css' rel='stylesheet'> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
         <link href='#' rel='stylesheet'>
     <!-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <style>
                                
    body { 
        font-family: Calibri, Helvetica, sans-serif;
    width: 80%; 
    margin-left:auto; 
    margin-right: auto; 
    min-height:100%;
    height:100%;
    background-color: #FFFFFF;
    border-radius: auto;
    -moz-border-radius:auto;


}

h1 {
    margin-bottom: 40px;
    text-align: left;
}

h6 {
    margin-bottom: 10px;
    text-align: left;
   
}


div.a {
   padding: 20px 0;
   text-align: center;
   }
hr {
  border: 1px solid black;
  margin-bottom: 10px;
  text-align: center;
}


label {
    color: black;
}

.button {
  background-color: #63C729  ;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {font-size: 30px;}
.button1 {padding: 10px 10px;}



</style>

 </head>
<body>
<form  method="post">
<form id="contact" method="post">
        <div class=" text-center mt-6 ">

           <div class="d-flex flex-row bd-highlight mb-3">
  <h1 class="p-2 bd-highlight fs-1 text-primary">HelpDESK</h1>
  <h1 class="p-2 bd-highlight fs-1 text-danger">Ticketing System </h1>
</div>
            
        </div>
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
                            <label for="firstname">Firstname</label>
                            <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Enter Firstname " required="required">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Lastname </label>
                            <input id="lastname" type="text" name="lastname" class="form-control" placeholder="Enter lastname" required="required" >
                                                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" placeholder="Enter email" required="required" >
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>School</label>
                            <select id="school" name="school" class="form-control" required="required">
                                <option name="school" value="Select School" selected disabled>Select School</option>
                                <option name="school" value="Alabyen school" >Alabyen school</option>
                                <option name="school" value="Oxford school" >Oxford school</option>
                                <option name="school" value="Standford school" >Standford school</option>
                                <option name="school" value="Malaysia School" >Malaysia School</option>
                            </select>
                            
                        </div>
</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
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
                            <label for="ticketsubject">TicketSubject</label>
                            
                            <input id="ticketsubject" type="text" name="ticketsubject" class="form-control" placeholder="Enter Ticketsubject " required="required" data-error="Firstname is required.">

                                
                            </div>
                            <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Enter your comment/feedback." rows="4" required="required" data-error="Please, leave us a message."></textarea
                                >
                            </div>
                            
                            
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">TicketAttachment</label>
                            <input id="file" type="file" name="ticketattachment" class="form-control" >
                            
                        </div>

                        </div>

                    <div class="col-md-12">
                   <div>
                   <button type="submit" class="button button-1"  name="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                
        
                     </div>
          
                </div>


        </div>
         </form>
        
       </div>

    <!-- /.row-->

</div>
</div>
                
 </body>
</html>