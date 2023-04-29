<?php
if(isset($_POST['email']))
{
//connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'music_society');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$email = $_POST['email'];
$query = "SELECT email FROM user WHERE email = '$email'";

$query_retrived = mysqli_query($conn, $query);
$rows = mysqli_fetch_assoc($query_retrived);
$result = mysqli_num_rows($query_retrived);

if ($result>0)
{
    echo "duplicate";
}
else
{
    echo "not_duplicate";
}
mysqli_free_result($query_retrived);
}
?>
