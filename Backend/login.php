<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));

$message = '';
$validation_error = '';

if(empty($form_data->username))
{
    $error[] = 'username is Required';
}
else
{
    $data[':username'] = $form_data->username;
}
if(empty($form_data->password))
{
    $error[] = 'Password is Required';
}
else
{
    $data[':password'] = $form_data->nip;
   
}

if(empty($error))
{
    $query = 'SELECT * FROM tbl_user Where username ="'.$data[':username'].'"';
    $statment = $connect->prepare($query);
    if($statment->execute($data)){
        $result = $statment->fetchAll();
        if($statment->rowCount() > 0)
        {
            foreach($result as $row)
            {
                $password = $form_data->password;
                if($password == $row["password"])
                {
                    $_SESSION["nama"] = $row["nama"];
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