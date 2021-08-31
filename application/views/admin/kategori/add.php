<h5>Tambah Kategori Surat</h5>
<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url("admin/kategori/save") ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Kategori Surat</label>
                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="masukkan kategori surat" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>