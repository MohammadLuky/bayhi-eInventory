<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_model extends CI_Model
{
    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function show_data($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function delete_data($table, $id_field, $id_input)
    {
        $this->db->where($id_field, $id_input);
        $this->db->delete($table);
    }

    public function getId_data($id, $table, $id_table)
    {
        return $this->db->get_where($table, [$id_table => $id])->row_array();
    }

    public function update_data($field_id_tb, $id_in_input, $table, $data)
    {
        $this->db->where($field_id_tb, $id_in_input);
        $this->db->update($table, $data);
    }

    public function join2_tables($tb_utama, $tb_tujuan, $id_tb_tujuan, $field_id_join)
    {
        return $this->db->from($tb_utama)
            ->join($tb_tujuan, $tb_tujuan . '.' . $id_tb_tujuan . '=' . $field_id_join)
            ->order_by($id_tb_tujuan, 'asc')
            ->get()
            ->result_array();
    }

    public function count_rows($tabel)
    {
        $query = $this->db->get($tabel);
        return $query->num_rows();
    }

    // Menghitung jumlah data dengan kondisi tertentu

    public function count_dataByID($table, $FieldJoinInTable, $id_dataCount)
    {
        $selectIdData = $this->db->where($FieldJoinInTable, $id_dataCount);
        return $selectIdData->count_all_results($table);
    }

    public function HitungTotalID_ByKriteria($id, $fieldnilai, $fieldID, $table, $kriteria, $fieldKriteria)
    {
        $this->db->select($fieldnilai);
        $this->db->from($table);
        $this->db->where($fieldID, $id);
        $this->db->where($fieldKriteria, $kriteria);

        $query = $this->db->get();
        $total_nilai = 0;

        foreach ($query->result() as $row) {
            $total_nilai += $row->$fieldnilai;
        }

        return $total_nilai;
    }

    function HitungTotalNilai($id, $fieldnilai, $fieldID, $table)
    {
        $this->db->select($fieldnilai);
        $this->db->from($table);
        $this->db->where($fieldID, $id);

        $query = $this->db->get();
        $total_nilai = 0;

        foreach ($query->result() as $row) {
            $total_nilai += $row->$fieldnilai;
        }

        return $total_nilai;
    }

    public function DatabyKategori($id, $tabel, $fieldtabel)
    {
        return $this->db->from($tabel)
            ->where([$fieldtabel => $id])
            ->get()
            ->result_array();
    }

    public function JoinPeranPengguna($username)
    {
        return $this->db->from('inventory_pengguna')
            ->join('inventory_peran_pengguna', 'inventory_peran_pengguna.id_peran=peran_id', 'left')
            ->where(['username' => $username])
            ->get()
            ->row_array();
    }

    public function JoinPengajuanATK()
    {
        return $this->db->from('inventory_pengajuan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengajuan_id')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengajuan_id')
            ->get()
            ->result_array();
    }

    public function JoinPembelianATK()
    {
        return $this->db->from('inventory_pembelian_atk')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=beli_atk_id', 'left')
            ->get()
            ->result_array();
    }

    public function JoinPengambilanUnit()
    {
        return $this->db->from('inventory_pengambilan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengambilan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengambilan_id', 'left')
            ->get()
            ->result_array();
    }

    public function getPengambilanUnit($id_unit)
    {
        return $this->db->from('inventory_pengambilan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengambilan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengambilan_id', 'left')
            ->where(['unit_pengambilan_id' => $id_unit])
            ->get()
            ->result_array();
    }

    public function getDetailPengajuanUnitAll($id_unit)
    {
        return $this->db->from('inventory_pengajuan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengajuan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengajuan_id', 'left')
            ->where(['unit_pengajuan_id' => $id_unit])
            ->get()
            ->result_array();
    }

    public function DataPengajuanATKUnit($id_unit)
    {
        return $this->db->from('inventory_pengajuan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengajuan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengajuan_id', 'left')
            ->where(['unit_pengajuan_id' => $id_unit])
            ->where(['status_pengajuan_atk' => 'approval'])
            ->get()
            ->result_array();
    }

    public function getDetailPengajuanUnit($id_unit)
    {
        return $this->db->from('inventory_pengajuan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengajuan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengajuan_id', 'left')
            ->where(['unit_pengajuan_id' => $id_unit])
            ->get()
            ->row_array();
    }

    public function getBarangPengajuanByUnit($id_unit, $id_atk)
    {
        return $this->db->from('inventory_pengajuan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengajuan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengajuan_id', 'left')
            ->where(['unit_pengajuan_id' => $id_unit])
            ->where(['atk_pengajuan_id' => $id_atk])
            ->get()
            ->row_array();
    }

    public function getPengajuanID($id_pengajuan)
    {
        return $this->db->from('inventory_pengajuan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengajuan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengajuan_id', 'left')
            ->where(['id_pengajuan' => $id_pengajuan])
            ->get()
            ->row_array();
    }

    public function getPengambilanID($id_pengambilan)
    {
        return $this->db->from('inventory_pengambilan_atk')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_pengambilan_id', 'left')
            ->join('inventory_barang_atk', 'inventory_barang_atk.id_atk=atk_pengambilan_id', 'left')
            ->where(['id_pengambilan' => $id_pengambilan])
            ->get()
            ->row_array();
    }

    public function getJumlahPengajuanBarang($id_unit, $id_atk)
    {
        $this->db->select('jumlah_pengajuan_atk');
        $this->db->where('unit_pengajuan_id', $id_unit);
        $this->db->where('atk_pengajuan_id', $id_atk);
        $query = $this->db->get('inventory_pengajuan_atk');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $row->jumlah_pengajuan_atk;
        }
    }

    // Join data Kepala dan Sarpras Unit
    public function getDataUnitCetakLaporan($id_unit)
    {
        return $this->db->from('inventory_unit')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_unit_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=kepala_unit_id', 'left')
            ->where(['id_unit' => $id_unit])
            ->get()
            ->row_array();
    }
    public function getDataUnitJoin($id_unit)
    {
        return $this->db->from('inventory_unit')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_unit_id', 'left')
            ->join('inventory_pengguna as pengguna1', 'pengguna1.id_pengguna=kepala_unit_id', 'left')
            ->join('inventory_pengguna as pengguna2', 'pengguna2.id_pengguna=sarpras_unit_id', 'left')
            ->where(['id_unit' => $id_unit])
            ->get()
            ->row_array();
    }

    public function DataUnitJoin()
    {
        return $this->db->from('inventory_unit')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_unit_id', 'left')
            ->join('inventory_pengguna as pengguna1', 'pengguna1.id_pengguna=kepala_unit_id', 'left')
            ->join('inventory_pengguna as pengguna2', 'pengguna2.id_pengguna=sarpras_unit_id', 'left')
            ->get()
            ->result_array();
    }

    // Mengambil data semua inputan aset
    public function join_input_aset()
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->get()
            ->result_array();
    }

    // Mengambil satu data aset
    public function get_input_aset($id_input_aset)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->where(['id_input_aset' => $id_input_aset])
            ->get()
            ->row_array();
    }

    // Mengambil semua data subUnit
    public function get_sub_unit()
    {
        return $this->db->from('inventory_sub_unit')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_sub_unit_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=ruang_sub_unit_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=subunit_pic_id', 'left')
            ->order_by('id_gedung', 'asc')
            ->get()
            ->result_array();
    }

    // Mengambil semua data subUnit
    public function get_subUnit($id_sub_unit)
    {
        return $this->db->from('inventory_sub_unit')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_sub_unit_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=ruang_sub_unit_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=subunit_pic_id', 'left')
            ->where('id_sub_unit', $id_sub_unit)
            ->order_by('id_gedung', 'asc')
            ->get()
            ->result_array();
    }

    // Mengambil data sub Unit by id user pada role SubUnit
    public function SubUnit_byIDPengguna($id_pengguna)
    {
        return $this->db->from('inventory_sub_unit')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_sub_unit_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=ruang_sub_unit_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=subunit_pic_id', 'left')

            ->order_by('id_gedung', 'asc')
            ->where('subunit_pic_id', $id_pengguna)
            ->get()
            ->result_array();
    }

    // Mengambil satu data sub Unit by id user pada role SubUnit
    public function get_SubUnit_IDPengguna($id_pengguna)
    {
        return $this->db->from('inventory_sub_unit')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_sub_unit_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=ruang_sub_unit_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=subunit_pic_id', 'left')
            ->where('subunit_pic_id', $id_pengguna)
            ->get()
            ->row_array();
    }

    // Mengambil 1 data di sub Unit

    public function satu_sub_unit($id_sub_unit)
    {
        return $this->db->from('inventory_sub_unit')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_sub_unit_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=ruang_sub_unit_id', 'left')
            ->order_by('id_gedung', 'asc')
            ->where('id_sub_unit', $id_sub_unit)
            ->get()
            ->row_array();
    }

    // Mengambil data aset by sub Unit
    public function get_aset_sub_unit($aset_sub_unit_id)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            // ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->where('aset_sub_unit_id', $aset_sub_unit_id)
            ->get()
            ->result_array();
    }

    // Mengambil data kondisi aset by sub Unit
    // public function kondisiAsetRusak($aset_sub_unit_id)
    public function AsetNonAktif($aset_sub_unit_id)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->where('aset_sub_unit_id', $aset_sub_unit_id)
            // ->where("(kondisi_aset = 'Rusak Ringan' OR kondisi_aset = 'Rusak Berat')")
            ->where('aset_aktif', 0)
            ->order_by('id_input_aset', 'asc')
            ->get()
            ->result_array();
    }

    // Mengambil data kondisi aset by Unit
    // public function kondisiAsetRusakUnit($aset_unit_id)
    public function AsetNonAktifUnit($aset_unit_id)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->where('aset_unit_id', $aset_unit_id)
            ->where('aset_aktif', 0)
            // ->where("(kondisi_aset = 'Rusak Ringan' OR kondisi_aset = 'Rusak Berat')")
            ->order_by('id_input_aset', 'asc')
            ->get()
            ->result_array();
    }

    // Mengambil data kondisi aset by Unit
    // public function kondisiAsetRusakUnit($aset_unit_id)
    public function AsetNonAktifSubUnit($aset_sub_unit_id)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->where('aset_sub_unit_id', $aset_sub_unit_id)
            ->where('aset_aktif', 0)
            // ->where("(kondisi_aset = 'Rusak Ringan' OR kondisi_aset = 'Rusak Berat')")
            ->order_by('id_input_aset', 'asc')
            ->get()
            ->result_array();
    }

    // Menghitung Jumlah Aset kondisi rusak
    public function HitungAsetRusak()
    {
        $selectIdData = $this->db->where("(kondisi_aset = 'Rusak Ringan' OR kondisi_aset = 'Rusak Berat')");
        return $selectIdData->count_all_results('inventory_kondisi_aset');
    }

    // Mengambil data kondisi aset by sub Unit
    public function asetSubUnit_kondisi($aset_sub_unit_id)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->where('aset_sub_unit_id', $aset_sub_unit_id)
            ->where('aset_aktif', 1)
            ->order_by('id_input_aset', 'asc')
            ->get()
            ->result_array();
    }

    // Mengambil data kondisi aset by sub Unit
    public function asetUnit_kondisi($aset_unit_id)
    {
        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->join('inventory_kondisi_aset', 'inventory_kondisi_aset.aset_id=id_input_aset', 'left')
            ->where('aset_unit_id', $aset_unit_id)
            ->order_by('id_input_aset', 'asc')
            ->get()
            ->result_array();
    }

    // Menampilkan data cek kondisi per aset
    public function get_cek_kondisi($id_aset)
    {
        return $this->db->from('inventory_kondisi_aset')
            ->join('inventory_input_aset', 'inventory_input_aset.id_input_aset=aset_id', 'left')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_kondisi_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=subunit_kondisi_id', 'left')
            ->where('aset_id', $id_aset)
            ->get()
            ->result_array();
    }

    // Mengambil semua data aset per Unit
    public function get_unit_aset($id_unit)
    {

        return $this->db->from('inventory_input_aset')
            ->join('inventory_unit', 'inventory_unit.id_unit=aset_unit_id', 'left')
            ->join('inventory_sub_unit', 'inventory_sub_unit.id_sub_unit=aset_sub_unit_id', 'left')
            ->join('inventory_jenis_aset', 'inventory_jenis_aset.id_jenis=jenis_aset_id', 'left')
            ->join('inventory_kelompok_aset', 'inventory_kelompok_aset.id_kelompok=jenis_kelompok_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=lokasi_gedung_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=lokasi_ruang_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=pic_id', 'left')
            ->where('aset_unit_id', $id_unit)
            ->where('aset_aktif', 1)
            ->order_by('id_sub_unit', 'asc')
            ->get()
            ->result_array();
    }

    // Ambil satu data unit
    public function satu_dataUnit($id_unit)
    {
        return $this->db->from('inventory_unit')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_unit_id', 'left')
            ->where(['id_unit' => $id_unit])
            ->get()
            ->row_array();
    }

    // Mengambil data sub Unit by id unit pada role Unit
    public function SubUnit_byIDUnit($id_unit)
    {
        return $this->db->from('inventory_sub_unit')
            ->join('inventory_unit', 'inventory_unit.id_unit=unit_id', 'left')
            ->join('inventory_gedung', 'inventory_gedung.id_gedung=gedung_sub_unit_id', 'left')
            ->join('inventory_ruang', 'inventory_ruang.id_ruang=ruang_sub_unit_id', 'left')
            ->join('inventory_pengguna', 'inventory_pengguna.id_pengguna=subunit_pic_id', 'left')
            ->order_by('id_unit', 'asc')
            ->where('unit_id', $id_unit)
            ->get()
            ->result_array();
    }
}
