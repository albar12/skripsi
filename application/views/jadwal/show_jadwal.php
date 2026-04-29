<?= form_open_multipart('#', ['id' => 'showjadwal']) ?>
<input type="hidden" id="id_jadwal" , name="id_jadwal" value="<?php echo $jadwal['id_jadwal'] ?>">

<div class="form-group row">
    <label for="mapel_edit" class="col-sm-4 col-form-label">Mata Pelajaran<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="mapel_edit" id="mapel_edit">
            <option selected disabled value="">--Pilih Mata Pelajaran--</option>
            <?php foreach ($mapel->result() as $item) { ?>
                <option value="<?php echo $item->id_mapel ?>" <?php if ($item->id_mapel == $jadwal['id_mapel']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $item->nama_mapel ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="jam_mulai_edit" class="col-sm-4 col-form-label">Jam Mulai<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="time" class="form-control form-control-sm" name="jam_mulai_edit" disabled id="jam_mulai_edit" value="<?php echo $jadwal['jam_mulai'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="jam_selesai_edit" class="col-sm-4 col-form-label">Jam Selesai<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="time" class="form-control form-control-sm" name="jam_selesai_edit" disabled id="jam_selesai_edit" value="<?php echo $jadwal['jam_selesai'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <?php foreach ($status->result() as $item) { ?>
                <option value="<?php echo $item->id_status ?>" <?php if ($item->id_status == $jadwal['status']) {
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