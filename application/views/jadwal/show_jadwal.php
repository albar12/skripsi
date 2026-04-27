<?= form_open_multipart('#', ['id' => 'showjadwal']) ?>
<input type="hidden" id="id_jadwal" , name="id_jadwal" value="<?php echo $jadwal['id_jadwal'] ?>">

<div class="form-group row">
    <label for="hari_edit" class="col-sm-4 col-form-label">Hari<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="hari_edit" id="hari_edit">
            <option selected disabled value="">--Pilih Hari--</option>
            <option value="Senin" <?php if ($jadwal['hari'] == "Senin") {
                                        echo "selected";
                                    } ?>>Senin</option>
            <option value="Selasa" <?php if ($jadwal['hari'] == "Selasa") {
                                        echo "selected";
                                    } ?>>Selasa</option>
            <option value="Rabu" <?php if ($jadwal['hari'] == "Rabu") {
                                        echo "selected";
                                    } ?>>Rabu</option>
            <option value="Kamis" <?php if ($jadwal['hari'] == "Kamis") {
                                        echo "selected";
                                    } ?>>Kamis</option>
            <option value="Jumat" <?php if ($jadwal['hari'] == "Jumat") {
                                        echo "selected";
                                    } ?>>Jumat</option>
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

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
</div>
</form>