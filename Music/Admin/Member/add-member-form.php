<?php
session_start();
require_once('../Config/Api.php');
if (strlen($_SESSION['adminid']==0)) {
    header('location:../logout.php');
}
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Add Member</title>
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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" />
    <style>
    .swal2-title {
        font-weight: 100 !important;
    }
    </style>
</head>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php 
        include_once('../Menu/navbarV2.php');
        include_once('../Menu/sidebar.php');
        // require_once('../Controller/Member/MemberAddEditController.php');
        require_once('../FunctionFile.php');
        require_once('../Config/Lists.php');
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Member</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../Dashboard/dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="manage-member.php">Manage Member</a></li>
                                <li class="breadcrumb-item active">Add Member</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div id="message"></div>
                    <?php
                        // if(isset($success)){
                        //     echo '<div class="alert alert-success">'.$success.'</div>';
                        //     echo"<script>
                        //             Swal.fire({
                        //             icon: 'success',
                        //             title: 'Your work has been saved',
                        //             showConfirmButton: true,
                                    
                        //         })
                        //     </script>";
                        // }elseif(isset($error))
                        // {
                        //     echo '<div class="alert alert-danger">'.$error.'</div>';
                        //     echo"<script>
                        //             Swal.fire({
                        //             icon: 'error',
                        //             title: 'Oops...',
                        //             text: 'Something went wrong!',
                        //             showConfirmButton: true,
                        //         })
                        //     </script>";
                        // }
                    ?>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Fill the Info</h3>
                                </div>
                                <form method="post" id="swaForm">
                                    <?php
                                        $rand=rand();
                                        $_SESSION['rand']=$rand;
                                    ?>
                                    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                                    <div class="card-body">
                                        <div class="row my-2">
                                            <label for="full_name" class="col-md-3">Full Name<span class="text-danger">
                                                    *</span></label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlInputType('text', 'full_name', 'Name', '', 'form-control', '255')
                                                ?>
                                                <span id="full_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <label for="phone" class="col-md-3">Phone<span class="text-danger">
                                                    *</span></label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlInputType('text', 'phone', 'Mobile No', '', 'form-control', '15')
                                                ?>
                                                <span id="phone_err"></span>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <label for="gender" class="col-md-3">Gender</label>
                                            <div class="col-md-9">
                                                <?php
                                                secondHtmlSelect('gender', lists_gender(), 'form-control', '', '-- Select a gender --');
                                            ?>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <label for="student_id" class="col-md-3">Student ID<span
                                                    class="text-danger">
                                                    *</span></label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlInputType('text', 'student_id', 'Student ID', '', 'form-control', '10')
                                                ?>
                                                <span id="student_id_err"></span>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <label for="ic" class=" col-md-3">NRIC No<span class="text-danger">
                                                    *</span></label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlInputType('text', 'ic', 'NRIC No (-)', '', 'form-control', '14');
                                                ?>
                                                <span id="ic_err"></span>
                                            </div>

                                        </div>
                                        <div class="row my-2">
                                            <label for="email" class="col-md-3">Email<span class="text-danger">
                                                    *</span></label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlInputType('email', 'email', 'Email', '', 'form-control', '255')
                                                ?>
                                                <span id="email_err"></span>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <label for="address" class="col-md-3">Home Address</label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlTextarea('address', 'Home Address', 'form-control', '')
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <label for="password" class="col-md-3">Password<span class="text-danger">
                                                    *</span></label>
                                            <div class="col-md-9">
                                                <?php
                                                htmlInputType('password', 'password', 'Password', '', 'form-control', '20');
                                                ?>
                                                <span id="password_err"></span>
                                            </div>
                                        </div>

                                        <div class="row my-2">
                                            <label for="enable_login" class="col-md-3">Enable Login</label>
                                            <div class="col-md-9">
                                                <div class="icheck-primary d-inline">
                                                    <?php
                                                        htmlCheckBox2('enable_login', '','');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="float-right">
                                            <a href="manage-member.php" class="btn btn-secondary">Back</a>
                                            <button type="button" id="submitbtn" name="add"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- AdminLTE APP -->
            <script src="../dist/js/adminlte.js"></script>
            <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {



    $('#full_name').on('input', function() {
        checkUser();
    });

    $('#phone').on('input', function() {
        checkPhone();
    });

    $('#student_id').on('input', function() {
        checkStudentId();
    });

    $('#ic').on('input', function() {
        checkIc();
    });
    $('#email').on('input', function() {
        checkEmail();
    });
    $('#password').on('input', function() {
        checkPassword();
    });


    $('#submitbtn').click(function() {


        if (!checkUser() && !checkPhone() && !checkStudentId() && !checkIc() && !checkEmail() && checkPassword()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                showConfirmButton: true,
            });
        } else if (!checkUser() || !checkPhone() || !checkStudentId() || !checkEmail() || !checkPassword()) {
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                showConfirmButton: true,
            });
            console.log("er");
        } else {
            console.log("ok");
            $("#message").html("");
            var form = $('#swaForm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "../Controller/Member/MemberReadDeleteController.php?action=add",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: true,
                        }).then((result) => {
                            // Reload the Page
                            location.reload();
                        });
                    }
                },
            });
        }
    });



    // $("#phone").change(function(event) {
    //     var phone = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "../ValidateForm.php?action=phone",
    //         data: "phone=" + phone,
    //         cache: false,
    //         success: function(html) {
    //             if(html == 1){
    //                 $("#phone_err").html("Duplicate Phone Number Found").removeClass("success").addClass("error");
    //                 $("#phone").removeClass("valid").addClass("invalid");
    //                 $('#submitbtn').prop('disabled', true);
    //             }else {
    //                 console.log('oi');
    //                 $("#phone_err").html(" ");
    //             }   
    //         }
    //     });
    // });

    // $("#ic").change(function(event) {
    //     var ic = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "../ValidateForm.php?action=ic",
    //         data: "ic=" + ic,
    //         cache: false,
    //         success: function(html) {
    //             if(html == 1){
    //                 $("#ic_err").html("Duplicate IC Found").removeClass("success").addClass("error");
    //                 $("#ic").removeClass("valid").addClass("invalid");
    //                 $('#submitbtn').prop('disabled', true);
    //             }
    //         }
    //     });
    // });
    // $("#email").change(function(event) {
    //     var email = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "../ValidateForm.php?action=email",
    //         data: "email=" + email,
    //         cache: false,
    //         success: function(html) {
    //             if(html == 1){
    //                 $("#email_err").html("Duplicate Email Found").removeClass("success").addClass("error");
    //                 $("#email").removeClass("valid").addClass("invalid");
    //                 $('#submitbtn').prop('disabled', true);
    //             }
    //         }
    //     });
    // });
});

