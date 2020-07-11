<?= $this->extend('layout/templates'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col mt-3">
            <h2 class="mt-3">Ubah Berita</h2>
            <form action="/berita/update/<?= $berita['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $berita['slug']; ?>">
                <input type="hidden" name="sampulLama" value="<?= $berita['sampul']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" placeholder="judul" value="<?= (old('judul')) ? old('judul') : $berita['judul']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" placeholder="penulis" value="<?= (old('penulis')) ? old('penulis') : $berita['penulis']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="isi">Isi Berita</label>
                    <input name="isi" id="isi" cols="30" rows="10" value="<?= (old('isi')) ? old('isi') : $berita['isi']; ?>">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= (old('deskripsi')) ? old('deskripsi') : $berita['deskripsi']; ?>" placeholder="isi deskripsi singkat">
                </div>
                <div class="form-group">
                    <label for="Sampul">Sampul</label>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <img src="/img/<?= $berita['sampul']; ?>" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="imgPreview()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sampul'); ?>
                                </div>
                                <label class="custom-file-label" for="sampul"><?= $berita['sampul']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection('content'); ?>