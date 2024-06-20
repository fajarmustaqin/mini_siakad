<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Mahasiswa Bimbingan Saya</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?=base_url('dosen')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Mahasiswa Bimbingan Saya</li>
        </ol>

        
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <table id="table" class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
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

<div class="modal fade" id="viewMahasiswa" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Mahasiswa</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Mahasiswa</h5>
                        <table class="table no-margin">
                            <tbody>
                                <tr>
                                    <th>Nim</th>
                                    <td><span id="nim"></span></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td><span id="nama"></span></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><span id="email"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><span id="jenis_kelamin"></span></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><span id="alamat"></span></td>
                                </tr>
                                <tr>
                                    <th>No Hp</th>
                                    <td><span id="no_hp"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Orang Tua</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Nama Ayah</th>
                                    <td><span id="nama_ayah"></span></td>
                                </tr>
                                <tr>
                                    <th>No Hp Ayah</th>
                                    <td><span id="no_hp_ayah"></span></td>
                                </tr>
                                <tr>
                                    <th>Nama Ibu</th>
                                    <td><span id="nama_ibu"></span></td>
                                </tr>
                                <tr>
                                    <th>No Hp Ibu</th>
                                    <td><span id="no_hp_ibu"></span></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><span id="alamat_ortu"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var save_method;
    var table;
    var base_url = '<?= base_url(); ?>';

    $(document).ready(function(){
        table = $('#table').DataTable({
            "serverSide" : true,
            "processing" : true,
            "language" : {
                "infoFiltered" : "",
                "processing" : "<img alt='loading...' src='<?php echo base_url()?>/assets/animasi/loading.gif' />"
            },
            "order" : [],

            "ajax" : {
                "url" : "<?php echo site_url('pebimbing/ajaxMahasiswa') ?>",
                "type" : "POST"
            },

            "columnDefs" : [
                {
                    "targets" : [0,5],
                    "orderable" : false,
                }
            ],
        });
    });

    function cekDetail(id){
        $('#viewMahasiswa').modal('show');

        $.ajax({
            url : "<?= site_url('pebimbing/getMhs') ?>/" + id,
            type : "GET",
            dataType : "JSON",
            success : function(data){
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
            },
            error : function (jqHXR, textstatus,errorThrown){
                alert('ada kesalaha ajax');
            }
        });
    }
</script>