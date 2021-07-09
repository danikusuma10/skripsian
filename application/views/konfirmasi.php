<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?= $title; ?></title>

	<link href="<?= base_url('assets/'); ?>logo/siap-bayar4.png" rel="shortcut icon" type="image/png">

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css">

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

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


					<center>
						<marquee direction="up" scrollamount="1" align="center" class="lead text-gray-800 d-none d-lg-block ml-3 mt-2" behavior="alternate" width="90%">
							<h1>PAYMENT SPP SMK YPT 1 PURBALINGGA HAVE BEEN SUCCESSFULLY CREATED  </h1>
						</marquee>
					</center>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">

							<h4 class="lead text-gray-800 d-none d-lg-block ml-3 mt-2"> <?php echo date('l, d-m-Y'); ?></h4>
							</a>
						
						
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->


				<head>
					<meta charset="utf-8">
					<title>Payment Created</title>

					<style type="text/css">
						::selection {
							background-color: #E13300;
							color: white;
						}

						::-moz-selection {
							background-color: #E13300;
							color: white;
						}

						body {
							background-color: #fff;
							margin: 40px;
							font: 13px/20px normal Helvetica, Arial, sans-serif;
							color: #4F5155;
						}

						a {
							color: #003399;
							background-color: transparent;
							font-weight: normal;
						}

						h1 {
							color: #444;
							background-color: transparent;
							border-bottom: 1px solid #D0D0D0;
							font-size: 19px;
							font-weight: normal;
							margin: 0 0 14px 0;
							padding: 14px 15px 10px 15px;
						}

						code {
							font-family: Consolas, Monaco, Courier New, Courier, monospace;
							font-size: 12px;
							background-color: #f9f9f9;
							border: 1px solid #D0D0D0;
							color: #002166;
							display: block;
							margin: 14px 0 14px 0;
							padding: 12px 10px 12px 10px;
						}

						#body {
							margin: 0 15px 0 15px;
						}

						p.footer {
							text-align: right;
							font-size: 11px;
							border-top: 1px solid #D0D0D0;
							line-height: 32px;
							padding: 0 10px 0 10px;
							margin: 20px 0 0 0;
						}

						#container {
							margin: 10px;
							border: 1px solid #D0D0D0;
							box-shadow: 0 0 8px #D0D0D0;
						}
					</style>
				</head>

				<body>

					<div class="container">
						<h1>Confirmation</h1>

						<div id="body">
							<table>
								<tr>
									<td>Status Code</td>
									<td>:&nbsp; &nbsp; <?php echo $finish->status_code; ?></td>
								</tr>
								<tr>
									<td>Status Message</td>
									<td>:&nbsp; &nbsp;<?php echo $finish->status_message; ?></td>
								</tr>
								<tr>
									<td>Order ID</td>
									<td>:&nbsp; &nbsp;<?php echo $finish->order_id; ?></td>
								</tr>
								<tr>
									<td>Transaction Status</td>
									<td>:&nbsp; &nbsp;<?php echo $finish->transaction_status; ?></td>
								</tr>
								<tr>
									<td>Bill Key</td>
									<td>:&nbsp; &nbsp;<?php
											if (isset($finish->bill_key)) {
												echo $finish->bill_key;
											} else {
												echo "0";
											}
											?></td>
								</tr>
								<tr>
									<td>Biller Code</td>
									<td>:&nbsp; &nbsp;
										<?php
										if (isset($finish->biller_code)) {
											echo $finish->biller_code;
										} else {
											echo "0";
										}
										?></td>
								</tr>


								<tr>
									<td>Bank</td>
									<td>: &nbsp; &nbsp;<?php
											if (isset($finish->va_numbers[0]->bank)) {
												echo $finish->va_numbers[0]->bank;
											} else {
												echo "-";
											}
											?></td>
								</tr>


								<tr>
									<td>VA Number</td>
									<td>: &nbsp; &nbsp;
										<?php
										if (isset($finish->va_numbers[0]->va_number)) {
											echo $finish->va_numbers[0]->va_number;
										} else {
											echo "0";
										}
										?></td>
								</tr>
								<tr>
									<td>VA Permata</td>
									<td>:&nbsp; &nbsp;
										<?php
										if (isset($finish->permata_va_number)) {
											echo $finish->permata_va_number;
										} else {
											echo "0";
										}
										?></td>
								</tr>
								<tr>
									<a class="btn btn-danger" href="<?= base_url('riwayat/'); ?>"><i class="fas fa-sign-out-alt"></i> Kembali</a>
								</tr>
							</table>

							<tr>
									<a class="btn btn-danger" href="<?= base_url('riwayat/'); ?>"><i class="fas fa-sign-out-alt"></i> Kembali</a>
								</tr>
						</div>

						<marquee direction="right" behavior="alternate">----- Maturnuwun sampun bayar SPP tepat waktu -----  </marquee>
					</div>

				</body>


				<!-- Footer -->
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span> YPT's - <em>Payment </em><?= date('Y'); ?> <em class="badge badge-info"> prototype</em> | <em>Developed By</em> Dani | <em>Theme by</em> <a href="https://startbootstrap.com/themes/sb-admin-2"> SB Admin 2</a>
							</span>
						</div>
					</div>
				</footer> <!-- End of Footer -->


</html>