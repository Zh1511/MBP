<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Member List</title>
    <link rel="stylesheet" href="../Menu/navbar.css">
    <link rel="stylesheet" href="../Css/RoleManagement.css">
</head>

<body>
    <?php 
        include('../Menu/AdminPageNavbar.php');
        require_once('../Config/Helper.php');
        // require_once('../Config/Pagination.php');
        require_once('../FunctionFile.php');
    ?>
    <br>
    <br>
    <br>
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header ">
                <br>
                <div class="container-fluid">
                    <h1 class="m-0 text-dark">System Control > Role Management</h1>
                </div>

            </div>
            <div class="pt-3    ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title h5 d-flex justify-content-between">
                                        <div class="pt-3">
                                            Role Lists
                                        </div>

                                        <div class="pt-2">
                                            <a href="AddRole.php" class="btn btn-primary">
                                                Add New Role
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="get_data"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    $(document).ready(function() {
        fetch();

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
                            url: '../Controller/Setting/RoleManagementReadController.php?action=delete',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            swal.fire('Deleted!', response.message, response.status);
                            fetch();
                        })
                        .fail(function() {
                            swal.fire('Oops...', 'Something went wrong with ajax !',
                                'error');
                        });
                }

            })

        });
    });

    function fetch(page) {
        $.ajax({
            method: 'POST',
            url: '../Controller/Setting/RoleManagementReadController.php',
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
    </script>
</body>

</html>