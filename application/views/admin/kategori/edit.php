<h5>Edit Jenis Surat</h5>
<div class="row">
    <div class="col-md-6">
    <form action="<?= base_url("admin/kategori/update/") . $kategori['kategori_id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Kategori Surat</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $kategori['kategori'] ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
       
    </div>
</div>