function checkUser() {
    var pattern = /^[A-Za-z0-9 ]+$/;
    var user = $("#full_name").val();
    var validuser = pattern.test(user);
    if (user == "") {
        $("#full_name_err").html("This field is required").removeClass("success").addClass("error");
        $("#full_name").removeClass("valid").addClass("invalid");
        return false;
    } else if ($("#full_name").val().length < 4) {
        $("#full_name_err").html('Name should be at least 3 characters').removeClass("success").addClass("error");
        $("#full_name").removeClass("valid").addClass("invalid");
        return false;
    } else if (!validuser) {
        $("#full_name_err").html('Name should be a-z ,A-Z only').removeClass("success").addClass("error");
        $("#full_name").removeClass("valid").addClass("invalid");
        return false;
    } else {
        $("#full_name_err").html("Valid").removeClass("error").addClass("success");
        $("#full_name").removeClass("invalid").addClass("valid");
        return true;
    }
}

function checkPhone() {
    var pattern = /^(01)[0-9][-][0-9]{3,4}\s[0-9]{4}$/;
    var phone = $("#phone").val();
    var validPhone = pattern.test(phone);

    if (phone == "") {
        $("#phone_err").html("This field is required").removeClass("success").addClass("error");
        $("#phone").removeClass("valid").addClass("invalid");
        return false;
    } else if (!validPhone) {
        $("#phone_err").html('The Phone No. should be in the format: XXX-XXX XXXX').removeClass("success").addClass(
            "error");
        $("#phone").removeClass("valid").addClass("invalid");
        return false;
    } else {
        $("#phone_err").html("Valid").removeClass("error").addClass("success");
        $("#phone").removeClass("invalid").addClass("valid");
        return true;
    }
}


function checkStudentId() {
    var pattern = /^[0-9]{2}[A-Z]{3}[0-9]{5}$/;
    var student_id = $("#student_id").val();
    var validStudentID = pattern.test(student_id);

    if (student_id == "") {
        $("#student_id_err").html("This field is required").removeClass("success").addClass("error");
        $("#student_id").removeClass("valid").addClass("invalid");
        return false;
    } else if (!validStudentID) {
        $("#student_id_err").html("Please specify a valid Student ID").removeClass("success").addClass("error");
        $("#student_id").removeClass("valid").addClass("invalid");
        return false;
    } else {
        $("#student_id_err").html("Valid").removeClass("error").addClass("success");
        $("#student_id").removeClass("invalid").addClass("valid");
        return true;
    }
}



function checkIc() {
    var pattern = /^[0-9]{6}[-]((0[1-9])|(1[0-9])|(2[0-9])|(3[0-9])|(4[0-9])|(5[0-9]))[-][0-9]{4}$/;
    var ic = $("#ic").val();
    var validateIc = pattern.test(ic);

    if (!validateIc) {
        $('#ic_err').html("The IC No. should be in the format: XXXXXX-XX-XXXX").removeClass("success").addClass(
            "error");
        $("#ic").removeClass("valid").addClass("invalid");
        return false;
    } else {
        $("#ic_err").html("Valid").removeClass("error").addClass("success");
        $("#ic").removeClass("invalid").addClass("valid");
        return true;
    }
}

function checkEmail() {
    var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var email = $("#email").val();
    var validateIc = pattern.test(email);

    if (email == "") {
        $('#email_err').html("This field is required").removeClass("success").addClass("error");
        $("#email").removeClass("valid").addClass("invalid");
        return false;
    } else if (!validateIc) {
        $('#email_err').html("The email should be in the format: abc@domain.tld").removeClass("success").addClass(
            "error");
        $("#email").removeClass("valid").addClass("invalid");
        return false;
    } else {
        $("#email_err").html("Valid").removeClass("error").addClass("success");
        $("#email").removeClass("invalid").addClass("valid");
        return true;
    }
}

function checkPassword() {
    var pattern = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    var password = $("#password").val();
    var validatePassword = pattern.test(password);

    if (email == "") {
        $("#password_err").html("This field is required").removeClass("success").addClass("error");
        $("#password").removeClass("valid").addClass("invalid");
        return false;
    } else if (!validatePassword) {
        $("#password_err").html(
            "The password should minimum contain eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:"
        ).removeClass("success").addClass("error");
        $("#password").removeClass("valid").addClass("invalid");
        return false;
    } else {
        $("#password_err").html("Valid").removeClass("error").addClass("success");
        $("#password").removeClass("invalid").addClass("valid");
        return true;
    }
}
</script>

</html>