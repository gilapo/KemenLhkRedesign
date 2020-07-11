<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <!-- Post Content Column -->
        <div class="col-lg-8">

            <h1 class="font-weight-light">Berita terkini</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col">
                    <div class="card-deck">
                        <?php foreach ($berita as $i) : ?>
                            <div class="card">
                                <img class="card-img-top" src="/img/<?= $i['sampul']; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $i['judul']; ?></h5>
                                    <p class="card-text"><?= $i['deskripsi']; ?></p>
                                    <a href="<?= $i['slug']; ?>">selengkapnya</a>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">dibuat pada <?= $i['created_at']; ?></small>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="mt-2 mb-3">
                        <a href="/create" class="btn btn-success mt-3">Tambah Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>