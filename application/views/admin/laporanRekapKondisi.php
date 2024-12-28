<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <style>
        .text-center {
            text-align: center
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
        <span class="text-kop3"><b><?= $title; ?></b></span>
        <br><span class="text-kop4">Tahun <?= $tahun_berjalan; ?></span>
    </div>
    <br>

    <p>
        <b>* Tabel Kondisi Aset Per Sub Unit</b>
    </p>
    <table id="berwarna" style="width: 100%;">
        <thead>
            <tr class="text-center" style="background-color: #17a2b8; color: azure">
                <th class="text-center">No</th>
                <th class="text-center">Nama Aset</th>
                <th class="text-center">Lokasi Aset</th>
                <th class="text-center">Kondisi Aset</th>
                <th class="text-center">Tindakan</th>
                <th class="text-center">PIC</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($dataKondisiAset as $kondisi) : ?>
                <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td><?= $kondisi['nama_sarana']; ?></td>
                    <td><?= $kondisi['nama_sub_unit']; ?> || <?= $kondisi['nama_unit']; ?></td>
                    <td class="text-center">
                        <?php if ($kondisi['kondisi_aset'] == 'Baik') : ?>
                            <span class="badge bg-success"><?= $kondisi['kondisi_aset']; ?></span>
                        <?php elseif ($kondisi['kondisi_aset'] == 'Rusak Ringan') : ?>
                            <span class="badge bg-warning"><?= $kondisi['kondisi_aset']; ?></span>
                        <?php elseif ($kondisi['kondisi_aset'] == 'Rusak Berat') : ?>
                            <span class="badge bg-danger"><?= $kondisi['kondisi_aset']; ?></span>
                        <?php elseif ($kondisi['kondisi_aset'] == 'Perbaikan') : ?>
                            <span class="badge bg-lightblue"><?= $kondisi['kondisi_aset']; ?></span>
                        <?php elseif ($kondisi['kondisi_aset'] == '') : ?>
                            <span class="badge bg-secondary">Belum Pengecekan Aset</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($kondisi['ket_kondisi_aset'])) : ?>
                            <?= $kondisi['ket_kondisi_aset']; ?>
                        <?php else : ?>
                            <span class="badge bg-secondary">Belum Ada Tindakan</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $kondisi['nama']; ?></td>
                </tr>
            <?php $no++;
            endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>

    <!-- <div id="ttd" class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <p id="title-ttd"><strong>Penanggung Jawab Aset</strong></p>
            <div id="nama-ttd">
                <strong>
                    <u><?= $get_aset['nama']; ?></u>
                </strong><br />
                NIY. <?= $get_aset['niy']; ?>
            </div>
        </div>
    </div> -->
</body>

</html>