<?= form_open_multipart('#', ['id' => 'editkategori']) ?>
<input type="hidden" name="id_kategori" id="id_kategori" value="<?php echo $kategori['id_kategori'] ?>">
<div class="form-group row">
    <label for="nama_kategori_edit" class="col-sm-4 col-form-label">Nama Kategori<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_kategori_edit" id="nama_kategori_edit" value="<?php echo $kategori['nama_kategori'] ?>">
    </div>
</div>

<div class="my-2" id="edit-data"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editkategori-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>