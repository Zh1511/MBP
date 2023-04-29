<?php
require_once('Config/Api.php');

$action = $_GET['action'];

if($action == 'student_id')
{
    $student_id = $_POST['student_id'];
    $ret=mysqli_query($conn,"SELECT * FROM member WHERE student_id = '$student_id'");
    
    $num=mysqli_fetch_array($ret);
    
    $result = 0;
    
    if($num>0)
    {
        $result = '1';
        echo trim($result);
    }
    else
    {
        $result = '0';
        echo trim($result);
    }
}

if($action == 'phone')
{
    $phone = $_POST['phone'];
    $ret=mysqli_query($conn,"SELECT * FROM member WHERE phone_no = '$phone'");
    
    $num=mysqli_fetch_array($ret);
    
    $result = 0;
    
    if($num>0)
    {
        $result = '1';
        echo trim($result);
    }
    else
    {
        $result = '0';
        echo trim($result);
    }
}

if($action == 'ic')
{
    $ic = $_POST['ic'];
    $ret=mysqli_query($conn,"SELECT * FROM member WHERE nric_no = '$ic'");
    
    $num=mysqli_fetch_array($ret);
    
    $result = 0;
    
    if($num>0)
    {
        $result = '1';
        echo trim($result);
    }
    else
    {
        $result = '0';
        echo trim($result);
    }
}

if($action == 'email')
{
    $email = $_POST['email'];
    $ret=mysqli_query($conn,"SELECT * FROM member WHERE email = '$email'");
    
    $num=mysqli_fetch_array($ret);
    
    $result = 0;
    
    if($num>0)
    {
        $result = '1';
        echo trim($result);
    }
    else
    {
        $result = '0';
        echo trim($result);
    }
}



?>