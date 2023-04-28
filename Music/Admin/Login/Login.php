<?php
//Set the session timeout for 2 seconds
session_start(); 
?>

<!DOCTYPE html>

<html>

<head>
    <title>LOGIN</title>
    <style>
body {

background: #91a716;

display: flex;

justify-content: center;

align-items: center;

height: 100vh;

flex-direction: column;

}

*{

font-family: cursive;

box-sizing: padding-box;

}

form {

width: 1000px;

border: 3px solid rgb(177, 142, 142);

padding: 20px;

background: rgb(85, 54, 54);

border-radius: 20px;

}

h2 {

text-align: center;

margin-bottom: 40px;

}

input {

display: block;

border: 2px solid #ccc;

width: 95%;

padding: 10px;

margin: 10px auto;

border-radius: 5px;

}

label {

color: #888;

font-size: 18px;

padding: 10px;

}

button {

float: right;

background: rgb(35, 174, 202);

padding: 10px 15px;

color: #fff;

border-radius: 5px;

margin-right: 10px;

border: none;

}

button:hover{

opacity: .10;

}

.error {

background: #F2DEDE;

color: #0c0101;

padding: 10px;

width: 95%;

border-radius: 5px;

margin: 20px auto;

}

h1 {

text-align: center;

color: rgb(134, 3, 3);

}

a {

float: right;

background: rgb(183, 225, 233);

padding: 10px 15px;

color: #fff;

border-radius: 10px;

margin-right: 10px;

border: none;

text-decoration: none;

}

a:hover{

opacity: .7;

}
    </style>

</head>

<body>

<?php

require_once('../Config/Api.php');
require_once('../Config/Helper.php');


if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: Login.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: Login.php?error=Password is required");

        exit();

    }else{

        $ret=mysqli_query($conn,"SELECT * FROM user WHERE username='$uname' and password='$pass'");

        $num=mysqli_fetch_array($ret);

        if($num>0)
        {   
            $extra="../Dashboard/Dashboard.php";
            $_SESSION['user_name']=$_POST['uname'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['adminid']=$num['id'];
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (30*60);
            echo "<script>window.location.href='".$extra."'</script>";
            exit();
        }
        else {
            header("Location: Login.php?error=Incorect User name or password");
            exit();
        }

    }

}
?>


     <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
            </div>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="Password"><br> 

        <button type="submit">Login</button>

     </form>

</body>

</html>
