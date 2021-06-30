<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewTahunaktif">Tambah Tahun Aktif</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Bayar</th>
                            <th>Nama Siswa</th>
                            <th>Tahun Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tahun_aktif as $t) :
                        ?>
                            <tr>
                                <td><?php echo $t->id_bayar ?></td>
                                <td><?php echo $t->nama_siswa ?></td>
                                <td><?php echo $t->tahun_masuk ?></td>

                                <td>

                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteTahunaktif<?= $t->id_bayar ?>"></a>

                                </td>
                            </tr>

                            <!--update donatur-->

                            <!--delete donatur-->
                            <div class="modal fade" id="deleteTahunaktif<?= $t->id_bayar ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewTahunaktifLabel">Hapus Tahun Aktif</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus siswa dengan nama <?= $t->nama_siswa ?></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('th_aktif/deleteTahunaktif?id_bayar=') ?><?= $t->id_bayar ?>" class="btn btn-primary">Hapus</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- /.container-fluid -->

<!-- /.container-fluid -->

<!-- End of Main Content -->


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="addNewTahunaktif" tabindex="-1" role="dialog" aria-labelledby="addNewTahunaktifLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewTahunaktifLabel">Tambah Admin Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="user" method="post" action="<?= base_url('Th_aktif/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" hidden="" id="id" name="id" placeholder="Masukan id" value="<?= set_value('id'); ?>">
                        <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select id="id_bayar" name="id_bayar" class="form-control" style="margin-left: 10px;">
                            <?php
                            foreach ($this->db->query('SELECT siswa.id_bayar, siswa.nama_siswa FROM siswa')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                            ?>
                                <option value="<?php echo $sis->id_bayar ?>"> <?php echo $sis->id_bayar . ' | ' . $sis->nama_siswa . ''; ?> </option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="id_tahun" name="id_tahun" class="form-control" style="margin-left: 10px;">
                            <?php
                            foreach ($this->db->query('SELECT * FROM tahun_masuk')->result() as $tajaran) { /*$this->m_transaksi->tampil_datatahun()->result() */
                            ?>
                                <option value="<?php echo $tajaran->id_tahun ?>"> <?php echo $tajaran->tahun_masuk; ?> </option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>