<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>System Control</title>
    <link rel="stylesheet" href="../Menu/navbar.css">
    <link rel="stylesheet" href="../Css/Setting.css">
</head>

<body>
    <?php 
        include('../Menu/AdminPageNavbar.php');
        require_once('../Config/Helper.php');
        require_once('../FunctionFile.php');
        $lists = [
            [
                'description' => 'Role Management',
                'url' => 'RoleManagement.php',
            ],
            [
                'description' => 'App Setting',
                'url' => 'AppSetting.php',
            ],
        ];
    ?>
    <br>
    <br>
    <br>
    <br>
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0 text-dark">System Control</h1>
                </div>
            </div>
            <div class="container-fluid pt-4">
                <div class="card">
                    <div class="card-header">
                        Control Lists
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                                <th class="fit px-2">#</th>
                                <th>Description</th>
                                <th class="fit">Options</th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($lists as $k => $l)
                                    {
                                        printf('
                                        <tr>
                                            <td class="text-center">%s</td>
                                            <td>%s</td>
                                            <td>
                                                <a href="%s" class="btn btn-sm btn-primary">Go</a>
                                            </td>
                                        </tr>
                                        ', $k+1, $l['description'], $l['url']);
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>