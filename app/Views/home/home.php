<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>

<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('<?= base_url('images/hero_1.jpg'); ?>')">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="display-4">mari jaga hutan kita</h3>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam dolorum sequi voluptates natus cumque, ipsam molestiae delectus error laboriosam consequatur beatae repudiandae recusandae similique dicta facilis. Deleniti ex commodi hic.</p>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('<?= base_url('images/hero_2.jpg'); ?>')">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="display-4">Jaga Kekayaan Alam Indonesia</h3>
                    <p class="lead">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veritatis temporibus obcaecati magnam placeat vitae, mollitia dolorum sint dolore ex sed officia voluptatem exercitationem asperiores architecto aut deserunt vel debitis nostrum.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<!-- Page Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col">
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
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <a href="berita/create" class="btn btn-success mt-5">Tambah Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>