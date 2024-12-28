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

                    <div class="col-lg-12">
                        <div class="card card-olive shadow">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto mr-auto">
                                        <h5>Tabel Aset <?= $GETsub_unit['nama_sub_unit']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- <table class="table table-bordered table-hover" id="TabelKondisiAset" style="width: 100%;"> -->
                                <table class="table table-bordered table-hover" id="data_aset">
                                    <thead>
                                        <tr class="text-center" style="background-color: #17a2b8; color: azure">
                                            <th>No</th>
                                            <th>Nama Sarana</th>
                                            <th>PIC</th>
                                            <th>Lokasi Unit & Sub Unit</th>
                                            <th>Lokasi Gedung & Ruang</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($aset_bySubUnit as $ia) : ?>
                                        <?php if($ia['aset_aktif'] == 1): 
                                            $no = 1; ?>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $ia['nama_sarana']; ?></td>
                                                <td><?= $ia['nama']; ?></td>
                                                <td class="text-center">Unit <?= $ia['nama_unit']; ?> | <?= $ia['nama_sub_unit']; ?></td>
                                                <td class="text-center"><?= $ia['nama_gedung']; ?> | <?= $ia['nama_ruang']; ?></td>
                                                <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('subunit/cek_kondisi_aset/') . $ia['id_input_aset']; ?>" class="badge bg-warning"><i class="far fa-edit"></i> Lakukan pengecekan aset
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $no++;
                                        endif;
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