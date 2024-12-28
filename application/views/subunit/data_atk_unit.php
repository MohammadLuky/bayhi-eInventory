<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('subunit'); ?>">Home</a></li>
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

                    <div class="pesan-eror" data-pesaneror="<?= validation_errors(); ?>"></div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel <?= $title; ?> <?= $GETunit['nama_unit']; ?></h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('subunit/input_pengambilanATK'); ?>" type="button" class="btn bg-gradient-dark btn-sm"><i class="fas fa-step-backward"></i> Input Pengambilan</a> |
                                        <a href="" class="btn bg-gradient-dark btn-sm" onclick="refreshPage()"><i class="fas fa-sync"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead style="background-color: #17a2b8; color: azure">
                                        <tr class="text-center">
                                            <th class="text-center" style="width: 7%;">NO</th>
                                            <th class="text-center" style="width: 33%;">NAMA BARANG</th>
                                            <th class="text-center" style="width: 15%;">TOTAL PENGAJUAN</th>
                                            <th class="text-center" style="width: 15%;">TOTAL PENGAMBILAN</th>
                                            <th class="text-center" style="width: 15%;">SISA PENGAJUAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($DataATKUnit as $stok) :
                                            $totalPengajuan = HitungTotalID_ByTwoCategory($stok['atk_pengajuan_id'], 'jumlah_pengajuan_atk', 'atk_pengajuan_id', 'inventory_pengajuan_atk', 'approval', 'status_pengajuan_atk', $GETsub_unit['unit_id'], 'unit_pengajuan_id');
                                            $totalPengambilan = HitungTotalID_ByTwoCategory($stok['atk_pengajuan_id'], 'jumlah_pengambilan_atk', 'atk_pengambilan_id', 'inventory_pengambilan_atk', 'approval', 'status_pengambilan_atk', $GETsub_unit['unit_id'], 'unit_pengambilan_id');
                                            $SisaATK = $totalPengajuan - $totalPengambilan;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $stok['nama_barang']; ?></td>
                                                <td class="text-center text-white" style="background-color: deepskyblue;"><b><?= $totalPengajuan; ?></b> <?= $stok['satuan_barang']; ?></td>
                                                <td class="text-center text-white" style="background-color: darkorange;"><?= $totalPengambilan; ?> <?= $stok['satuan_barang']; ?></td>
                                                <?php if ($SisaATK == 0) : ?>
                                                    <td class="text-center text-white" style="background-color: crimson;"><b><?= $SisaATK; ?> <?= $stok['satuan_barang']; ?></b></td>
                                                <?php else : ?>
                                                    <td class="text-center text-white" style="background-color: limegreen;"><b><?= $SisaATK; ?></b> <?= $stok['satuan_barang']; ?></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
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