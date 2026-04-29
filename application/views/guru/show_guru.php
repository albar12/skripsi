<?= form_open_multipart('#', ['id' => 'showguru']) ?>
<input type="hidden" id="id_user" , name="id_user" value="<?php echo $guru['id_user'] ?>">

<div class="form-group row">
    <label for="nip_edit" class="col-sm-4 col-form-label">NIP<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" disabled name="nip_edit" id="nip_edit" value="<?php echo $guru['nip'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="nama_edit" class="col-sm-4 col-form-label">Nama Guru<font color="red">*</font></label>
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
                                            echo 'selected';
                                        } ?>>Laki-laki</option>
            <option value="Perempuan" <?php if ($guru['jk'] == "Perempuan") {
                                            echo 'selected';
                                        } ?>>Perempuan</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="jabatan_edit" class="col-sm-4 col-form-label">Jabatan<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="jabatan_edit" id="jabatan_edit">
            <option selected disabled value="">--Pilih Jabatan--</option>
            <?php foreach ($jabatan->result() as $r) { ?>
                <option value="<?php echo $r->id_jabatan ?>" <?php if ($r->id_jabatan == $guru['jabatan']) {
                                                                    echo "selected";
                                                                } ?>><?php echo $r->nama_jabatan ?></option>
            <?php } ?>
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
    <label for="email_edit" class="col-sm-4 col-form-label">Email<font color="red">*</font></label>
    <div class="col-sm-8">
        <input type="email" class="form-control form-control-sm" disabled name="email_edit" id="email_edit" value="<?php echo $guru['email'] ?>">
    </div>
</div>

<div class="form-group row">
    <label for="alamat_edit" class="col-sm-4 col-form-label">Alamat<font color="red">*</font></label>
    <div class="col-sm-8">
        <textarea class="form-control form-control-sm" disabled name="alamat_edit" id="alamat_edit" cols="30" rows="10"><?php echo $guru['alamat'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="agama_edit" class="col-sm-4 col-form-label">Agama<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="agama_edit" id="agama_edit">
            <option selected disabled value="">--Pilih Agama--</option>
            <?php foreach ($agama->result() as $r) { ?>
                <option value="<?php echo $r->id_agama ?>" <?php if ($r->id_agama == $guru['agama']) {
                                                                echo "selected";
                                                            } ?>><?php echo $r->nama_agama ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="status_edit" class="col-sm-4 col-form-label">Status<font color="red">*</font></label>
    <div class="col-sm-8">
        <select class="form-control form-control-sm" disabled name="status_edit" id="status_edit">
            <option selected disabled value="">--Pilih Status--</option>
            <?php foreach ($status->result() as $r) { ?>
                <option value="<?php echo $r->id_status ?>" <?php if ($r->id_status == $guru['status']) {
                                                                echo "selected";
                                                            } ?>><?php echo $r->nama_status ?></option>
            <?php } ?>
        </select>
    </div>
</div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal"><span class="fas fa-times mr-1"></span>Tutup</button>
</div>
</form>