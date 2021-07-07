<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-lg-7">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-4">
                <div class="text-center">
                  <img src="<?= base_url('assets/'); ?>logo/ypt-kecil.png" alt="logo-image" class="img-circle">
                  <p class="font-weight-normal">YPT's SMART PAYMENT GATEWAY</p>
                  <p class="font-weight-bold">SISTEM INFORMASI PEMBAYARAN SPP METODE PAYMENT GATEWAY</p>

                  <hr>
                  <h1 class="h4 text-gray-900">Login Page</h1>
                </div>

                <?= $this->session->flashdata('message'); ?>

                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="username, contoh : example@gmail.com" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password...">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>

                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                </div>
                <div class="text-center">
                  <a class="small" >Or</a>
                </div>
                <div class="text-center">
                  <a class="small" href="<?= base_url('riwayat'); ?>">Historical Payment</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>