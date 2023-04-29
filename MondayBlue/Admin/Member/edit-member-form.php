<?php
session_start();
require_once('../Config/Api.php');
if (strlen($_SESSION['adminid']==0)) {
    header('location:../logout.php');
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Member</title>
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Styling -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Css/Custom.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"/>
</head>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Jquery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php 
        include_once('../Menu/navbarV2.php');
        include_once('../Menu/sidebar.php');
        require_once('../FunctionFile.php');
        require_once('../Controller/Member/MemberAddEditController.php');
        require_once('../Config/Lists.php');

        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $id = strtoupper(trim($_GET['id']));
            $sql = "SELECT * FROM member WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($row = $result->fetch_object())
            {
                $id = $row->id;
                $full_name = $row->full_name;
                $nric_no = $row->nric_no;
                $phone_no = $row->phone_no;
                $student_id = $row->student_id;
                $email = $row->email;
                $gender = $row->gender;
                $home_address= $row->home_address;
                $enable_login = $row->enable_login;
            }   
            $result->free();
            $conn->close();
        }
    ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>View member : <?php echo $full_name ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../Dashboard/dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="manage-member.php">Manage Member</a></li>
                                <li class="breadcrumb-item active">Edit Member</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div style="display: none;" id="success" class="alert alert-success">
                        Record Updated successfully
                    </div>
                    <div style="display: none;" id="fail" class="alert alert-danger">
                        Record Not Updated
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            htmlFormStart('#','post','myForm');
                        ?>
                            <!-- Personal Details -->
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="pill" href="#pills-personal">Edit
                                                Customer</a>
                                        </li>
                                    </ul>
                                    <div class="card">
                                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
                                            <div class="card-title"><h3>Personal Detail</h3></div>
                                            <div class="card-tools pt-2">
                                                <input type="checkbox" name="my-checkbox"  checked data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Show" data-off-text="Hide">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php
                                                    htmlInputType('hidden', 'id', '', $id, '', '')
                                                ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="salutation">Salutation</label>
                                                        <?php
                                                            htmlSelect('salutation', lists_salutation(), 'form-control', '', '-- Select a salutation --');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="full_name">Full Name<span class="text-danger">*</span></label>
                                                        <?php
                                                            $full_name = (isset($full_name))? $full_name : '';
                                                            htmlInputType('text', 'full_name', 'Name', $full_name, 'form-control', '255')
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Gender<span class="text-danger">*</span></label>
                                                        <?php
                                                            $gender = (isset($gender))? $gender : '';
                                                            htmlSelect('gender', lists_gender(), 'form-control', $gender, '-- Select a gender --');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ic">IC</label>
                                                        <?php
                                                            $nric_no = (isset($nric_no))? $nric_no : '';
                                                            htmlInputType('text', 'ic', 'NRIC No (-)', $nric_no, 'form-control', '14');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passport">Passport</label>
                                                        <?php
                                                        
                                                            htmlInputType('text', 'passport', 'Passport', '', 'form-control', '');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nationality">Nationality</label>
                                                        <?php
                                                        
                                                            htmlSelect('nationality', list_nationality(), 'form-control', '', '-- Select a nationality --');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nationality">Marital Status</label>
                                                        <?php
                                                        
                                                            htmlSelect('martial_status', martial_status(), 'form-control', '', '-- Select a status --');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="education_level">Education Level</label>
                                                        <?php
                                                        
                                                            htmlInputType('text', 'education_level', 'Education Level', '', 'form-control', '');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_address">Home Address</label>
                                                        <?php
                                                            $home_address = (isset($home_address))? $home_address : '';
                                                            htmlTextarea('address', 'Home Address', 'form-control', $home_address)
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email<span class="text-danger">*</span></label>
                                                        <?php
                                                            $email = (isset($email))? $email : '';
                                                            htmlInputType('text', 'email', 'Email', $email, 'form-control', '');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="student_id">Student ID<span class="text-danger">*</span></label>
                                                        <?php
                                                            $student_id = (isset($student_id))? $student_id : '';
                                                            htmlInputType('text', 'student_id', 'Student ID', $student_id, 'form-control', '10');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="house_phone_no">House Telephone Number</label>
                                                        <?php
                                                            htmlInputType('text', 'house_phone_no', 'House Telephone Number', '', 'form-control', '');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Mobile Number</label>
                                                        <?php
                                                            $phone_no = (isset($phone_no))? $phone_no : '';
                                                            htmlInputType('text', 'phone', 'XXX-XXX XXXX', $phone_no, 'form-control', '15')                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="residential_address">Residential Address</label>
                                                        <?php
                                                             htmlTextarea('residential_address', 'Residential Address', 'form-control', '');
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="study_year">Year of Studying</label>
                                                        <?php

                                                            htmlInputType('text', 'study_year', 'Year of Studying', '', 'form-control', '')
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="residential_status">Residential Status</label>
                                                        <?php

                                                            htmlInputType('text', 'residential_status', 'Residential Status', '', 'form-control', '') 
                                                        ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mailing_address">Mailing Address</label>
                                                        <?php

                                                            htmlInputType('text', 'mailing_address', 'Mailing Address', '', 'form-control', '') 
                                                        ?>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <?php
                                                                $enable_login = (isset($enable_login))? $enable_login : '';
                                                                htmlCheckBox2('enable_login', $enable_login,'Enable Login');
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END OF Personal Details -->

                                    <!-- Employment Details -->
                                    <div class="card">
                                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
                                            <h3>Employment Details</h3>
                                        </div>
                                        <div class="card-body collapse">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Occupation</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Working Period</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name Of Employer</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Address Of Employer</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nature of Business</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Company Telephone Number</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END OF Employment Details -->

                                    <!-- Spouse Details -->
                                    <div class="card">
                                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
                                            <h3>Spouse Details</h3>
                                        </div>
                                        <div class="card-body collapse">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name of Spouse</label>
                                                    <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mobile No</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Occupation</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Working Period</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name of Employer</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Of Employer</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nature Of Business</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Company Phone No.</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END OF Spouse Details -->

                                    <!-- Emergency Contact -->
                                    <div class="card">
                                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
                                            <h3>Emergency Contact (Except Spouse)</h3>
                                        </div>
                                        <div  class="card-body collapse">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Relationship</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mobile No</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END OF Emergency Contact -->
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <a href="manage-member.php" class="btn btn-secondary">Back</a>
                                        <button type="submit" id="update" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- AdminLTE APP -->
        <script src="../dist/js/adminlte.js"></script>  
        <!-- Jquery Form Validation -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>        <script>
        var prevent_default = 0;

        $.validator.addMethod("phoneMY", function(phone_number, element) {
            phone_number = phone_number.replace(/\(|\)/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(01)[0-9][-][0-9]{3,4}\s[0-9]{4}$/);
        }, "The Phone No. should be in the format: XXX-XXX XXXX");

        $.validator.addMethod("tarStudentID", function(student_id, element) {
            student_id = student_id.replace(/\(|\)|\s+|-/g, "");
            return this.optional(element) || student_id.length > 9 &&
                student_id.match(/[0-9]{2}[A-Z]{3}[0-9]{5}/);
        }, "Please specify a valid Student ID.");

        $.validator.addMethod("icMY", function(ic_no, element) {
            ic_no = ic_no.replace(/\(|\)|\s+/g, "");
            return this.optional(element) || ic_no.length > 13 &&
                ic_no.match(
                    /[0-9]{6}[-]((0[1-9])|(1[0-9])|(2[0-9])|(3[0-9])|(4[0-9])|(5[0-9]))[-][0-9]{4}/
                );
        }, "The IC No. should be in the format: XXXXXX-XX-XXXX");

        var $updateForm = $('#myForm');
        if ($updateForm.length) {
            $updateForm.validate({
                rules: {
                    full_name: {
                        required: true,
                        minlength: 3
                    },
                    phone: {
                        required: true,
                        phoneMY: true
                    },
                    student_id: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        tarStudentID: true
                    },
                    ic: {
                        minlength: 14,
                        maxlength: 14,
                        icMY: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    full_name: {
                        required: "This field is required",
                        minlength: "Name should be at least 3 characters"
                    },
                    phone: {
                        required: "This field is required"
                    },
                    student_id: {
                        required: "This field is required",
                        minlength: "Student ID should be at least 10 characters",
                        maxlength: "Student ID should be completely 10 characters"
                    },
                    ic: {
                        minlength: "IC should be at least 14 characters",
                        maxlength: "IC should be at least 14 characters"
                    },
                    email: {
                        required: "This field is required",
                        email: "The email should be in the format: abc@domain.tld"
                    },
                },
            });
        }
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $(document).ready(function() {

            $("#student_id").change(function(event) {
                var student_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../ValidateForm.php",
                    data: "student_id=" + student_id,
                    cache: false,
                    success: function(html) {
                        //alert(html);
                        if (html == 1) {
                            $("#student_id").addClass("fail");
                            $("#id_duplicate").show();
                            $('#update').prop('disabled', true);
                        } else {
                            $("#student_id").removeClass("fail");
                            prevent_default = 0;
                            $("#id_duplicate").hide();
                        }
                    }
                });
            });



            $("#update").click(function(event) {

                var id = $("#id").val();
                var name = $("#full_name").val();
                var phone = $("#phone").val();
                var gender = $("#gender").val();
                var student_id = $("#student_id").val();
                var ic_no = $("#ic").val();
                var email = $("#email").val();
                var address = $("#address").val();
                var enable_login = $("#enable_login").val();

                $.ajax({
                    url: '../Controller/Member/MemberReadDeleteController.php?action=edit',
                    method: 'POST',
                    data: {
                        id: id,
                        name: name,
                        phone: phone,
                        gender: gender,
                        student_id: student_id,
                        ic_no: ic_no,
                        email: email,
                        address: address,
                        enable_login: enable_login,
                    },
                    success: function(response) {
                        var json = $.parseJSON(response);
                        if (json.status == 'success') {
                            $("#success").removeAttr("style");
                        } else {
                            $("#fail").removeAttr("style");
                        }
                        Swal.fire({
                            icon: json.status,
                            title: json.message,
                            showConfirmButton: true,
                        }).then((result) => {
                            // Reload the Page
                            location.reload();
                        });
                    },
                });
            });
        });



        // $("#select-daily-filter").change(function() {
        // 		var filter = $(this).val();
        // 		$.ajax({	
        // 			url: "{{route('ajax.userDailyRegistration')}}", 
        // 			type: 'POST',
        // 			data: {
        // 				filter :  filter,
        // 				_token: '{{ csrf_token() }}',
        // 			},

        // 			success: function(response)
        // 			{
        // 				var registrationArray = response.MainAllDailyRegistration;
        // 				var registrationLabelArray = [];
        // 				var registrationDataArray = [];
        // 				$.each(registrationArray, function(key, value) {
        // 					registrationLabelArray.push(key);
        // 					registrationDataArray.push(value);
        // 				});

        // 				updateChart(daily_registration_chart,registrationLabelArray,registrationDataArray);
        // 			},
        // 			error: function(response)
        // 			{
        // 				console.log(response);
        // 			}
        // 		});
        // 	});

        // $(function() {
        //     $('#select-daily-filter').daterangepicker({
        //         opens: 'left'
        //     }).change(function(start, end, label) {
        //         var startDate = start.format('YYYY-MM-DD');
        //         var endDate = end.format('YYYY-MM-DD');
        //         $.ajax({
        //             url: "{{route('ajax.userDailyRegistration')}}",
        //             type: 'POST',
        //             data: {
        //                 startDate: startDate,
        //                 endDate: endDate,
        //                 _token: '{{ csrf_token() }}',
        //             },

        //             success: function(response) {
        //                 var registrationArray = response.MainAllDailyRegistration;
        //                 var registrationLabelArray = [];
        //                 var registrationDataArray = [];
        //                 $.each(registrationArray, function(key, value) {
        //                     registrationLabelArray.push(key);
        //                     registrationDataArray.push(value);
        //                 });

        //                 updateChart(daily_registration_chart, registrationLabelArray,
        //                     registrationDataArray);
        //             },
        //             error: function(response) {
        //                 console.log(response);
        //             }
        //         });
        //     });
        // });
        </script>


</body>

</html>