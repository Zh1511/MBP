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
    <title>Customer List</title>
    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
    <div class="wrapper">
        <?php 
        include_once('../Menu/navbarV2.php');
        include_once('../Menu/sidebar.php');
        // require_once('../Config/Helper.php');
        require_once('../FunctionFile.php');
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manage Customer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Customer</li>
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
                                            Manage Customer
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                                data-source="manage-member.php"
                                                data-source-selector="#card-refresh-content" >
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                    class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_POST['form_submitted'])): ?>
                                        <?php 
                                                $search_gender = $_POST['search_gender'];
                                                $member_status = $_POST['search_condition'];
                                                
                                                if($search_gender!= null && $member_status!= null)
                                                {
                                                    $sql = "SELECT * FROM member WHERE (gender LIKE '$search_gender') AND (status LIKE '$member_status')";
                                                }
                                                elseif($search_gender == null && $member_status!= null)
                                                {
                                                    $sql = "SELECT * FROM member WHERE status LIKE '$member_status'";
                                                }
                                                elseif($search_gender != null && $member_status == null)
                                                {
                                                    $sql = "SELECT * FROM member WHERE gender LIKE '$search_gender'";
                                                }
                                                else
                                                {
                                                    $sql = "SELECT * FROM member WHERE enable_login = '-1'";
                                                    
                                                }

                                                $query = mysqli_query($conn, $sql);
                                                if(!can('member.delete') && !can('member.edit'))
                                                {
                                                    printf('
                                                    <table class="table table-hover" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Full Name</th>
                                                                <th>Email</th>
                                                                <th style="text-align:center">Customer ID</th>
                                                                <th style="text-align:center">Reg Date.</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                    ');
                                                }
                                                else {
                                                    printf('
                                                    <table class="table table-hover" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Full Name</th>
                                                                <th>Email</th>
                                                                <th style="text-align:center">Customer ID</th>
                                                                <th style="text-align:center">Reg Date.</th>
                                                                <th style="text-align:center">Options</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                    ');
                                                }

                                                if ($query->num_rows > 0){
                                                    $no = 0;
                                                    while($row = $query->fetch_assoc()){
                                                        $no += 1;
                                                        if(can('member.delete') && can('member.edit'))
                                                        {
                                                            printf(
                                                                '
                                                            <tr>
                                                                <td>'.$no.'</td>
                                                                <td>'.checkEmpty($row["full_name"]).'</td>
                                                                <td>'.checkEmpty($row["email"]).'</td>
                                                                <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                <td class="">
                                                                    <a href="edit-member-form.php?id='.$row["id"].'"><span class="bx bx-edit" title="Edit" style="font-size:35px;color:#50f952;"></span></a>
                                                                    <span class="delete_product" title="Delete" style="cursor: pointer;" data-id="'.$row['id'].'"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></span>
                                                                </td>
                                                            </tr>
                                                            '
                                                            );
                                                        }
                                                        elseif(can('member.delete') && !can('member.edit'))
                                                        {
                                                            printf(
                                                                '
                                                            <tr>
                                                                <td>'.$no.'</td>
                                                                <td>'.checkEmpty($row["full_name"]).'</td>
                                                                <td>'.checkEmpty($row["email"]).'</td>
                                                                <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                <td class="">
                                                                    <span class="delete_product" title="Delete" style="cursor: pointer;" data-id="'.$row['id'].'"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></span>
                                                                </td>
                                                            </tr>
                                                            '
                                                            );
                                                        }
                                                        else if(!can('member.delete') && can('member.edit'))
                                                        {
                                                            printf(
                                                                '
                                                                <tr>
                                                                    <td>'.$no.'</td>
                                                                    <td>'.checkEmpty($row["full_name"]).'</td>
                                                                    <td>'.checkEmpty($row["email"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                    <td class="d-flex justify-content-around">
                                                                        <a href="edit-member-form.php?id='.$row["id"].'"><span class="bx bx-edit" title="Edit" style="font-size:35px;color:#50f952;"></span></a>
                                                                    </td>
                                                                </tr>
                                                                '
                                                            );
                                                        }
                                                        else
                                                        {
                                                            printf(
                                                                '
                                                                <tr>
                                                                    <td>'.$no.'</td>
                                                                    <td>'.checkEmpty($row["full_name"]).'</td>
                                                                    <td>'.checkEmpty($row["email"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                </tr>
                                                                '
                                                            );
                                                        }
                                                        // echo '<tr>';
                                                        // echo    '<td>'.$no.'</td>';
                                                        // echo    '<td>'.checkEmpty($row->full_name).'</td>';
                                                        // echo    '<td>'.checkEmpty($row->email).'</td>';
                                                        // echo    '<td align=center>'.checkEmpty($row->student_id).'</td>';
                                                        // echo    '<td align=center>'.checkEmpty($row->created_at).'</td>';
                                                        // echo    '<td class="d-flex justify-content-around">';
                                                        // echo        '<a href="edit-member-form.php?id='.$row->id.'">';
                                                        // echo            '<span class="bx bx-edit" title="Edit"';
                                                        // echo                'style="font-size:35px;color:#50f952;"></span>';
                                                        // echo        '</a>';
                                                        // echo        '<span class="bx bx-trash delete_product" title="Delete"';
                                                        // echo            'style="font-size:35px;color:#ff0000;cursor: pointer;"';
                                                        // echo            'data-id="'.$row->id.'"></span>';
                                                        // echo    '</td>';
                                                        // echo '</tr>';
                                                    }
                                                }
                                                else {
                                                    echo '
                                                    <tr>
                                                        <td align=center>No Data available</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>';                                     
                                                }
                                                echo '        
                                                    </tbody>
                                                </table>';  
                                            ?>
                                        <?php else: ?>
                                        <?php
                                                $sql = "SELECT * FROM member";
            
                                                $query = mysqli_query($conn, $sql);
                                                if(!can('member.delete') && !can('member.edit'))
                                                {
                                                    printf(
                                                        '
                                                    <table class="table table-hover table-bordered table-striped" id="myTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Full Name</th>
                                                                    <th>Email</th>
                                                                    <th style="text-align:center">Customer ID</th>
                                                                    <th style="text-align:center">Reg <Date class=""></Date></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>        
                                                    '
                                                    );
                                                }
                                                else {
                                                    printf(
                                                        '
                                                    <table class="table table-hover table-bordered table-striped" id="myTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Full Name</th>
                                                                    <th>Email</th>
                                                                    <th style="text-align:center">Customer ID</th>
                                                                    <th style="text-align:center">Reg Date.</th>
                                                                    <th style="text-align:center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>        
                                                    '
                                                    );
                                                }
                                            
                                                if($query->num_rows > 0){
                                                    $no = 0;
                                                    while($row = $query->fetch_assoc())
                                                    {
                                                        $no+=1;
                                                        if(can('member.delete') && can('member.edit'))
                                                        {
                                                            printf(
                                                                '
                                                            <tr>
                                                                <td>'.$no.'</td>
                                                                <td>'.checkEmpty($row["full_name"]).'</td>
                                                                <td>'.checkEmpty($row["email"]).'</td>
                                                                <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                <td class="">
                                                                    <a href="edit-member-form.php?id='.$row["id"].'"><span class="fa fa-edit" title="Edit" ></span></a>
                                                                    <a href="change-password-form.php?id='.$row["id"].'"><span class="fa fa-key" title="Change Password" ></span></a>
                                                                    <span class="delete_product" title="Delete" style="cursor: pointer;" data-id="'.$row['id'].'"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></span>
                                                                </td>
                                                            </tr>
                                                            '
                                                            );
                                                        }
                                                        else if(can('member.delete') && !can('member.edit'))
                                                        {
                                                            printf(
                                                                '
                                                            <tr>
                                                                <td>'.$no.'</td>
                                                                <td>'.checkEmpty($row["full_name"]).'</td>
                                                                <td>'.checkEmpty($row["email"]).'</td>
                                                                <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                <td class="">
                                                                    <span class="delete_product" title="Delete" style="cursor: pointer;" data-id="'.$row['id'].'"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></span>
                                                                </td>
                                                            </tr>
                                                            '
                                                            );
                                                        }
                                                        else if(!can('member.delete') && can('member.edit'))
                                                        {
                                                            printf(
                                                                '
                                                                <tr>
                                                                    <td>'.$no.'</td>
                                                                    <td>'.checkEmpty($row["full_name"]).'</td>
                                                                    <td>'.checkEmpty($row["email"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                    <td class="">
                                                                    <a href="edit-user-form.php?id='.$row["id"].'"><span class="fa fa-edit" title="Edit" ></span></a>
                                                                    </td>
                                                                </tr>
                                                                '
                                                            );
                                                        }
                                                        else
                                                        {
                                                            printf(
                                                                '
                                                                <tr>
                                                                    <td>'.$no.'</td>
                                                                    <td>'.checkEmpty($row["full_name"]).'</td>
                                                                    <td>'.checkEmpty($row["email"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["student_id"]).'</td>
                                                                    <td align=center>'.checkEmpty($row["created_at"]).'</td>
                                                                </tr>
                                                                '
                                                            );
                                                        }
                                                        
                                                    }
                                                }
                                                else
                                                {
                                                    printf(
                                                        '
                                                    <tr>
                                                        <td align=center>No Data available</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>                                  
                                                    </tr>
                                                    '
                                                    );
                                                    
                                                }
                                                printf(
                                                    '
                                                    </tbody>
                                                </table>
                                                '
                                                );
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

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
        fetch();

        $("#myTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#myTable_wrapper .col-md-6:eq(0)');

        //LIVE SEARCH METHOD 1
        // $('.search-box input[type="text"]').on("keyup input", function() {
        //     /* Get input value on change */
        //     var inputVal = $(this).val();
        //     var resultDropdown = $(this).siblings(".result");
        //     if (inputVal.length) {
        //         $.get("../Controller/Member/backend-search.php", {
        //             term: inputVal
        //         }).done(function(data) {
        //             // Display the returned data in browser
        //             resultDropdown.html(data);
        //         });
        //     } else {
        //         resultDropdown.empty();
        //     }
        // });

        // // Set search input value on click of result item
        // $(document).on("click", ".result p", function() {
        //     $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        //     $(this).parent(".result").empty();
        // });



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
                            url: '../Controller/Member/MemberReadDeleteController.php?action=delete',
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

    // function filterData(event) {
    //     var member_name = $("#search_member_name").val();
    //     var member_email = $("#search_member_email").val();
    //     var status = $("#search_status").val();

    //     $.ajax({
    //         url: '../Controller/Member/MemberReadDeleteController.php?act=search',
    //         method: 'POST',
    //         data: {
    //             member_name: member_name,
    //             member_email: member_email,
    //             status: status,
    //         },
    //         success: function(data) {
    //             event.preventDefault();
    //             $('#search_data').html(data);

    //         }
    //     });
    //     return true;
    // }


    function fetch(page) {
        $.ajax({
            method: 'POST',
            url: '../Controller/Member/MemberReadDeleteController.php',
            data: {
                page: page
            },
            success: function(data) {
                $('#get_data').html(data);
            }
        });
    }


    $(document).on("click", ".page-item", function() {
        var page = $(this).attr("id");
        fetch(page);
    })


    //LIVE SEARCH METHOD 2
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }



    //LIVE SEARCH METHOD 3
    // var selectedName ='';
    // var selectedTitle ='';
    // var selectedCity ='';

    // var myFilter = function () {
    //    $("#myTable tr").filter(function () {        
    //       $(this).toggle($(this).find("td:eq(1)").text().toLowerCase().indexOf(selectedName) > -1 &&
    //       $(this).find("td:eq(2)").text().toLowerCase().indexOf(selectedTitle) > -1 &&
    //       $(this).find("td:eq(4)").text().toLowerCase().indexOf(selectedCity) > -1)            
    //     });                          
    //  };

    //     $("#search_member_name").on("keyup", function () {
    //         selectedName = $(this).val().toLowerCase();            
    //         myFilter();
    //     });    

    //     $("#search_member_email").on("keyup", function () {
    //        selectedTitle = $(this).val().toLowerCase();
    //        myFilter();
    //     });

    //     $("#search_status").on("change", function () {
    //        selectedCity = $(this).val().toLowerCase(); 
    //        if (selectedCity == '-- Select a status --')
    //          selectedCity ='';
    //        myFilter();
    //     });
    </script>



</body>

</html>
