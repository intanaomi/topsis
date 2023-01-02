<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">


                <?php if (session('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <!-- <?= session('success'); ?> -->
                    </div>
                <?php endif; ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Nomor</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai Preferensi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif as $row) : ?>
                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td><?= $row->nama_alter; ?></td>
                                <td><?= $row->hasil_alter; ?></td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <?= $this->endSection(); ?>