<h5>Edit Jenis Surat</h5>
    <?php foreach ($desa as $key => $value) : ?>
<div class="row">
    <div class="col-md-12">
    <form action="<?= base_url("admin/desa/update/") . $value['profil_desa_id']; ?>" method="post" enctype="multipart/form-data">
    <?= $this->session->flashdata('message'); ?>
    
        <div class="form-group">
            <label for="nama">Nama Desa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $value['nama']; ?>"  required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Desa</label>
            <textarea type="text" class="form-control" id="alamat" name="alamat" value="<?= $value['alamat']; ?>" required><?= $value['alamat']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="telp">Telepon</label>
            <input type="tel" class="form-control" id="telp" name="telp" value="<?= $value['telp']; ?>"  required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $value['email']; ?>" placeholder="<?= $value['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="total_pria">Jumlah Penduduk Pria</label>
            <input type="number" class="form-control" id="total_pria" name="total_pria" value="<?= $value['total_pria']; ?>" onkeyup="sum();" placeholder="<?= $value['total_pria']; ?>" required>
        </div>
        <div class="form-group">
            <label for="total_wanita">Jumlah Penduduk Wanita</label>
            <input type="number" class="form-control" id="total_wanita" name="total_wanita" value="<?= $value['total_wanita']; ?>" onkeyup="sum();" placeholder="<?= $value['total_wanita']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nama">Jumlah Penduduk</label>
            <input type="number" class="form-control" id="total_penduduk" name="total_penduduk" value="<?= $value['total_penduduk']; ?>"  placeholder="<?= $value['total_penduduk']; ?>" required>
            
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $value['deskripsi']; ?>" placeholder="" required><?= $value['deskripsi']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="gmaps">Maps</label>
            <input type="text" class="form-control" id="gmaps" name="gmaps" value="<?= $value['gmaps']; ?>" placeholder="<?= $value['gmaps']; ?>" >
        </div>
        <?php endforeach; ?>
  
           
   

    <button type="submit" class="btn btn-primary">Edit</button>
  
        </form>
    </div>
</div>
<input type="number" id="form-controls" id="id_admin" name="id_admin" value="<?= $user['id_admin']; ?>"  placeholder="<?= $user['id_admin']; ?>" required>
  
