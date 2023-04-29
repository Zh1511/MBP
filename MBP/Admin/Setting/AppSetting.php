<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>App Setting</title>
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
                <div class="container-fluid d-flex justify-content-between">
                    <h1 class="m-0 text-dark">System Setting</h1>
                </div>

            </div>
            <div class="pt-5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title h5 d-flex justify-content-between">
                                        <div class="pt-3">
                                            Setting
                                        </div>

                                        <div class="pt-2">
                                            <a href="AddRole.php" class="btn btn-primary">
                                                Add New Role
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="my-3">
                                        <h4>Related App Info</h4>
                                        <hr>
                                        
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>