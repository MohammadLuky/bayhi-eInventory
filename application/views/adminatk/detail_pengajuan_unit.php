<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('adminatk'); ?>">Home</a></li>
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

                    <?php if ($getUnit['status_pengajuan'] == 'pengajuan' || $getUnit['status_pengajuan'] == 'revisi') : ?>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h5>Proses Pengajuan</h5>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('adminatk/prosesValidasi/') . $getUnit['id_unit']; ?>" method="post">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-control select2" name="proses_validasi" id="proses_validasi" style="width: 100%;">
                                                    <option value="">Pilih Proses Pengajuan</option>
                                                    <option value="approval">Approve Pengajuan</option>
                                                    <option value="revisi">Revisi Pengajuan</option>
                                                </select>
                                            </div>
                                            <!-- <div id="input_revisi">
                                            </div> -->
                                            <button type="submit" class="btn btn-sm bg-gradient-navy">SIMPAN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <div class="row">
                                            <table class="table table-sm">
                                                <h5>Informasi <?= $title; ?></h5>
                                                <tbody>
                                                    <tr>
                                                        <td>Nama Unit</td>
                                                        <td>:</td>
                                                        <td><strong><em><?= $getUnit['nama_unit']; ?> </em></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Periode Tahun</td>
                                                        <td>:</td>
                                                        <td><strong><em><?= date('Y'); ?></em></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('adminatk/DataValidasiPengajuanATK'); ?>" type="button" class="btn bg-gradient-dark btn-sm"><i class="fas fa-step-backward"></i> Kembali</a>
                                        <?php if ($getUnit['status_pengajuan'] == 'pengisian') : ?>
                                            | <a href="#" data-toggle="modal" data-target="#proses_pengajuan<?= $getUnit['id_unit']; ?>" class=" btn bg-gradient-maroon btn-sm"><i class="fas fa-paper-plane"></i> Pengajuan Barang</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                    </div>
                                    <div class="col-auto">
                                        <?php if ($getUnit['status_pengajuan'] == 'approval') : ?>
                                            <a href="<?= base_url('adminatk/cetakExcelPengajuanATKUnit/') . $getUnit['id_unit']; ?>" type="button" class="btn bg-gradient-orange btn-sm"><i class="fas fa-print"></i> Cetak Pengajuan</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center align-middle" style="width: 10%;">No</th>
                                            <th class="text-center align-middle" style="width: 8%;">Tahun Periode</th>
                                            <th class="text-center align-middle" style="width: 14%;">Tanggal Pengajuan</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Barang ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Jumlah Pengajuan ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Harga Satuan</th>
                                            <th class="text-center align-middle" style="width: 10%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $seluruhtotalpengajuanUnit = 0;
                                        $totalpengajuanUnit = 0;
                                        foreach ($DataPengajuanUnit as $unitATK) :
                                            $jumlahPengajuanUnit = HitungTotalNilai($unitATK['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
                                            $seluruhtotalpengajuanUnit += $jumlahPengajuanUnit;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $unitATK['tahun_pengajuan']; ?></td>
                                                <td class="text-center"><?= tanggal_indonesia_format($unitATK['tanggal_pengajuan']); ?></td>
                                                <td><?= $unitATK['nama_barang']; ?></td>
                                                <td class="text-center"><?= $unitATK['jumlah_pengajuan_atk']; ?> <?= $unitATK['satuan_atk_pengajuan']; ?></td>
                                                <td class="text-center"><?= buatRupiah($unitATK['harga_pengajuan_atk']); ?> </td>
                                                <td class="text-center text-white" style="background-color: green;"><?= buatRupiah($unitATK['total_pengajuan_atk']); ?> </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr style="background-color: lemonchiffon;">
                                        <td class="text-center" colspan="6"><b>Total Pengajuan</b></td>
                                        <td class="text-center">
                                            <b>
                                                <?php if(empty($jumlahPengajuanUnit)):?>
                                                    0
                                                <?php else:?>
                                                    <?= buatRupiah($jumlahPengajuanUnit);?>
                                                <?php endif;?>
                                            </b>
                                        </td>
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

<?php foreach ($DataPengajuanUnit as $ATKunit) : ?>
    <div id="proses_pengajuan<?= $ATKunit['id_unit']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="proses_pengajuan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title" id="proses_pengajuan">Data Pengajuan Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminatk/prosesPengajuan/') . $getUnit['id_unit']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $ATKunit['id_unit']; ?>">
                        <input type="hidden" name="id_unit" id="id_unit" value="<?= $ATKunit['id_unit']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Data Pengajuan</h4>
                                <table class="table table-bordered table-hover text-center">
                                    <thead style="background-color: darkgray;">
                                        <tr>
                                            <th>Total ATK</th>
                                            <th>Total Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: aliceblue;" class="text-dark">
                                        <?php
                                        $seluruhtotalpengajuanUnit = 0;
                                        $totalpengajuanUnit = 0;
                                        foreach ($DataPengajuanUnit as $unitATK) :
                                            $jumlahPengajuanUnit = HitungTotalNilai($unitATK['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
                                            $seluruhtotalpengajuanUnit += $jumlahPengajuanUnit;
                                        ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td><?= HitungData('inventory_pengajuan_atk', 'unit_pengajuan_id', $unitATK['id_unit']); ?></td>
                                            <td><?= buatRupiah($jumlahPengajuanUnit); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>