<?= form_open_multipart('#', ['id' => 'editjadwal']) ?>
<input type="hidden" id="id_jadwal" , name="id_jadwal" value="<?php echo $jadwal['id_jadwal'] ?>">

<div class="form-group row">
    <label for="hari_edit" class="col-sm-4 col-form-label">Hari<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="hari_edit" id="hari_edit">
            <option selected disabled value="">--Pilih Hari--</option>
            <option value="Senin" <?php if ($jadwal['id_jadwal'] == "Senin") {
                                        echo "selected";
                                    } ?>>Senin</option>
            <option value="Selasa" <?php if ($jadwal['id_jadwal'] == "Selasa") {
                                        echo "selected";
                                    } ?>>Selasa</option>
            <option value="Rabu" <?php if ($jadwal['id_jadwal'] == "Rabu") {
                                        echo "selected";
                                    } ?>>Rabu</option>
            <option value="Kamis" <?php if ($jadwal['id_jadwal'] == "Kamis") {
                                        echo "selected";
                                    } ?>>Kamis</option>
            <option value="Jumat" <?php if ($jadwal['id_jadwal'] == "Jumat") {
                                        echo "selected";
                                    } ?>>Jumat</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="jam_mulai_edit" class="col-sm-4 col-form-label">Jam Mulai<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="time" class="form-control form-control-sm" name="jam_mulai_edit" id="jam_mulai_edit" value="<?php echo $jadwal['jam_mulai'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="jam_selesai_edit" class="col-sm-4 col-form-label">Jam Selesai<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="time" class="form-control form-control-sm" name="jam_selesai_edit" id="jam_selesai_edit" value="<?php echo $jadwal['jam_selesai'] ?>">
    </div>
</div>

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>cancel</button>
    <button type="submit" class="btn btn-xs btn-warning" id="editjadwal-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>