<h5>List User</h5>
<div class="row mt-3">
    <div class="col-md-12">
        <a href="<?= base_url("admin/user/add") ?>" class="btn btn-primary mb-2">Tambah User</a>
        <?= $this->session->flashdata("add"); ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="table_id">
                <thead class="thead-primary">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">User</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userList as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['emails'] ?></td>
                            <?php if( $value['role'] == 0):?>
                            <td>Super Admin</td>
                            <?php elseif( $value['role'] == 1):?>
                            <td>Staff</td>
                            <?php else:?>
                            <?php endif;?>

                            <td>
                                <a class="btn btn-info mr-1 mt-1" href="<?= base_url("admin/user/edit/") . $value['id_admin'] ?>">edit</a>
                                <a class="btn btn-warning mr-1 mt-1" href="<?= base_url("admin/user/editpassword/") . $value['id_admin'] ?>">edit password</a>
                                <a class="btn btn-danger mt-1 mt-1" href="<?= base_url("admin/user/deletelist/") . $value['id_admin'] ?>" onclick="return confirm('Yakin mau dihapus ?');">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>