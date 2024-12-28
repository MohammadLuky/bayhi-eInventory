<div class="card card-olive">
    <div class="card-header">
        <div class="row">
            <div class="col-auto mr-auto">
                <h5>Tabel Aset <?= $get_unit['nama_unit']; ?></h5>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('adminaset/laporanAset_PerUnit/') . $get_unit['id_unit']; ?>" class="btn bg-gradient-dark btn-block btn-sm"><i class="fas fa-file-pdf"></i> Cetak Laporan</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

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
                        <tr style="background-color: lemonchiffon;">
                            <td colspan="9" class="text-center">
                                <b>Total Nominal Aset Tahun Berjalan</b>
                            </td>
                            <td class="text-right"><b><?= buatRupiah($jumlah_total_harga_aset); ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>