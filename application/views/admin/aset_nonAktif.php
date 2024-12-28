<div class="content-wrapper">
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
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= validation_errors(); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card card-lightblue shadow">
                                <div class="card-header">
                                    <label class="floating-label">
                                        <h5>Filterisasi</h5>
                                    </label>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="floating-label">
                                            <h5>Filter Sub Unit</h5>
                                        </label>
                                        <select class="form-control select2" name="pilih_sub_unit4" id="pilih_sub_unit4" style="width: 100%;">
                                            <option value="0">Pilih Sub Unit</option>
                                            <?php foreach ($sub_unit as $sb) : ?>
                                                <option value="<?= $sb['id_sub_unit']; ?>"><?= $sb['nama_unit']; ?> || <?= $sb['nama_sub_unit']; ?> - <?= $sb['nama_ruang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <button type="button" class="form-control btn bg-gradient-dark btn-block" onclick="refreshPage()"><i class="fas fa-sync"></i> Reset Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-olive shadow ">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel <?= $title; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_aset">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Aset</th>
                                        <th class="text-center">Lokasi Aset</th>
                                        <th class="text-center">Kondisi Aset</th>
                                        <th class="text-center">Jumlah Aset</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">PIC</th>
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
    </section>
</div>