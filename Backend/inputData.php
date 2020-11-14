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
    $sql = 'INSERT INTO tbl_absensi(id, nip, status, date, date_stamp) VALUES
    ("","'.$data[':karyawan'].'","'.$data[':keterangan'].'","'.$data[':masuk'].'","'.date("Y/m/d h:m:s").'")';

    if ($conn->query($sql) === TRUE) {
        $message = 'Input Success';
    } else {
        $validation_error = "Error: " . $sql . "<br>" . $conn->error;
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