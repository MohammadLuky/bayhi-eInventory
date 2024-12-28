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
<tr>
    <td colspan="6" class="text-center">
        <div class="col-md-2">
            <a style="display: inline-block; margin:auto;" href="<?= base_url('adminaset/laporanRekapKondisi/') . $get_subUnit['id_sub_unit']; ?>" class="btn bg-gradient-dark btn-block btn-sm"><i class="fas fa-file-pdf"></i> Cetak Laporan</a>
        </div>
    </td>
</tr>