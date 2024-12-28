<?php foreach ($aset_bySubUnit as $ia) : ?>
    <?php if($ia['aset_aktif'] == 1): 
        $no = 1; ?>
        <tr>
            <td class="text-center"><?= $no; ?></td>
            <td><?= $ia['nama_sarana']; ?></td>
            <td><?= $ia['nama']; ?></td>
            <td class="text-center">Unit <?= $ia['nama_unit']; ?> | <?= $ia['nama_sub_unit']; ?></td>
            <td class="text-center"><?= $ia['nama_gedung']; ?> | <?= $ia['nama_ruang']; ?></td>
            <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
            <td class="text-center">
                <a href="<?= base_url('admin/cek_kondisi_aset/') . $ia['id_input_aset']; ?>" class="badge bg-warning"><i class="far fa-edit"></i> Lakukan pengecekan aset
                </a>
            </td>
        </tr>
    <?php $no++;
    endif;?>
<?php endforeach; ?>