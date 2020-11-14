<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';
    
if(empty($form_data->tgl_awal))
{
    $error[] = 'Tanggal Awal Perlu Diisi';
}
else
{
    $data[':tgl_awal'] = $form_data->tgl_awal;
}
if(empty($form_data->tgl_akhir))
{
    $error[] = 'Tanggal Awal Perlu Diisi';
}
else
{
    $data[':tgl_akhir'] = $form_data->tgl_akhir;
}


if(empty($error))
{
    $sql = 'SELECT a.nip, k.nama,
    k.fungsional,
    k.struktural,
    COUNT(IF(a.`status` = "Sakit",1,NULL)) "sakit",
    COUNT(IF(a.`status` = "Ijin",1,NULL)) "ijin",
    COUNT(IF(a.`status` = "Hadir",1,NULL)) "hadir",
    COUNT(a.nip)"total"
    from tbl_absensi a LEFT JOIN tbl_karyawan k on a.nip = k.nip
    where a.date between "'.$data[':tgl_awal'].'" and "'.$data[':tgl_akhir'].'"
    GROUP BY a.nip, k.nama';
    $arr = array();
    $result = $conn->query($sql) or die($sql);
    if ($result->num_rows > 0) {
        $i=1;
        while($row = $result->fetch_assoc()) 
        {
            $arr[] = array('no'=>$i,'nip'=>$row["nip"],'nama'=>$row["nama"],'fungsional'=>$row["fungsional"],
            'struktural'=>$row["struktural"],'hadir'=>$row["hadir"],'sakit'=>$row["sakit"],'total'=>$row["total"],
            'ijin'=>$row["ijin"],'alpa'=>"22");
            $i++;
        }
    }
}
else
{
    $validation_error = implode(", ", $error);
}

echo $json_info = json_encode($arr);
 

?>