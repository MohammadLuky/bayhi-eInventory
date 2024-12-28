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

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel <?= $title; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center align-middle" style="width: 8%;">No</th>
                                            <th class="text-center align-middle" style="width: 50%;">Nama Unit</th>
                                            <th class="text-center align-middle" style="width: 20%;">Total Pengajuan</th>
                                            <th class="text-center align-middle" style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $seluruhtotalpengajuanUnit = 0;
                                        $totalpengajuanUnit = 0;
                                        foreach ($DataUnit as $unit) :
                                            $jumlahPengajuanUnit = HitungTotalNilai($unit['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
                                            $seluruhtotalpengajuanUnit += $jumlahPengajuanUnit;
                                        ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $no; ?></td>
                                                <td class="align-middle"><?= $unit['nama_unit']; ?></td>
                                                <td class="text-center align-middle text-white" style="background-color: green;"><?= buatRupiah($jumlahPengajuanUnit); ?> </td>
                                                <?php if ($unit['status_pengajuan'] == 'approval') : ?>
                                                    <td class="text-center align-middle">
                                                        <a href="<?= base_url('admin/input_pengambilanATK/') . $unit['id_unit'] ?>" class="badge bg-navy"><i class="fas fa-pen"></i> Input Pengambilan
                                                    </td>
                                                <?php elseif ($unit['status_pengajuan'] == 'pengajuan' || $unit['status_pengajuan'] == 'pengisian' || $unit['status_pengajuan'] == '') : ?>
                                                    <td class="text-center align-middle">
                                                        <span class="badge bg-info"><i class="fas fa-spinner fa-spin"></i> Proses Pengajuan</span>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr style="background-color: lemonchiffon;">
                                        <td class="text-center" colspan="2"><b>Total Pengajuan</b></td>
                                        <td class="text-center">
                                            <b>
                                                <?= buatRupiah($seluruhtotalpengajuanUnit); ?>
                                            </b>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>