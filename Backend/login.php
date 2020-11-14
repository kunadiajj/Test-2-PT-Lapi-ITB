<?php

include('database_connection.php');

session_start();


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
    $data[':password'] = $form_data->password;
   
}

if(empty($error))
{
    $sql = 'SELECT * FROM tbl_user Where username ="'.$data[':username'].'"';
    $result = $conn->query($sql) or die($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $password = $form_data->password;
                if($password == $row["password"])
                {
                    $_SESSION["name"] = $row["nama"];
                }
                else
                {
                    $validation_error = "PIN Salah";
                }
        }
    }
    else
    {
        $validation_error = "Username/NIP Salah";
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