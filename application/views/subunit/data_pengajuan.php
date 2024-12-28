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
                        <li class="breadcrumb-item"><a href="<?= base_url('subunit'); ?>">Home</a></li>
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
                                    <div class="col-auto">
                                        <?php if ($GETunit['status_pengajuan'] == 'approval' || $GETunit['status_pengajuan'] == 'pengajuan') : ?>
                                            <a href="<?= base_url('subunit/input_pengajuanATK'); ?>" type="button" class="btn btn-block bg-gradient-dark btn-sm disabled">
                                                <i class="fas fa-plus"></i> Tambah Pengajuan</a>
                                        <?php else : ?>
                                            <a href="<?= base_url('subunit/input_pengajuanATK'); ?>" type="button" class="btn btn-block bg-gradient-dark btn-sm">
                                                <i class="fas fa-plus"></i> Tambah Pengajuan</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="data_unit" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th class="text-center align-middle" style="width: 10%;">Aksi</th>
                                            <th class="text-center align-middle" style="width: 8%;">Tahun Periode</th>
                                            <th class="text-center align-middle" style="width: 14%;">Tanggal Pengajuan</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Unit</th>
                                            <th class="text-center align-middle" style="width: 16%;">Nama Barang ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Jumlah Pengajuan ATK</th>
                                            <th class="text-center align-middle" style="width: 10%;">Harga Satuan</th>
                                            <th class="text-center align-middle" style="width: 10%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $jumlahtotalpengajuan = 0;
                                        foreach ($DataPengajuanATK as $pengajuanATK) :
                                            $totalpengajuan = $pengajuanATK['total_pengajuan_atk'];
                                            $jumlahtotalpengajuan += $totalpengajuan;
                                        ?>
                                            <tr>
                                                <?php if ($pengajuanATK['status_pengajuan_atk'] == 'approval') : ?>
                                                    <td class="text-center">
                                                        <a href="" class="badge bg-success">Sudah Approval
                                                        </a>
                                                    </td>
                                                <?php elseif ($pengajuanATK['status_pengajuan_atk'] == 'pengajuan') : ?>
                                                    <td class="text-center">
                                                        <a href="" class="badge bg-warning">Antrian Pengajuan
                                                        </a>
                                                    </td>
                                                <?php else : ?>
                                                    <td class="text-center">
                                                        <!-- <a href="<?= base_url('subunit/edit_pengajuanATK/') . $pengajuanATK['id_pengajuan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                                                        </a> | -->
                                                        <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_pengajuanATK<?= $pengajuanATK['id_pengajuan']; ?>"><i class="far fa-trash-alt"></i> Hapus
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                                <td class="text-center"><?= $pengajuanATK['tahun_pengajuan']; ?></td>
                                                <td class="text-center"><?= tanggal_indonesia_format($pengajuanATK['tanggal_pengajuan']); ?></td>
                                                <td><?= $pengajuanATK['nama_unit']; ?></td>
                                                <td><?= $pengajuanATK['nama_barang']; ?></td>
                                                <td class="text-center"><?= $pengajuanATK['jumlah_pengajuan_atk']; ?> <?= $pengajuanATK['satuan_atk_pengajuan']; ?></td>
                                                <td class="text-center"><?= buatRupiah($pengajuanATK['harga_pengajuan_atk']); ?> </td>
                                                <td class="text-center"><?= buatRupiah($pengajuanATK['total_pengajuan_atk']); ?> </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr style="background-color: lemonchiffon;">
                                        <td class="text-center" colspan="7"><b>Total Pengajuan</b></td>
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

<?php foreach ($DataPengajuanATK as $pengajuanATK) : ?>
    <div id="hapus_pengajuanATK<?= $pengajuanATK['id_pengajuan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="hapus_pengajuanATK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="hapus_pengajuanATK">Hapus Data Pengajuan Barang ATK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= base_url('subunit/hapus_pengajuanATK/') . $pengajuanATK['id_pengajuan']; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_pengajuan" id="id_pengajuan" value="<?= $pengajuanATK['id_pengajuan']; ?>">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Peringatan!!!</h4>
                                <p class="mb-0">
                                    Apakah anda akan tetap menghapus data pengajuan barang <strong><?= $pengajuanATK['nama_barang']; ?></strong> yang berjumlah <strong><?= $pengajuanATK['jumlah_pengajuan_atk']; ?></strong> <strong><?= $pengajuanATK['satuan_atk_pengajuan']; ?></strong> pada <strong><?= $pengajuanATK['nama_unit']; ?></strong> ?
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