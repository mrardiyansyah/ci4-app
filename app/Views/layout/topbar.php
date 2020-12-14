<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Notification -->
                <!-- <div class="navbar-notification"> -->
                <li class="nav-item dropdown no-arrow mx-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <div class="badge-counter">
                            <div id="counter-notif">
                                <?= view_cell('\App\Libraries\Notification::renderCounterNotif', ['id_user' => session()->get('id_user')]); ?>
                            </div>
                        </div>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="max-width:350px;">
                        <h6 class="dropdown-header" style="background-color: #046b7b;">
                            Notifications
                        </h6>
                        <div class="" style="overflow-y:scroll; max-height: 350px;" id="list-notification">
                            <?= view_cell('\App\Libraries\Notification::renderListNotif', ['id_user' => session()->get('id_user')]); ?>
                        </div>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>
                <!-- </div> -->

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?> (<?= $role['role_type']; ?>) </span>
                        <?php if ($user['image'] == 'default.jpg') { ?>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/' . $user['image']); ?>">
                        <?php } else { ?>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/' . $user['id_user'] . '/' . $user['image']); ?>">
                        <?php } ?>

                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                            <i class="fas fa-user-tie fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('edit-profile'); ?>">
                            <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('user/changepassword'); ?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <script>


        </script>