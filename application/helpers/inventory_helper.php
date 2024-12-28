<?php

function is_login($peran_id)
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role = $ci->session->userdata('peran_id');
        // var_dump($role);
        // die;
        $ci->db->get_where('inventory_pengguna', ['peran_id' => $role])->row_array();
        if ($role !== $peran_id) {
            redirect('auth/blocked');
        }
    }
}


function buatRupiah($angka)
{
    $hasil = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil;
}


if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        // $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        // $hari = date("w", strtotime($date));
        $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;
        // $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }
}


function terbilang($angka)
{
    $angka = floatval($angka);
    $nominal = array(
        '',
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas'
    );

    if ($angka < 12) {
        return $nominal[$angka];
    } elseif ($angka < 20) {
        return $nominal[$angka - 10] . ' Belas';
    } elseif ($angka < 100) {
        return $nominal[floor($angka / 10)] . ' Puluh ' . $nominal[$angka % 10];
    } elseif ($angka < 200) {
        return 'Seratus ' . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        return $nominal[floor($angka / 100)] . ' Ratus ' . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        return 'Seribu ' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        return terbilang(floor($angka / 1000)) . ' Ribu ' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        return terbilang(floor($angka / 1000000)) . ' Juta ' . terbilang($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        return terbilang(floor($angka / 1000000000)) . ' Miliar ' . terbilang(fmod($angka, 1000000000));
    } else {
        return 'Angka terlalu besar';
    }
}

function tanggal_indonesia_format($tanggal)
{
    $bulan = array(
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    );

    $parts = explode('/', $tanggal);
    $bulan_num = (int)$parts[0];
    $hari = (int)$parts[1];
    $tahun = $parts[2];

    $tanggal_indonesia =  $hari . ' ' . $bulan[$bulan_num] . ' ' . $tahun;
    return $tanggal_indonesia;
}


function HitungData($tabel, $fieldJoinWithId, $id_tabel)
{
    $ci = get_instance();
    $selectIdData = $ci->db->where($fieldJoinWithId, $id_tabel);
    return $selectIdData->count_all_results($tabel);
}

function HitungTotalNilai($id, $fieldnilai, $fieldID, $table)
{
    $ci = get_instance();
    $ci->db->select($fieldnilai);
    $ci->db->from($table);
    $ci->db->where($fieldID, $id);

    $query = $ci->db->get();
    $total_nilai = 0;

    foreach ($query->result() as $row) {
        $total_nilai += $row->$fieldnilai;
    }

    return $total_nilai;
}

function HitungTotalID_ByKriteria($id, $fieldnilai, $fieldID, $table, $kriteria, $fieldKriteria)
{
    $ci = get_instance();
    $ci->db->select($fieldnilai);
    $ci->db->from($table);
    $ci->db->where($fieldID, $id);
    $ci->db->where($fieldKriteria, $kriteria);

    $query = $ci->db->get();
    $total_nilai = 0;

    foreach ($query->result() as $row) {
        $total_nilai += $row->$fieldnilai;
    }

    return $total_nilai;
}

function HitungTotalID_ByTwoCategory($id, $fieldnilai, $fieldID, $table, $kriteria1, $fieldKriteria1, $kriteria2, $fieldKriteria2)
{
    $ci = get_instance();
    $ci->db->select($fieldnilai);
    $ci->db->from($table);
    $ci->db->where($fieldID, $id);
    $ci->db->where($fieldKriteria1, $kriteria1);
    $ci->db->where($fieldKriteria2, $kriteria2);

    $query = $ci->db->get();
    $total_nilai = 0;

    foreach ($query->result() as $row) {
        $total_nilai += $row->$fieldnilai;
    }

    return $total_nilai;
}

function perpendekNama($username, $length = 15)
{
    if (strlen($username) > $length) {
        return substr($username, 0, $length) . '...';
    }
    return $username;
}
