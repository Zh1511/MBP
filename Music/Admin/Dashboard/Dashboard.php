<?php
session_start();
require_once('../Config/Api.php');

if (strlen($_SESSION['adminid']==0)) {
    header('location:../logout.php');
}
else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        header('location:../logout.php');
    }
    else
    {      
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Member List</title>
    <!-- Styling -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <style>
        .bg-warning, .bg-warning>a{
            color: #fff!important;
        }
    </style>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<body class="hold-transition sidebar-mini layout-fixed">


    <?php 
        include_once('../Menu/navbarV2.php');
        include_once('../Menu/sidebar.php');


        require_once('../FunctionFile.php');
        require_once('../Config/Lists.php');
        
        $sql = "SELECT COUNT(id) AS sum, DATE_FORMAT(created_at,'%m') AS created_month FROM member
        WHERE YEAR(created_at) = (YEAR(CURRENT_DATE()))
        GROUP BY created_month ";
        $result = $conn->query($sql);


        $rows = array();

        $data1 = [];
        $data2 = [];
        $data3 = [];

        while($row = mysqli_fetch_array($result)){
            $data1[] = $row['created_month'];
            $data2[] = $row['sum'];

        }
        foreach ($data1 as $value) {
            $data3[] = returnMonthWithSingleQuote($value);
        }
        $data2 = implode(', ', $data2);
        $data3 = implode(', ', $data3);
        
    ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <?php

                                    $sql = "SELECT * FROM member";
                                    $result=mysqli_query($conn,$sql);
                                    $rowcount = mysqli_num_rows($result);
                                    printf("<h3>%d</h3>",$rowcount);
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                    ?>
                                    <p>Member</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="../Member/manage-member.php" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>

                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Agent</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="../Member/ListMember.php" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>

                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Member</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="../Member/ListMember.php" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>

                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Member</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="../Member/ListMember.php" class="small-box-footer">More info <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="container-fluid">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                Daily Registration
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="collapse show" id="dailyRegistration">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="box-body table-responsive">
                                            <div id="daily-registration-filter"
                                                class="input-group input-group-sm col-md-4">
                                                <span class="input-group-addon chart-filter">Year : &nbsp; </span>
                                                <?php
                                                    htmlSelect('filter', filterDailyRegistration(), 'form-control', '', '');
                                                ?>
                                            </div>
                                            <canvas id="myChart" style="width:100%;height:450px"></canvas>
                                            <div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
            
        </div>
    </div>
    <!-- Content Wrapper. Contains page content -->


<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- Jquery Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
$(document).ready(function() {
    //ajax for changing the daily registration range
    $("#filter").change(function() {
        var filter = $(this).val();

        $.ajax({
            url: "../Controller/UserDashboardController.php",
            type: 'POST',
            data: {
                filter: filter,
                dataType: 'json',
            },
            success: function(response) {
                var xValues = response.data2;
                xValues = xValues.split(", ");
                var yValues = response.data1;
                yValues = yValues.split(", ");
                yValues = yValues.map(function(e) {
                    return parseInt(e);
                });
                console.log(xValues);
                console.log(yValues);
                // console.log(yValues);
                updateChart(xValues, yValues);
            },
            error: function(response) {
                console.log(response);
            },
        });
    });

    var xValues = [<?php echo $data3 ?>];
    var yValues = [<?php echo $data2 ?>];
    updateChart(xValues, yValues);

    function updateChart(label, data) {
        new Chart("myChart", {
            type: "line",
            data: {
                labels: label,
                datasets: [{
                    data: data,
                    borderColor: "red",
                    label: 'Year of Registrants',
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: "Yearly User Registration"
                },
                responsive: true,
                maintainAspectRatio: true,
            }
        });
    }

})
</script>
</body>
</html>
<?php
    }
}
?>