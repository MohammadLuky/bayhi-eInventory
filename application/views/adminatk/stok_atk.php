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

                    <div class="col-lg-8">
                        <div class="callout callout-info">
                            <h5>Pemberitahuan!!</h5>

                            <p>Data Stok selalu dicek kembali agar tidak kehabisan stok.</p>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-olive shadow ">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel <?= $title; ?></h5>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn bg-gradient-maroon btn-sm" data-toggle="modal" data-target=".beli_stok_atk"><i class="fas fa-plus-circle"></i> Input Stok Barang ATK</button> |
                                        <a href="<?= base_url('adminatk/pembelianATK') ?>" class="text-dark btn bg-gradient-warning btn-sm"><i class="far fa-list-alt"></i> Riwayat Pembelian ATK</a>
                                        <!-- <a href="<?= base_url('adminatk/atk') ?>" class="text-dark btn bg-gradient-warning btn-sm"><i class="far fa-list-alt"></i> Daftar Barang ATK</a> -->
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
                                            <th class="text-center" style="width: 15%;">BARANG MASUK</th>
                                            <th class="text-center" style="width: 15%;">BARANG KELUAR</th>
                                            <th class="text-center" style="width: 15%;">SISA BARANG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($BarangATK as $stok) :
                                            $totalPengajuan = HitungTotalID_ByKriteria($stok['id_atk'], 'jumlah_pengajuan_atk', 'atk_pengajuan_id', 'inventory_pengajuan_atk', 'approval', 'status_pengajuan_atk');
                                            $stokMasuk = HitungTotalNilai($stok['id_atk'], 'jumlah_atk', 'beli_atk_id', 'inventory_pembelian_atk');
                                            $stokKeluar = HitungTotalID_ByKriteria($stok['id_atk'], 'jumlah_pengambilan_atk', 'atk_pengambilan_id', 'inventory_pengambilan_atk', 'approval', 'status_pengambilan_atk');
                                            $hasilstok = $stokMasuk - $stokKeluar;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $stok['nama_barang']; ?></td>
                                                <td class="text-center text-white" style="background-color: darkkhaki;"><b><?= $totalPengajuan; ?></b> <?= $stok['satuan_barang']; ?></td>
                                                <td class="text-center text-white" style="background-color: seagreen;"><?= $stokMasuk; ?> <?= $stok['satuan_barang']; ?></td>
                                                <td class="text-center text-white" style="background-color: crimson;"><?= $stokKeluar; ?> <?= $stok['satuan_barang']; ?></td>
                                                <?php if ($hasilstok >= 5) : ?>
                                                    <td class="text-center" style="background-color: deepskyblue;"><b><?= $hasilstok; ?></b> <?= $stok['satuan_barang']; ?></td>
                                                <?php elseif ($hasilstok < 5 && $hasilstok >= 1) : ?>
                                                    <td class="text-center text-white" style="background-color: goldenrod;"><b><?= $hasilstok; ?></b> <?= $stok['satuan_barang']; ?></td>
                                                <?php elseif ($hasilstok == 0) : ?>
                                                    <td class="text-center text-white" style="background-color: maroon;"><b><?= $hasilstok; ?> <?= $stok['satuan_barang']; ?></b></td>
                                                <?php else : ?>
                                                    <td class="text-center text-danger"><b>Tidak Diketahui</b></td>
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

<!-- Modal Insert -->
<div class="modal fade beli_stok_atk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?= base_url('adminatk/stokATK'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">Input Pembelian Stok Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Tanggal Pengajuan</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_pembelian" id="tanggal_pembelian" value="<?= set_value('tanggal_pembelian'); ?>" autocomplete="off" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-control select2" name="atk_stok" id="atk_stok" style="width: 100%;">
                                        <option>Pilih Barang ATK</option>
                                        <?php foreach ($BarangATK as $atks) : ?>
                                            <option value="<?= $atks['id_atk']; ?>"><?= $atks['nama_barang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <select class="form-control select2" style="width: 100%;" id="satuan_pembelian" name="satuan_pembelian">
                                        <option>Pilih Satuan Barang</option>
                                        <?php foreach ($satuan_brg as $sb) : ?>
                                            <option value="<?= $sb; ?>"><?= $sb; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" placeholder="Jumlah Barang" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label">Harga Satuan</label>
                                    <input type="number" class="form-control" name="harga_pembelian" id="harga_pembelian" placeholder="Harga Satuan" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="floating-label">Total Pembelian Barang</label>
                                    <input type="number" class="form-control" name="total_pembelian" id="total_pembelian" placeholder="Total Pembelian" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-danger btn-sm" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn  btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>