<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$arr = array();
$a = $form_data->nip;
$sql = 'SELECT * from tbl_karyawan where nip like "%'.$a.'%" or nama like "%'.$a.'%"';
$result = $conn->query($sql) or die($sql);
if ($result->num_rows > 0) {
     $i=1;
     while($row = $result->fetch_assoc()) 
     {
      $arr[] = array('no'=>$i,'nip'=>$row["nip"],'nama'=>$row["nama"],'fungsional'=>$row["fungsional"],
      'struktural'=>$row["struktural"],'tgl_masuk'=>$row["tgl_masuk"],'pin'=>$row["pin"]);  
      $i++;
     }  
}
 echo json_encode($arr); 

?>