<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';

if(empty($form_data->nama))
{
    $error[] = 'Nama Perlu Diisi';
}
else
{
    $data[':nama'] = $form_data->nama;
}

if(empty($form_data->masuk))
{
    $error[] = 'Tanggal Perlu Diisi';
}
else
{
    $data[':masuk'] = $form_data->masuk;
}

if(empty($form_data->fungsi))
{
    $error[] = 'Fungsional Perlu Diisi';
}
else
{
    $data[':fungsi'] = $form_data->fungsi;
}

if(empty($form_data->struk))
{
    $error[] = 'Struktural Perlu Diisi';
}
else
{
    $data[':struk'] = $form_data->struk;
}

if(empty($form_data->pin))
{
    $error[] = 'Nama Perlu Diisi';
}
else
{
    $data[':pin'] = $form_data->pin;
   
}

if(empty($error))
{
    $a="";
    $b=substr($form_data->masuk,2,2);;
    $nip="";

    if($form_data->fungsi == "Engineer"){
        $a = "01";
    }
    else if($form_data->fungsi == "Administrasi"){
        $a = "02";
    }
    else if($form_data->fungsi == "Support"){
        $a = "03";
    }
    
    $query = 'SELECT * FROM tbl_karyawan ORDER BY nip DESC LIMIT 1';
    $statment = $connect->prepare($query);
    if($statment->execute($data)){
        $result = $statment->fetchAll();
        if($statment->rowCount() > 0)
        {
            foreach($result as $row)
            {
                $nip = $b.''.$a.''.substr($row["nip"],4)+1;
            }
        }
        else
        {
            $validation_error = "data tidak ada";
        }
    }
    $query = 'INSERT INTO tbl_karyawan(nip, nama, tgl_masuk, fungsional, struktural, pin) VALUES
     ("'.$nip.'","'.$data[':nama'].'","'.$data[':masuk'].'","'.$data[':fungsi'].'", "'.$data[':struk'].'", "'.$data[':pin'].'")';
    $statment = $connect->prepare($query);
    if($statment->execute($data))
    {
        $message = 'Input Success';
    }
}
else
{
    $validation_error = implode(", ", $error);
}

$output = array(
    'error'     => $validation_error,
    'message'   => $message
);

echo json_encode($output);


?>