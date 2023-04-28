<?php

if (isset($_POST['add'])&& $_POST['randcheck']==$_SESSION['rand'])
{
    $date = date("Y-m-d h:m:s");
    $name = (isset($_POST['full_name'])) ? $_POST['full_name'] : null;
    $phone = (isset($_POST['phone'])) ? $_POST['phone'] : null;
    $gender = (isset($_POST['gender'])) ? $_POST['gender'] : null;
    $student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : null;
    $ic = (isset($_POST['nric_no'])) ? $_POST['nric_no'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $address = (isset($_POST['address'])) ? $_POST['address'] : null;
    $pwd = (isset($_POST['password'])) ? $_POST['password'] : null;
    $status = (isset($_POST['enable_login'])) ? $_POST['enable_login'] : null;

    $sql = "INSERT INTO member (full_name, nric_no, phone_no, student_id, email, gender, home_address, enable_login, pwd, created_at)
    VALUES ('$name', '$ic', '$phone', '$student_id', '$email', '$gender', '$address', '$status', '$pwd', '$date')";

    if ($conn->query($sql) === TRUE) {
        $success ='Record added successfully';

    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
?>