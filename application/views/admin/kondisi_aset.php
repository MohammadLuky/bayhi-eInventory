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

                    <div class="col-lg-5">
                        <div class="card card-lightblue shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Filterisasi</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="floating-label">
                                        <h5>Pilih Sub Unit</h5>
                                    </label>
                                    <select class="form-control select2" name="pilih_sub_unit1" id="pilih_sub_unit1" style="width: 100%;">
                                        <option value="0">Pilih Sub Unit</option>
                                        <?php foreach ($sub_unit as $sb) : ?>
                                            <option value="<?= $sb['id_sub_unit']; ?>"><?= $sb['nama_unit']; ?> || <?= $sb['nama_sub_unit']; ?> - <?= $sb['nama_ruang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel Aset</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-info col-lg-6">
                                    <div class="form-group row col-lg-12">
                                        <label class="col-sm-4 col-form-label">Cari Aset :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="searchInput" placeholder="Ketik Nama Aset">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover" id="TabelKondisiAset" style="width: 100%;">
                                    <!-- <table class="table table-bordered table-hover" id="data_aset"> -->
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th>No</th>
                                            <th>Nama Sarana</th>
                                            <th>PIC</th>
                                            <th>Lokasi Unit & Sub Unit</th>
                                            <th>Lokasi Gedung & Ruang</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>