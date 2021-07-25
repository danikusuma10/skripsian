<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <!-- DataTales Example -->
    <div class="container my-auto">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-borderd" id="example" width="30%" cellspacing="1">
                    <input type="text" name="id_bayar" id="id_bayar">
                    <button id="search">Tampilkan</button>
                    <thead>
                        <tr>
                            <th>ID Bayar</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

           

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> YPT's - <em>Payment </em><?= date('Y'); ?> <em class="badge badge-info"> prototype</em> | <em>Developed By</em> Dani | <em>Theme by</em> <a href="https://startbootstrap.com/themes/sb-admin-2"> SB Admin 2</a>
                        </span>
                    </div>
                </div>
            </footer> <!-- End of Footer -->


            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



            <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



            <!-- DATATABLE BARU -->
            <script type="text/javascript">
                //var id_bayar    = $('#id_bayar').val();
                var dataTable = $('#example').DataTable({
                    dom: 'B t<"top"i>r<"clear">',
                    language: {
                        lengthMenu: "Display _MENU_ records",
                        zeroRecords: "Masukkan ID Bayar dengan benar data yang akan dicari <i class='far fa-smile-wink'></i>", // Setting Kata-katanya jika record kosong
                        processing: "<i class='fas fa-spinner fa-spin' style='align:left;vertical-align:middle;padding:1px;'></i><br> Permintaan sedang diproses" // Kalo lagi proses, misal jika cari data yang ada di datatable
                    },
                    processing: true, // Ternyata disini masalahnya
                    serverSide: true,
                    ajax: {
                        url: "<?php echo site_url('/riwayat/getData') ?>",
                        type: "POST",
                        data: function(data) {
                            data.id_bayar = $('#id_bayar').val();
                        },
                    },
                });

                $('#search').on('click change', function(event) {
                    event.preventDefault();
                    if ($('#id_bayar').val() == "") {
                        $('#id_bayar').focus();
                    } else {
                        dataTable.draw();
                    }
                });
            </script>
            <!-- END -->
        </div>
    </div>
</div>