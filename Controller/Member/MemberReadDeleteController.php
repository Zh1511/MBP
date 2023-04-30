
<?php
session_start();
require_once('../../Config/Api.php');
require_once('../../Config/Lists.php');


function can($permission_code)
{
    $sql = "SELECT * FROM role_permission WHERE
    permission_code = '$permission_code' AND    
    status = '1' AND
    role_id IN (SELECT role_id from user_role WHERE user_id = '".$_SESSION['adminid']."')";

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $result = $conn->query($sql);
    $id = '';
    if ($row = $result->fetch_object()){
        $id = $row->id;
    }
    else{
        $id = null;
    }

    if($id == null && $id == ''){
        return false;
    }
    else 
    {
        return true;
    }
}

$output = '';

if(isset($_GET['action'])){
	$action = $_GET['action'];
}else
{
    $action = 'fetch';
}

if($action == 'fetch'){

    
    $sql = "SELECT * FROM member ";
    
    $query = mysqli_query($conn, $sql);
    if(!can('member.delete') && !can('member.edit'))
    {
        $output .= '
        <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th style="text-align:center">Gender</th>
                        <th style="text-align:center">Status</th>
                    </tr>
                </thead>
                <tbody>        
        ';
    }
    else {
        $output .= '
        <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th style="text-align:center">Gender</th>
                        <th style="text-align:center">Status</th>
                        <th style="text-align:center">Options</th>
                    </tr>
                </thead>
                <tbody>        
        ';
    }

    if($query->num_rows > 0){


        while($row = $query->fetch_assoc())
        {
            if(can('member.delete') && can('member.edit'))
            {
                $output .= '
                <tr>
                    <td>'.checkEmpty($row["id"]).'</td>
                    <td>'.checkEmpty($row["full_name"]).'</td>
                    <td>'.checkEmpty($row["email"]).'</td>
                    <td align=center>'. genderIcon($row["gender"]).'</td>
                    <td align=center>'.statusIcon($row["enable_login"]).'</td>
                    <td class="d-flex justify-content-around">
                        <a href="EditMember.php?id='.$row["id"].'"><span class="bx bx-edit" title="Edit" style="font-size:35px;color:#50f952;"></span></a>
                        <span class="bx bx-trash delete_product" title="Delete" style="font-size:35px;color:#ff0000;cursor: pointer;" data-id="'.$row['id'].'"></span>
                    </td>
                </tr>
                ';
            }
            else if(can('member.delete') && !can('member.edit'))
            {
                $output .= '
                <tr>
                    <td>'.checkEmpty($row["id"]).'</td>
                    <td>'.checkEmpty($row["full_name"]).'</td>
                    <td>'.checkEmpty($row["email"]).'</td>
                    <td align=center>'. genderIcon($row["gender"]).'</td>
                    <td align=center>'.statusIcon($row["enable_login"]).'</td>
                    <td class="d-flex justify-content-around">
                        <span class="bx bx-trash delete_product" title="Delete" style="font-size:35px;color:#ff0000;cursor: pointer;" data-id="'.$row['id'].'"></span>
                    </td>
                </tr>
                ';
            }
            else if(!can('member.delete') && can('member.edit'))
            {
                $output .= '
                <tr>
                    <td>'.checkEmpty($row["id"]).'</td>
                    <td>'.checkEmpty($row["full_name"]).'</td>
                    <td>'.checkEmpty($row["email"]).'</td>
                    <td align=center>'. genderIcon($row["gender"]).'</td>
                    <td align=center>'.statusIcon($row["enable_login"]).'</td>
                    <td class="d-flex justify-content-around">
                    <a href="EditMember.php?id='.$row["id"].'"><span class="bx bx-edit" title="Edit" style="font-size:35px;color:#50f952;"></span></a>
                    </td>
                </tr>
                ';
            }
            else
            {
                $output .= '
                <tr>
                    <td>'.checkEmpty($row["id"]).'</td>
                    <td>'.checkEmpty($row["full_name"]).'</td>
                    <td>'.checkEmpty($row["email"]).'</td>
                    <td align=center>'. genderIcon($row["gender"]).'</td>
                    <td align=center>'.statusIcon($row["enable_login"]).'</td>
                </tr>
                ';
            }

        }
    }
    else
    {
        $output .= '
        <tr>
            <td align=center>No Data available</td>

        </tr>
        ';
    }

    $output .= '
        </tbody>
    </table>
    ';

    echo $output;
}

if($action == 'delete'){
    $id = $_POST['id'];
    $output = array();
    $sql = "DELETE FROM member WHERE id = '$id'";
    if(!$conn->query($sql)){
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in deleting the member';

    }
    else{
        $output['status'] = 'success';
        $output['message'] = 'Member deleted successfully';
    }

    echo json_encode($output);
}

if($action == 'edit')
{
    $id=$_POST["id"];
    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $gender=$_POST["gender"];
    $student_id=$_POST["student_id"];
    $ic_no=$_POST["ic_no"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $enable_login=$_POST["enable_login"];

    $output = array();
    $sql="UPDATE member SET full_name='$name', nric_no = '$ic_no', phone_no = '$phone',
    student_id = '$student_id', email = '$email', gender = '$gender', home_address = '$address',
    enable_login = '$enable_login' WHERE id='$id'" ;
    if($conn->query($sql) == TRUE){
        $output['status'] = 'success';
        $output['message'] = 'Member updated successfully';
    }
    else{
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in updating the member';
    }
    echo json_encode($output);
}

if($action == 'changePWD')
{
    $id=$_POST["id"];
    $pwd=$_POST["pwd"];

    $output = array();
    $sql="UPDATE member SET pwd = '$pwd'  WHERE id='$id'";

    if($conn->query($sql) == TRUE){
        $output['status'] = 'success';
        $output['message'] = 'Password updated successfully';
    }
    else{
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in updating the password';
    }
    echo json_encode($output);
}

if($action == 'add')
{
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:m:s");
    $name = htmlspecialchars(trim($_POST['full_name']));
    $ic = (isset($_POST['ic'])) ? htmlspecialchars(trim($_POST['ic'])) : null;
    $phone = htmlspecialchars(trim($_POST['phone']));
    $student_id = htmlspecialchars(trim($_POST['student_id']));
    $email = htmlspecialchars(trim($_POST['email']));
    $gender = (isset($_POST['gender'])) ? $_POST['gender'] : null;

    $address = (isset($_POST['address'])) ? htmlspecialchars(trim($_POST['address'])) : null;
    $pwd = htmlspecialchars(trim($_POST['password']));
    $status = (isset($_POST['enable_login'])) ? $_POST['enable_login'] : null;

    $sql = "INSERT INTO member (full_name, nric_no, phone_no, student_id, email, gender, home_address, enable_login, pwd, created_at)
    VALUES ('$name', '$ic', '$phone', '$student_id', '$email', '$gender', '$address', '$status', '$pwd', '$date')";
    $result = '0';

    if ($conn->query($sql) === TRUE) {
        $result = '1';
        echo trim($result); 

    } else {
        $result = '0';
        echo trim($result);
    }
}

?>