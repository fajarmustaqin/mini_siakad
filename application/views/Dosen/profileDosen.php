<div id="layoutSidenav_content">
    
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Dosen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('Dosen')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">My Profile</li>
        </ol>
        <button type="button" class="btn btn-primary" onclick="edit()">Edit Data</button>
        <br><br>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>NIDN</th>
                            <td><?= $nidn ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?= $nama ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= $jenis_kelamin ?></td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td><?= $no_hp ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $email ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= $alamat ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modalDosen" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="form">
                    <div class="form-group mb-3">
                        <label for="Nidn">NIDN</label>
                        <small class="text-danger">*</small>
                        <input type="hidden" name="id">
                        <input type="text" class="form-control" name="nidn" id="nidn" value="<?= set_value('nidn') ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Nama">Nama</label>
                        <small class="text-danger">*</small>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama')?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenisKelamin">Jenis Kelamin</label>
                        <small class="text-danger">*</small>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" value="<?= set_value('jenis_kelamin')?>">
                            <option selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="NoHp">No Hp</label>
                        <small class="text-danger">*</small>
                        <input type="number" name="no_hp" class="form-control" id="no_hp" value="<?= set_value('no_hp') ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Email">Email</label>
                        <small class="text-danger"></small>
                        <input type="email" name="email" class="form-control" id="email" value="<?= set_value('email')?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="from-group mb-3">
                        <label for="Alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="<?= set_value('alamat') ?>">
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
    function edit(){
        $('#modalDosen').modal('show');
        $('#modal-title').text('Edit Data Pribadi');
    }

    
</script>