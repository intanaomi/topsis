<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Nomor</th>
                        <th>Nama Alternatif</th>
                        <!-- cara menambah nama kriteria ke tabel secara otomatis -->
                        <?php foreach ($kriteria as $row) : ?>
                            <th><?= $row->nama_kriteria ?></th>
                        <?php endforeach; ?>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif as $alter) : ?>
                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td><?= $alter->nama_alter; ?></td>
                                <?php foreach ($nilaialter[$alter->id_alter] as $nilai) : ?>
                                    <td><?= $nilai ?></td>
                                <?php endforeach; ?>
                                <td width="15%" class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelUbah-<?= $alter->id_alter; ?>"><i class="fas fa-edit"></i></button>
                                </td>
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

    <?php foreach ($alternatif as $alter) : ?>
        <div class="modal fade" id="modelUbah-<?= $alter->id_alter; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Nilai <?= $alter->nama_alter; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('nilaialter/ubah/' . $alter->id_alter) ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group mb-0">
                                <?php foreach ($kriteria as $kri) : ?>
                                    <label for="kriteria[<?= $kri->id_kriteria ?>]"> <?= $kri->nama_kriteria ?> - <?= $kri->atribut ?> </label>
                                    <input type="number" name="kriteria[<?= $kri->id_kriteria ?>]" id="kriteria[<?= $kri->id_kriteria ?>]" class="form-control" value="<?= $nilaialter[$alter->id_alter][$kri->id_kriteria]; ?>" required>
                                <?php endforeach; ?>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <?= $this->endSection(); ?>