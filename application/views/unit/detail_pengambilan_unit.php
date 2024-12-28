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
                </div>
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
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $this->session->flashdata('error'); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-olive">
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
                                                        <td>Total Pengajuan</td>
                                                        <td>:</td>
                                                        <td>
                                                            <strong><em><?= buatRupiah($JumlahPengajuanATKUnit); ?>,-</em></strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-auto h3">
                                        Total Penyerapan : <button type="button" class="btn btn-light btn-lg"> <b><?= number_format($persentase_perUnit, 2); ?> %</b></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center align-middle" style="width: 10%;">Aksi</th>
                                            <th class="text-center align-middle" style="width: 8%;">Tahun Periode</th>
                                            <th class="text-center align-middle" style="width: 14%;">Tanggal Pengambilan</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Unit</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Barang ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Jumlah Pengambilan ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Harga Satuan</th>
                                            <th class="text-center align-middle" style="width: 10%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $jumlahtotalpengajuan = 0;
                                        foreach ($DataPengambilanATK as $pengambilanATK) :
                                            $totalpengajuan = $pengambilanATK['total_pengambilan_atk'];
                                            $jumlahtotalpengajuan += $totalpengajuan;
                                        ?>
                                            <tr>
                                                <?php if ($pengambilanATK['status_pengambilan_atk'] == 'pengajuan') : ?>
                                                    <td class="text-center">
                                                        <span class="badge bg-info"><i class="fas fa-spinner fa-spin"></i> Proses Pengajuan</span>
                                                    </td>
                                                <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'approval') : ?>
                                                    <td class="text-center">
                                                        <span class="badge bg-success"><i class="far fa-check-circle"></i> Pengambilan Berhasil</span>
                                                    </td>
                                                <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'revisi') : ?>
                                                    <td class="text-center">
                                                        <em class="text-danger">Revisi</em>
                                                        <a href="<?= base_url('admin/edit_pengambilanATK/') . $pengambilanATK['id_pengambilan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                                                        </a> |
                                                        <a href="#" class="badge bg-navy" data-toggle="modal" data-target="#ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="fas fa-paper-plane"></i> Ajukan
                                                        </a>
                                                    </td>
                                                <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'pengisian') : ?>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('admin/edit_pengambilanATK/') . $pengambilanATK['id_pengambilan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                                                        </a> |
                                                        <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                        </a> |
                                                        <a href="#" class="badge bg-navy" data-toggle="modal" data-target="#ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="fas fa-paper-plane"></i> Ajukan
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                                <td class="text-center"><?= $pengambilanATK['tahun_pengambilan']; ?></td>
                                                <td class="text-center"><?= tanggal_indonesia_format($pengambilanATK['tanggal_pengambilan']); ?></td>
                                                <td><?= $pengambilanATK['nama_unit']; ?></td>
                                                <td><?= $pengambilanATK['nama_barang']; ?></td>
                                                <td class="text-center"><?= $pengambilanATK['jumlah_pengambilan_atk']; ?> <?= $pengambilanATK['satuan_atk_pengambilan']; ?></td>
                                                <td class="text-center"><?= buatRupiah($pengambilanATK['harga_pengambilan_atk']); ?> </td>
                                                <td class="text-center"><?= buatRupiah($pengambilanATK['total_pengambilan_atk']); ?> </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr style="background-color: lemonchiffon;">
                                        <td class="text-center" colspan="7"><b>Total Pengambilan</b></td>
                                        <td class="text-center">
                                            <b>
                                                <?= buatRupiah($jumlahtotalpengajuan); ?>
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