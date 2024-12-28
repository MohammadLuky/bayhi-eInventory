<?php $no = 1;
foreach ($aset_bySubUnit as $ia) : ?>
    <tr>
        <td class="text-center"><?= $no; ?></td>
        <td><?= $ia['nama_sarana']; ?></td>
        <td class="text-center">Unit <?= $ia['nama_unit']; ?> || <?= $ia['nama_sub_unit']; ?></td>
        <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
        <td><?= buatRupiah($ia['harga_perolehan']); ?></td>
        <td><?= buatRupiah($ia['total_perolehan']); ?></td>
        <td class="text-center">
            <a href="#" class="badge bg-lightblue" data-toggle="modal" data-target="#detail_aset<?= $ia['id_input_aset']; ?>"><i class="fas fa-info-circle"></i> Details
            </a>
        </td>
    </tr>
<?php $no++;
endforeach; ?>