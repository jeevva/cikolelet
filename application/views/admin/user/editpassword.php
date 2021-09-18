

<h5>Edit User Password</h5>
<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url("admin/user/updatepassword/") . $admin['id_admin']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="password"><?= $admin['name'] ?></label>
                <input type="password" class="form-control" id="password" name="password" value=""  required>
            </div>
           

            <button type="submit" class="btn btn-primary">Edit Password</button>
        </form>
    </div>
</div>

