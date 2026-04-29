<?= form_open_multipart('#', ['id' => 'showkepsek']) ?>
<input type="hidden" name="id_jabatan" id="id_jabatan" value="<?php echo $jabatan['id_jabatan'] ?>">

<div class="form-group row">
    <label for="nama_jabatan_edit" class="col-sm-4 col-form-label">Nama Jabatan<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" disabled name="nama_jabatan_edit" id="nama_jabatan_edit" value="<?php echo $jabatan['nama_jabatan'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <?php foreach ($status->result() as $item) { ?>
                <option value="<?php echo $item->id_status ?>" <?php if ($item->id_status == $jabatan['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $item->nama_status ?></option>
            <?php } ?>
        </select>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
</div>
</form>