<?php
 $conn = mysqli_connect("localhost","root","","Steve");
 if(!$conn)
  {
   echo "Error: ".mysqli_connect_error();
  }
?>
