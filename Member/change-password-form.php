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

</head>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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
                            <h1>Reset Member Password</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../Dashboard/dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="manage-member.php">Manage Member</a></li>
                                <li class="breadcrumb-item active">Reset Member Password</li>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Fill the Info</h3>
                                </div>
                                <?php
                                    htmlFormStart('#','post','swaForm')
                                ?>
                                <div class="card-body">
                                    <?php
                                        htmlInputType('hidden', 'id', '', $id, '', '')
                                    ?>
                                    <div class="row my-2">
                                        <label for="password" class="col-md-3">Password<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <?php
                                                htmlInputType('password', 'pwd', 'Password', '', 'form-control', '255')
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <label for="confirm_password" class="col-md-3">Confirm Password<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <?php
                                                htmlInputType('password', 'confirm_pwd', 'Confirm Password', '', 'form-control', '15')
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <a href="manage-member.php" class="btn btn-secondary">Back</a>
                                        <button type="button" id="update" class="btn btn-primary">Submit</button>
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

        <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        $(document).ready(function() {

            "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"

            
            $.validator.addMethod("validatePassword", function(pwd, element) {
                return this.optional(element) || pwd.length > 7 &&
                pwd.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/);
            }, "The password should contain minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:");


            $("#swaForm").validate({
                rules: {
                    pwd: {
                        required: true,
                        minlength: 8,
                        validatePassword:true,
                    },
                    confirm_pwd: {
                        required: true,
                        equalTo: "#pwd",
                    },
                },
                messages: {
                    pwd: {
                        required: "This field is required",
                        minlength: "Password should be at least 8 characters",
                    },
                    confirm_pwd: {
                        required: "This field is required",
                        equalTo: "Password not matched"
                    },
                }
            });

        });




        $("#update").click(function(event) {

            var id = $("#id").val();
            var pwd = $("#pwd").val();

            $.ajax({
                url: '../Controller/Member/MemberReadDeleteController.php?action=changePWD',
                method: 'POST',
                data: {
                    id: id,
                    pwd: pwd,
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
                    });
                },
            });

        });
        </script>

    </div>
</body>

</html>