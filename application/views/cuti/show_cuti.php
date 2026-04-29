<?= form_open_multipart('#', ['id' => 'showcuti']) ?>
<input type="hidden" name="id_cuti" id="id_cuti" value="<?php echo $cuti['id_cuti'] ?>">

<div class="form-group row">
    <label for="user_edit" class="col-sm-4 col-form-label">Pegawai</label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="user_edit" id="user_edit">
            <option selected disabled value="">--Pilih Pegawai--</option>
            <?php foreach ($user->result() as $item) { ?>
                <option value="<?php echo $item->id_user ?>" <?php if ($item->id_user == $cuti['id_user']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $item->nama ?></option>
            <?php  } ?>

        </select>
    </div>
</div>

<div class="form-group row">
    <label for="tanggal_edit" class="col-sm-4 col-form-label">Tanggal</label>
    <div class="col-sm-8">
        <input type="date" class="form-control form-control-sm" min="<?php echo date("Y-m-d", strtotime("+1 days")) ?>" disabled name="tanggal_edit" id="tanggal_edit" value="<?php echo $cuti['tanggal'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="waktu_edit" class="col-sm-4 col-form-label">Waktu (Hari)</label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" name="waktu_edit" id="waktu_edit" disabled value="<?php echo $cuti['waktu'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alasan_edit" class="col-sm-4 col-form-label">Alasan</label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" name="alasan_edit" id="alasan_edit" cols="30" disabled rows="10"><?php echo $cuti['alasan'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="approve" class="col-sm-4 col-form-label">Approve<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="approve" id="approve">
            <option selected disabled value="">--Pilih Approval--</option>
            <option value="Approve" <?php if ($cuti['status'] == "Approve") {
                                        echo "selected";
                                    } ?>>Approve</option>
            <option value="Unapprove" <?php if ($cuti['status'] == "Unapprove") {
                                            echo "selected";
                                        } ?>>Unapprove</option>
        </select>
    </div>
</div>

<div class="my-2" id="approve-data">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
</div>
</form>