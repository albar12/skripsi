<?= form_open_multipart('#', ['id' => 'editguru']) ?>
<input type="hidden" id="nip" , name="nip" value="<?php echo $guru['nip'] ?>">
<div class="form-group row">
    <label for="nip_edit" class="col-sm-4 col-form-label">NIP<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" disabled name="nip_edit" id="nip_edit" value="<?php echo $guru['nip'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="nama_edit" class="col-sm-4 col-form-label">Nama<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" disabled name="nama_edit" id="nama_edit" value="<?php echo $guru['nama'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="jenis_kelamin_edit" class="col-sm-4 col-form-label">Jenis Kelamin<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="jenis_kelamin_edit" id="jenis_kelamin_edit">
            <option selected disabled value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-laki" <?php if ($guru['jk'] == "Laki-laki") {
                                            echo "selected";
                                        } ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($guru['jk'] == "Perempuan") {
                                            echo "selected";
                                        } ?>>Perempuan</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="jabatan_edit" class="col-sm-4 col-form-label">Jabatan<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="jabatan_edit" id="jabatan_edit">
            <option selected disabled value="">--Pilih Jabatan--</option>
            <option value="Wali Kelas" <?php if ($guru['jabatan'] == "Wali Kelas") {
                                            echo "selected";
                                        } ?>>Wali Kelas</option>
            <option value="Guru Penjas" <?php if ($guru['jabatan'] == "Guru Penjas") {
                                            echo "selected";
                                        } ?>>Guru Penjas</option>
            <option value="Guru Bhs Inggris" <?php if ($guru['jabatan'] == "Guru Bhs Inggris") {
                                                    echo "selected";
                                                } ?>>Guru Bhs Inggris</option>
            <option value="Guru Agama" <?php if ($guru['jabatan'] == "Guru Agama") {
                                            echo "selected";
                                        } ?>>Guru Agama</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="nomor_hp_edit" class="col-sm-4 col-form-label">Nomor Handphone<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="number" class="form-control form-control-sm" disabled name="nomor_hp_edit" id="nomor_hp_edit" value="<?php echo $guru['no_hp'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alamat_edit" class="col-sm-4 col-form-label">Alamat<font color="red">*</font></label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" name="alamat_edit" disabled id="alamat_edit" cols="30" rows="10"><?php echo $guru['alamat'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="agama_edit" class="col-sm-4 col-form-label">Agama<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="agama_edit" id="agama_edit">
            <option selected disabled value="">--Pilih Agama--</option>
            <option value="Islam" <?php if ($guru['agama'] == "Islam") {
                                        echo "selected";
                                    } ?>>Islam</option>
            <option value="Kristen" <?php if ($guru['agama'] == "Kristen") {
                                        echo "selected";
                                    } ?>>Kristen</option>
            <option value="Hindu" <?php if ($guru['agama'] == "Hindu") {
                                        echo "selected";
                                    } ?>>Hindu</option>
            <option value="Budha" <?php if ($guru['agama'] == "Budha") {
                                        echo "selected";
                                    } ?>>Budha</option>
        </select>
    </div>
</div>

<div class="my-2" id="info-edit"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
</div>
</form>