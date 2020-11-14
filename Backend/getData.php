<?php

include('database_connection.php');

$arr = array();
$sql = 'SELECT * from tbl_karyawan';
$result = $conn->query($sql) or die($sql);
if ($result->num_rows > 0) {
     $i=1;
     while($row = $result->fetch_assoc()) 
     {
      $arr[] = array('no'=>$i,'nip'=>$row["nip"],'nama'=>$row["nama"],'fungsional'=>$row["fungsional"],
      'struktural'=>$row["struktural"],'tgl_masuk'=>$row["tgl_masuk"]);  
      $i++;
     }  
}
 echo json_encode($arr); 

?>