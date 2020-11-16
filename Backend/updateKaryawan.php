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
    $sql = 'UPDATE tbl_karyawan SET nama = "'.$data[':nama'].'", tgl_masuk = "'.$data[':masuk'].'",
     fungsional = "'.$data[':fungsi'].'", struktural = "'.$data[':struk'].'", pin =  "'.$data[':pin'].'" WHERE
    nip = "'.$form_data->nip.'"';

    if (mysqli_query($conn, $sql)) {
        $message = 'Update Success';
    } else {
        $validation_error = "Error: " . $sql . "<br>" . mysqli_error($conn);
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