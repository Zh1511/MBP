<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
<?php
require_once('../FunctionFile.php');
?>

<head>
    <meta charset="UTF-8">
    <title>Admin Navigation Bar</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    </style>
</head>

<body id="body-pd" style="background-color: #f4f6f9">


    <script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show_nn')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo text-decoration-none">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Assignment</span>
                </a>
                <div class="nav_list">

                    <?php
                    if(isEnabled('ENABLE_MODULE_DASHBOARD'))
                    {
                        if(can('dashboard.view'))
                        {
                            printf('
                                <a href="../Dashboard/Dashboard.php" class="nav_link text-decoration-none">
                                    <i class="bx bxs-dashboard"></i>
                                    <span class="nav_name">Dashboard</span>
                                </a>
                            ');
                        }

                    }
                ?>


                    <?php
                    if(isEnabled('ENABLE_MODULE_MEMBER'))
                    {
                        if(can('member.view'))
                        {
                            printf('
                            <a href="../Member/index.php" class="nav_link text-decoration-none">
                                <i class="bx bx-user"></i>
                                <span class="nav_name">Member Mgmt.</span>
                            </a>

                            ');
                        }

                    }
                    ?>
                    <!-- <button class="nav_link text-decoration-none border-0 acc" style="background-color:#343a40;">
                        <i class="bx bx-user-circle nav_icon" title="Member"></i>
                        <span class="nav_name">Member Mgmt. <i class="bx bx-chevron-down ps-3"></i></span>
                    </button>
                    <div class="panel">
                        <a class="nav_link active text-decoration-none ps-2" href="../Member/ListMember.php">
                            <i class='bx bx-chevron-right' style="font-size:16px">
                                <span class="nav_name">Member List</span>
                            </i>
                        </a>
                        <a class="nav_link active text-decoration-none ps-2" href=""><i class='bx bx-chevron-right'
                                style="font-size:16px">aa</i></a>
                    </div> -->
                    <?php
                    if(isEnabled('ENABLE_MODULE_EVENT'))
                    {
                        if(can('event.view'))
                        {
                            printf('
                                <a href="../Event/index.php" class="nav_link text-decoration-none">
                                <i class="bx bx-calendar-event"></i>
                                    <span class="nav_name">Event Mgmt.</span>
                                </a>
                            ');
                        }
                    }
                    ?>

                    <?php
                    if(isEnabled('ENABLE_MODULE_USER'))
                    {
                        if(can('user.view'))
                        {
                            printf('
                                <a href="../User/User.php" class="nav_link text-decoration-none">
                                    <i class="bx bxs-user-detail"></i>
                                    <span class="nav_name">User Mgmt.</span>
                                </a>
                            ');
                        }
                    }
                    ?>

                    <?php
                    if(isEnabled('ENABLE_MODULE_SETTING'))
                    {
                        if(can('setting'))
                        {
                            printf('
                                <a href="../Setting/index.php" class="nav_link text-decoration-none">
                                    <i class="bx bx-cog"></i>
                                    <span class="nav_name">Sytem Control</span>
                                </a>
                            ');
                        }
                    }
                    ?>




                </div>
            </div>
            <a href="../Logout.php" class="nav_link text-decoration-none">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>

        <script>
        var acc = document.getElementsByClassName("acc");

        for (var i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
        </script>
    </div>
    <!--Container Main start-->
    <div class="pt-3">
    </div>
    <!--Container Main end-->

</body>

</html>