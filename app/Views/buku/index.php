<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">List Buku</h2>
            <a href="buku/create" class="btn btn-primary mb-3">Tambah Buku</a>
            <form action="" method="POST">
                <div class="input-group mr-3 my-3">
                    <input type="text" class="form-control" placeholder="Cari Buku" name="cari">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
            <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (4 * ($currentPage - 1)); ?>
                    <?php foreach ($buku as $b): ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $b['cover']; ?>" alt="" class="cover"></td>
                        <td><?= $b['judul']; ?></td>
                        <td><a href="buku/<?= $b['slug']; ?>" class="btn btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('buku', 'buku_page') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>