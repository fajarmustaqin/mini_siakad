<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Mahasiswa Bimbingan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dosen') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Mahasiswa Bimbingan</li>
            </ol>


            <div class="card mb-4">
                <div class="card-body table-responsive">
                    <table id="table" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>



    <script>
        var save_method;
        var table;
        var base_url = '<?= base_url(); ?>';

        $(document).ready(function() {
            table = $('#table').DataTable({
                "serverSide": true,
                "processing": true,
                "language": {
                    "infoFiltered": "",
                    "processing": "<img alt='loading...' src='<?php echo base_url() ?>/assets/animasi/loading.gif' />"
                },
                "order": [],

                "ajax": {
                    "url": "<?php echo site_url('bimbingan/showDosen') ?>",
                    "type": "POST"
                },

                "columnDefs": [{
                    "targets": [0, 5, 6],
                    "orderable": false,
                }],
            });
        });
    </script>