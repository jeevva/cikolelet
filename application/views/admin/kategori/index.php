<h5>Kategori Surat</h5>
<div class="row mt-3">
    <div class="col-md-12">
        <a href="<?= base_url("admin/kategori/add") ?>" class="btn btn-primary mb-2">Tambah Kategori Surat</a>
        <?= $this->session->flashdata("add"); ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="table_id">
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kategori as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td><?= $value['kategori'] ? str_replace('-', " ", $value['kategori']) : ""; ?></td>
                            <td>
                                <a class="btn btn-info mr-1" href="<?= base_url("admin/kategori/edit/") . $value['kategori_id'] ?>">edit</a>
                                <a class="btn btn-danger mt-1" href="<?= base_url("admin/kategori/delete/") . $value['kategori_id'] ?>" onclick="return confirm('Yakin mau dihapus ?');">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

