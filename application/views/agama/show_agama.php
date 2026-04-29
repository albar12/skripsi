<?= form_open_multipart('#', ['id' => 'showadmin']) ?>
<input type="hidden" name="id_agama" id="id_agama" value="<?php echo $agama['id_agama'] ?>">

<div class="form-group row">
    <label for="nama_agama_edit" class="col-sm-4 col-form-label">Nama Agama<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_agama_edit" disabled id="nama_agama_edit" value="<?php echo $agama['nama_agama'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <?php foreach ($status->result() as $item) { ?>
                <option value="<?php echo $item->id_status ?>" <?php if ($item->id_status == $agama['status']) {
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