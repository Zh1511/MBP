<?php
$con= mysqli_connect("localhost", "root", "", "music_society");

//Fetch Limit Data Code
$limit = 5;
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

$start_from = ($page - 1)* $limit;
$query = mysqli_query($con, "SELECT * from member LIMIT $start_from, $limit");
$output .= '
    <div class ="table-responsive">
        <table class="table">
            <tr>
                <th>Full Name</th>
                <th>Nric no</th>
                <th>Phone no</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Gender</th>
            </tr>
';
if(mysqli_num_rows($query) > 0)
{
    while($row = mysqli_fetch_array($query))
    {
        $output.='
            <tr>
                <td>'.ucfirst($row["full_name"]).'</td>
                <td>'.$row["nric_no"].'</td>
                <td>'.$row["phone_no"].'</td>
                <td>'.$row["student_id"].'</td>
                <td>'.$row["email"].'</td>
                <td>'.$row["gender"].'</td>
            </tr>
        ';
    }
}
else
{
    $output .= '
        <tr>
            <td>No Data Available</td>
        </tr>
    ';
}

$output .= '
    </table>
    </div>
';

//Pagination Code
$query = mysqli_query($con, "SELECT * from member");
$total_records = mysqli_num_rows($query);
$total_pages =  ceil($total_records/$limit);
$output .= '<ul class="pagination">';

if($page > 1)
{
    $previous = $page - 1;
    $output .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $output .= '<li class="page-item" id="'.$previous.'"><span class="page-link">Previous</span></li>';
}

for($i=1; $i<$total_pages; $i++)
{
        $active_class = "";
        if($i == $page)
        {
            $active_class = "active";
        }

        $output .= '<li class="page-item '.$active_class.'" id="'.$i.'"><span class="page-link">'.$i.'</span></li>';
}

if($page < $total_pages)
{
    $page++;
    $output .= '<li class="page-item" id="'.$page.'"><span class="page-link">Next</span></li>';
    $output .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
}

$output .= '</ul>';
echo $output;
?>