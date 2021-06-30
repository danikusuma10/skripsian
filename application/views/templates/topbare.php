

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

             <img src="<?= base_url('assets/logo/logos.png'); ?>" alt="logo-image" class="img-circle">


             <center><marquee direction="up" scrollamount="1" align="center" class="lead text-gray-800 d-none d-lg-block ml-3 mt-2" behavior="alternate" width="90%"><marquee direction="right" behavior="alternate"> Selamat datang Sistem informasi Pembayaran SPP Metode Payment GATEWAY <span class="badge badge-info">Prototype</span> </marquee></marquee></center>

             <!-- Topbar Navbar -->
             <ul class="navbar-nav ml-auto">

                 <div class="topbar-divider d-none d-sm-block"></div>

                 <!-- Nav Item - User Information -->
                 <li class="nav-item dropdown no-arrow">
                     
                     <h4 class="lead text-gray-800 d-none d-lg-block ml-3 mt-2"> <?php echo date('l, d-m-Y');?></h4>
                     </a>
                     <!-- Dropdown - User Information -->
                     <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                         <a class="dropdown-item" href="<?= base_url('user'); ?>">
                             <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                             Profile
                         </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item text-danger" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                             <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
                             Logout
                         </a>
                     </div>
                 </li>

             </ul>

         </nav>
         <!-- End of Topbar -->