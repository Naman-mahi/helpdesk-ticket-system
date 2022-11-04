<?php 
if(isset($_POST['update_ticket']))
  {
  	$ticket_id=$_POST['ticket_id'];
  	//Getting Post Values
    $importance=$_POST['new_importance'];
    $assign=$_POST['new_assign'];
    
    
	    //Query for data updation
     $query=mysqli_query($con, "update generate_ticket set ticket_assign='$assign', ticket_importance='$importance'
	    where ticket_id='$ticket_id'"); 
	 
    if ($query) {
    echo "<script>alert('You have successfully update the data');</script>";
    echo "<script>location.href='$_SERVER[HTTP_REFERER]';</script>";
    
    



 
  }
  else
    {
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
