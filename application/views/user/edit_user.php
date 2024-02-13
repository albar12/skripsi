<?= form_open_multipart('#', ['id' => 'edituser']) ?>
<input type="hidden" name="id_user" id="id_user" value="<?php echo $user['id_user'] ?>">
<div class="form-group row">
    <label for="nama_edit" class="col-sm-4 col-form-label">Nama User<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_edit" id="nama_edit" value="<?php echo $user['nama'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="username_edit" class="col-sm-4 col-form-label">Username<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="username_edit" id="username_edit" value="<?php echo $user['username'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="password_edit" class="col-sm-4 col-form-label">Password<font color="red">*</font></label>
    <div class="col-sm-8">
        <div class="input-group" id="show_hide_password">
            <input type="password" class="form-control form-control-sm" name="password_edit" id="password_edit" value="<?php echo $user['password'] ?>">
            <div class="input-group-append">
                <button class="input-group-text" type="button" tabindex="-1"><span class="fas fa-eye-slash" aria-hidden="false"></span></button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="password_old" id="password_old" value="<?php echo $user['password'] ?>">

<div class="form-group row">
    <label for="jenis_kelamin_edit" class="col-sm-4 col-form-label">Jenis Kelamin<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="jenis_kelamin_edit" id="jenis_kelamin_edit">
            <option selected disabled value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-laki" <?php if ($user['jenis_kelamin'] == "Laki-laki") {
                                            echo "selected";
                                        } ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($user['jenis_kelamin'] == "Perempuan") {
                                            echo "selected";
                                        } ?>>Perempuan</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="nomor_hp_edit" class="col-sm-4 col-form-label">Nomor Handphone<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" name="nomor_hp_edit" id="nomor_hp_edit" value="<?php echo $user['nomor_hp'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alamat_edit" class="col-sm-4 col-form-label">Alamat<font color="red">*</font></label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" name="alamat_edit" id="alamat_edit" cols="30" rows="10"><?php echo $user['alamat'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="posisi_edit" class="col-sm-4 col-form-label">Posisi<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="posisi_edit" id="posisi_edit">
            <option selected disabled value="">--Pilih Jenis Posisi--</option>
            <option value="1" <?php if ($user['posisi'] == '1') {
                                    echo 'selected';
                                } ?>>Administrator</option>
            <option value="2" <?php if ($user['posisi'] == '2') {
                                    echo 'selected';
                                } ?>>Owner</option>
            <option value="3" <?php if ($user['posisi'] == '3') {
                                    echo 'selected';
                                } ?>>Supervisor</option>
            <option value="4" <?php if ($user['posisi'] == '4') {
                                    echo 'selected';
                                } ?>>Team Produk</option>
        </select>
    </div>
</div>

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>cancel</button>
    <button type="submit" class="btn btn-xs btn-warning" id="edituser-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>