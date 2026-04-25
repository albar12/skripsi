<?= form_open_multipart('#', ['id' => 'editabsensi']) ?>
<input type="hidden" name="id_absensi" id="id_absensi" value="<?php echo $absensi['id_absensi'] ?>">
<div class="form-group row">
    <label for="guru_edit" class="col-sm-4 col-form-label">Guru<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="guru_edit" id="guru_edit">
            <option selected disabled value="">--Pilih Guru--</option>
            <?php foreach ($guru->result() as $item) { ?>
                <option value="<?php echo $item->nip ?>" <?php if ($item->nip == $absensi['nip']) {
                                                                echo "selected";
                                                            } ?>><?php echo $item->nama ?></option>
            <?php  } ?>

        </select>
    </div>
</div>

<div class="form-group row">
    <label for="tanggal_edit" class="col-sm-4 col-form-label">Tanggal<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="date" class="form-control form-control-sm" name="tanggal_edit" id="tanggal_edit" readonly value="<?php echo $absensi['tanggal'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <option value="Hadir" <?php if ($absensi['status'] == "Hadir") {
                                        echo "selected";
                                    } ?>>Hadir</option>
            <option value="Izin" <?php if ($absensi['status'] == "Izin") {
                                        echo "selected";
                                    } ?>>Izin</option>
            <option value="Sakit" <?php if ($absensi['status'] == "Sakit") {
                                        echo "selected";
                                    } ?>>Sakit</option>
            <option value="Alpha" <?php if ($absensi['status'] == "Alpha") {
                                        echo "selected";
                                    } ?>>Alpha</option>
        </select>
    </div>
</div>

<div class="my-2" id="edit-data"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editabsensi-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>