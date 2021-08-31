<h5>Edit User</h5>
<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url("admin/user/editlist/") . $userList['id_admin']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Surat</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $userList['name'] ?>"  required>
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select class="form-control form-control-user " id="kategori_id" name="_id" required="true" >
                    <option value="" disabled selected>Pilih Role </option>
                    <option value="0">Super Admin</option>
                    <option value="1">Staff</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

