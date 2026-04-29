<?= form_open_multipart('#', ['id' => 'editjabatan']) ?>
<input type="hidden" name="id_jabatan" id="id_jabatan" value="<?php echo $jabatan['id_jabatan'] ?>">

<div class="form-group row">
    <label for="nama_jabatan_edit" class="col-sm-4 col-form-label">Nama Jabatan<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_jabatan_edit" id="nama_jabatan_edit" value="<?php echo $jabatan['nama_jabatan'] ?>">
        <input type="hidden" class="form-control form-control-sm" name="nama_jabatan_old" id="nama_jabatan_old" value="<?php echo $jabatan['nama_jabatan'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <?php foreach ($status->result() as $item) { ?>
                <option value="<?php echo $item->id_status ?>" <?php if ($item->id_status == $jabatan['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $item->nama_status ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editjabatan-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>