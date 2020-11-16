<?php

include('database_connection.php');

$form_data = json_decode(file_get_contents("php://input"));
$message = '';
$validation_error = '';
$arr = array();
$a = $form_data->nip;
$sql = 'DELETE from tbl_karyawan where nip like "'.$a.'"';

if (mysqli_query($conn, $sql)) {
    $message = 'Update Success';
} else {
    $validation_error = "Error: " . $sql . "<br>" . mysqli_error($conn);
}

 echo json_encode($arr); 

?>