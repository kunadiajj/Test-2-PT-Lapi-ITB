<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';

if(empty($form_data->nip))
{
    $error[] = 'Nip is Required';
}
else
{
    $data[':nip'] = $form_data->nip;
}
if(empty($form_data->pin))
{
    $error[] = 'PIN is Required';
}
else
{
    $data[':pin'] = $form_data->nip;
    $data[':status'] ="Hadir";
    $data[':date'] = date('Y-m-d');
    $date = new DateTime();
    $date->format('Y-m-d H:i:s');
}

if(empty($error))
{
    $sql = 'SELECT * FROM tbl_karyawan Where nip ="'.$data[':nip'].'"';
    $result = $conn->query($sql) or die($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) 
        {
            $pin = $form_data->pin;
            if($pin == $row["pin"])
            {
                $sql2 ='INSERT INTO tbl_absensi(id, nip, status, date, date_stamp) 
                VALUES ("","'.$data[':nip'].'","'.$data[':status'].'", "'.$data[':date'].'","'.$date->format('Y-m-d H:i:s').'")';

                if (mysqli_query($conn, $sql2)) {
                    $message = 'Absen Success';
                } else {
                    $validation_error = "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                }
            }
            else
            {
                $validation_error = "PIN Salah";
            }
        }
    }
    else
    {
        $validation_error = "NIP Salah";
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