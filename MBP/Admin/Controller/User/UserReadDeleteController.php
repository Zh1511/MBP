<?php
session_start();
require_once('../../Config/Api.php');
require_once('../../Config/Lists.php');


$action = $_GET['action'];

if($action == 'delete'){
    $id = $_POST['id'];
    $output = array();
    $sql = "DELETE FROM user WHERE id = '$id'";
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

?>

<!-- <script>
$(document).ready(function() {
    $('.select2').select2({
        width: '100%'
    });


    //ajax for changing the daily registration range
    $("#select-daily-filter").change(function() {
        var filter = $(this).val();
        $.ajax({
            url: "{{route('ajax.registration')}}",
            type: 'POST',
            data: {
                filter: filter,
                _token: '{{ csrf_token() }}',
            },

            success: function(response) {
                var registrationArray = response.MainAllDailyRegistration;
                var registrationLabelArray = [];
                var registrationDataArray = [];
                $.each(registrationArray, function(key, value) {
                    registrationLabelArray.push(key);
                    registrationDataArray.push(value);
                });

                updateChart(daily_registration_chart, registrationLabelArray,
                    registrationDataArray);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });




    //For daily registration line chart
    var registrationArray = {
        !!json_encode($MainAllDailyRegistration) !!
    };
    var registrationLabelArray = $.map(registrationArray, function(element, index) {
        return index
    });
    var registrationDataArray = $.map(registrationArray, function(element, index) {
        return element
    });

    var daily_registration_chart = new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: registrationLabelArray,
            datasets: [{
                data: registrationDataArray,
                label: 'Number of Registrants',
                borderColor: "#f39c12",
                fill: false
            }]
        },
        options: {
            // legend: {
            // display: false
            // }
            responsive: true,
            maintainAspectRatio: false,
        }
    });
});


$('#collapse').click(function(e) {
    daily_registration_chart.options.maintainAspectRatio = true;
    daily_registration_chart.update();
});

function updateChart(chart, label, data) {
    chart.data.labels = label
    chart.data.datasets.forEach((dataset) => {
        dataset.data = data;
    });
    chart.update();
}
</script>

<div class="box box-warning">
    <div class="box-header with-border">
        <i class="fa fa-clock-o"></i>
        <h3 class="box-title">Age Group</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="input-group input-group-sm col-md-4 col-xs-6" style="margin-bottom:20px;">
            <span class="input-group-addon chart-filter">Age Range : </span>
            {{Form::select('filter-age', array('10' => '10', '5' => '5') , '' , ['class'=>'form-control','id'=>'select-age-filter'])}}
        </div>
        <div class="age-chart">
            <canvas id="bar-chart-horizontal" width="800" height="400"></canvas>
        </div>
        <div class="age-table table-responsive">
            <table class="table">
                <tr>
                    <th>Age Range</th>
                    <th>Total</th>
                </tr>
                @foreach($MainAgeCount as $key => $age_count)
                <tr class="age-table-data">
                    <td>{{ $key }}</td>
                    <td>{{ $age_count }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div> -->