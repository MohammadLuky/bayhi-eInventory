<?php $no = 1;
foreach ($aset_bySubUnit as $ia) : ?>

<?php if($ia['aset_aktif'] == 1):?>
    <?php if ($ia['keterangan_aset'] == '') : ?>
        <tr style="background-color: crimson;" class="text-white">
            <td class="text-center"><?= $no; ?></td>
            <td>
                <?= $ia['nama_sarana']; ?>
                <a href="#" data-toggle="modal" data-target="#nonaktif_aset<?= $ia['id_input_aset']; ?>" class="badge bg-success BtnAktifAset">Aktif</a>
                <!-- <span class="badge bg-secondary BtnNonAktifAset">Non Aktif</span> -->
            </td>
            <td class="text-center">Unit <b><?= $ia['nama_unit']; ?></b> || Ruang <b><?= $ia['nama_ruang']; ?></b></td>
            <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
            <td><?= buatRupiah($ia['harga_perolehan']); ?></td>
            <td><?= buatRupiah($ia['total_perolehan']); ?></td>
            <td class="text-center">
                Keterangan Aset Harus diisi. | <a href="<?= base_url('admin/edit_aset/') . $ia['id_input_aset']; ?>" class="badge bg-warning btn-edit-aset"><i class="far fa-edit"></i> Edit
                </a>
                <!-- <a href="#" class="badge bg-secondary DisableEditAset"><i class="far fa-edit"></i> Edit </a> -->
            </td>
        </tr>
    <?php elseif ($ia['harga_perolehan'] == '0') : ?>
        <tr style="background-color: teal;" class="text-white">
            <td class="text-center"><?= $no; ?></td>
            <td>
                <?= $ia['nama_sarana']; ?>
                <a href="#" data-toggle="modal" data-target="#nonaktif_aset<?= $ia['id_input_aset']; ?>" class="badge bg-success BtnAktifAset">Aktif</a>
                <!-- <span class="badge bg-secondary BtnNonAktifAset">Non Aktif</span> -->
            </td>
            <td class="text-center">Unit <b><?= $ia['nama_unit']; ?></b> || Ruang <b><?= $ia['nama_ruang']; ?></b></td>
            <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
            <td class="text-center" colspan="3">
                Harga Perolehan harus diisi. | <a href="<?= base_url('admin/edit_aset/') . $ia['id_input_aset']; ?>" class="badge bg-warning btn-edit-aset"><i class="far fa-edit"></i> Edit
                </a>
                <!-- <a href="#" class="badge bg-secondary DisableEditAset" ><i class="far fa-edit"></i> Edit </a> -->
            </td>
        </tr>
    <?php else : ?>
        <tr>
            <td class="text-center"><?= $no; ?></td>
            <td>
                <?= $ia['nama_sarana']; ?>
                <a href="#" data-toggle="modal" data-target="#nonaktif_aset<?= $ia['id_input_aset']; ?>" class="badge bg-success BtnAktifAset">Aktif</a>
                <!-- <span class="badge bg-secondary BtnNonAktifAset">Non Aktif</span> -->
            </td>
            <td class="text-center">Unit <b><?= $ia['nama_unit']; ?></b> || Ruang <b><?= $ia['nama_ruang']; ?></b></td>
            <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
            <td><?= buatRupiah($ia['harga_perolehan']); ?></td>
            <td><?= buatRupiah($ia['total_perolehan']); ?></td>
            <td class="text-center">
                <a href="#" class="badge bg-lightblue AsetDetail" data-toggle="modal" data-target="#detail_aset<?= $ia['id_input_aset']; ?>" data-aset-aktif="<?= $ia['aset_aktif']; ?>"><i class="fas fa-info-circle"></i> Details
                </a> |
                <a href="<?= base_url('admin/edit_aset/') . $ia['id_input_aset']; ?>" class="badge bg-warning btn-edit-aset"><i class="far fa-edit"></i> Edit
                </a> |
                <!-- <a href="#" class="badge bg-secondary DisableEditAset" ><i class="far fa-edit"></i> Edit </a> -->
                <a href="#" class="badge bg-danger btn-hapus-aset" data-toggle="modal" data-target="#hapus_aset<?= $ia['id_input_aset']; ?>" ><i class="far fa-trash-alt"></i> Hapus
                </a>
                <!-- <a href="#" class="badge bg-secondary DisableHapusAset" ><i class="far fa-trash-alt"></i> Hapus </a> -->
            </td>
        </tr>
    <?php endif; ?>
<?php else:?>
    <tr>
        <td class="text-center"><?= $no; ?></td>
        <td>
            <?= $ia['nama_sarana']; ?>
            <span class="badge bg-secondary BtnNonAktifAset">Non Aktif</span>
        </td>
        <td class="text-center">Unit <b><?= $ia['nama_unit']; ?></b> || Ruang <b><?= $ia['nama_ruang']; ?></b></td>
        <td class="text-center"><?= $ia['jumlah_aset']; ?></td>
        <td><?= buatRupiah($ia['harga_perolehan']); ?></td>
        <td><?= buatRupiah($ia['total_perolehan']); ?></td>
        <td class="text-center">
            <a href="#" class="badge bg-lightblue AsetDetail" data-toggle="modal" data-target="#detail_aset<?= $ia['id_input_aset']; ?>" data-aset-aktif="<?= $ia['aset_aktif']; ?>"><i class="fas fa-info-circle"></i> Details
            </a> |
            <a href="#" class="badge bg-secondary DisableEditAset" ><i class="far fa-edit"></i> Edit </a> |
            <a href="#" class="badge bg-secondary DisableHapusAset" ><i class="far fa-trash-alt"></i> Hapus </a>
        </td>
    </tr>
<?php endif;?>

<?php $no++;
endforeach; ?>

<!-- <script>
$(document).ready(function(){
    $('tbody tr').each(function(){
        var BtnEditAset = $(this).find('.btn-edit-aset');
        var BtnHapusAset = $(this).find('.btn-hapus-aset');
        var BtnAktifAset = $(this).find('.BtnAktifAset');
        var BtnNonAktifAset = $(this).find('.BtnNonAktifAset');
        var DisableEditAset = $(this).find('.DisableEditAset');
        var DisableHapusAset = $(this).find('.DisableHapusAset');
        var AsetDetail = $(this).find('.AsetDetail');

        var asetAktifadmin = parseInt(AsetDetail.data('aset-aktif'));
        console.log(asetAktifadmin);

            if (asetAktifadmin == 1) {
                BtnEditAset.show();
                BtnHapusAset.show();
                BtnAktifAset.show();
                BtnNonAktifAset.hide();
                DisableEditAset.hide();
                DisableHapusAset.hide();
            } else {
                BtnEditAset.hide();
                BtnHapusAset.hide();
                BtnAktifAset.hide();
                BtnNonAktifAset.show();
                DisableEditAset.show();
                DisableHapusAset.show();
            }
        });
    });
</script> -->