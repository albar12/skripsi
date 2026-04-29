<?= form_open_multipart('#', ['id' => 'editcuti']) ?>
<input type="hidden" name="id_cuti" id="id_cuti" value="<?php echo $cuti['id_cuti'] ?>">

<div class="form-group row">
    <label for="user_data_edit" class="col-sm-4 col-form-label">Pegawai<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="user_data_edit" id="user_data_edit">
            <option selected disabled value="">--Pilih Pegawai--</option>
            <?php foreach ($user->result() as $item) { ?>
                <option value="<?php echo $item->id_user ?>" <?php if ($item->id_user == $cuti['id_user']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $item->nama ?></option>
            <?php  } ?>
        </select>
        <input type="hidden" id="user_edit" name="user_edit" value="<?php echo $this->session->userdata("id_user") ?>">
    </div>
</div>

<div class="form-group row">
    <label for="tanggal_edit" class="col-sm-4 col-form-label">Tanggal<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="date" class="form-control form-control-sm" min="<?php echo date("Y-m-d", strtotime("+1 days")) ?>" name="tanggal_edit" id="tanggal_edit" value="<?php echo $cuti['tanggal'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="waktu_edit" class="col-sm-4 col-form-label">Waktu (Hari)<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" name="waktu_edit" id="waktu_edit" value="<?php echo $cuti['waktu'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alasan_edit" class="col-sm-4 col-form-label">Alasan<font color="red">*</font></label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" name="alasan_edit" id="alasan_edit" cols="30" rows="10"><?php echo $cuti['alasan'] ?></textarea>
    </div>
</div>

<div class="my-2" id="info-edit">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editcuti-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>