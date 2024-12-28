<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Aset <?= $get_unit['nama_unit']; ?></title>
    <style>
        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-left {
            text-align: left
        }

        * {
            box-sizing: border-box;
        }

        .col-text {
            display: flex;
            float: left;
            text-align: center;
            width: 736px;
            padding: 3px;
            height: 10px;
        }

        .col-logo {
            float: left;
            width: 13%;
            padding: 1px;
            height: 10px;
        }

        .text-kop1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 22px;
        }

        .text-kop2 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
        }

        .text-kop3 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 17px;
        }

        .text-kop4 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }

        .text-kop5 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .logo {
            max-width: 80px;
            margin-right: 20px;
        }

        .line-title {
            border-top: 10px solid black;
            height: 5px;
            border-bottom: 1px solid black;
        }

        #berwarna {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #berwarna td,
        #berwarna th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #berwarna tr:hover {
            background-color: #ddd;
        }

        #berwarna th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #title-ttd {
            text-align: center;
        }

        #nama-ttd {
            margin-top: 100px;
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="row">
        <div class="col-logo">
            <img class="logo" src="<?= base_url('assets/images/bayhi_logo.png') ?>">
        </div>
        <div class="col-text">
            <span>
                <span class="text-kop1"><b>Yayasan Bayt Al-Hikmah</b></span>
                <br><span class="text-kop4">Jalan ..............</span>
                <br><span class="text-kop5">No Telp.</span>
            </span>
        </div>
        <div class="col-logo">
            <img class="logo" src="<?= base_url('assets/images/bayhi_logo.png') ?>">
        </div>
    </div>

    <hr class="line-title" />
    <br>

    <?php $tahun_berjalan = date('Y'); ?>
    <div class="text-center">
        <span class="text-kop3"><b>Rekapitulasi Data Aset <?= $get_unit['nama_unit']; ?></b></span>
        <br><span class="text-kop4">Tahun <?= $tahun_berjalan; ?></span>
    </div>
    <br>
    <table>
        <tbody>
            <tr>
                <td>Nama Unit</td>
                <td> :</td>
                <td><strong><em><?= $get_unit['nama_unit']; ?> </em></strong></td>
            </tr>
        </tbody>
    </table>


    <table id="berwarna" style="width: 100%;">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Lokasi</th>
                <th>Jumlah</th>
                <th>Tahun Perolehan</th>
                <th>Harga Perolehan</th>
                <th>Total Harga</th>
                <th>Penyusutan Per Barang</th>
                <th>Harga Tahun Berjalan</th>
                <th>Total Harga Aset</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $jumlah_total_harga_aset = 0;
            foreach ($aset_unit as $au) : ?>
                <?php
                $susut_pertahun = $au['harga_perolehan'] / $au['umur_aset'];
                $harga_tahun_berjalan = $au['harga_perolehan'] - (($tahun_berjalan - $au['tahun_pengadaan']) * $susut_pertahun);
                $harga_total_aset = $harga_tahun_berjalan * $au['jumlah_aset'];
                $jumlah_total_harga_aset += $harga_total_aset; ?>
                <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td><?= $au['nama_sarana']; ?></td>
                    <td class="text-center"><?= $au['nama_sub_unit']; ?></td>
                    <td class="text-center"><?= $au['jumlah_aset']; ?></td>
                    <td class="text-center"><?= $au['tahun_pengadaan']; ?></td>
                    <td class="text-right"><?= buatRupiah($au['harga_perolehan']); ?></td>
                    <td class="text-right"><?= buatRupiah($au['total_perolehan']); ?></td>
                    <td class="text-right"><?= buatRupiah($susut_pertahun); ?></td>
                    <td class="text-right"><?= buatRupiah($harga_tahun_berjalan); ?></td>
                    <td class="text-right"><?= buatRupiah($harga_total_aset); ?></td>
                </tr>
            <?php $no++;
            endforeach; ?>
            <tr></tr>
            <tr>
                <td rowspan="2" colspan="8" class="text-center">
                    <b>Total Nominal Aset Tahun Berjalan</b>
                </td>
                <td rowspan="2" colspan="2" class="text-right"><b><?= buatRupiah($jumlah_total_harga_aset); ?></b></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>

</body>

</html>