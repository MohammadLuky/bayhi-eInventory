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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
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
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $this->session->flashdata('error'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-6">
                        <div class="card card-outline card-lightblue shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Import Data Aset</h5>
                                        <a href="<?= base_url('admin/DownloadFormatAset'); ?>" class="badge bg-info"> Download Format Import Aset</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?= form_open_multipart('admin/upload_InputDataAset'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label">Pilih File Format</label>
                                            <div class="custom-file">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input type="file" class="custom-file-input" id="import_data_aset" name="import_data_aset" accept=".xlsx, .xls">
                                                        <label class="custom-file-label" for="import_data_aset">Choose file</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-info" type="submit">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card card-outline card-olive shadow">
                            <form action="<?= base_url('admin/input_aset'); ?>" method="post">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <h5>Input Aset</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= base_url('admin/hasil_input_aset'); ?>" type="button" class="btn btn-block bg-gradient-dark btn-sm"><i class="fas fa-list-alt"></i> Hasil Inputan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Sub Unit</label>
                                                <select class="form-control" name="aset_sub_unit" id="aset_sub_unit" style="width: 100%;">
                                                    <option value="">Pilih Sub Unit</option>
                                                    <?php foreach ($sub_unit as $sb) : ?>
                                                        <option value="<?= $sb['id_sub_unit']; ?>" data-value1="<?= $sb['gedung_sub_unit_id']; ?>" data-value2="<?= $sb['unit_id']; ?>" data-value3="<?= $sb['ruang_sub_unit_id']; ?>" data-value4="<?= $sb['subunit_pic_id']; ?>" data-value5="<?= $sb['nama']; ?>" data-value6="<?= $sb['nama_unit']; ?>">

                                                            <?= $sb['nama_gedung']; ?> || Unit <?= $sb['nama_unit']; ?> || <?= $sb['nama_ruang']; ?> || <?= $sb['nama_sub_unit']; ?>

                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" id="value_aset_input1" name="value_aset_input1" placeholder="Id Gedung">
                                                <input type="hidden" id="value_aset_input2" name="value_aset_input2" placeholder="Id Unit">
                                                <input type="hidden" id="value_aset_input3" name="value_aset_input3" placeholder="Id Ruang">
                                                <?= form_error('aset_sub_unit', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Penanggung Jawab</label>
                                                <input type="hidden" class="form-control" id="value_aset_input4" name="value_aset_input4" placeholder="Nama PIC" readonly>
                                                <input type="text" class="form-control" id="namaPIC" name="namaPIC" placeholder="Nama PIC" readonly>
                                                <input type="hidden" class="form-control" id="namaUnit" name="namaUnit" placeholder="Nama Unit" readonly>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Nama Sarana</label>
                                                <input type="text" class="form-control" id="nama_sarana" name="nama_sarana" placeholder="Contoh : Printer Epson 3210" autocomplete="off" value="<?= set_value('nama_sarana'); ?>">
                                                <?= form_error('nama_sarana', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Jenis Aset</label>
                                                <select class="form-control select2" name="jenis_aset_id" id="jenis_aset_id" style="width: 100%;">
                                                    <option value="">Pilih Jenis Aset</option>
                                                    <?php foreach ($jenis as $ja) : ?>
                                                        <option value="<?= $ja['id_jenis']; ?>" data-text="<?= $ja['kelompok_id']; ?>"><?= $ja['nama_kelompok']; ?> | <?= $ja['jenis_aset']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name="jenis_aset_id_text" id="jenis_aset_id_text" placeholder="Jenis Aset">
                                                <?= form_error('jenis_aset_id', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Jumlah Aset</label>
                                                <input type="number" class="form-control" id="jumlah_aset" name="jumlah_aset" placeholder="Jumlah Aset" autocomplete="off" value="<?= set_value('jumlah_aset'); ?>">
                                                <?= form_error('jumlah_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Satuan Aset</label>
                                                <select class="form-control select2" name="satuan_aset" id="satuan_aset" style="width: 100%;">
                                                    <option value="">Pilih Satuan Aset</option>
                                                    <?php foreach ($satuan_aset as $satuan) : ?>
                                                        <option value="<?= $satuan; ?>"><?= $satuan; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('satuan_aset', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Harga Perolehan</label>
                                                <input type="number" class="form-control" id="harga_perolehan" name="harga_perolehan" placeholder="Isikan Nominal Harga" autocomplete="off" value="<?= set_value('harga_perolehan'); ?>">
                                                <?= form_error('harga_perolehan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="floating-label">Tahun Pengadaan</label>
                                                <input type="number" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan" placeholder="Tahun Pengadaan" autocomplete="off" value="<?= set_value('tahun_pengadaan'); ?>">
                                                <?= form_error('tahun_pengadaan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Status Kepemilikan</label>
                                                <select class="form-control select2" name="status_kepemilikan" id="status_kepemilikan" style="width: 100%;">
                                                    <option value="">Pilih Kepemilikan</option>
                                                    <?php foreach ($kepemilikan as $milik) : ?>
                                                        <option value="<?= $milik; ?>"><?= $milik; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('status_kepemilikan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Keterangan Barang</label>
                                                <select class="form-control select2" name="ket_aset" id="ket_aset" style="width: 100%;">
                                                    <option value="">Pilih Keterangan Barang</option>
                                                    <?php foreach ($ket_aset as $keterangan) : ?>
                                                        <option value="<?= $keterangan; ?>"><?= $keterangan; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
        </div>
    </section>
</div>