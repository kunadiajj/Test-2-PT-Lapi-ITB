<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';

if(empty($form_data->karyawan))
{
    $error[] = 'Nip Perlu Diisi';
}
else
{
    $data[':karyawan'] = $form_data->karyawan;
}

if(empty($form_data->masuk))
{
    $error[] = 'Tanggal Perlu Diisi';
}
else
{
    $data[':masuk'] = $form_data->masuk;
}
if(empty($form_data->keterangan))
{
    $error[] = 'Keterangan Perlu Diisi';
}
else
{
    $data[':keterangan'] = $form_data->keterangan;
}

if(empty($error))
{
    $query = 'INSERT INTO tbl_absensi(id, nip, status, date) VALUES
     ("","'.$data[':karyawan'].'","'.$data[':keterangan'].'","'.$data[':masuk'].'")';
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