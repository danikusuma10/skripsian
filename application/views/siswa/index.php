<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>

    <!-- data table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
            <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('siswa/tambahsiswa'); ?>"><i class="fas fa-user-plus fa-sm"></i> Tambah Siswa</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center thead-light">
                        <tr>
                            <th scope="col">ID Bayar</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswa as $s) : ?>
                            <tr>
                                <th scope="row"><?= $s['id_bayar']; ?></th>
                                <th scope="row"><?= $s['nama_siswa']; ?></th>
                                <th scope="row"><?= $s['nama_kelas']; ?></th>

                                <td class="text-center">
                                    <a href="#detailModal<?= $s['id_bayar']; ?>" data-toggle="modal" class="badge badge-info mr-1">
                                        <i class="fas fa-book-reader fa-sm"></i> Detail
                                    </a>

                                    <a href="#editModal<?= $s['id_bayar']; ?>" class="badge badge-warning mr-1" data-toggle="modal">
                                        <i class="fas fa-edit fa-sm"></i> edit
                                    </a>

                                    <a href="<?= base_url('siswa/hapussiswa/' . $s['id_bayar']); ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                        <i class="far fa-trash-alt fa-sm"></i> delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Detail Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="detailModal<?= $s['id_bayar'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="id_bayar">ID Bayar</label>
                            <input type="text" class="form-control" id="id_bayar" value="<?= $s['id_bayar']; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['nama_siswa']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" value="<?= $s['jenis_kelamin']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" value="<?= $s['nama_kelas']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="emailwalimurid">Email Walimurid</label>
                            <input type="text" class="form-control" id="emailwalimurid" value="<?= $s['emailwalimurid']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="no_hp_siswa">NO HP Siswa</label>
                            <input type="text" class="form-control" id="no_hp_siswa" value="<?= $s['no_hp_siswa']; ?>" readonly>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /. akhir detil Modal -->


<!-- edit Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="editModal<?= $s['id_bayar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('siswa/editsiswa'); ?>">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="id_bayar">ID Bayar</label>
                                    <input type="text" class="form-control" id="id_bayar" name="id_bayar" value="<?= $s['id_bayar']; ?>" maxlength="16" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa']; ?>">
                                    <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" type="text">
                                        <option value="<?= $s['jenis_kelamin']; ?>" selected><?= $s['jenis_kelamin']; ?></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="emailwalimurid">Email Walimurid</label>
                                    <input type="text" class="form-control" id="emailwalimurid" name="emailwalimurid" value="<?= $s['emailwalimurid']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="no_hp_siswa">Nomor HP Siswa</label>
                                    <input type="text" class="form-control" id="no_hp_siswa" name="no_hp_siswa" value="<?= $s['no_hp_siswa']; ?>">
                                    <?= form_error('no_hp_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>


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

                    </form>
                    <!-- akhir form input -->

                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- akhir edit Modal -->