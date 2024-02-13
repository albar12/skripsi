<?= form_open_multipart('#', ['id' => 'editsupplier']) ?>
<input type="hidden" name="id_supp" id="id_supp" value="<?php echo $supplier['id_supp'] ?>">
<div class="form-group row">
    <label for="nama_supp_edit" class="col-sm-4 col-form-label">Nama Supplier<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_supp_edit" id="nama_supp_edit" value="<?php echo $supplier['nama_supp'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alamat_supp_edit" class="col-sm-4 col-form-label">Alamat Supplier<font color="red">*</font></label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" name="alamat_supp_edit" id="alamat_supp_edit" cols="30" rows="10"><?php echo $supplier['alamat_supp'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="tlp_supp_edit" class="col-sm-4 col-form-label">Nomor Telephone<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" name="tlp_supp_edit" id="tlp_supp_edit" value="<?php echo $supplier['tlp_supp'] ?>">
    </div>
</div>

<div class="my-2" id="edit-data"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editsupplier-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>