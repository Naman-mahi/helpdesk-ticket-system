<?php
$con=mysqli_connect("localhost", "root", "", "helpdesk_db");
if(mysqli_connect_errno())
{
echo "Connection Fail".mysqli_connect_error();
}
?>