<?php
    header("Content-Type: application/json");   
    require_once('../Config/Api.php');
    require_once('../Config/Lists.php');
    $filter=$_POST["filter"];
    $output = array();

    if ($filter == 'CurrentYear')
    {
        $sql = "SELECT COUNT(id) AS sum, DATE_FORMAT(created_at,'%m') AS created_month FROM member 
        WHERE YEAR(created_at) = (YEAR(CURRENT_DATE()))
        GROUP BY created_month ";
    }
    elseif($filter == 'LastYear')
    {
        $sql = "SELECT COUNT(id) AS sum, DATE_FORMAT(created_at,'%m') AS created_month FROM member 
        WHERE YEAR(created_at) = (YEAR(CURRENT_DATE()) - 1)
        GROUP BY created_month ";
    }
    elseif($filter == 'Last2Year')
    {
        $sql = "SELECT COUNT(id) AS sum, DATE_FORMAT(created_at,'%m') AS created_month FROM member 
        WHERE YEAR(created_at) = (YEAR(CURRENT_DATE()) - 2)
        GROUP BY created_month ";
    }
    else{
        $sql = "SELECT COUNT(id) AS sum, DATE_FORMAT(created_at,'%m') AS created_month FROM member 
        WHERE YEAR(created_at) = (YEAR(CURRENT_DATE()) - 3)
        GROUP BY created_month ";

    }
    $result = $conn->query($sql);
    

    $info1 = [];
    $info2 = [];
    $info3 = [];

    while($row = mysqli_fetch_array($result)){
        $info1[] = $row['created_month'];
        $info2[] = $row['sum'];
    }


    
    
    foreach ($info1 as $value) {
        $info3[] = returnMonth($value);
    }


    $data1 = implode(', ', $info2);
    $data2  = implode(', ', $info3);

    $output['data1'] = $data1; 
    $output['data2'] = $data2;

    echo json_encode($output);

    // $data1 = implode(', ', $info2);
    // $data2 = implode(', ', $info3);



    

