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
                        <li class="breadcrumb-item"><a href="<?= base_url('unit'); ?>">Home</a></li>
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

                    <div class="card card-olive">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel Aset <?= $GETunit['nama_unit']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-hover" id="data_aset">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure; width: 100%;">
                                        <th style="width: 8%;">No</th>
                                        <th style="width: 15%;">Nama Aset</th>
                                        <th style="width: 10%;">Lokasi</th>
                                        <th style="width: 8%;">Jumlah</th>
                                        <th style="width: 8%;">Tahun Perolehan</th>
                                        <th style="width: 10%;">Harga Perolehan</th>
                                        <th style="width: 10%;">Total Harga</th>
                                        <th style="width: 10%;">Penyusutan Per Barang</th>
                                        <th style="width: 10%;">Harga Tahun Berjalan</th>
                                        <th style="width: 10%;">Total Harga Aset</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $jumlah_total_harga_aset = 0;
                                    $no = 1;
                                    foreach ($aset_unit as $asets) :
                                        $tahun_berjalan = date('Y');
                                        $susut_pertahun = $asets['harga_perolehan'] / $asets['umur_aset'];
                                        $harga_tahun_berjalan = $asets['harga_perolehan'] - (($tahun_berjalan - $asets['tahun_pengadaan']) * $susut_pertahun);
                                        $harga_total_aset = $harga_tahun_berjalan * $asets['jumlah_aset'];
                                        $jumlah_total_harga_aset += $harga_total_aset;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $asets['nama_sarana']; ?></td>
                                            <td class="text-center"><?= $asets['nama_sub_unit']; ?></td>
                                            <td class="text-center"><?= $asets['jumlah_aset']; ?></td>
                                            <td class="text-center"><?= $asets['tahun_pengadaan']; ?></td>
                                            <td class="text-right"><?= buatRupiah($asets['harga_perolehan']); ?></td>
                                            <td class="text-right"><?= buatRupiah($asets['total_perolehan']); ?></td>
                                            <td class="text-right"><?= buatRupiah($susut_pertahun); ?></td>
                                            <td class="text-right"><?= buatRupiah($harga_tahun_berjalan); ?></td>
                                            <td class="text-right"><?= buatRupiah($harga_total_aset); ?></td>
                                        </tr>
                                    <?php $no++;
                                    endforeach; ?>
                                </tbody>
                                <tr style="background-color: lemonchiffon;">
                                    <td colspan="9" class="text-center">
                                        <b>Total Nominal Aset Tahun Berjalan</b>
                                    </td>
                                    <td class="text-right"><b><?= buatRupiah($jumlah_total_harga_aset); ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>