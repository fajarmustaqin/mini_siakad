<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Pribadi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Pribadi</li>
        </ol>

        <button type="button" class="btn btn-outline-success" onclick="addMahasiswa()" >Edit Data Pribadi</button>
        <br><br>

        <div class="card mb-4">
            <div class="card-body">
                <table id="table" class="table table-striped">
                    <tbody>
                        <tr>
                            <th>NIM</th>
                            <td><?= $nim ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td><?= $nama ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $email ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= $jenis_kelamin ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= $alamat ?></td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td><?= $no_hp ?></td>
                        </tr>
                        <tr>
                            <th>Nama Ayah</th>
                            <td><?= $nama_ayah ?></td>
                        </tr>
                        <tr>
                            <th>No Hp Ayah</th>
                            <td><?= $no_hp_ayah ?></td>
                        </tr>
                        <tr>
                            <th>Nama Ibu</th>
                            <td><?= $nama_ibu ?></td>
                        </tr>
                        <tr>
                            <th>No Hp Ibu</th>
                            <td><?= $no_hp_ibu ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Orang Tua</th>
                            <td><?= $alamat_ortu; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
