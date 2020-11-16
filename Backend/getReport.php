<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$arr = array();
$a=0;
$bln = substr($form_data->tgl_awal,5);
if ($bln == "01" or $bln == "03" or $bln == "05" or $bln == "07" or $bln == "08" or $bln == "10" or $bln == "12"){
    $a=22;
}
else
{
    $a=21;
}
$sql = 'SELECT a.nip, k.nama,
k.fungsional,
k.struktural,
COUNT(IF(a.`status` = "Sakit",1,NULL)) "sakit",
COUNT(IF(a.`status` = "Ijin",1,NULL)) "ijin",
COUNT(IF(a.`status` = "Hadir",1,NULL)) "hadir",
COUNT(a.nip)"total"
from tbl_absensi a LEFT JOIN tbl_karyawan k on a.nip = k.nip
where a.nip like "%'.$form_data->nip.'%" and a.date like "%'.$form_data->tgl_awal.'%" 
GROUP BY a.nip, k.nama';
$result = $conn->query($sql) or die($sql);
if ($result->num_rows > 0) {
    $i=1;
    while($row = $result->fetch_assoc()) 
    {
        $alpa = $a - ($row["sakit"]+$row["hadir"]+$row["ijin"]);
        $arr[] = array('no'=>$i,'nip'=>$row["nip"],'nama'=>$row["nama"],'fungsional'=>$row["fungsional"],
        'struktural'=>$row["struktural"],'hadir'=>$row["hadir"],'sakit'=>$row["sakit"],'total'=>$row["total"]+$alpa,
        'ijin'=>$row["ijin"],'alpa'=>$alpa);
        $i++;
    }
}
 echo json_encode($arr); 

?>