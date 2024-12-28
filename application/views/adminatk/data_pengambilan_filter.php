<?php $no = 1;
foreach ($DataPengambilanATK as $pengambilanATK) :
?>
    <tr>
        <?php if ($pengambilanATK['status_pengambilan_atk'] == 'pengajuan') : ?>
            <td class="text-center">
                <a href="#" class="badge bg-navy" data-toggle="modal" data-target="#ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="fas fa-paper-plane"></i> Approve
                </a> |
                <a href="<?= base_url('adminatk/revisi_pengambilanATK/') . $pengambilanATK['id_pengambilan']; ?>" class="badge bg-maroon"><i class="fas fa-hammer"></i> Revisi
                </a>
            </td>
        <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'approval') : ?>
            <td class="text-center">
                <span class="badge bg-success"><i class="far fa-check-circle"></i> Pengambilan Valid</span>
            </td>
        <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'revisi') : ?>
            <td class="text-center">
                <span class="badge bg-info"><i class="fas fa-spinner fa-spin"></i> Proses Revisi</span>
            </td>
        <?php elseif ($pengambilanATK['status_pengambilan_atk'] == 'pengisian') : ?>
            <td class="text-center">
                <span class="badge bg-info"><i class="fas fa-spinner fa-spin"></i> Belum Pengajuan</span>
            </td>
        <?php endif; ?>
        <td class="text-center"><?= $pengambilanATK['tahun_pengambilan']; ?></td>
        <td class="text-center"><?= tanggal_indonesia_format($pengambilanATK['tanggal_pengambilan']); ?></td>
        <td><?= $pengambilanATK['nama_unit']; ?></td>
        <td><?= $pengambilanATK['nama_barang']; ?></td>
        <td class="text-center"><?= $pengambilanATK['jumlah_pengambilan_atk']; ?> <?= $pengambilanATK['satuan_atk_pengambilan']; ?></td>
    </tr>
<?php $no++;
endforeach; ?>


<!-- <td class="text-center">
                <a href="#" class="badge bg-navy" data-toggle="modal" data-target="#ajukan_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="fas fa-paper-plane"></i> Approve
                </a>
            </td> -->
<!-- <a href="<?= base_url('adminatk/edit_pengambilanATK/') . $pengambilanATK['id_pengambilan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                </a> |
                <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="far fa-trash-alt"></i> Hapus
                </a> | -->
<!-- <a href="<?= base_url('adminatk/edit_pengambilanATK/') . $pengambilanATK['id_pengambilan'] ?>" class="badge bg-warning"><i class="far fa-edit"></i> Edit
                </a> |
                <a href="#" class="badge bg-danger" data-toggle="modal" data-target="#hapus_pengambilanATK<?= $pengambilanATK['id_pengambilan']; ?>"><i class="far fa-trash-alt"></i> Hapus
                </a> -->
<!-- <span class="badge bg-info"><i class="fas fa-spinner fa-spin"></i> Proses Pengajuan</span> -->