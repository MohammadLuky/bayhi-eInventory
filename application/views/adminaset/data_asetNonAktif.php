<?php $no = 1;
foreach ($dataAsetNonAktif as $asetNA) : ?>
    <tr>
        <td class="text-center"><?= $no; ?></td>
        <td><?= $asetNA['nama_sarana']; ?></td>
        <td><?= $asetNA['nama_sub_unit']; ?> || <?= $asetNA['nama_unit']; ?></td>
        <td class="text-center">
            <?php if ($asetNA['kondisi_aset'] == 'Rusak Ringan') : ?>
                <span class="badge bg-warning"><?= $asetNA['kondisi_aset']; ?></span>
            <?php elseif ($asetNA['kondisi_aset'] == 'Rusak Berat') : ?>
                <span class="badge bg-danger"><?= $asetNA['kondisi_aset']; ?></span>
            <?php elseif ($asetNA['kondisi_aset'] == '') : ?>
                <span class="badge bg-danger">Tidak Diketahui</span>
            <?php endif; ?>
        </td>
        <td class="text-center"><?= $asetNA['jumlah_aset']; ?> <?= $asetNA['satuan_aset']; ?></td>
        <td>
            <?php if (!empty($asetNA['ket_kondisi_aset'])) : ?>
                <?= $asetNA['ket_kondisi_aset']; ?>
            <?php else : ?>
                <span class="text-danger">Belum ada tindakan</span>
            <?php endif; ?>
        </td>
        <td><?= $asetNA['nama']; ?></td>
    </tr>
<?php $no++;
endforeach; ?>