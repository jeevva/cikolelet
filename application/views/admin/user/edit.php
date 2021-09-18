

<h5>Edit User</h5>
<div class="row">
    <div class="col-md-6">
        <form action="<?= base_url("admin/user/update/") . $admin['id_admin']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Admin</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $admin['name'] ?>"  required>
            </div>
            <div class="form-group">
                <label for="nama">Email Admin</label>s
                <input type="email" class="form-control" id="emails" name="emails" value="<?= $admin['emails'] ?>"  required>
            </div> 

            <div class="form-group">    
            <label for="role">Role</label>
                <select class="form-control " id="role" name="role" required="true" >
                    <option value="" disabled selected>Pilih Role </option>
                    <option value="0" >Super Admin </option>
                    <option value="1" >Staff</option>

                </select>
            </div>



            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

