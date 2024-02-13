<?= form_open_multipart('#', ['id' => 'editpelanggan']) ?>
<input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?php echo $pelanggan['id_pelanggan'] ?>">
<div class="form-group row">
    <label for="nama_pelanggan_edit" class="col-sm-4 col-form-label">Nama Pelanggan<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_pelanggan_edit" id="nama_pelanggan_edit" value="<?php echo $pelanggan['nama_pelanggan'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alamat_pelanggan_edit" class="col-sm-4 col-form-label">Alamat Pelanggan<font color="red">*</font></label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" name="alamat_pelanggan_edit" id="alamat_pelanggan_edit" cols="30" rows="10"><?php echo $pelanggan['alamat_pelanggan'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="jenis_kelamin_edit" class="col-sm-4 col-form-label">Jenis Kelamin<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="jenis_kelamin_edit" id="jenis_kelamin_edit">
            <option selected disabled value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-laki" <?php if ($pelanggan['jenis_kelamin'] == "Laki-laki") {
                                            echo 'selected';
                                        } ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($pelanggan['jenis_kelamin'] == "Perempuan") {
                                            echo 'selected';
                                        } ?>>Perempuan</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="tlp_pelanggan_edit" class="col-sm-4 col-form-label">Nomor Telephone<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" name="tlp_pelanggan_edit" id="tlp_pelanggan_edit" value="<?php echo $pelanggan['tlp_pelanggan'] ?>">
    </div>
</div>

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editpelanggan-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>