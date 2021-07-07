
<!-- Load file JQuery online -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Load file Midtrans online -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-XntQN7g-lIfRoI0F"></script>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php foreach ($siswa as $u) { ?>
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Tagihan dan Pembayaran SPP</h6>
                    </div>
                   
                </div>
        </div>

        <div class="card-body">
            <form class="form-inline"id="payment-form"  method="post" action="<?= site_url() ?>Snap/finish">
            <input type="hidden" name="result_type" id="result-type" value="">
            <input type="hidden" name="result_data" id="result-data" value="">
                <input name="id_bayar" class="form-control" id="id_bayar"  type="text" value="<?php echo $u->id_bayar ?>"hidden >
                <input name="nama_siswa" class="form-control" id="nama_siswa" type="text" value="<?php echo $u->nama_siswa ?>"hidden >
                <input name="no_hp_siswa" class="form-control"id="no_hp_siswa"  type="text" value="<?php echo $u->no_hp_siswa ?>"hidden >
                <input name="emailwalimurid" class="form-control" id="emailwalimurid" type="text" value="<?php echo $u->emailwalimurid ?>"hidden >
                
                
                
                <div class="form-group ">
                                    <label> Berapa Bulan ? &nbsp; </label>
                                    <input type="text" placeholder="Ingin berapa bulan?" name="pirangwulan" id="pirangwulan" class="form-control"   value=" "  >
                                </div>

                        <div class="form-group col-6">
                    <label>Tahun Masuk</label>
                    <select name="tahun_masuk" id="tahun_masuk" class="form-control" style="margin-left: 10px;">
                        <?php
                        foreach ($this->db->query('SELECT tahun_masuk.id_tahun, tahun_masuk.tahun_masuk, tahun_masuk.besar_spp FROM tahun_masuk JOIN tahun_aktif ON tahun_masuk.id_tahun=tahun_aktif.id_tahun WHERE id_bayar=\'' . $u->id_bayar . '\'')->result() as $tahun) { /*$this->m_transaksi->tampil_datatahun()->result() */
                        ?>
                            <option value="<?php echo $tahun->id_tahun ?>"> <?php echo $tahun->tahun_masuk . ' | Rp. ' . number_format($tahun->besar_spp, 0, ',', '.'); ?> </option>

                        <?php } ?>
                    </select>
                    <div class="form-group col-6">
                    <input type="text" id="total" class="form-control" placeholder="Total" >   
                    <input type="text" name="jumlahe" id="jumlahe" class="form-control" value="<?php echo    number_format($tahun->besar_spp, 0, ',', ''); ?>"  hidden>
                    </div>

                </div>
                 
                    
                    <div class="form-group col-2">
                    <a class="btn btn-secondary mb-3" href="<?= base_url('riwayat'); ?>">KEMBALI</a>
                    <button type="submit" name="bayar" id="pay-button" class="btn btn-primary mb-3" >BAYAR</button> 
                    
                </div>

            <?php } ?>

            


                
           

            </form>

            <div class="container">


            </div>

            <div class="table-responsive" style="margin-top: 30px">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>ID Transaksi</th>
                            <th>Bulan</th>
                            <th>Tahun Ajaran</th>
                            <th>Tagihan</th>
                            <th>Besar SPP</th>
                            <th>Admin</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($trans as $u) {
                        ?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $u->id_transaksi ?></td>
                                <?php
                                if ($u->id_bulan <= 07) {
                                    $tahun = substr($u->tahun_masuk, 0, 4);
                                } else {
                                    $tahun = substr($u->tahun_masuk, 5);
                                }
                                ?>
                                <td><?php echo $u->bulan . ' ' . $tahun ?></td>
                                <td><?php echo $u->tahun_masuk ?></td>
                                <td><?php echo date('d-m-Y', strtotime($u->tanggal_bayar)); ?></td>
                                <td><?php echo 'Rp. ' . number_format($u->besar_spp, 0, ',', '.'); ?></td>
                                <td><?php echo $u->name ?></td>
                                

                                    
                              
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#jumlahe, #pirangwulan").keyup(function() {
            var pirangwulan = $("#pirangwulan").val();
            var jumlahe= $("#jumlahe").val();

            var total = parseInt(pirangwulan) * parseInt(jumlahe);
            $("#total").val(total);
        });
    });
</script>


<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        var id_bayar = $('#id_bayar').val();
        var nama_siswa = $('#nama_siswa').val();
        var no_hp_siswa = $('#no_hp_siswa').val();
        var emailwalimurid = $('#emailwalimurid').val();
        var pirangwulan = $('#pirangwulan').val();
        var total = $('#total').val();

        $.ajax({
            type: 'POST',
            url: '<?= site_url() ?>snap/token',

            data: {

                id_bayar: id_bayar,
                nama_siswa: nama_siswa,
                no_hp_siswa: no_hp_siswa,
                emailwalimurid: emailwalimurid,
                pirangwulan: pirangwulan,
                total: total
            },
            cache: false,


            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>