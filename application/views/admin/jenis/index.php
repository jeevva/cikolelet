<h5>Jenis Surat</h5>
<div class="row mt-3">
    <div class="col-md-12">
        <a href="<?= base_url("admin/jenis/add") ?>" class="btn btn-primary mb-2">Tambah Jenis Surat</a>
        <?= $this->session->flashdata("add"); ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="table_id">
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 0;
                    foreach ($dataJenis as $row):
                    $no++ 
                ?>
                    <tr>
                    <td><?=$no?></td>
                    <td><?=$row->nama?></td>
                    <td><?=$row->kategori ? str_replace('-', " ", $row->kategori) : "" ?></td>
                    <td>
                        <a class="btn btn-info mr-1" href="<?= base_url("admin/jenis/edit/") . $row->jenis_id ?>">edit</a>
                        <a class="btn btn-danger mt-1" href="<?= base_url("admin/jenis/delete/") . $row->jenis_id ?>" onclick="return confirm('Yakin mau dihapus ?');">hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

