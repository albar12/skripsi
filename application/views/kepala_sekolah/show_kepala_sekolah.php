<?= form_open_multipart('#', ['id' => 'showkepsek']) ?>
<input type="hidden" name="nip" id="nip" value="<?php echo $kepsek['nip'] ?>">
<div class="form-group row">
    <label for="nip_edit" class="col-sm-4 col-form-label">NIP<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nip_edit" id="nip_edit" disabled value="<?php echo $kepsek['nip'] ?>">
    </div>
</div>
<div class="form-group row">
    <label for="nama_edit" class="col-sm-4 col-form-label">Nama<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" disabled name="nama_edit" id="nama_edit" value="<?php echo $kepsek['nama_kepsek'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="username_kepsek_edit" class="col-sm-4 col-form-label">Username<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="username_kepsek_edit" disabled id="username_kepsek_edit" disabled value="<?php echo $kepsek['username'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="role_edit" class="col-sm-4 col-form-label">Role<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="role_edit" id="role_edit">
            <option selected disabled value="">--Pilih Role--</option>
            <option value="Admin" <?php if ($kepsek['role'] == "Admin") {
                                        echo "selected";
                                    } ?>>Admin</option>
            <option value="Guru" <?php if ($kepsek['role'] == "Guru") {
                                        echo "selected";
                                    } ?>>Guru</option>
        </select>
    </div>
</div>

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
</div>
</form>