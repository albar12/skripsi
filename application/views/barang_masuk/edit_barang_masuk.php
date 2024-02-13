<?= form_open_multipart('#', ['id' => 'editbarangmasuk']) ?>
<input type="hidden" name="id_barang_masuk" id="id_barang_masuk" value="<?php echo $barang_masuk['id_barang_masuk'] ?>">

<div class="form-group row">
    <label for="id_supp_edit" class="col-sm-4 col-form-label">Supplier<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="id_supp_edit" id="id_supp_edit">
            <option disabled selected value="">--Pilih Kategori--</option>
            <?php foreach ($supplier->result() as $data) { ?>
                <option value="<?php echo $data->id_supp ?>" <?php if ($barang_masuk['id_supp'] == $data->id_supp) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $data->nama_supp ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="id_kategori_edit" class="col-sm-4 col-form-label">Kategori<font color="red">*</font></label>
    <div class="col-sm-8">
        <select onchange="kategori_change_edit()" class="form-control form-control-sm" name="id_kategori_edit" id="id_kategori_edit">
            <option disabled selected value="">--Pilih Kategori--</option>
            <?php foreach ($kategori->result() as $data) { ?>
                <option value="<?php echo $data->id_kategori ?>" <?php if ($barang_masuk['id_kategori'] == $data->id_kategori) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $data->nama_kategori ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="id_produk_edit" class="col-sm-4 col-form-label">Produk<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="id_produk_edit" id="id_produk_edit">
            <option disabled selected value="">--Pilih Produk--</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="tanggal_kadaluarsa_edit" class="col-sm-4 col-form-label">Tanggal Kadaluarsa<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="date" class="form-control form-control-sm" name="tanggal_kadaluarsa_edit" id="tanggal_kadaluarsa_edit" value="<?php echo $barang_masuk['tanggal_kadaluarsa'] ?>">
    </div>
</div>
<div class="my-2" id="info-edit">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editbarangmasuk-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>

<script>
    $(document).ready(function() {
        var id_kategori = '<?php echo $barang_masuk['id_kategori'] ?>';
        var id_produk = '<?php echo $barang_masuk['id_produk'] ?>';
        $.ajax({
            type: "POST",
            url: '<?= base_url('index.php/barangmasuk/get_produk'); ?>',
            data: {
                id_kategori: id_kategori,
                id_produk: id_produk
            },
            success: function(data) {
                $('#id_produk_edit').html(data);
            },
        });
    });

    function kategori_change_edit() {
        var id_kategori = $('#id_kategori').val();
        $.ajax({
            type: "POST",
            url: '<?= base_url('index.php/barangmasuk/get_produk'); ?>',
            data: {
                id_kategori: id_kategori
            },
            success: function(data) {
                $('#id_produk_edit').html(data);
            },
        });
    }
</script>