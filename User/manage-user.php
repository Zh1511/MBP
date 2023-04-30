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
    <title>Admin List</title>
    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css">
    <!-- Styling -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Css/Custom.css">

</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php 
        include_once('../Menu/navbarV2.php');
        include_once('../Menu/sidebar.php');
        // require_once('../Config/Helper.php');
        require_once('../FunctionFile.php');
        include_once('../Config/Lists.php');
    ?>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manage Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Admin</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
                                    Filter
                                    <small class="float-right">
                                        <i class="fa fa-plus"></i>
                                    </small>
                                </div>
                                <!-- </button> -->
                                <!-- /.card-header -->
                                <div class="card-body collapse">
                                    <form name='' action='ListMember.php' method='post'>
                                        <div class="form-group row">
                                            <?php
                                                htmlLabel('search_member_gender', 'col-sm-3 col-form-label', 'Member Gender')
                                            ?>
                                            <div class="col-md-6">
                                                <?php
                                                    secondHtmlSelect('search_gender', lists_gender(), 'form-control', '', '-- Select a gender --');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <?php
                                                htmlLabel('search_member_condition', 'col-sm-3 col-form-label', 'Member Status')
                                            ?>
                                            <div class="col-md-6">
                                                <?php
                                                        secondHtmlSelect('search_condition', list_status(), 'form-control', '', '-- Select a status --');
                                                ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="form_submitted" value="1" />
                                        <div class="form-group row ">
                                            <div class="col-md-6 offset-md-10 float-right">
                                                <input class="btn btn-warning" onClick="resetForm()" type="submit"
                                                    value="Clear">
                                                <button type="submit" class="btn btn-primary search"
                                                    id="search">Search</button>

                                            </div>
                                        </div>
                                        <?php
                                            htmlFormEnd();
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Manage Admin
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                                data-source="manage-user.php"
                                                data-source-selector="#card-refresh-content">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                    class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div id="get_data"></div> -->
                                        <table class="table table-hover table-bordered table-striped" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Email</th>
                                                    <th>Full Name</th>
                                                    <th>Roles</th>
                                                    <th style="text-align:center">Gender</th>
                                                    <th style="text-align:center">Login</th>
                                                    <?php
                                                        $sql = "SELECT * FROM user";
                                                        $query = mysqli_query($conn, $sql);
                                                        if(can('user.delete') || can('user.edit'))
                                                        {
                                                            printf('               
                                                                <th style="text-align:center">Options</th>
                                                            ');
                                                        }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if($query->num_rows > 0)
                                                    {
                                                        while($row = $query->fetch_assoc())
                                                        {
                                                            $sql2 = "SELECT * from roles, user_role, user 
                                                            WHERE user.id = ".$row['id']." AND user.id = user_role.user_id 
                                                            AND user_role.role_id = roles.id";
                                                            $query2 = mysqli_query($conn, $sql2);
                                                            $row2 = $query2->fetch_assoc();

                                                            printf('
                                                            <tr>
                                                                <td>'.checkEmpty($row["id"]).'</td>
                                                                <td>'.checkEmpty($row["email"]).'</td>
                                                                <td>'.checkEmpty($row["name"]).'</td>
                                                                <td>'.$row2["title"].'</td>
                                                                <td align=center>'. genderIcon($row["gender"]).'</td>
                                                                <td align=center>'.statusIcon($row["enable_login"]).'</td>
                                                            ');
                                                            if(can('user.delete') && can('user.edit'))
                                                            {
                                                                printf('
                                                                <td>
                                                                    <a href="edit-user-form.php?id='.$row["id"].'"><span class="fa fa-edit" title="Edit" ></span></a>
                                                                    <span class="delete_product" title="Delete" style="cursor: pointer;" data-id="'.$row['id'].'"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></span>
                                                                </td>
                                                                ');
                                                            }
                                                            else if(can('user.delete') && !can('user.edit'))
                                                            {
                                                                printf('
                                                                <td class="">
                                                                    <span class="delete_product" title="Delete" style="cursor: pointer;" data-id="'.$row['id'].'"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></span>
                                                                </td>
                                                                ');
                                                            }
                                                            else if(!can('user.delete') && can('user.edit'))
                                                            {
                                                                printf('
                                                                <td class="">
                                                                <a href="edit-user-form.php?id='.$row["id"].'"><span class="fa fa-edit" title="Edit" ></span></a>
                                                                </td>
                                                                ');
                                                            }

                                                            printf('
                                                            </tr>
                                                            '); 
                                                        } 
                                                    }
                                                ?>
                                                <!-- <span class="bx bx-edit delete_edit" title="Edit"
                                                    style="font-size:35px;color:#50f952;cursor: pointer;"
                                                    data-id="'.$row['id'].'"></span>
                                                <span class="bx bx-trash delete_product" title="Delete"
                                                    style="font-size:35px;color:#ff0000;cursor: pointer;"
                                                    data-id="'.$row['id'].'"></span> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>

    <!-- AdminLTE APP -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- Datatables  -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
    <!-- Sweet ALert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
    $(document).ready(function() {

        $("#myTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');


        $(document).on('click', '.delete_product', function() {
            var id = $(this).data('id');

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                            url: '../Controller/User/UserReadDeleteController.php?action=delete',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal.fire('Deleted!', response.message, response.status).then((
                                result) => {
                                // Reload the Page
                                location.reload();
                            });
                        })
                        .fail(function() {
                            swal.fire('Oops...', 'Something went wrong with ajax !',
                                'error');
                        });
                }

            })

        });
    });

    </script>
</body>

</html>
