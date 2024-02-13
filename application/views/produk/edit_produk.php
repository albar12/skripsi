<?= form_open_multipart('#', ['id' => 'editproduk']) ?>
<input type="hidden" name="id_produk" id="id_produk" value="<?php echo $produk['id_produk'] ?>">

<div class="form-group row">
    <label for="id_kategori_edit" class="col-sm-4 col-form-label">Kategori<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="id_kategori_edit" id="id_kategori_edit">
            <option disabled selected value="">--Pilih Kategori--</option>
            <?php foreach ($kategori->result() as $data) { ?>
                <option value="<?php echo $data->id_kategori ?>" <?php if ($produk['id_kategori'] == $data->id_kategori) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $data->nama_kategori ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="nama_produk_edit" class="col-sm-4 col-form-label">Nama Produk<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="nama_produk_edit" id="nama_produk_edit" value="<?php echo $produk['nama_produk'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="harga_satuan_edit" class="col-sm-4 col-form-label">Harga Satuan<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" name="harga_satuan_edit" id="harga_satuan_edit" value="<?php echo $produk['harga_satuan'] ?>">
    </div>
</div>
<div class="my-2" id="edit-data">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editproduk-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>