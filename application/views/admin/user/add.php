<h5>Tambah User</h5>
<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url("admin/user/save") ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Admin</label>
                <input type="text" class="form-control" id="name" name="name" value=""  required>
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                <label for="emails">Email Admin</label>
                <input type="email" class="form-control" id="emails" name="emails" value=""  required>
                <?= form_error('emails', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control form-control-user " id="role" name="role" required="true" >
                    <option value="" disabled selected>Pilih Role </option>
                    <option value="0" >Super Admin </option>
                    <option value="1" >Staff</option>

                </select>
                <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                <label for="password1">Pasword</label>
                <input type="password" class="form-control" id="password1" name="password1" value="" required >
                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
            

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

