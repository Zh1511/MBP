
<?php
require_once('../FunctionFile.php');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">

        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">BLMS | Banker </span>
        </a>
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../dist/img/manager.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Testing</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php
                    if(isEnabled('ENABLE_MODULE_DASHBOARD'))
                    {       
                        if(can('dashboard.view'))
                        {           
                ?>
                    <li class="nav-item">
                        <a href="../Dashboard/Dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                <?php
                        }
                    }       
                ?>

                    <!--Subadmins--->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Customer Mgmt.
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                                <a href="../Member/manage-member.php" class="nav-link">
                                    <i class="fa fa-tasks nav-icon"></i>
                                    <p>Manage Customer</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../Member/add-member-form.php" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Add Customer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--Practice Areas--->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Admin Mgmt.
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="../User/manage-user.php" class="nav-link">
                                    <i class="fa fa-tasks nav-icon"></i>
                                    <p>Manage Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="add-member-form.php" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Add Admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
		   <!--
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Event Mgmt.
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="add-locker-form.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="manage-locker-form.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Manage</p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Report
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="bwdates-report-ds.php" class="nav-link">
                                    <i class="far fa-calendar-alt nav-icon"></i>
                                    <p>B/w Dates</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="search-report.php" class="nav-link">
                                    <i class="fas fa-search nav-icon"></i>
                                    <p>Search Report</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Pages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="aboutus.php" class="nav-link">
                                    <i class="far fa-file-alt nav-icon"></i>
                                    <p>About us</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="contact-us.php" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Contact us</p>
                                </a>
                            </li>
                        </ul>
                    </li>
		   -->


                    <!--Profile--->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Account Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="change-password-form.php" class="nav-link">
                                    <i class="fas fa-cog nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="logout.php" class="nav-link">
                                    <i class="fas fa-sign-out-alt nav-icon"></i>
                                    <p>Logout</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!--History log--->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-history"></i>
                            <p>
                                History Log
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-sign-in nav-icon"></i>
                                    <p>Log in history</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
