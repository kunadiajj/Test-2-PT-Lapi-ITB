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
    $b=substr($form_data->masuk,2,2);
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
    $sql = 'SELECT * FROM tbl_karyawan ORDER BY nip DESC LIMIT 1';
    $result = $conn->query($sql) or die($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $nip = $b.''.$a.''.substr($row["nip"],4)+1;
            }
        }
    else
    {
        $validation_error = "data tidak ada";
        
    }
    $sql = 'INSERT INTO tbl_karyawan(nip, nama, tgl_masuk, fungsional, struktural, pin) VALUES
    ("'.$nip.'","'.$data[':nama'].'","'.$data[':masuk'].'","'.$data[':fungsi'].'", "'.$data[':struk'].'", "'.$data[':pin'].'")';

    if (mysqli_query($conn, $sql)) {
        $message = 'Input Success';
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