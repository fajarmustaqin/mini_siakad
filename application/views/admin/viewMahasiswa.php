<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Mahasiswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Mahasiswa</li>
            </ol>

            <button type="button" class="btn btn-primary" onclick="addMahasiswa()">+ Tambah</button>
            <br>
            <br>
            <?= $this->session->flashdata('message'); ?>
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Mahasiswa
                </div>
                <div class="card-body table-responsive">
                    <table id="table" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Dosen Pebimbing</th>
                                <th></th>
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

    <div class="modal fade" id="modal_detail_mahasiswa" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-info">Detail Data Mahasiswa</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">Mahasiswa</h5>
                            <table class="table no-margin">
                                <tbody>
                                    <tr>
                                        <th class="text-danger">NIM</th>
                                        <td><span id="nim" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Nama</th>
                                        <td><span id="nama" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Email</th>
                                        <td><span id="email" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Jenis Kelamin</th>
                                        <td><span id="jenis_kelamin" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Alamat</th>
                                        <td><span id="alamat" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">No Hp</th>
                                        <td><span id="no_hp" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">NIDN</th>
                                        <td><span id="nidn" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Dosen Pebimbing</th>
                                        <td><span id="nama_dsn" class="text-success"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Orang Tua</h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-danger">Nama Ayah</th>
                                        <td><span id="nama_ayah" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">No Hp Ayah</th>
                                        <td><span id="no_hp_ayah" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Nama Ibu</th>
                                        <td><span id="nama_ibu" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">No Hp Ibu</th>
                                        <td><span id="no_hp_ibu" class="text-success"></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Alamat</th>
                                        <td><span id="alamat_ortu" class="text-success"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" onclick="">Print</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_add_mahasiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-mhs"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" id="form_mahasiswa">
                        <h4 class="text-center">Data Mahasiswa</h4>
                        <div class="form-group mb-3">
                            <label for="Nim">NIM</label>
                            <small class="text-danger">*</small>
                            <input type="hidden" name="id" id="id" value="<?= set_value('id') ?>">
                            <input type="text" class="form-control" name="nim" id="nim" value="<?= set_value('nim') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Nama">Nama</label>
                            <small class="text-danger">*</small>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Email">Email</label>
                            <small class="text-danger">*</small>
                            <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenisKelamin">Jenis Kelamin</label>
                            <small class="text-danger">*</small>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <small class="text-danger">*</small>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= set_value('alamat') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="NoHp">No Hp</label>
                            <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?= set_value('no_hp') ?>">
                        </div>

                        <h4 class="text-center">Data Orang Tua</h4>
                        <div class="form-group mb-3">
                            <label for="namaAyah">Nama Ayah</label>
                            <small class="text-danger">*</small>
                            <input type="hidden" name="id_ortu" id="id_ortu" value="<?= set_value('id_ortu') ?>">
                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="<?= set_value('nama_ayah') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="NoHpAyah">No Hp Ayah</label>
                            <input type="number" class="form-control" name="no_hp_ayah" id="no_hp_ayah" value="<?= set_value('no_hp_ayah') ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="NamaIbu">Nama Ibu</label>
                            <small class="text-danger">*</small>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= set_value('nama_ibu') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="NoHpibu">No Hp Ibu</label>
                            <input type="number" class="form-control" id="no_hp_ibu" name="no_hp_ibu" value="<?= set_value('no_hp_ibu') ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="AlamatOrtu">Alamat Orang Tua</label>
                            <input type="text" class="form-control" id="alamat_ortu" name="alamat_ortu" value="<?= set_value('alamat_ortu') ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="saveMahasiswa()" id="btnSave" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pilih_dospem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Dosen Pebimbing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form_dospem">
                        <div class="form-group">
                            <input type="hidden" name="id_mhs">
                            <label for="dospem">Dosen Pebimbing</label>
                            <select name="dospem" id="dospem" class="form-select">
                                <option selected disabled>Pilih Dosen Pebimbing</option>
                                <?php foreach ($dosen as $row) : ?>
                                    <option value="<?= $row->id_dsn ?>"><?= $row->nama_dsn ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="save_dospem()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        var save_method;
        var table;
        var base_url = '<?= base_url(); ?>';

        $(document).ready(function() {
            table = $('#table').DataTable({
                "serverSide": true,
                "processing": true,
                "language": {
                    "infoFiltered": "",
                    "processing": "<img alt='loading...' src='<?php echo base_url() ?>/assets/image/loading.gif' />"
                },
                "order": [],

                "ajax": {
                    "url": "<?php echo site_url('mahasiswa/showMhs') ?>",
                    "type": "POST"
                },

                <?php if ($this->session->userdata('id_group') == 1) { ?> "columnDefs": [{
                        "targets": [0, 5, 6, 7, 8],
                        "orderable": false
                    }]
                <?php } else { ?> "columnDefs": [{
                        "targets": [0, 5, 6, 7],
                        "orderable": false
                    }]
                <?php } ?>
            });
        });


        function detail(id) {
            $('#modal_detail_mahasiswa').modal('show');

            $.ajax({
                url: "<?= site_url('mahasiswa/getMhs') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#nim').text(data.nim);
                    $('#nama').text(data.nama);
                    $('#email').text(data.email);
                    $('#jenis_kelamin').text(data.jenis_kelamin);
                    $('#alamat').text(data.alamat);
                    $('#no_hp').text(data.no_hp);
                    $('#nama_ayah').text(data.nama_ayah);
                    $('#no_hp_ayah').text(data.no_hp_ayah);
                    $('#nama_ibu').text(data.nama_ibu);
                    $('#no_hp_ibu').text(data.no_hp_ibu);
                    $('#alamat_ortu').text(data.alamat_ortu);
                    $('#nidn').text(data.nidn);
                    $('#nama_dsn').text(data.nama_dsn);
                },
                error: function(jqHXR, textstatus, errorThrown) {
                    alert('ada kesalaha ajax');
                }
            });
        }



        function reloadTable() {
            table.ajax.reload(null, false);
        }

        function updateMahasiswa(id) {
            save_method = 'update';
            $('#form_mahasiswa')[0].reset();
            $('.form-group').removeClass('has-error');

            $.ajax({
                url: "<?php echo site_url('mahasiswa/getMhs') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-title-mhs').text('Ubah Data Mahasiswa');
                    $('#btnSave').attr('disabled', false);
                    $('#form_mahasiswa').find('input').removeClass('is-invalid');
                    $('#form_mahasiswa').find('select').removeClass('is-invalid');
                    $('[name="id"]').val(data.id);
                    $('[name="nim"]').val(data.nim);
                    $('[name="nama"]').val(data.nama);
                    $('[name="email"]').val(data.email);
                    $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="no_hp"]').val(data.no_hp);
                    $('[name="id_ortu"]').val(data.id_ortu);
                    $('[name="nama_ayah"]').val(data.nama_ayah);
                    $('[name="no_hp_ayah"]').val(data.no_hp_ayah);
                    $('[name="nama_ibu"]').val(data.nama_ibu);
                    $('[name="no_hp_ibu"]').val(data.no_hp_ibu);
                    $('[name="alamat_ortu"]').val(data.alamat_ortu);
                    $('#modal_add_mahasiswa').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('error get data from ajax');
                }
            });
        }

        function addMahasiswa() {
            save_method = 'add';
            $('#form_mahasiswa')[0].reset();
            $('#modal-title-mhs').text('Tambah Data Mahasiswa');
            $('.form-group').removeClass('has-error');
            $('#modal_add_mahasiswa').modal('show');
        }

        function saveMahasiswa() {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disable', true);
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('mahasiswa/addMhs') ?>";
            } else {
                url = "<?php echo site_url('mahasiswa/updateMhs') ?>";
            }

            var formData = new FormData($('#form_mahasiswa')[0]);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modal_add_mahasiswa').modal('hide');
                        reloadTable();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    } else {

                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('Simpan data');
                    $('#btnSave').attr('disable', false);
                },
                error: function() {
                    console.log('error database');
                }
            });
        }


        function deleteMahasiswa(id) {

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
                        url: "<?php echo site_url('mahasiswa/deleteMhs') ?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            reloadTable();
                        },
                        error: function(jqHXR, textStatus, arrorThrown) {
                            alert('error deleting data');
                        }
                    });

                    Swal.fire(
                        'Hapus',
                        'Data Berhasil di Hapus',
                        'success'
                    )
                }
            })
        }

        function modal_dospem(id) {
            $('#form_dospem')[0].reset();
            $('#pilih_dospem').modal('show');
            $.ajax({
                url: "<?= site_url('mahasiswa/getMhs') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_mhs"]').val(data.id);
                },
                error: function() {
                    alert('error ajax');
                }

            })
        }

        function save_dospem() {
            url = "<?php echo site_url('mahasiswa/addDospem') ?>";
            var formData = new FormData($('#form_dospem')[0]);

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    $('#pilih_dospem').modal('hide');
                    reloadTable();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'data berhasil disimpan',
                        showConfirmButton: false,
                        timer: 1000
                    })
                },
                error: function() {
                    console.log('error database');
                }
            });
        }
    </script>