<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Akun</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Akun</li>
            </ol>
            <button class="btn btn-primary" onclick="add()">Tambah Akun</button>
            <br><br>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Akun
                </div>
                <div class="card-body table-responsive">
                    <table id="tableAkun" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Real Name</th>
                                <th>Email</th>
                                <th>Role User</th>
                                <th></th>
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

    <div class="modal fade" id="modalAkun" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="formAkun">
                        <div class="form-group mb-3">
                            <label for="Username">Username</label>
                            <small class="text-danger">*</small>
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="NamaLengkap">Nama Lengkap</label>
                            <small class="text-danger">*</small>
                            <input type="text" class="form-control" id="real_name" name="real_name" value="<?= set_value('real_name') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Email">Email</label>
                            <small class="text-danger">*</small>
                            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3" id="ps">
                            <label for="Password">Password</label>
                            <small class="text-danger">*</small>
                            <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password') ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="IdGroup">Id Group</label>
                            <small class="text-danger">*</small>
                            <select name="id_group" id="id_group" class="form-select" value="<?= set_value('id_group') ?>">
                                <option selected disabled>Pilih Id Group</option>
                                <option value="1">Administrator</option>
                                <option value="2">Admin Baak</option>
                                <option value="3">Dosen</option>
                                <option value="4">Mahasiswa</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="btnSave" onclick="save()">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var table;
        var save_method;
        var base_url = '<?= base_url(); ?>';
        var formAkun = $('#formAkun');
        var btnSave = $('#btnSave');

        $(document).ready(function() {
            table = $('#tableAkun').DataTable({
                "serverSide": true,
                "Processing": true,
                "languange": {
                    "infoFiltered": "",
                    "processing": "<img alt='loading...' src='<?php echo base_url() ?>/assets/animasi/loading.gif' />"

                },
                "order": [],
                "columnDefs": [{
                    "targets": [5, 6],
                    "orderable": false
                }],
                "ajax": {
                    "url": "<?php echo site_url('akun/showAkun') ?>",
                    "type": "POST"
                }
            });
        });

        function reloadTable() {
            table.ajax.reload(null, false);
        }

        function add() {
            save_method = 'add';
            formAkun[0].reset();
            $('.form-group').removeClass('has-error');
            $('#modalAkun').modal('show');
            $('#modal-title').text('Tambah Akun');
        }

        function save() {
            btnSave.text('Wait..');
            btnSave.attr('disabled', true);

            var url;

            if (save_method == 'add') {
                url = "<?= base_url('akun/addAkun'); ?>";
            } else {
                url = "<?= base_url('akun/updateAkun'); ?>";
            }

            $.ajax({
                type: 'POST',
                url: url,
                data: formAkun.serialize(),
                dataType: 'JSON',
                success: function(response) {
                    $('#modalAkun').modal('hide');
                    reloadTable();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function() {
                    console.log('error database');
                }

            });
        }

        function updateUser(id) {
            save_method = 'update';
            $('#formAkun')[0].reset();
            $('.form-group').removeClass('has-error');

            $.ajax({
                url: "<?= site_url('akun/getAkun') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('#modal-title').text('Ubah Data Akun');
                    $('#btnSave').attr('disabled', false);
                    $('#formAkun').find('input').removeClass('is-invalid');
                    $('[name="id"]').val(data.id);
                    $('[name="username"]').val(data.username);
                    $('[name="real_name"]').val(data.real_name);
                    $('[name="email"]').val(data.email);
                    $('#ps').remove();
                    $('[name="id_group"]').val(data.id_group);
                    $('#modalAkun').modal('show');
                },
                error: function(jqHXR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        text: 'ada terjadi kesalahan saat ambil data!'
                    });
                }
            });
        }

        function deleteUser(id) {
            Swal.fire({
                title: 'Hapus',
                text: "Apakah anda yakin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('akun/deleteAkun') ?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(response) {
                            reloadTable();
                            Swal.fire(
                                'Deleted!',
                                'data berhasil dihapus.',
                                'success'
                            )
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'ada kesalahan',
                                text: 'harus menghapus data mahasiswa atau dosen terlebih dahulu!'
                            })
                        }
                    })
                }
            })
        }
    </script>