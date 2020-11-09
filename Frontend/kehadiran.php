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
   
}

if(empty($error))
{
    $query = 'SELECT * FROM tbl_karyawan Where nip ="'.$data[':nip'].'"';
    $statment = $connect->prepare($query);
    if($statment->execute($data)){
        $result = $statment->fetchAll();
        if($statment->rowCount() > 0)
        {
            foreach($result as $row)
            {
                
                $pin = $form_data->pin;
                if($pin == $row["pin"])
                {
                    $query2 = 'INSERT INTO tbl_absensi(id, nip, status, date) 
                    VALUES ("","'.$data[':nip'].'","'.$data[':status'].'", "'.$data[':date'].'")';
                    $statment2 = $connect->prepare($query2);
                    if($statment2->execute($data))
                    {
                        $message = "Absen Success";
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