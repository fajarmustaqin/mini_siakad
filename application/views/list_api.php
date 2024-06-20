<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Consuming Public Api</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<? base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Consuming Public Api</li>
        </ol>
        <div class="row justify-content-center">

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Consuming Api
            </div>
            <div class="card-bod">
                <table id="table" class="table table-striped table-sm table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Body</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($number as $key) { ?>
                            <tr>
                                <td><?= $key->userId ?></td>
                                <td><?= $key->id ?></td>
                                <td><?= $key->title ?></td>
                                <td><?= $key->body ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>