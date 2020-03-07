<div class="header-bg">
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo-->
                <div>
                    <a href="<?=base_url('/dashboard')?>" class="logo">
                        <img src="<?=base_url()?>assets/images/logo-light.png" class="logo-lg" alt="" height="26">
                        <img src="<?=base_url()?>assets/images/logo-sm.png" class="logo-sm" alt="" height="28">
                    </a>
                </div>
                <!-- End Logo-->

                <div class="menu-extras topbar-custom navbar p-0">

                    <ul class="mb-0 nav navbar-right ml-auto list-inline">

                        <li class="list-inline-item notification-list d-none d-sm-inline-block">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="fas fa-expand"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <span class="profile-username" style="margin-left:0px">
                                    <?=auth()->name?> <span class="mdi mdi-chevron-down font-15"></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=base_url('dashboard/profile')?>" class="dropdown-item"> Profile Settings</a></li>
                                <li><a href="<?=base_url('dashboard/change_password')?>" class="dropdown-item"> Change Password</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="<?=base_url('authentication/logout')?>" class="dropdown-item"> Logout</a></li>
                            </ul>
                        </li>

                        <li class="menu-item dropdown notification-list list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                    </ul>

                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div>
            <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">

                <div id="navigation">

                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="<?=base_url("dashboard/")?>"><i class="ti-home"></i> Dashboard</a>
                        </li>

                        <?php if(auth_has_all("user roles", "user permissions", "user management", "user details")): ?>
                        
                        <li class="has-submenu">
                            <a href="<?=base_url("dashboard/taxonomy")?>"><i class="ti-home"></i> Classification</a>
                        </li>

                        <?php endif; ?>

                        <?php if(auth_has_all("user roles", "user permissions", "user management", "user details")): ?>

                        <li class="has-submenu">
                            <a href="#"><i class="ti-user"></i> Users <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                            <ul class="submenu">

                                <li>
                                    <a href="<?=base_url("dashboard/user_permissions")?>">Permissions </a>
                                </li>
                                <li>
                                    <a href="<?=base_url("dashboard/user_roles")?>">Roles </a>
                                </li>
                                <li>
                                    <a href="<?=base_url("dashboard/user_management")?>">Management </a>
                                </li>
                                <li>
                                    <a href="<?=base_url("dashboard/user_details")?>">Details </a>
                                </li>

                            </ul>
                        </li>

                        <?php endif; ?>

                    </ul>
                    <!-- End navigation menu -->
                </div>
                <!-- end #navigation -->
            </div>
            <!-- end container -->
        </div>
        <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->

</div>
<!-- header-bg -->