<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-primary"><?= $title; ?></h1>

    <!-- card -->
    <div class="card shadow mb-4 py-4 px-4">

        <!-- form Input data -->
        <form method="post" action="<?= base_url('siswa/editsiswa'); ?>">
            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="id_bayar">ID Bayar</label>
                        <input type="text" class="form-control" id="id_bayar" name="id_bayar" maxlength="16" value="<?= set_value('id_bayar'); ?>" readonly>
                        <?= form_error('id_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= set_value('nama_siswa'); ?>">
                        <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki">
                            <label class="form-check-label" for="jenis_kelamin">
                                Laki-laki
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                            <label class="form-check-label" for="jenis_kelamin">
                                Perempuan
                            </label>
                        </div>
                        <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="form-group">
                        <label for="emailwalimurid">email</label>
                        <input type="text" class="form-control" id="emailwalimurid" name="emailwalimurid" value="<?= set_value('emailwalimurid'); ?>">
                        <?= form_error('emailwalimurid', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="no_hp_siswa">Nomor hp</label>
                        <input type="text" class="form-control" id="no_hp_siswa" name="no_hp_siswa" maxlength="16" value="<?= set_value('no_hp_siswa'); ?>">
                        <?= form_error('no_hp_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-lg">

                    <div class="col-lg">
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select class="form-control" id="kelas_id" name="kelas_id" type="text">
                                <option value="<?= $s['kelas_id']; ?>"><?= $s['nama_kelas']; ?></option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa'); ?>">Batal</a>
                        </div>
                    </div>
                </div>

        </form>
        <!-- akhir form input -->

    </div>
    <!-- /.card -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->