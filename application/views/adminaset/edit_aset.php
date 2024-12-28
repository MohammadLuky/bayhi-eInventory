<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('adminaset'); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="card card-outline card-olive">
                        <form action="<?= base_url('adminaset/edit_aset/') . $get_aset['id_input_aset']; ?>" method="post">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Edit Aset</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('adminaset/hasil_input_aset'); ?>" type="button" class="btn  btn-warning btn-sm"><i class="fas fa-step-backward"></i> Hasil Inputan</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id_input_aset" id="id_input_aset" value="<?= $get_aset['id_input_aset']; ?>">
                                            <label class="floating-label">Sub Unit</label>
                                            <select class="form-control" name="aset_sub_unit" id="aset_sub_unit" disabled style="width: 100%;">
                                                <option value="">Pilih Sub Unit</option>
                                                <?php foreach ($sub_unit as $sb) : ?>
                                                    <?php if ($get_aset['aset_sub_unit_id'] == $sb['id_sub_unit']) : ?>
                                                        <option value="<?= $sb['id_sub_unit']; ?>" data-value1="<?= $sb['gedung_sub_unit_id']; ?>" data-value2="<?= $sb['unit_id']; ?>" data-value3="<?= $sb['ruang_sub_unit_id']; ?>" selected><?= $sb['nama_gedung']; ?> || Unit <?= $sb['nama_unit']; ?> || <?= $sb['nama_ruang']; ?> || <?= $sb['nama_sub_unit']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $sb['id_sub_unit']; ?>" data-value1="<?= $sb['gedung_sub_unit_id']; ?>" data-value2="<?= $sb['unit_id']; ?>" data-value3="<?= $sb['ruang_sub_unit_id']; ?>"><?= $sb['nama_gedung']; ?> || Unit <?= $sb['nama_unit']; ?> || <?= $sb['nama_ruang']; ?> || <?= $sb['nama_sub_unit']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <p><code>Hanya bisa diubah di menu mutasi aset.</code></p>
                                            <input type="hidden" id="value_aset_input1" name="value_aset_input1" placeholder="Id Gedung" value="<?= $get_aset['lokasi_gedung_id']; ?>">
                                            <input type="hidden" id="value_aset_input2" name="value_aset_input2" placeholder="Id Unit" value="<?= $get_aset['aset_unit_id']; ?>">
                                            <input type="hidden" id="value_aset_input3" name="value_aset_input3" placeholder="Id Ruang" value="<?= $get_aset['lokasi_ruang_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Penanggung Jawab</label>
                                            <input type="text" class="form-control" value="<?= $get_aset['jabatan_pengguna']; ?> | <?= $get_aset['nama']; ?>" readonly>
                                            <p><code>Hanya bisa diubah di menu mutasi aset.</code></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Nama Sarana</label>
                                            <input type="text" class="form-control" id="nama_sarana" name="nama_sarana" placeholder="Contoh : Printer Epson 3210" autocomplete="off" value="<?= $get_aset['nama_sarana']; ?>">
                                            <?= form_error('nama_sarana', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Jenis Aset</label>
                                            <select class="form-control select2" name="jenis_aset_id" id="jenis_aset_id" style="width: 100%;">
                                                <option value="">Pilih Jenis Aset</option>
                                                <?php foreach ($jenis_aset as $ja) : ?>
                                                    <?php if ($get_aset['jenis_aset_id'] == $ja['id_jenis']) : ?>
                                                        <option value="<?= $ja['id_jenis']; ?>" data-text="<?= $ja['kelompok_id']; ?>" selected><?= $ja['nama_kelompok']; ?> | <?= $ja['jenis_aset']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $ja['id_jenis']; ?>" data-text="<?= $ja['kelompok_id']; ?>"><?= $ja['nama_kelompok']; ?> | <?= $ja['jenis_aset']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" name="jenis_aset_id_text" id="jenis_aset_id_text" placeholder="Jenis Aset" value="<?= $get_aset['jenis_kelompok_id']; ?>">
                                            <!-- <?= form_error('jenis_aset_id', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Jumlah Aset</label>
                                            <input type="number" class="form-control" id="jumlah_aset" name="jumlah_aset" placeholder="Jumlah Aset" autocomplete="off" value="<?= $get_aset['jumlah_aset']; ?>">
                                            <?= form_error('jumlah_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Satuan Aset</label>
                                            <select class="form-control select2" name="satuan_aset" id="satuan_aset" style="width: 100%;">
                                                <option value="">Pilih Satuan Aset</option>
                                                <?php foreach ($satuan_aset as $satuan) : ?>
                                                    <?php if ($get_aset['satuan_aset'] == $satuan) : ?>
                                                        <option value="<?= $satuan; ?>" selected><?= $satuan; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $satuan; ?>"><?= $satuan; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('satuan_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Harga Perolehan</label>
                                            <?php if ($get_aset['harga_perolehan'] == '') : ?>
                                                <input type="number" class="form-control is-invalid" id="harga_perolehan" name="harga_perolehan" placeholder="Isikan Nominal Harga" autocomplete="off" value="<?= $get_aset['harga_perolehan']; ?>">
                                            <?php else : ?>
                                                <input type="number" class="form-control" id="harga_perolehan" name="harga_perolehan" placeholder="Isikan Nominal Harga" autocomplete="off" value="<?= $get_aset['harga_perolehan']; ?>">
                                            <?php endif; ?>
                                            <?= form_error('harga_perolehan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="floating-label">Tahun Pengadaan</label>
                                            <input type="number" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan" placeholder="Tahun Pengadaan" autocomplete="off" value="<?= $get_aset['tahun_pengadaan']; ?>">
                                            <?= form_error('tahun_pengadaan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status Kepemilikan</label>
                                            <select class="form-control select2" name="status_kepemilikan" id="status_kepemilikan" style="width: 100%;">
                                                <option value="">Pilih Kepemilikan</option>
                                                <?php foreach ($kepemilikan as $milik) : ?>
                                                    <?php if ($get_aset['status_kepemilikan'] == $milik) : ?>
                                                        <option value="<?= $milik; ?>" selected><?= $milik; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $milik; ?>"><?= $milik; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('status_kepemilikan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php if ($get_aset['keterangan_aset'] == '') : ?>
                                                <label>Keterangan Barang <code><em><b> * Harus diisi.</b></em></code></label>
                                                <select class="form-control" name="ket_aset" id="ket_aset" style="width: 100%;">
                                                    <option value="">Pilih Keterangan Barang</option>
                                                    <?php foreach ($ket_aset as $keterangan) : ?>
                                                        <?php if ($get_aset['keterangan_aset'] == $keterangan) : ?>
                                                            <option value="<?= $keterangan; ?>" selected><?= $keterangan; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $keterangan; ?>"><?= $keterangan; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else : ?>
                                                <label>Keterangan Barang</label>
                                                <select class="form-control" name="ket_aset" id="ket_aset" style="width: 100%;">
                                                    <option value="">Pilih Keterangan Barang</option>
                                                    <?php foreach ($ket_aset as $keterangan) : ?>
                                                        <?php if ($get_aset['keterangan_aset'] == $keterangan) : ?>
                                                            <option value="<?= $keterangan; ?>" selected><?= $keterangan; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $keterangan; ?>"><?= $keterangan; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                            <?= form_error('ket_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto mr-auto"></div>
                                    <div class="col-auto">
                                        <button class="btn btn-info" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>