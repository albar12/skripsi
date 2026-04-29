<?= form_open_multipart('#', ['id' => 'editmapel']) ?>
<input type="hidden" name="id_mapel" id="id_mapel" value="<?php echo $mapel['id_mapel'] ?>">

<div class="form-group row">
    <label for="mapel_edit" class="col-sm-4 col-form-label">Nama Mata Pelajaran<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="mapel_edit" id="mapel_edit" value="<?php echo $mapel['nama_mapel'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <?php foreach ($status->result() as $item) { ?>
                <option value="<?php echo $item->id_status ?>" <?php if ($item->id_status == $mapel['status']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $item->nama_status ?></option>
            <?php  } ?>
        </select>
    </div>
</div>

<div class="my-2" id="info-edit">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editmapel-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>