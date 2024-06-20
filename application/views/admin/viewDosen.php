<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Dosen</li>
            </ol>
            <button type="button" class="btn btn-primary" onclick="modal_dosen()">+ Tambah</button>
            <br><br>
            <?= $this->session->flashdata('message'); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Dosen
                </div>
                <div class="card-body table-responsive">
                    <table id="table" class="table table-striped table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>No Hp</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th></th>
                                <?php if ($this->session->userdata('id_group') == 1) { ?>
                                    <th></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modal_add_dosen" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form_dosen">
                        <div class="form-group mb-3">
                            <label for="Nidn">NIDN</label>
                            <small class="text-danger">*</small>
                            <input type="hidden" name="id_dsn">
                            <input type="text" class="form-control" name="nidn" id="nidn" value="<?= set_value('nidn') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Nama">Nama</label>
                            <small class="text-danger">*</small>
                            <input type="text" class="form-control" id="nama_dsn" name="nama_dsn" value="<?= set_value('nama_dsn') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenisKelamin">Jenis Kelamin</label>
                            <small class="text-danger">*</small>
                            <select name="jenis_kelamin_dsn" id="jenis_kelamin_dsn" class="form-select" value="<?= set_value('jenis_kelamin_dsn') ?>">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="NoHp">No Hp</label>
                            <small class="text-danger">*</small>
                            <input type="number" name="no_hp_dsn" class="form-control" id="no_hp_dsn" value="<?= set_value('no_hp_dsn') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Email">Email</label>
                            <small class="text-danger"></small>
                            <input type="email" name="email_dsn" class="form-control" id="email_dsn" value="<?= set_value('email_dsn') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="from-group mb-3">
                            <label for="Alamat">Alamat</label>
                            <input type="text" name="alamat_dsn" class="form-control" id="alamat_dsn" value="<?= set_value('alamat_dsn') ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="btnSave" onclick="save_dosen()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    var table;
    var save_method;
    var base_url = '<?= base_url() ?>';
    var btnSave = $('#btnSave');

    $(document).ready(function() {
        table = $('#table').DataTable({
            "serverSide": true,
            "Processing": true,
            "language": {
                "infoFiltered": "",
                "processing": "<img alt='loading...' src='<?php echo base_url() ?>/assets/image/loading.gif' />"

            },
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('dosen/showDosen') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [7],
                "className": 'text-center'
            }],
            <?php if ($this->session->userdata('id_group') == 1) { ?> "columnDefs": [{
                    "targets": [0, 6, 7, 8],
                    "orderable": false
                }]
            <?php } else { ?> "columnDefs": [{
                    "targets": [0, 6, 7],
                    "orderable": false
                }]
            <?php } ?>
        });
    });


    function reloadTable() {
        table.ajax.reload(null, false);
    }

    function modal_dosen() {
        save_method = 'add';
        $('#form_dosen')[0].reset();
        $('#modal-title').text('Tambah Data Dosen')
        $('.form-group').removeClass('has-error');
        $('#modal_add_dosen').modal('show');
    }

    function save_dosen() {
        btnSave.text('Wait..');
        btnSave.attr('disable', true);

        var url;

        if (save_method == 'add') {
            url = "<?= site_url('dosen/addDosen'); ?>";
        } else {
            url = "<?= site_url('dosen/updateDosen'); ?>";
        }

        var formData = new FormData($('#form_dosen')[0]);

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#modal_add_dosen').modal('hide');
                    reloadTable();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Data Dosen Berhasil disimpan',
                        showConfirmButton: false,
                        timer: 1000
                    })
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name"' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name"' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }

                }
                btnSave.text('Wait..');
                btnSave.attr('disabled', false);
            },
            error: function() {
                console.log('error database');
            }
        });
    }

    function deleteDosen(id) {
        Swal.fire({
            title: 'Hapus',
            text: "apakah anda yakin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus data'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('dosen/deleteDosen') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire(
                            'Hapus',
                            'Data Berhasil di Hapus',
                            'success'
                        )
                        reloadTable();
                    },
                    error: function(jqHXR, textStatus, arrorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hapus Gagal',
                            text: 'Data dosen tidak dapat dihapus, karena  masih menjadi dosen pebimbing mahasiswa'
                        })
                    }
                });
            }
        })
    }

    function updateDosen(id) {
        save_method = 'update';
        $('#form_dosen')[0].reset();
        $('.form-group').removeClass('has-error');

        $.ajax({
            url: "<?= site_url('dosen/getDosen') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('#modal-title').text('Ubah Data Dosen');
                $('#btnSave').attr('disabled', false);
                $('#form_dosen').find('input').removeClass('is-invalid');
                $('[name="id_dsn"]').val(data.id_dsn);
                $('[name="nidn"]').val(data.nidn);
                $('[name="nama_dsn"]').val(data.nama_dsn);
                $('[name="jenis_kelamin_dsn"]').val(data.jenis_kelamin_dsn);
                $('[name="no_hp_dsn"]').val(data.no_hp_dsn);
                $('[name="email_dsn"]').val(data.email_dsn);
                $('[name="alamat_dsn"]').val(data.alamat_dsn);
                $('#modal_add_dosen').modal('show');
            },
            error: function(jqHXR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    text: 'ada terjadi kesalahan saat ambil data!'
                });
            }
        });
    }
</script>