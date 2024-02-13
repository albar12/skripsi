<?= form_open_multipart('#', ['id' => 'editstokopname']) ?>
<input type="hidden" name="id_barang_keluar" id="id_barang_keluar" value="<?php echo $stok_opname['id_barang_keluar'] ?>">
<input type="hidden" name="flag_so" id="flag_so" value="<?php echo $stok_opname['flag_so'] ?>">

<div class="form-group row">
    <label for="id_kategori_edit" class="col-sm-4 col-form-label">Kategori<font color="red">*</font></label>
    <div class="col-sm-8">
        <select onchange="kategori_change_edit()" class="form-control form-control-sm" name="id_kategori_edit" id="id_kategori_edit">
            <option disabled selected value="">--Pilih Kategori--</option>
            <?php foreach ($kategori->result() as $data) { ?>
                <option value="<?php echo $data->id_kategori ?>" <?php if ($stok_opname['id_kategori'] == $data->id_kategori) {
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
    <label for="jumlah_edit" class="col-sm-4 col-form-label">Jumlah<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" name="jumlah_edit" id="jumlah_edit" value="<?php echo $stok_opname['jumlah'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="status_produk_edit" class="col-sm-4 col-form-label">Status Produk<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" name="status_produk_edit" id="status_produk_edit">
            <option disabled selected value="">--Pilih Status--</option>
            <option value="Produk Kadaluarsa" <?php if ($stok_opname['status_produk'] == 'Produk Kadaluarsa') {
                                                    echo 'selected';
                                                } ?>>Produk Kadaluarsa</option>
            <option value="Produk Rusak" <?php if ($stok_opname['status_produk'] == 'Produk Rusak') {
                                                echo 'selected';
                                            } ?>>Produk Rusak</option>
        </select>
    </div>
</div>
<div class="my-2" id="info-edit">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Cancel</button>
    <button type="submit" class="btn btn-xs btn-primary" id="editstokopname-btn"><span class="fas fa-plus mr-1"></span>Edit</button>
</div>
</form>

<script>
    $(document).ready(function() {
        var id_kategori = '<?php echo $stok_opname['id_kategori'] ?>';
        var id_produk = '<?php echo $stok_opname['id_produk'] ?>';
        $.ajax({
            type: "POST",
            url: '<?= base_url('stokopname/get_produk_edit'); ?>',
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
            url: '<?= base_url('stokopname/get_produk'); ?>',
            data: {
                id_kategori: id_kategori
            },
            success: function(data) {
                $('#id_produk_edit').html(data);
            },
        });
    }
</script>