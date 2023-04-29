<?php
//connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'music_society');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if(isset($_GET['action'])){
	$action = $_GET['action'];
}
else
{
    $action = 'fetch';
}


if($action == 'fetch'){
	$output = '';
	$sql = "SELECT * FROM member";
	$query = $conn->query($sql);
	$cnt=1;
	while($row = $query->fetch_assoc()){
		$output .= "
		<tr>
		<td>". $cnt."</td>
		<td>".$row['full_name']."</td>
		<td>".$row['nric_no']."</td>
		<td>".$row['phone_no']."</td>
		<td><span class='btn btn-sm btn-danger delete_product' data-id='".$row['id']."'>Delete</span></td>
		</tr>
		";
		$cnt=$cnt+1;
	}

	echo json_encode($output);
}

if($action == 'delete'){
	$id = $_POST['id'];
	$output = array();
	$sql = "DELETE FROM member WHERE id = '$id'";
	if($conn->query($sql)){
		$output['status'] = 'success';
		$output['message'] = 'Member deleted successfully';
	}
	else{
		$output['status'] = 'error';
		$output['message'] = 'Something went wrong in deleting the member';
	}

	echo json_encode($output);

} ?>