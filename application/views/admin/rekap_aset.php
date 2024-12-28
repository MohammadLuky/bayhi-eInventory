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
                </div><!-- /.col -->
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
                                            <h5>Filter Unit</h5>
                                        </label>
                                        <select class="form-control select2" name="filter_unit" id="filter_unit" style="width: 100%;">
                                            <option value="0">Pilih Unit</option>
                                            <?php foreach ($units as $unit) : ?>
                                                <option value="<?= $unit['id_unit']; ?>">Unit <?= $unit['nama_unit']; ?></option>
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
                    <div id="hasilFilterUnit">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>