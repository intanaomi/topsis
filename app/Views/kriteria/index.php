<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelTambah">
                    Tambah data
                </button>

                <?php if (session('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <!-- <?= session('success'); ?> -->
                    </div>
                <?php endif; ?>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <th>Nomor</th>
                        <th>Nama Kriteria</th>
                        <th>Atribut</th>
                        <th>Bobot</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($kriteria as $row) : ?>
                            <tr>
                                <td scope="row"><?= $no; ?></td>
                                <td><?= $row->nama_kriteria; ?></td>
                                <td><?= $row->atribut; ?></td>
                                <td><?= $row->bobot; ?></td>
                                <td width="15%" class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelUbah-<?= $row->id_kriteria; ?>"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelHapus-<?= $row->id_kriteria; ?>"><i class="fas fa-trash-alt"></i></button>
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

    <!-- Modal tambah -->
    <div class="modal fade" id="modelTambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kriteria/tambah'); ?>" method="post">
                        <div class="form-group mb-0">
                            <label for="nama_kriteria">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" placeholder="Masukan Nama Kriteria">
                        </div>
                        <div class="form-group mb-0">
                            <label for="atribut">Atribut</label>
                            <input type="text" name="atribut" id="atribut" class="form-control" placeholder="Masukan Nama Atribut">
                        </div>
                        <div class="form-group mb-0">
                            <label for="bobot">Bobot Kriteria (1 s/d 5)</label>
                            <input type="number" name="bobot" id="bobot" min="1" maxlength="1" max="5" class="form-control" placeholder="Masukan Bobot kriteria">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal ubah -->

    <?php foreach ($kriteria as $kriteria) : ?>

        <div class="modal fade" id="modelUbah-<?= $kriteria->id_kriteria; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('kriteria/ubah/' . $kriteria->id_kriteria) ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group mb-0">
                                <label for="nama_kriteria">Kode Kriteria</label>
                                <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" value="<?= $kriteria->nama_kriteria; ?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="atribut">Atribut</label>
                                <input type="text" name="atribut" id="atribut" class="form-control" value="<?= $kriteria->atribut; ?>" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="bobot">Bobot Kriteria (1 s/d 5)</label>
                                <input type="number" name="bobot" id="bobot" maxlength="1" max="5" min="1" class="form-control" value="<?= $kriteria->bobot; ?>" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modelHapus-<?= $kriteria->id_kriteria; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus <?= $kriteria->nama_kriteria ?> <?= $kriteria->atribut ?> ?</h5>
                    </div>
                    <!--                    <div class="modal-body">-->
                    <form action="<?= base_url('kriteria/hapus/' . $kriteria->id_kriteria) ?>" method="post">
                        <?= csrf_field(); ?>
                        <!--                    </div>-->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal hapus -->


    <?= $this->endSection(); ?>