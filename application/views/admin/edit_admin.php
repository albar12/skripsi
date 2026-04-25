<?= form_open_multipart('#', ['id' => 'editadmin']) ?>
<input type="hidden" name="id_admin" id="id_admin" value="<?php echo $admin['id_admin'] ?>">
<div class="form-group row">
    <label for="nama_edit" class="col-sm-4 col-form-label">Nama<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_edit" id="nama_edit" value="<?php echo $admin['nama_admin'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="username_admin_edit" class="col-sm-4 col-form-label">Username<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="username_admin_edit" id="username_admin_edit" disabled value="<?php echo $admin['username'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="password_admin_edit" class="col-sm-4 col-form-label">Password <font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="password" class="form-control form-control-sm" name="password_admin_edit" id="password_admin_edit" value="<?php echo $admin['password'] ?>">
        <input type="checkbox" onclick="togglePasswordedit()"> Show Password
    </div>
    <input type="hidden" class="form-control form-control-sm" name="password_admin_old" id="password_admin_old" value="<?php echo $admin['password'] ?>">

</div>

<div class="form-group row">
    <label for="role_edit" class="col-sm-4 col-form-label">Role<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="role_edit" id="role_edit">
            <option selected disabled value="">--Pilih Role--</option>
            <option value="Admin" <?php if ($admin['role'] == "Admin") {
                                        echo "selected";
                                    } ?>>Admin</option>
            <option value="Kepala Sekolah" <?php if ($admin['role'] == "Kepala Sekolah") {
                                                echo "selected";
                                            } ?>>Kepala Sekolah</option>
        </select>
    </div>
</div>

<div class="my-2" id="edit-data"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editadmin-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>