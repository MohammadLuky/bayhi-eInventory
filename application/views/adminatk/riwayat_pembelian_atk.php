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
                        <li class="breadcrumb-item"><a href="<?= base_url('adminatk'); ?>">Home</a></li>
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

                    <div class="pesan-eror" data-pesaneror="<?= validation_errors(); ?>"></div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel <?= $title; ?></h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('adminatk/stokATK') ?>" class="text-dark btn bg-gradient-warning btn-sm"><i class="far fa-list-alt"></i> Daftar Stok ATK</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead style="background-color: #17a2b8; color: azure">
                                        <tr class="text-center">
                                            <th class="text-center" style="width: 7%;">Aksi</th>
                                            <th class="text-center" style="width: 15%;">Tanggal Pembelian</th>
                                            <th class="text-center" style="width: 33%;">Nama Barang</th>
                                            <th class="text-center" style="width: 15%;">Jumlah Barang</th>
                                            <th class="text-center" style="width: 15%;">Harga Barang</th>
                                            <th class="text-center" style="width: 15%;">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $totalPembelian = 0;
                                        foreach ($BarangATKBeli as $stok) :
                                            $totalBeliBarang = $stok['total_beli_atk'];
                                            $totalPembelian += $totalBeliBarang;
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapuspembelianATK<?= $stok['id_history_beli']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                    </a>
                                                </td>
                                                <td class="text-center"><?= tanggal_indonesia_format($stok['tanggal_beli']); ?></td>
                                                <td><?= $stok['nama_barang']; ?></td>
                                                <td class="text-center"><?= $stok['jumlah_atk']; ?> <?= $stok['satuan_atk_beli']; ?></td>
                                                <td class="text-center"><?= buatRupiah($stok['harga_beli_atk']); ?></td>
                                                <td class="text-center"><?= buatRupiah($stok['total_beli_atk']); ?></td>
                                            </tr>
                                        <?php
                                        endforeach; ?>
                                    </tbody>
                                    <tr>
                                        <td colspan="5" class="text-center" style="background-color: antiquewhite;"><b>Total Pembelian</b></td>
                                        <td class="text-center" style="background-color: antiquewhite;"><b><?= buatRupiah($totalPembelian); ?></b></td>
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

<?php foreach ($BarangATKBeli as $stok) : ?>
    <div id="hapuspembelianATK<?= $stok['id_history_beli']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapuspembelianATK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="hapuspembelianATK">Hapus Pembelian Stok Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('adminatk/hapuspembelianATK/') . $stok['id_history_beli']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $stok['id_history_beli']; ?>">
                        <input type="hidden" name="id_history_beli" id="id_history_beli" value="<?= $stok['id_history_beli']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus data barang <strong><?= $stok['nama_barang']; ?></strong> yang berjumlah <strong><?= $stok['jumlah_atk']; ?></strong> <strong><?= $stok['satuan_atk_beli']; ?></strong> pada tanggal <strong><?= tanggal_indonesia_format($stok['tanggal_beli']); ?></strong> ?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn  btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>