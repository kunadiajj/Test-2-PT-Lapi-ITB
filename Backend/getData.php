<?php

 $connect = mysqli_connect("localhost", "root", "16agustus", "db_absensi");  

 $output = [];  
 $query = "SELECT * FROM tbl_karyawan";  
 $result = mysqli_query($connect, $query);  
 while($row = mysqli_fetch_array($result))  
 {  
      $output[] = $row;  
 }  
 echo json_encode($output); 

?>