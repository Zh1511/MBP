<?php
session_start();
require_once('../../Config/Api.php');
require_once('../../Config/Lists.php');

function can($permission_code)
{
    $sql = "SELECT * FROM role_permission WHERE
    permission_code = '$permission_code' AND    
    status = '1' AND
    role_id IN (SELECT role_id from user_role WHERE user_id = '".$_SESSION['id']."')";

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

//Fetch Limit Data Code
$limit = 10;
$page = 0;
$output = '';
if(isset($_POST["page"]))
{
    $page = $_POST["page"];
}
else
{
    $page = 1;
}

if(isset($_GET['action'])){
	$action = $_GET['action'];
}else
{
    $action = 'fetch';
}


if($action == 'fetch'){
    $start_from = ($page - 1)* $limit;
    $sql = "SELECT * FROM roles LIMIT $start_from, $limit";
    $query = mysqli_query($conn, $sql);



        $output .= '
        <table class="table table-sm table-striped table-hover table-bordered">
            <thead>
                <th class="fit px-2">#</th>
                <th>Title</th>
                <th class="fit">Status</th>
                <th class="fit">Options</th>
            </thead>
            <tbody>        
        ';

    if($query->num_rows > 0)
    {
        while($row = $query->fetch_assoc())
        {               
                $output .= '
                <tr>
                    <td align=center>'.checkEmpty($row["id"]).'</td> 
                    <td>'.checkEmpty($row["title"]).'</td>
                    <td align=center>'.statusIcon($row["status"]).'</td>
                    <td align=center>
                        <span class="bx bx-edit delete_edit" title="Edit" style="font-size:25px;colo    r:#0f0048;cursor: pointer;" data-id="'.$row['id'].'"></span>
                    </td>
                </tr>
                ';
        }
    }
    else
    {
        $output .= '
        <tr>
            <td colspan=6 align=center>No Data available</td>
        </tr>
        ';
    }

    $output .= '
        </tbody>
    </table>
    ';

    //Pagination Code
    $query = mysqli_query($conn, "SELECT * from roles");
    $total_records = mysqli_num_rows($query);
    $total_pages =  ceil($total_records/$limit);
    $output .= '<ul class="pagination">';

    if($page > 1)
    {
        $previous = $page - 1;
        $output .= '<li class="page-item" id="1"><span class="page-link" style="cursor:pointer;">First Page</span></li>';
        $output .= '<li class="page-item" id="'.$previous.'"><span class="page-link" style="cursor:pointer;">Previous</span></li>';
    }

    for($i=1; $i<$total_pages; $i++)
    {
            $active_class = "";
            if($i == $page)
            {
                $active_class = "active";
            }

            $output .= '<li class="page-item '.$active_class.'" id="'.$i.'"><span class="page-link" style="cursor:pointer;">'.$i.'</span></li>';
    }

    if($page < $total_pages)
    {
        $page++;
        $output .= '<li class="page-item" id="'.$page.'"><span class="page-link" style="cursor:pointer;">Next</span></li>';
        $output .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link" style="cursor:pointer;">Last Page</span></li>';
    }

    $output .= '</ul>';
    echo $output;
}

if($action == 'delete'){
    $id = $_POST['id'];
    $output = array();
    $sql = "DELETE FROM user WHERE id = '$id'";
    if($conn->query($sql)){
        $output['status'] = 'success';
        $output['message'] = 'User deleted successfully';
    }
    else{
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in deleting the user';
    }

    echo json_encode($output);
}

?>