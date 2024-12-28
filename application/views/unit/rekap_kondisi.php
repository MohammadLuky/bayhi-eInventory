<div class="content-wrapper">
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

                    <div class="card card-olive shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <h5>Tabel <?= $title; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="data_aset">
                                <thead>
                                    <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Aset</th>
                                        <th class="text-center">Lokasi Aset</th>
                                        <th class="text-center">Kondisi Aset</th>
                                        <th class="text-center">Jumlah Aset</th>
                                        <th class="text-center">Keterangan</th>
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
                                                    <span class="badge bg-secondary">Belum dilakukan pengecekan aset</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?= $kondisi['jumlah_aset_kondisi']; ?> <?= $kondisi['satuan_aset']; ?></td>
                                            <td>
                                                <?php if (!empty($kondisi['ket_kondisi_aset'])) : ?>
                                                    <?= $kondisi['ket_kondisi_aset']; ?>
                                                <?php else : ?>
                                                    <span class="text-danger">Belum ada tindakan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $kondisi['nama']; ?></td>
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
    </section>
</div>