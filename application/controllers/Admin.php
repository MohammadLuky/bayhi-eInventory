<?php
require FCPATH . 'vendor/autoload.php';

defined('BASEPATH') or exit('No direct script access allowed');

// Render to Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
// Render to PDF
use Mpdf\Mpdf;

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model', 'inv');
        is_login('1');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['peran'] = $this->inv->JoinPeranPengguna($this->session->userdata('username'));
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['jumlah_gedung'] = $this->inv->count_rows('inventory_gedung');
        $data['jumlah_aset'] = $this->inv->count_rows('inventory_input_aset');
        $data['jumlah_atk'] = $this->inv->count_rows('inventory_barang_atk');
        $dataUnit = $this->inv->show_data('inventory_unit');
        $data['dataunit'] = $dataUnit;

        $seluruhtotalpengajuanUnit = 0;
        $seluruhtotalpengambilanUnit = 0;
        foreach ($dataUnit as $unit) {
            $jumlahPengajuanUnit = HitungTotalNilai($unit['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
            $jumlahPengambilanUnit = HitungTotalNilai($unit['id_unit'], 'total_pengambilan_atk', 'unit_pengambilan_id', 'inventory_pengambilan_atk');

            $seluruhtotalpengajuanUnit += $jumlahPengajuanUnit;
            $seluruhtotalpengambilanUnit += $jumlahPengambilanUnit;

            if ($seluruhtotalpengambilanUnit > 0) {
                $data['persentase_total'] = ($seluruhtotalpengambilanUnit / $seluruhtotalpengajuanUnit) * 100;
            } else {
                $data['persentase_total'] = 0;
            }
        }

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template3/layout_footer');
    }

    public function gedung()
    {
        $data['title'] = 'Gedung Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['gedung'] = $this->inv->show_data('inventory_gedung');

        $this->form_validation->set_rules('nama_gedung', 'Nama Gedung', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/gedung', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_gedung' => htmlspecialchars($this->input->post('nama_gedung')),
            ];
            $this->inv->insert_data($data, 'inventory_gedung');
            $this->session->set_flashdata('message', 'Gedung Baru Telah Ditambahkan');
            return redirect('admin/gedung');
        }
    }

    public function HitungDataGedung($id_gedung)
    {
        $count_ruang = $this->inv->count_dataByID('inventory_ruang', 'gedung_id', $id_gedung);
        $count_sub_unit = $this->inv->count_dataByID('inventory_sub_unit', 'gedung_sub_unit_id', $id_gedung);
        $count_aset = $this->inv->count_dataByID('inventory_input_aset', 'lokasi_gedung_id', $id_gedung);

        $data = array(
            'count_ruang' => $count_ruang,
            'count_sub_unit' => $count_sub_unit,
            'count_aset' => $count_aset,
        );

        echo json_encode($data);
    }

    public function edit_gedung($id_gedung)
    {
        $data['title'] = 'Gedung Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['gedung_edit'] = $this->inv->getId_data($id_gedung, 'inventory_gedung', 'id_gedung');
        $data['gedung'] = $this->inv->show_data('inventory_gedung');

        $this->form_validation->set_rules('nama_gedung', 'Nama Gedung', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/gedung', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_gedung' => htmlspecialchars($this->input->post('nama_gedung')),
            ];
            $this->inv->update_data('id_gedung', $this->input->post('id_gedung'), 'inventory_gedung', $data);
            $this->session->set_flashdata('message', 'Gedung Telah Diubah');
            return redirect('admin/gedung');
        }
    }

    public function hapus_gedung($id_gedung)
    {
        $this->inv->delete_data('inventory_gedung', 'id_gedung', $id_gedung);
        $this->session->set_flashdata('message', 'Gedung Telah Dihapus');
        return redirect('admin/gedung');
    }

    public function ruang()
    {
        $data['title'] = 'Ruang Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['gedung'] = $this->inv->show_data('inventory_gedung');
        $data['ruang'] = $this->inv->join2_tables('inventory_ruang', 'inventory_gedung', 'id_gedung', 'gedung_id');

        $this->form_validation->set_rules('nama_ruang', 'Nama Ruang', 'required|trim');
        $this->form_validation->set_rules('gedung_id', 'Pemilihan Gedung', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/ruang', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_ruang' => htmlspecialchars($this->input->post('nama_ruang')),
                'gedung_id' => htmlspecialchars($this->input->post('gedung_id')),
            ];
            $this->inv->insert_data($data, 'inventory_ruang');
            $this->session->set_flashdata('message', 'Ruang Baru Telah Ditambahkan');
            return redirect('admin/ruang');
        }
    }

    public function HitungDataRuang($id_ruang)
    {
        $count_sub_unit = $this->inv->count_dataByID('inventory_sub_unit', 'ruang_sub_unit_id', $id_ruang);
        $count_aset = $this->inv->count_dataByID('inventory_input_aset', 'lokasi_ruang_id', $id_ruang);

        $data = array(
            'count_sub_unit' => $count_sub_unit,
            'count_aset' => $count_aset,
        );

        echo json_encode($data);
    }

    public function edit_ruang($id_ruang)
    {
        $data['title'] = 'Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['ruang_edit'] = $this->inv->getId_data($id_ruang, 'inventory_ruang', 'id_ruang');
        $data['gedung'] = $this->inv->show_data('inventory_gedung');
        $data['ruang'] = $this->inv->join2_tables('inventory_ruang', 'inventory_gedung', 'id_gedung', 'gedung_id');

        $this->form_validation->set_rules('nama_ruang', 'Nama Ruang', 'required|trim');
        $this->form_validation->set_rules('gedung_id1', 'Pemilihan Gedung', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/ruang', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_ruang' => htmlspecialchars($this->input->post('nama_ruang')),
                'gedung_id' => htmlspecialchars($this->input->post('gedung_id1')),
            ];
            $this->inv->update_data('id_ruang', $this->input->post('id_ruang'), 'inventory_ruang', $data);
            $this->session->set_flashdata('message', 'Ruang Telah Diubah');
            return redirect('admin/ruang');
        }
    }

    public function hapus_ruang($id_ruang)
    {
        $this->inv->delete_data('inventory_ruang', 'id_ruang', $id_ruang);
        $this->session->set_flashdata('message', 'Ruang Telah Dihapus');
        return redirect('admin/ruang');
    }

    public function unit()
    {
        $data['title'] = 'Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['gedung'] = $this->inv->show_data('inventory_gedung');
        $data['pengguna'] = $this->inv->show_data('inventory_pengguna');
        $data['unit'] = $this->inv->DataUnitJoin();

        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required|trim');
        $this->form_validation->set_rules('kepala_unit', 'Pemilihan Gedung', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'kepala_unit_id' => htmlspecialchars($this->input->post('kepala_unit')),
            ];
            $this->inv->insert_data($data, 'inventory_unit');
            $this->session->set_flashdata('message', 'Unit Baru Telah Ditambahkan');
            return redirect('admin/unit');
        }
    }

    public function HitungDataUnit($id_unit)
    {
        $count_sub_unit = $this->inv->count_dataByID('inventory_sub_unit', 'unit_id', $id_unit);
        $count_aset = $this->inv->count_dataByID('inventory_input_aset', 'aset_unit_id', $id_unit);

        $data = array(
            'count_sub_unit' => $count_sub_unit,
            'count_aset' => $count_aset,
        );

        echo json_encode($data);
    }

    public function edit_unit($id_unit)
    {
        $data['title'] = 'Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['unit_edit'] = $this->inv->getId_data($id_unit, 'inventory_unit', 'id_unit');
        $data['unit'] = $this->inv->join2_tables('inventory_unit', 'inventory_gedung', 'id_gedung', 'gedung_unit_id');

        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required|trim');
        $this->form_validation->set_rules('kepala_unit2', 'Kepala Unit', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'kepala_unit_id' => htmlspecialchars($this->input->post('kepala_unit2')),
            ];
            $this->inv->update_data('id_unit', $this->input->post('id_unit'), 'inventory_unit', $data);
            $this->session->set_flashdata('message', 'Unit Telah Diubah');
            return redirect('admin/unit');
        }
    }

    public function hapus_unit($id_unit)
    {
        $this->inv->delete_data('inventory_unit', 'id_unit', $id_unit);
        $this->session->set_flashdata('message', 'Unit Telah Dihapus');
        return redirect('admin/unit');
    }

    public function sub_unit()
    {
        $data['title'] = 'Sub Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['unit'] = $this->inv->DataUnitJoin();
        $data['sub_unit'] = $this->inv->get_sub_unit();
        $data['pengguna'] = $this->inv->show_data('inventory_pengguna');
        $data['ruang'] = $this->inv->join2_tables('inventory_ruang', 'inventory_gedung', 'id_gedung', 'gedung_id');

        $this->form_validation->set_rules('nama_sub_unit', 'Nama Sub Unit', 'required|trim');
        $this->form_validation->set_rules('unit_id', 'Pemilihan Unit', 'required|trim');
        $this->form_validation->set_rules('ruang_sub_unit', 'Pemilihan Ruang', 'required|trim');
        $this->form_validation->set_rules('pic_subunit', 'PIC Sub Unit', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/sub_unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_sub_unit' => htmlspecialchars($this->input->post('nama_sub_unit')),
                'unit_id' => htmlspecialchars($this->input->post('unit_id')),
                'gedung_sub_unit_id' => htmlspecialchars($this->input->post('ruang_sub_unit_text')),
                'ruang_sub_unit_id' => htmlspecialchars($this->input->post('ruang_sub_unit')),
                'subunit_pic_id' => htmlspecialchars($this->input->post('pic_subunit')),
            ];
            $this->inv->insert_data($data, 'inventory_sub_unit');
            $this->session->set_flashdata('message', 'Sub Unit Baru Telah Ditambahkan');
            return redirect('admin/sub_unit');
        }
    }

    public function HitungDataSubUnit($id_sub_unit)
    {
        $count_aset = $this->inv->count_dataByID('inventory_input_aset', 'aset_sub_unit_id', $id_sub_unit);

        $data = array(
            'count_aset' => $count_aset,
        );

        echo json_encode($data);
    }

    public function edit_sub_unit($id_sub_unit)
    {
        $data['title'] = 'Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit_edit'] = $this->inv->getId_data($id_sub_unit, 'inventory_sub_unit', 'id_sub_unit');
        $data['unit'] = $this->inv->show_data('inventory_unit');
        $data['pengguna'] = $this->inv->show_data('inventory_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();

        $this->form_validation->set_rules('nama_sub_unit', 'Nama Sub Unit', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/sub_unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_sub_unit' => htmlspecialchars($this->input->post('nama_sub_unit')),
                'gedung_sub_unit_id' => htmlspecialchars($this->input->post('ruang_sub_unit1_text')),
                'subunit_pic_id' => htmlspecialchars($this->input->post('pic_subunit1')),
            ];

            $this->inv->update_data('id_sub_unit', $this->input->post('id_sub_unit'), 'inventory_sub_unit', $data);

            $this->session->set_flashdata('message', 'Sub Unit Telah Diubah');
            return redirect('admin/sub_unit');
        }
    }

    public function hapus_sub_unit($id_sub_unit)
    {
        $data = [
            'subunit_pic_id' => 0,
        ];
        $this->inv->update_data('id_sub_unit', $this->input->post('id_sub_unit'), 'inventory_sub_unit', $data);
        $this->inv->delete_data('inventory_sub_unit', 'id_sub_unit', $id_sub_unit);
        $this->session->set_flashdata('message', 'Sub Unit Telah Dihapus');
        return redirect('admin/sub_unit');
    }

    public function kelompok_aset()
    {
        $data['title'] = 'Kelompok Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['kelompok'] = $this->inv->show_data('inventory_kelompok_aset');

        $this->form_validation->set_rules('nama_kelompok', 'Nama Kelompok', 'required|trim');
        $this->form_validation->set_rules('umur_aset', 'Umur Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/kelompok_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_kelompok' => htmlspecialchars($this->input->post('nama_kelompok')),
                'umur_aset' => htmlspecialchars($this->input->post('umur_aset')),
            ];
            $this->inv->insert_data($data, 'inventory_kelompok_aset');
            $this->session->set_flashdata('message', 'Kelompok Aset Baru Telah Ditambahkan');
            return redirect('admin/kelompok_aset');
        }
    }

    public function HitungDataKelompok($id_kelompok)
    {
        $count_kelompok = $this->inv->count_dataByID('inventory_jenis_aset', 'kelompok_id', $id_kelompok);
        $count_aset = $this->inv->count_dataByID('inventory_input_aset', 'jenis_kelompok_id', $id_kelompok);

        $data = array(
            'count_kelompok' => $count_kelompok,
            'count_aset' => $count_aset,
        );

        echo json_encode($data);
    }

    public function edit_kelompok_aset($id_kelompok)
    {
        $data['title'] = 'Kelompok Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['kelompok_edit'] = $this->inv->getId_data($id_kelompok, 'inventory_kelompok_aset', 'id_kelompok');
        $data['kelompok'] = $this->inv->show_data('inventory_kelompok_aset');

        $this->form_validation->set_rules('nama_kelompok', 'Nama Kelompok', 'required|trim');
        $this->form_validation->set_rules('umur_aset', 'Umur Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/kelompok_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_kelompok' => htmlspecialchars($this->input->post('nama_kelompok')),
                'umur_aset' => htmlspecialchars($this->input->post('umur_aset')),
            ];
            $this->inv->update_data('id_kelompok', $this->input->post('id_kelompok'), 'inventory_kelompok_aset', $data);
            $this->session->set_flashdata('message', 'Kelompok Aset Telah Diubah');
            return redirect('admin/kelompok_aset');
        }
    }

    public function hapus_kelompok($id_kelompok)
    {
        $this->inv->delete_data('inventory_kelompok_aset', 'id_kelompok', $id_kelompok);
        $this->session->set_flashdata('message', 'Kelompok Aset Telah Dihapus');
        return redirect('admin/kelompok_aset');
    }

    public function jenis_aset()
    {
        $data['title'] = 'Jenis Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['jenis_aset'] = $this->inv->join2_tables('inventory_jenis_aset', 'inventory_kelompok_aset', 'id_kelompok', 'kelompok_id');
        $data['kelompok'] = $this->inv->show_data('inventory_kelompok_aset');

        $this->form_validation->set_rules('kelompok_id', 'Nama Kelompok', 'required|trim');
        $this->form_validation->set_rules('kode_aset', 'Kode Aset', 'required|trim');
        $this->form_validation->set_rules('jenis_aset', 'Jenis Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/jenis_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id')),
                'kode_aset' => htmlspecialchars($this->input->post('kode_aset')),
                'jenis_aset' => htmlspecialchars($this->input->post('jenis_aset')),
            ];
            $this->inv->insert_data($data, 'inventory_jenis_aset');
            $this->session->set_flashdata('message', 'Jenis Aset Baru Telah Ditambahkan');
            return redirect('admin/jenis_aset');
        }
    }

    public function HitungDataJenis($id_jenis)
    {
        $count_aset = $this->inv->count_dataByID('inventory_input_aset', 'jenis_aset_id', $id_jenis);

        $data = array(
            'count_aset' => $count_aset,
        );

        echo json_encode($data);
    }

    public function edit_jenis_aset($id_jenis)
    {
        $data['title'] = 'Jenis Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['jenis_edit'] = $this->inv->getId_data($id_jenis, 'inventory_jenis_aset', 'id_jenis');
        $data['jenis_aset'] = $this->inv->join2_tables('inventory_jenis_aset', 'inventory_kelompok_aset', 'id_kelompok', 'kelompok_id');
        $data['kelompok'] = $this->inv->show_data('inventory_kelompok_aset');

        $this->form_validation->set_rules('kelompok_id1', 'Nama Kelompok', 'required|trim');
        $this->form_validation->set_rules('kode_aset', 'Kode Aset', 'required|trim');
        $this->form_validation->set_rules('jenis_aset', 'Jenis Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/jenis_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id1')),
                'kode_aset' => htmlspecialchars($this->input->post('kode_aset')),
                'jenis_aset' => htmlspecialchars($this->input->post('jenis_aset')),
            ];
            $this->inv->update_data('id_jenis', $this->input->post('id_jenis'), 'inventory_jenis_aset', $data);
            $this->session->set_flashdata('message', 'Jenis Aset Baru Telah Ditambahkan');
            return redirect('admin/jenis_aset');
        }
    }

    public function hapus_jenis_aset($id_jenis)
    {
        $this->inv->delete_data('inventory_jenis_aset', 'id_jenis', $id_jenis);
        $this->session->set_flashdata('message', 'Kelompok Aset Telah Dihapus');
        return redirect('admin/jenis_aset');
    }

    public function atk()
    {
        $data['title'] = 'Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['BarangATK'] = $this->inv->show_data('inventory_barang_atk');
        $data['satuan_brg'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'set', 'tube', 'unit'];

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|trim');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_barang', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_harga', 'Harga Satuan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/barang_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'kode_barang' => htmlspecialchars($this->input->post('kode_barang')),
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
                'satuan_barang' => htmlspecialchars($this->input->post('satuan_barang')),
                'satuan_harga' => htmlspecialchars($this->input->post('satuan_harga')),
                'ket_barang' => 'bayhi',
            ];
            $this->inv->insert_data($data, 'inventory_barang_atk');

            $getIDatk = $this->db->insert_id();

            $dataUpdate = [
                'kode_kelompok_barang' => '1.1.12.01.03.0001-' . $getIDatk . '-bayhi',
                'id_standart_harga' => '9520001-' . $getIDatk . '-bayhi',
                'kode_barang_dari_pemerintah' => '1.1.12.01.03.0001.' . $getIDatk . '-bayhi',
                'kode_rekening' => '5.1.02.01.01.0024.-' . $getIDatk . '-bayhi',
            ];

            $this->inv->update_data('id_atk', $getIDatk, 'inventory_barang_atk', $dataUpdate);

            $this->session->set_flashdata('message', 'Barang ATK Baru Telah Ditambahkan');
            return redirect('admin/atk');
        }
    }

    public function UploadBarangATK()
    {
        $config['upload_path'] = './assets/file_upload/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('import_data_aset')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/atk');
        } else {
            $file = $this->upload->data();
            $file_path = './assets/file_upload/' . $file['file_name'];

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $row = 4;
            $importDataATK = array();
            while ($worksheet->getCell('A' . $row)->getValue() !== null) {
                $kodeKelompok = $worksheet->getCell('B' . $row)->getValue();
                $standartHarga = $worksheet->getCell('C' . $row)->getValue();
                $kodebarangpemerintah = $worksheet->getCell('D' . $row)->getValue();
                $koderekening = $worksheet->getCell('E' . $row)->getValue();
                $kodebarang = $worksheet->getCell('F' . $row)->getValue();
                $namabarang = $worksheet->getCell('G' . $row)->getValue();
                $satuanbarang = $worksheet->getCell('H' . $row)->getValue();
                $satuanharga = $worksheet->getCell('I' . $row)->getValue();

                $importDataATK[] = array(
                    'kode_kelompok_barang' => $kodeKelompok,
                    'id_standart_harga' => $standartHarga,
                    'kode_barang_dari_pemerintah' => $kodebarangpemerintah,
                    'kode_rekening' => $koderekening,
                    'kode_barang' => $kodebarang,
                    'nama_barang' => $namabarang,
                    'satuan_barang' => $satuanbarang,
                    'satuan_harga' => $satuanharga,
                    'ket_barang' => 'pemerintah'
                );

                $row++;
            }

            foreach ($importDataATK as $data) {
                $this->inv->insert_data($data, 'inventory_barang_atk');
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $this->session->set_flashdata('message', 'ATK Baru Berhasil Diupload');
            return redirect('admin/atk');
        }
    }

    public function edit_atk($id_atk)
    {
        $data['title'] = 'Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['atk_get'] = $this->inv->getId_data($id_atk, 'inventory_barang_atk', 'id_atk');
        $data['BarangATK'] = $this->inv->show_data('inventory_barang_atk');
        $data['satuan_brg'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'set', 'tube', 'unit'];

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|trim');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_barang1', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_harga', 'Harga Satuan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/barang_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'kode_barang' => htmlspecialchars($this->input->post('kode_barang')),
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
                'satuan_barang' => htmlspecialchars($this->input->post('satuan_barang1')),
                'satuan_harga' => htmlspecialchars($this->input->post('satuan_harga')),
            ];
            $this->inv->update_data('id_atk', $this->input->post('id_atk'), 'inventory_barang_atk', $data);
            $this->session->set_flashdata('message', 'Barang ATK Telah Diubah');
            return redirect('admin/atk');
        }
    }

    public function HitungATK($id_atk)
    {
        $count_atk = $this->inv->count_dataByID('inventory_pengajuan_atk', 'atk_pengajuan_id', $id_atk);

        $data = array(
            'count_atk' => $count_atk,
        );

        echo json_encode($data);
    }

    public function hapus_atk($id_atk)
    {
        $this->inv->delete_data('inventory_barang_atk', 'id_atk', $id_atk);
        $this->session->set_flashdata('message', 'Barang ATK Telah Dihapus');
        return redirect('admin/atk');
    }

    public function stokATK()
    {
        $data['title'] = 'Stok Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['BarangATK'] = $this->inv->show_data('inventory_barang_atk');
        $data['satuan_brg'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'set', 'tube', 'unit'];


        $this->form_validation->set_rules('tanggal_pembelian', 'Tanggal Pembelian', 'required|trim');
        $this->form_validation->set_rules('atk_stok', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_pembelian', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('jumlah_pembelian', 'Jumlah Barang', 'required|trim');
        $this->form_validation->set_rules('harga_pembelian', 'Harga Barang', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/stok_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'beli_atk_id' => htmlspecialchars($this->input->post('atk_stok')),
                'jumlah_atk' => htmlspecialchars($this->input->post('jumlah_pembelian')),
                'satuan_atk_beli' => htmlspecialchars($this->input->post('satuan_pembelian')),
                'harga_beli_atk' => htmlspecialchars($this->input->post('harga_pembelian')),
                'total_beli_atk' => htmlspecialchars($this->input->post('total_pembelian')),
                'tanggal_beli' => htmlspecialchars($this->input->post('tanggal_pembelian')),
            ];
            $this->inv->insert_data($data, 'inventory_pembelian_atk');
            $this->session->set_flashdata('message', 'Data Pembelian Berhasil Ditambahkan.');
            return redirect('admin/stokATK');
        }
    }

    public function pembelianATK()
    {
        $data['title'] = 'Stok Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['BarangATKBeli'] = $this->inv->JoinPembelianATK();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/riwayat_pembelian_atk', $data);
        $this->load->view('template3/layout_footer');
    }

    public function hapuspembelianATK($id_history_beli)
    {
        $this->inv->delete_data('inventory_pembelian_atk', 'id_history_beli', $id_history_beli);
        $this->session->set_flashdata('message', 'Pembelian ATK Telah Dihapus');
        return redirect('admin/pembelianATK');
    }

    public function manajemen_pengguna()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');


        $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|trim');
        $this->form_validation->set_rules('jabatan_pengguna', 'Jabatan Pengguna', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[inventory_pengguna.username]', [
            'is_unique' => 'Username ini Sudah Terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/manajemen_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'jabatan_pengguna' => htmlspecialchars($this->input->post('jabatan_pengguna')),
                'peran_id' => htmlspecialchars($this->input->post('peran_id')),
                'username' => htmlspecialchars($this->input->post('username')),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'pass_tampil' => ($this->input->post('password1')),
                'img' => '5856.jpg',
            ];
            $this->inv->insert_data($data, 'inventory_pengguna');
            $this->session->set_flashdata('message', 'Pengguna Baru Telah Ditambahkan');
            return redirect('admin/manajemen_pengguna');
        }
    }

    public function UploadPengguna()
    {
        $config['upload_path'] = './assets/file_upload/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('import_data_pengguna')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/manajemen_pengguna');
        } else {
            $file = $this->upload->data();
            $file_path = './assets/file_upload/' . $file['file_name'];

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $row = 4;
            $importDataPengguna = array();
            while ($worksheet->getCell('B' . $row)->getValue() !== null) {
                $namaUser = $worksheet->getCell('C' . $row)->getValue();
                $jabatanUser = $worksheet->getCell('D' . $row)->getValue();
                $username = $worksheet->getCell('E' . $row)->getValue();

                $importDataPengguna[] = array(
                    'nama' => $namaUser,
                    'username' => $username,
                    'password' => password_hash($username, PASSWORD_DEFAULT),
                    'pass_tampil' => $username,
                    'img' => '5856.jpg',
                    'jabatan_pengguna' => $jabatanUser,
                    'peran_id' => 10
                );

                $row++;
            }

            foreach ($importDataPengguna as $data) {
                $this->inv->insert_data($data, 'inventory_pengguna');
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $this->session->set_flashdata('message', 'Data Pengguna Baru Berhasil Diupload');
            return redirect('admin/manajemen_pengguna');
        }
    }

    public function tambah_peran()
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');

        $this->form_validation->set_rules('peran', 'Peran Pengguna', 'required|trim');
        $this->form_validation->set_rules('ket_peran', 'Keterangan Peran Pengguna', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/manajemen_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {

            $data_peran = [
                'peran' => htmlspecialchars($this->input->post('peran')),
                'ket_peran' => htmlspecialchars($this->input->post('ket_peran')),
            ];
            $this->inv->insert_data($data_peran, 'inventory_peran_pengguna');
            $this->session->set_flashdata('message', 'Peran Baru Telah Ditambahkan');
            return redirect('admin/manajemen_pengguna');
        }
    }

    public function edit_pengguna($id_pengguna)
    {
        $data['title'] = 'Manajemen Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['get_pengguna'] = $this->inv->getId_data($id_pengguna, 'inventory_pengguna', 'id_pengguna');
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');

        $this->form_validation->set_rules('nama_edit', 'Nama Pengguna', 'required|trim');
        $this->form_validation->set_rules('peran_id1', 'Peran', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/manajemen_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama_edit')),
                'jabatan_pengguna' => htmlspecialchars($this->input->post('jabatan_pengguna_edit')),
                'peran_id' => htmlspecialchars($this->input->post('peran_id1')),
            ];
            $this->inv->update_data('id_pengguna', $this->input->post('id_pengguna'), 'inventory_pengguna', $data);
            $this->session->set_flashdata('message', 'Pengguna Telah Diubah');
            return redirect('admin/manajemen_pengguna');
        }
    }

    public function hapus_pengguna($id_pengguna)
    {
        $this->inv->delete_data('inventory_pengguna', 'id_pengguna', $id_pengguna);
        $this->session->set_flashdata('message', 'Pengguna Telah Dihapus');
        return redirect('admin/manajemen_pengguna');
    }

    public function profil_pengguna()
    {
        $data['title'] = 'Profil Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');

        $this->form_validation->set_rules('nama_profil', 'Nama Pengguna', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/profil_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $nama_profil = $this->input->post('nama_profil');
            $username = $this->input->post('username');

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/images/user/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['peran']['img'];
                    if ($old_image != '5856.jpg') {
                        unlink(FCPATH . 'assets/images/user/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('img', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }
            $this->db->set('nama', $nama_profil);
            $this->db->where('username', $username);
            $this->db->update('inventory_pengguna');
            $this->session->set_flashdata('message', 'Profil Pengguna Telah Diubah');
            return redirect('admin/profil_pengguna');
        }
    }

    public function ubah_password()
    {
        $data['title'] = 'Profil Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');

        $this->form_validation->set_rules('pass_sekarang', 'Password Aktif', 'required|trim');
        $this->form_validation->set_rules('pass_new1', 'Password Baru', 'required|trim|min_length[5]|matches[pass_new2]');
        $this->form_validation->set_rules('pass_new2', 'Konfirmasi Password Baru', 'required|trim|min_length[5]|matches[pass_new1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/profil_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $pass_sekarang = $this->input->post('pass_sekarang');
            $new_password = $this->input->post('pass_new1');
            if (!password_verify($pass_sekarang, $data['peran']['password'])) {
                $this->session->set_flashdata('message_password', 'Password Aktif Anda Salah!');
                redirect('admin/ubah_password');
            } else {
                if ($pass_sekarang == $new_password) {
                    $this->session->set_flashdata('message_password', 'Password Baru tidak Boleh sama dengan Password Aktif!');
                    redirect('admin/ubah_password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->set('pass_tampil', $new_password);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('inventory_pengguna');

                    $this->session->set_flashdata('message_password_ok', 'Password Berhasil Diubah!');
                    redirect('admin/ubah_password');
                }
            }
        }
    }

    public function TahunPeriode()
    {
        $data['title'] = 'Tahun Periode';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('cooming_soon', $data);
        $this->load->view('template3/layout_footer');
    }

    public function input_aset()
    {
        $data['title'] = 'Input Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();
        $data['kepemilikan'] = ['Milik', 'Sewa'];
        $data['jenis'] = $this->inv->join2_tables('inventory_jenis_aset', 'inventory_kelompok_aset', 'id_kelompok', 'kelompok_id');
        $data['satuan_aset'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'set', 'tube', 'unit'];
        $data['ket_aset'] = ['Baru', 'Lama/Second'];
        $jumlahAset_perUnit = $this->inv->count_dataByID('inventory_input_aset', 'aset_unit_id', $this->input->post('value_aset_input2'));

        $kodeAset = $jumlahAset_perUnit + 1;

        $this->form_validation->set_rules('aset_sub_unit', 'Nama Sub Unit dan Unit', 'required|trim');
        $this->form_validation->set_rules('jenis_aset_id', 'Jenis Aset dan Kelompok', 'required|trim');
        $this->form_validation->set_rules('nama_sarana', 'Nama Sarana', 'required|trim');
        $this->form_validation->set_rules('jumlah_aset', 'Jumlah Sarana', 'required|trim');
        $this->form_validation->set_rules('status_kepemilikan', 'Kepemilikan', 'required|trim');
        $this->form_validation->set_rules('harga_perolehan', 'Harga Perolehan', 'required|trim');
        $this->form_validation->set_rules('tahun_pengadaan', 'Tahun Pengadaan', 'required|trim');
        $this->form_validation->set_rules('ket_aset', 'Keterangan Aset', 'required|trim');
        $this->form_validation->set_rules('satuan_aset', 'Satuan Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/input_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'lokasi_gedung_id' => htmlspecialchars($this->input->post('value_aset_input1')),
                'aset_unit_id' => htmlspecialchars($this->input->post('value_aset_input2')),
                'lokasi_ruang_id' => htmlspecialchars($this->input->post('value_aset_input3')),
                'aset_sub_unit_id' => htmlspecialchars($this->input->post('aset_sub_unit')),
                'jenis_aset_id' => htmlspecialchars($this->input->post('jenis_aset_id')),
                'jenis_kelompok_id' => htmlspecialchars($this->input->post('jenis_aset_id_text')),
                'nama_sarana' => htmlspecialchars($this->input->post('nama_sarana')),
                'jumlah_aset' => htmlspecialchars($this->input->post('jumlah_aset')),
                'satuan_aset' => htmlspecialchars($this->input->post('satuan_aset')),
                'status_kepemilikan' => htmlspecialchars($this->input->post('status_kepemilikan')),
                'harga_perolehan' => htmlspecialchars($this->input->post('harga_perolehan')),
                'tahun_pengadaan' => htmlspecialchars($this->input->post('tahun_pengadaan')),
                'pic_id' => htmlspecialchars($this->input->post('value_aset_input4')),
                'total_perolehan' => htmlspecialchars($this->input->post('harga_perolehan')) * htmlspecialchars($this->input->post('jumlah_aset')),
                'keterangan_aset' => htmlspecialchars($this->input->post('ket_aset')),
                'aset_aktif' => 1,
                'label_aset' => $kodeAset . '/INV/' . htmlspecialchars($this->input->post('namaUnit')) . '/' . htmlspecialchars($this->input->post('tahun_pengadaan')),
            ];
            $this->inv->insert_data($data, 'inventory_input_aset');

            $this->session->set_flashdata('message', 'Aset Baru Telah Ditambahkan');
            return redirect('admin/input_aset');
        }
    }

    public function DownloadFormatAset()
    {
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $JudulImportData = 'Format Input Data Aset';
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $DataSubUnit = $this->inv->get_sub_unit();
        $DataJenisAset = $this->inv->show_data('inventory_jenis_aset');

        // eksport Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:Q1');
        $sheet->setCellValue('A1', $JudulImportData);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

        // Set fill color
        $headerData1 = array(
            'A3' => array('NO', 5),
            'B3' => array('LETAK LOKASI ASET (SUB UNIT)', 20),
            'C3' => array('ID SUB UNIT', 12),
            'D3' => array('ID GEDUNG', 12),
            'E3' => array('ID RUANG', 12),
            'F3' => array('ID UNIT', 12),
            'G3' => array('ID PIC PENGGUNA', 12),
            'H3' => array('NAMA UNIT', 12),
            'I3' => array('JENIS ASET', 20),
            'J3' => array('ID JENIS', 12),
            'K3' => array('ID KELOMPOK', 12),
            'L3' => array('NAMA SARANA', 35),
            'M3' => array('JUMLAH ASET', 15),
            'N3' => array('SATUAN ASET', 15),
            'O3' => array('STATUS KEPEMILIKAN', 17),
            'P3' => array('TAHUN PENGADAAN', 17),
            'Q3' => array('HARGA PEROLEHAN', 17)
        );

        foreach ($headerData1 as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('70deb1');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }
        $kolomHide1 = ['C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'U', 'V', 'W', 'X', 'Y'];
        foreach ($kolomHide1 as $hide1) {
            $sheet->getColumnDimension($hide1)->setVisible(false);
        }


        // Batas Data Ke Data Sub Unit
        $sheet->setCellValue('R1', '')->getColumnDimension('R')->setWidth(3);

        $sheet->mergeCells('S1:Y1');
        $sheet->getStyle('S1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('S1', 'Data Sub Unit');
        $sheet->getStyle('S1')->getFont()->setBold(true)->setSize(16);


        // HEADER DATA SUB UNIT
        $headerData2 = array(
            'S3' => array('NAMA SUB UNIT', 30),
            'T3' => array('NAMA UNIT', 20),
            'U3' => array('ID SUB UNIT', 12),
            'V3' => array('ID GEDUNG', 12),
            'W3' => array('ID RUANG', 12),
            'X3' => array('ID UNIT', 12),
            'Y3' => array('ID PIC PENGGUNA', 12)
        );

        foreach ($headerData2 as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('70deb1');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }

        $sheet->setCellValue('Z1', '')->getColumnDimension('Z')->setWidth(3);

        $sheet->mergeCells('AA1:AC1');
        $sheet->getStyle('AA1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('AA1', 'Data Jenis Aset');
        $sheet->getStyle('AA1')->getFont()->setBold(true)->setSize(16);


        // HEADER DATA JENIS ASET
        $headerData3 = array(
            'AA3' => array('JENIS ASET', 38),
            'AB3' => array('ID JENIS', 12),
            'AC3' => array('ID KELOMPOK', 12)
        );

        foreach ($headerData3 as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('70deb1');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }

        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000']
                ]
            ],
        ];

        $sheet->getStyle('A3:Q250')->applyFromArray($borderStyle);
        $sheet->getStyle('S3:Y3')->applyFromArray($borderStyle);
        $sheet->getStyle('AA3:AC3')->applyFromArray($borderStyle);


        // DOWNLOAD DATA SUB UNIT
        $row = 4;
        foreach ($DataSubUnit as $itemSubUnit) {
            $sheet->setCellValue('S' . $row, $itemSubUnit['nama_sub_unit']);
            $sheet->setCellValue('T' . $row, $itemSubUnit['nama_unit']);
            $sheet->setCellValue('U' . $row, $itemSubUnit['id_sub_unit']);
            $sheet->getStyle('U' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('V' . $row, $itemSubUnit['gedung_sub_unit_id']);
            $sheet->getStyle('V' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('W' . $row, $itemSubUnit['ruang_sub_unit_id']);
            $sheet->getStyle('W' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('X' . $row, $itemSubUnit['unit_id']);
            $sheet->getStyle('X' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('Y' . $row, $itemSubUnit['subunit_pic_id']);
            $sheet->getStyle('Y' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('S' . $row . ':Y' . $row)->applyFromArray($borderStyle);
            $DataSubUnitLookUp = '$S$4:$Y$' . $row;

            $row++;
        }


        // DOWNLOAD DATA ASET
        $row = 4;
        foreach ($DataJenisAset as $itemJenisAset) {
            $sheet->setCellValue('AA' . $row, $itemJenisAset['jenis_aset']);
            $sheet->setCellValue('AB' . $row, $itemJenisAset['id_jenis']);
            $sheet->getStyle('AB' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('AC' . $row, $itemJenisAset['kelompok_id']);
            $sheet->getStyle('AC' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('AA' . $row . ':AC' . $row)->applyFromArray($borderStyle);

            $DataJenisLookUp = '$AA$4:$AC$' . $row;
            $row++;
        }

        // Unprotect pada cell tertentu
        $sheet->getProtection()->setSheet(true);
        $sheet->getStyle('A4:Q250')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        $sheet->getProtection()->setPassword('hanyaAdminSaja');

        // Memberikan Formula Vlookup
        for ($barisFormAset = 4; $barisFormAset <= 250; $barisFormAset++) {
            $sheet->setCellValue('C' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',3,FALSE),"")');
            $sheet->setCellValue('D' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',4,FALSE),"")');
            $sheet->setCellValue('E' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',5,FALSE),"")');
            $sheet->setCellValue('F' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',6,FALSE),"")');
            $sheet->setCellValue('G' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',7,FALSE),"")');
            $sheet->setCellValue('H' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',2,FALSE),"")');
            $sheet->setCellValue('J' . $barisFormAset, '=IFERROR(VLOOKUP($I' . $barisFormAset . ',' . $DataJenisLookUp . ',2,FALSE),"")');
            $sheet->setCellValue('K' . $barisFormAset, '=IFERROR(VLOOKUP($I' . $barisFormAset . ',' . $DataJenisLookUp . ',3,FALSE),"")');
        }


        $writer = new Xlsx($spreadsheet);
        $filename = $JudulImportData  . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function upload_InputDataAset()
    {
        $config['upload_path'] = './assets/file_upload/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('import_data_aset')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('admin/input_aset');
        } else {
            $file = $this->upload->data();
            $file_path = './assets/file_upload/' . $file['file_name'];

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $row = 4;

            $importDataAset = array();
            while ($worksheet->getCell('B' . $row)->getValue() !== null) {
                $IDsubunit = $worksheet->getCell('C' . $row)->getCalculatedValue();
                $IDgedung = $worksheet->getCell('D' . $row)->getCalculatedValue();
                $IDruang = $worksheet->getCell('E' . $row)->getCalculatedValue();
                $IDunit = $worksheet->getCell('F' . $row)->getCalculatedValue();
                $IDpicpengguna = $worksheet->getCell('G' . $row)->getCalculatedValue();
                $namaUnit = $worksheet->getCell('H' . $row)->getCalculatedValue();
                $IDjenis = $worksheet->getCell('J' . $row)->getCalculatedValue();
                $IDkelompok = $worksheet->getCell('K' . $row)->getCalculatedValue();
                $namaSarana = $worksheet->getCell('L' . $row)->getValue();
                $jumlahAset = $worksheet->getCell('M' . $row)->getValue();
                $satuanAset = $worksheet->getCell('N' . $row)->getValue();
                $statusKepemilikan = $worksheet->getCell('O' . $row)->getValue();
                $tahunPengadaan = $worksheet->getCell('P' . $row)->getValue();
                $hargaPerolehan = $worksheet->getCell('Q' . $row)->getValue();

                $jumlahAset_perUnit = $this->inv->count_dataByID('inventory_input_aset', 'aset_unit_id', $IDunit);

                $kodeAset = $jumlahAset_perUnit + 1;

                $importDataAset[] = array(
                    'aset_unit_id' => $IDunit,
                    'aset_sub_unit_id' => $IDsubunit,
                    'lokasi_gedung_id' => $IDgedung,
                    'lokasi_ruang_id' => $IDruang,
                    'pic_id' => $IDpicpengguna,
                    'jenis_aset_id' => $IDjenis,
                    'jenis_kelompok_id' => $IDkelompok,
                    'nama_sarana' => $namaSarana,
                    'jumlah_aset' => $jumlahAset,
                    'satuan_aset' => $satuanAset,
                    'status_kepemilikan' => $statusKepemilikan,
                    'tahun_pengadaan' => $tahunPengadaan,
                    'harga_perolehan' => $hargaPerolehan,
                    'total_perolehan' => $hargaPerolehan * $jumlahAset,
                    'aset_aktif' => 1,
                    'label_aset' => $kodeAset . '/INV/' . $namaUnit . '/' . $tahunPengadaan
                );

                $row++;
            }
            foreach ($importDataAset as $data) {
                $this->inv->insert_data($data, 'inventory_input_aset');
            }

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $this->session->set_flashdata('message', 'Aset Baru Berhasil Diupload');
            return redirect('admin/input_aset');
        }
    }

    public function hasil_input_aset()
    {
        $data['title'] = 'Input Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();
        $data['input_aset'] = $this->inv->join_input_aset();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/input_aset_tabel', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_all_aset()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['aset_bySubUnit'] = $this->inv->get_aset_sub_unit($id_subUnit);
        $this->load->view('admin/data_all_aset', $data);
    }

    public function HitungDataCekAset($id_aset)
    {
        $count_cek = $this->inv->count_dataByID('inventory_kondisi_aset', 'aset_id', $id_aset);

        $data = array(
            'count_cek' => $count_cek,
        );

        echo json_encode($data);
    }

    public function edit_aset($id_input_aset)
    {
        $data['title'] = 'Edit Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['get_aset'] = $this->inv->get_input_aset($id_input_aset);
        $data['sub_unit'] = $this->inv->get_sub_unit();
        $data['jenis_aset'] = $this->inv->join2_tables('inventory_jenis_aset', 'inventory_kelompok_aset', 'id_kelompok', 'kelompok_id');
        $data['pic'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['kepemilikan'] = ['Milik', 'Sewa'];
        $data['satuan_aset'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'set', 'tube', 'unit'];
        $data['ket_aset'] = ['Baru', 'Lama/Second'];

        $this->form_validation->set_rules('jenis_aset_id', 'Jenis Aset dan Kelompok', 'required|trim');
        $this->form_validation->set_rules('nama_sarana', 'Nama Sarana', 'required|trim');
        $this->form_validation->set_rules('jumlah_aset', 'Jumlah Sarana', 'required|trim');
        $this->form_validation->set_rules('status_kepemilikan', 'Kepemilikan', 'required|trim');
        $this->form_validation->set_rules('harga_perolehan', 'Harga Perolehan', 'required|trim');
        $this->form_validation->set_rules('tahun_pengadaan', 'Tahun Pengadaan', 'required|trim');
        $this->form_validation->set_rules('ket_aset', 'Keterangan Aset', 'required|trim');
        $this->form_validation->set_rules('satuan_aset', 'Satuan Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/edit_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_sarana' => htmlspecialchars($this->input->post('nama_sarana')),
                'jumlah_aset' => htmlspecialchars($this->input->post('jumlah_aset')),
                'satuan_aset' => htmlspecialchars($this->input->post('satuan_aset')),
                'jenis_aset_id' => htmlspecialchars($this->input->post('jenis_aset_id')),
                'jenis_kelompok_id' => htmlspecialchars($this->input->post('jenis_aset_id_text')),
                'status_kepemilikan' => htmlspecialchars($this->input->post('status_kepemilikan')),
                'harga_perolehan' => htmlspecialchars($this->input->post('harga_perolehan')),
                'tahun_pengadaan' => htmlspecialchars($this->input->post('tahun_pengadaan')),
                'total_perolehan' => htmlspecialchars($this->input->post('harga_perolehan')) * htmlspecialchars($this->input->post('jumlah_aset')),
                'keterangan_aset' => htmlspecialchars($this->input->post('ket_aset')),
            ];
            $this->inv->update_data('id_input_aset', $this->input->post('id_input_aset'), 'inventory_input_aset', $data);
            $this->session->set_flashdata('message', 'Aset Telah Diubah');
            return redirect('admin/hasil_input_aset');
        }
    }

    public function hapus_aset($id_input_aset)
    {
        $this->inv->delete_data('inventory_kondisi_aset', 'aset_id', $id_input_aset);
        $this->inv->delete_data('inventory_input_aset', 'id_input_aset', $id_input_aset);
        $this->session->set_flashdata('message', 'Aset Telah Dihapus');
        return redirect('admin/hasil_input_aset');
    }

    public function nonaktif_aset($id_input_aset)
    {
        $data = [
            'aset_aktif' => 0,
        ];
        $this->inv->update_data('id_input_aset', $id_input_aset, 'inventory_input_aset', $data);
        $this->session->set_flashdata('message', 'Aset Telah Di Non Aktifkan');
        return redirect('admin/hasil_input_aset');
    }

    public function mutasi_aset()
    {
        $data['title'] = 'Mutasi Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();
        $data['input_aset'] = $this->inv->join_input_aset();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('cooming_soon', $data);
        $this->load->view('template3/layout_footer');
    }

    public function kondisi_aset()
    {
        $data['title'] = 'Pengecekan Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();
        $data['input_aset'] = $this->inv->join_input_aset();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/kondisi_aset', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_data_aset()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['aset_bySubUnit'] = $this->inv->get_aset_sub_unit($id_subUnit);
        $this->load->view('admin/data_aset_bySubUnit', $data);
    }

    public function laporanKondisi($id_aset)
    {

        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $titleLaporan = 'Laporan Pengecekan Aset';
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $getAset = $this->inv->get_input_aset($id_aset);
        $kondisi_per_aset = $this->inv->get_cek_kondisi($id_aset);
        $tahun_ini = date('Y');

        // eksport Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', $titleLaporan);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Tahun ' . $tahun_ini);

        //Header Identitas Aset
        $sheet->setCellValue('B4', 'Nama Aset');
        $sheet->getStyle('B4')->getFont()->setBold(true);
        $sheet->setCellValue('C4', ': ' . $getAset['nama_sarana']);

        $sheet->setCellValue('B5', 'Lokasi Aset');
        $sheet->getStyle('B5')->getFont()->setBold(true);
        $sheet->setCellValue('C5', ': ' . $getAset['nama_sub_unit']);

        $sheet->setCellValue('B6', 'Jumlah Aset');
        $sheet->getStyle('B6')->getFont()->setBold(true);
        $sheet->setCellValue('C6', ': ' . $getAset['jumlah_aset']);

        $sheet->setCellValue('B7', 'Nama PIC');
        $sheet->getStyle('B7')->getFont()->setBold(true);
        $sheet->setCellValue('C7', ': ' . $getAset['nama']);

        // Set fill color

        $headerData = array(
            'A9' => array('No', 7),
            'B9' => array('Nama Aset', 30),
            'C9' => array('Kondisi Aset', 30),
            'D9' => array('Tindakan', 95),
            'E9' => array('Jumlah Aset', 15),
            'F9' => array('Tanggal Cek', 30)
        );

        foreach ($headerData as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('60e690');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }


        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000']
                ]
            ],
        ];

        $sheet->getStyle('A9:F9')->applyFromArray($borderStyle);

        $row = 10;
        $a = 1;
        foreach ($kondisi_per_aset as $item) {
            $sheet->setCellValue('A' . $row, $a++);
            $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('B' . $row, $item['nama_sarana']);
            $sheet->setCellValue('C' . $row, $item['kondisi_aset']);
            $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('D' . $row, $item['ket_kondisi_aset']);
            $sheet->setCellValue('E' . $row, $item['jumlah_aset_kondisi']);
            $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('F' . $row, $item['tanggal_cek']);
            $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($borderStyle);

            $row++;
        }

        $sheet->mergeCells('E' . ($row + 2) . ':F' . ($row + 2));
        $sheet->setCellValue('E' . ($row + 2), 'Mengetahui');

        $sheet->mergeCells('E' . ($row + 3) . ':F' . ($row + 3));
        $sheet->setCellValue('E' . ($row + 3), 'Penanggung Jawab Aset');

        $sheet->mergeCells('E' . ($row + 8) . ':F' . ($row + 8));
        $sheet->getStyle('E' . ($row + 8))->getFont()->setBold(true);
        $sheet->setCellValue('E' . ($row + 8), $getAset['nama']);

        $writer = new Xlsx($spreadsheet);
        $filename = $titleLaporan  . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function cek_kondisi_aset($id_aset)
    {
        $data['title'] = 'Edit Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['get_aset'] = $this->inv->get_input_aset($id_aset);
        $data['kondisi_per_aset'] = $this->inv->get_cek_kondisi($id_aset);
        $data['all_aset'] = $this->inv->join_input_aset();
        $data['pilih_kondisi'] = ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Perbaikan'];

        $this->form_validation->set_rules('tanggal_cek', 'Tanggal Cek', 'required|trim');
        $this->form_validation->set_rules('kondisi_aset', 'Kondisi Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/cek_kondisi_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'aset_id' => $id_aset,
                'pic_kondisi_id' => htmlspecialchars($this->input->post('pic_kondisi_id')),
                'unit_kondisi_id' => htmlspecialchars($this->input->post('unit_kondisi_id')),
                'subunit_kondisi_id' => htmlspecialchars($this->input->post('subunit_kondisi_id')),
                'tanggal_cek' => htmlspecialchars($this->input->post('tanggal_cek')),
                'kondisi_aset' => htmlspecialchars($this->input->post('kondisi_aset')),
                'ket_kondisi_aset' => htmlspecialchars($this->input->post('ket_kondisi_aset')),
                'jumlah_aset_kondisi' => htmlspecialchars($this->input->post('jumlah_aset')),
                'aturan_edit' => 0,
            ];
            $this->inv->insert_data($data, 'inventory_kondisi_aset');
            $this->session->set_flashdata('message', 'Cek Kondisi Aset telah Ditambahkan');
            return redirect('admin/cek_kondisi_aset/' . $id_aset);
        }
    }

    public function hapus_kondisi($id_kondisi)
    {
        $aset_id = $this->input->post('aset_id');
        $this->inv->delete_data('inventory_kondisi_aset', 'id_kondisi', $id_kondisi);
        $this->session->set_flashdata('message', 'Catatan Kondisi Berhasil Dihapus');
        return redirect('admin/cek_kondisi_aset/' . $aset_id);
    }

    public function PengajuanATK()
    {
        $data['title'] = 'Data Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataPengajuanATK'] = $this->inv->JoinPengajuanATK();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/data_pengajuan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function input_pengajuanATK()
    {
        $data['title'] = 'Input Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['BarangATK'] = $this->inv->show_data('inventory_barang_atk');
        $data['satuan_barang'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'tube', 'unit'];
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->form_validation->set_rules('pilih_unit_atk', 'Unit', 'required|trim');
        $this->form_validation->set_rules('pilih_atk', 'Barang ATK', 'required|trim');
        $this->form_validation->set_rules('jumlah_atk', 'Jumlah Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_barang', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal_pengajuan_atk', 'Tanggal Pengajuan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/input_pengajuan_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'unit_pengajuan_id' => htmlspecialchars($this->input->post('pilih_unit_atk')),
                'atk_pengajuan_id' => htmlspecialchars($this->input->post('pilih_atk')),
                'jumlah_pengajuan_atk' => htmlspecialchars($this->input->post('jumlah_atk')),
                'tanggal_pengajuan' => htmlspecialchars($this->input->post('tanggal_pengajuan_atk')),
                'satuan_atk_pengajuan' => htmlspecialchars($this->input->post('satuan_barang')),
                'harga_pengajuan_atk' => htmlspecialchars($this->input->post('harga_satuan_atk_pengajuan')),
                'total_pengajuan_atk' => htmlspecialchars($this->input->post('total_harga_pengajuan')),
                'tahun_pengajuan' => htmlspecialchars($this->input->post('tahun_periode')),
                'status_pengajuan_atk' => 'pengisian',
            ];
            $this->inv->insert_data($data, 'inventory_pengajuan_atk');

            $statusPengajuan = [
                'status_pengajuan' => 'pengisian',
            ];
            $this->inv->update_data('id_unit', $this->input->post('pilih_unit_atk'), 'inventory_unit', $statusPengajuan);

            $this->session->set_flashdata('message', 'Pengajuan Barang Berhasil Ditambahkan.');
            return redirect('admin/PengajuanATK');
        }
    }

    // public function edit_pengajuanATK($id_pengajuan)
    // {
    //     $data['title'] = 'Edit Pengajuan Barang ATK';
    //     $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
    //     $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
    //     $data['GetPengajuan'] = $this->inv->getPengajuanID($id_pengajuan);
    //     $data['BarangATK'] = $this->inv->show_data('inventory_barang_atk');
    //     $data['satuan_barang'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'tube', 'unit'];
    //     $data['DataUnit'] = $this->inv->show_data('inventory_unit');

    //     $this->form_validation->set_rules('pilih_unit_atk', 'Unit', 'required|trim');
    //     $this->form_validation->set_rules('pilih_atk', 'Barang ATK', 'required|trim');
    //     $this->form_validation->set_rules('jumlah_atk', 'Jumlah Barang', 'required|trim');
    //     $this->form_validation->set_rules('satuan_barang', 'Satuan Barang', 'required|trim');
    //     $this->form_validation->set_rules('tanggal_pengajuan_atk', 'Tanggal Pengajuan', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('template3/layout_header', $data);
    //         $this->load->view('template3/layout_sidebar', $data);
    //         $this->load->view('admin/edit_pengajuan_atk', $data);
    //         $this->load->view('template3/layout_footer');
    //     } else {
    //         $idPengajuan = $this->input->post('id_pengajuan');
    //         $data = [
    //             'unit_pengajuan_id' => htmlspecialchars($this->input->post('pilih_unit_atk')),
    //             'atk_pengajuan_id' => htmlspecialchars($this->input->post('pilih_atk')),
    //             'jumlah_pengajuan_atk' => htmlspecialchars($this->input->post('jumlah_atk')),
    //             'tanggal_pengajuan' => htmlspecialchars($this->input->post('tanggal_pengajuan_atk')),
    //             'satuan_atk_pengajuan' => htmlspecialchars($this->input->post('satuan_barang')),
    //             'harga_pengajuan_atk' => htmlspecialchars($this->input->post('harga_satuan_atk_pengajuan')),
    //             'total_pengajuan_atk' => htmlspecialchars($this->input->post('total_harga_pengajuan')),
    //             'tahun_pengajuan' => htmlspecialchars($this->input->post('tahun_periode')),
    //         ];
    //         $this->inv->update_data('id_pengajuan', $idPengajuan, 'inventory_pengajuan_atk', $data);
    //         $this->session->set_flashdata('message', 'Pengajuan Barang Berhasil Diubah.');
    //         return redirect('admin/PengajuanATK');
    //     }
    // }

    public function hapus_pengajuanATK($id_pengajuan)
    {
        $this->inv->delete_data('inventory_pengajuan_atk', 'id_pengajuan', $id_pengajuan);
        $this->session->set_flashdata('message', 'Barang Pengajuan Berhasil Dihapus');
        return redirect('admin/PengajuanATK');
    }

    public function PengambilanATK()
    {
        $data['title'] = 'Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/data_pengambilan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function input_pengambilanATK($id_unit)
    {
        $data['title'] = 'Input Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataATK'] = $this->inv->DataPengajuanATKUnit($id_unit);
        $data['DataPengambilanATK'] = $this->inv->getPengambilanUnit($id_unit);
        $data['getUnit'] = $this->inv->getId_data($id_unit, 'inventory_unit', 'id_unit');
        $data['satuan_barang'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'tube', 'unit'];

        $this->form_validation->set_rules('pilih_atk_pengambilan', 'Barang ATK', 'required|trim');
        $this->form_validation->set_rules('jumlah_atk_pengambilan', 'Jumlah Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_barang_pengambilan', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal_pengambilan_atk', 'Tanggal Pengajuan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/input_pengambilan_atk', $data);
            $this->load->view('template3/layout_footer', $data);
        } else {
            $data = [
                'unit_pengambilan_id' => htmlspecialchars($this->input->post('id_unit_pengambilan')),
                'atk_pengambilan_id' => htmlspecialchars($this->input->post('pilih_atk_pengambilan')),
                'jumlah_pengambilan_atk' => htmlspecialchars($this->input->post('jumlah_atk_pengambilan')),
                'tanggal_pengambilan' => htmlspecialchars($this->input->post('tanggal_pengambilan_atk')),
                'satuan_atk_pengambilan' => htmlspecialchars($this->input->post('satuan_barang_pengambilan')),
                'harga_pengambilan_atk' => htmlspecialchars($this->input->post('harga_satuan_atk_pengambilan1')),
                'total_pengambilan_atk' => htmlspecialchars($this->input->post('total_harga_pengambilan2')),
                'tahun_pengambilan' => htmlspecialchars($this->input->post('tahun_periode')),
                'status_pengambilan_atk' => 'pengisian',
            ];
            $this->inv->insert_data($data, 'inventory_pengambilan_atk');

            $statusPengambilan = [
                'status_pengambilan' => 'pengisian',
            ];
            $this->inv->update_data('id_unit', $this->input->post('id_unit_pengambilan'), 'inventory_unit', $statusPengambilan);

            $this->session->set_flashdata('message', 'Pengambilan Barang Berhasil Ditambahkan.');
            return redirect('admin/input_pengambilanATK/' . $id_unit);
        }
    }

    public function hitungATKdiAmbil()
    {
        $idBarang = $this->input->post('id_barang');
        $jumlah = $this->inv->HitungTotalID_ByKriteria($idBarang, 'jumlah_pengambilan_atk', 'atk_pengambilan_id', 'inventory_pengambilan_atk', 'approval', 'status_pengambilan_atk');
        echo json_encode(array('jumlah' => $jumlah));
    }

    public function edit_pengambilanATK($id_pengambilan)
    {
        $data['title'] = 'Edit Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['getPengambilanATK'] = $this->inv->getPengambilanID($id_pengambilan);
        $data['DataATK'] = $this->inv->show_data('inventory_barang_atk');
        $data['getBarangPengajuan'] = $this->inv->getBarangPengajuanByUnit($data['getPengambilanATK']['unit_pengambilan_id'], $data['getPengambilanATK']['atk_pengambilan_id']);
        $data['satuan_barang'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'tube', 'unit'];
        $id_unit = $data['getPengambilanATK']['unit_pengambilan_id'];

        $this->form_validation->set_rules('jumlah_atk_pengambilan2', 'Jumlah Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal_pengambilan_atk', 'Tanggal Pengajuan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('admin/edit_pengambilan_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'jumlah_pengambilan_atk' => htmlspecialchars($this->input->post('jumlah_atk_pengambilan2')),
                'tanggal_pengambilan' => htmlspecialchars($this->input->post('tanggal_pengambilan_atk')),
                'total_pengambilan_atk' => htmlspecialchars($this->input->post('total_harga_pengambilan3')),
            ];
            $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $data);

            $this->session->set_flashdata('message', 'Pengambilan Barang Berhasil Diubah.');
            return redirect('admin/input_pengambilanATK/' . $id_unit);
        }
    }

    public function hapus_pengambilanATK($id_pengambilan)
    {
        $id_unit = $this->input->post('id_unit_pengambilan');
        $this->inv->delete_data('inventory_pengambilan_atk', 'id_pengambilan', $id_pengambilan);
        $this->session->set_flashdata('message', 'Barang Berhasil Dihapus');
        return redirect('admin/input_pengambilanATK/' . $id_unit);
    }

    public function pengajuan_pengambilanATK($id_pengambilan)
    {
        $id_unit = $this->input->post('id_unit_pengambilan');
        $dataPengajuan = [
            'status_pengambilan_atk' => 'pengajuan',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Proses Mengajukan Pengambilan Barang Berhasil.');
        return redirect('admin/input_pengambilanATK/' . $id_unit);
    }

    public function DataValidasiPengajuanATK()
    {
        $data['title'] = 'Data Validasi Pengajuan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/validasi_pengajuan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function detail_pengajuanATKUnit($id_unit)
    {
        $data['title'] = 'Data Validasi Pengajuan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataPengajuanUnit'] = $this->inv->getDetailPengajuanUnitAll($id_unit);
        $data['getUnit'] = $this->inv->getId_data($id_unit, 'inventory_unit', 'id_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/detail_pengajuan_unit', $data);
        $this->load->view('template3/layout_footer');
    }

    public function cetakExcelPengajuanATKUnit($id_unit)
    {
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $pengguna = $this->inv->show_data('inventory_pengguna');

        $titleLaporan = 'Pengajuan ATK';
        $getUnit = $this->inv->getDataUnitCetakLaporan($id_unit);
        $DataPengajuanUnit = $this->inv->getDetailPengajuanUnitAll($id_unit);
        $tahun_ini = date('Y');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $pathLogo = base_url('assets/admin2/images/aset_atk.png');
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setImageResource(imagecreatefrompng($pathLogo));
        $drawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_PNG);
        $drawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_PNG);
        $drawing->setWidth(105);
        $drawing->setHeight(105);
        $drawing->setCoordinates('B1');
        $drawing->setWorksheet($sheet);


        $sheet->mergeCells('C1:F1');
        $sheet->setCellValue('C1', $titleLaporan);
        $sheet->getStyle('C1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('C2:F2');
        $sheet->setCellValue('C2', $getUnit['nama_unit']);
        $sheet->getStyle('C2')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('C3:F3');
        $sheet->setCellValue('C3', 'Tahun ' . $tahun_ini);
        $sheet->getStyle('C3')->getFont()->setBold(true)->setSize(13);

        $headerData = array(
            'A5' => array('No', 7),
            'B5' => array('Tanggal Pengajuan', 17),
            'C5' => array('Nama Barang ATK', 25),
            'D5' => array('Jumlah Pengajuan ATK', 20),
            'E5' => array('Harga Satuan', 20),
            'F5' => array('Total', 20)
        );

        foreach ($headerData as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('60e690');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }


        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000']
                ]
            ],
        ];

        $sheet->getStyle('A5:F5')->applyFromArray($borderStyle);

        $row = 6;
        $a = 1;
        $formatRupiah = '#,##0';
        foreach ($DataPengajuanUnit as $item) {
            $sheet->setCellValue('A' . $row, $a++);
            $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('B' . $row, $item['tanggal_pengajuan']);
            $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C' . $row, $item['nama_barang']);
            $sheet->setCellValue('D' . $row, $item['jumlah_pengajuan_atk'] . '' . $item['satuan_atk_pengajuan']);
            $sheet->setCellValue('E' . $row, $item['harga_pengajuan_atk']);
            $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode($formatRupiah);
            $sheet->setCellValue('F' . $row, $item['total_pengajuan_atk']);
            $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode($formatRupiah);

            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray($borderStyle);

            $row++;
        }

        $sheet->getStyle('A' . $row . ':F' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A' . $row . ':F' . $row)->getFill()->getStartColor()->setARGB('FFCCCCCC');
        $sheet->mergeCells('A' . ($row + 1) . ':E' . ($row + 1));
        $sheet->setCellValue('A' . ($row + 1), 'Total Pengajuan');
        $sheet->getStyle('A' . ($row + 1))->getFont()->setBold(true);
        $sheet->setCellValue('F' . ($row + 1), '=SUM(F6:F' . $row . ')');
        $sheet->getStyle('F' . ($row + 1))->getNumberFormat()->setFormatCode($formatRupiah);
        $sheet->getStyle('F' . ($row + 1))->getFont()->setBold(true);
        $sheet->getStyle('A' . ($row + 1) . ':F' . ($row + 1))->applyFromArray($borderStyle);

        $sheet->mergeCells('E' . ($row + 4) . ':F' . ($row + 4));
        $sheet->setCellValue('E' . ($row + 4), 'Mengetahui');

        $sheet->mergeCells('E' . ($row + 5) . ':F' . ($row + 5));
        $sheet->setCellValue('E' . ($row + 5), 'Kepala Unit');

        $sheet->mergeCells('E' . ($row + 10) . ':F' . ($row + 10));
        $sheet->getStyle('E' . ($row + 10))->getFont()->setBold(true);
        $sheet->setCellValue('E' . ($row + 10), $getUnit['nama']);

        $sheet->getProtection()->setSheet(true);
        $sheet->getProtection()->setPassword('hanyaAdminSaja');

        $writer = new Xlsx($spreadsheet);
        $filename = $titleLaporan  . ' - ' . $getUnit['nama_unit'] . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function prosesPengajuan($id_unit)
    {
        $dataUnit = [
            'status_pengajuan' => 'pengajuan',
        ];
        $this->inv->update_data('id_unit', $id_unit, 'inventory_unit', $dataUnit);

        $dataPengajuan = [
            'status_pengajuan_atk' => 'pengajuan',
        ];
        $this->inv->update_data('unit_pengajuan_id', $id_unit, 'inventory_pengajuan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Proses Pengajuan Barang Berhasil Diubah.');
        return redirect('admin/DataValidasiPengajuanATK');
    }

    public function prosesValidasi($id_unit)
    {
        $valueValidasi = $this->input->post('proses_validasi');
        $dataUnit = [
            'status_pengajuan' => $valueValidasi,
        ];
        $this->inv->update_data('id_unit', $id_unit, 'inventory_unit', $dataUnit);

        $dataPengajuan = [
            'status_pengajuan_atk' => $valueValidasi,
        ];
        $this->inv->update_data('unit_pengajuan_id', $id_unit, 'inventory_pengajuan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Proses Pengajuan Barang Berhasil Diubah.');
        return redirect('admin/DataValidasiPengajuanATK');
    }

    public function DataValidasiPengambilanATK()
    {
        $data['title'] = 'Data Validasi Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataPengambilanATK'] = $this->inv->JoinPengambilanUnit();
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/validasi_pengambilan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_pengambilanATK()
    {
        $IDunit = $this->input->post('selectedValue');
        $data['DataPengambilanATK'] = $this->inv->getPengambilanUnit($IDunit);
        $this->load->view('admin/data_pengambilan_filter', $data);
    }

    public function approve_pengambilanATK($id_pengambilan)
    {
        $dataPengajuan = [
            'status_pengambilan_atk' => 'approval',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Approval Pengambilan Barang Berhasil.');
        return redirect('admin/DataValidasiPengambilanATK');
    }

    public function revisi_pengambilanATK($id_pengambilan)
    {
        $dataPengajuan = [
            'status_pengambilan_atk' => 'revisi',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Revisi Pengambilan Barang Berhasil.');
        return redirect('admin/DataValidasiPengambilanATK');
    }

    public function rekap_aset()
    {
        $data['title'] = 'Rekapitulasi Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['units'] = $this->inv->DataUnitJoin();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/rekap_aset', $data);
        $this->load->view('template3/layout_footer');
    }

    public function aset_rekapByUnit()
    {
        $getIDunit = $this->input->post('getIDunit');
        $data['get_unit'] = $this->inv->satu_dataUnit($getIDunit);
        $data['aset_unit'] = $this->inv->get_unit_aset($getIDunit);

        $this->load->view('admin/rekap_asetByUnit', $data);
    }

    public function laporanAset_PerUnit($id_unit)
    {
        $titleLaporan = 'Laporan Aset Per Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['get_unit'] = $this->inv->satu_dataUnit($id_unit);
        $dataAset_unit = $this->inv->get_unit_aset($id_unit);
        $tahun_ini = date('Y');


        // eksport Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', $titleLaporan);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A2:J2');
        $sheet->setCellValue('A2', 'Unit ' . $data['get_unit']['nama_unit']);
        $sheet->mergeCells('A3:J3');
        $sheet->setCellValue('A3', 'Tahun ' . $tahun_ini);

        // Set fill color

        $headerData = array(
            'A5' => array('No', 7),
            'B5' => array('Nama Aset', 30),
            'C5' => array('Lokasi', 50),
            'D5' => array('Jumlah', 8),
            'E5' => array('Tahun Perolehan', 10),
            'F5' => array('Harga Perolehan', 20),
            'G5' => array('Total Harga', 20),
            'H5' => array('Penyusutan Per Barang', 20),
            'I5' => array('Harga Tahun Berjalan', 20),
            'J5' => array('Total Harga Aset', 20)
        );
        // $wrapText = true;

        foreach ($headerData as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('60e690');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }

        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000']
                ]
            ],
        ];

        $sheet->getStyle('A5:J5')->applyFromArray($borderStyle);

        $row = 6;
        $a = 1;
        $formatRupiah = '#,##0';
        foreach ($dataAset_unit as $item) {
            $sheet->setCellValue('A' . $row, $a++);
            $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('B' . $row, $item['nama_sarana']);
            $sheet->setCellValue('C' . $row, $item['nama_sub_unit'] . ' | ' . $item['nama_ruang']);
            $sheet->setCellValue('D' . $row, $item['jumlah_aset']);
            $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('E' . $row, $item['tahun_pengadaan']);
            $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('F' . $row, $item['harga_perolehan']);
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode($formatRupiah);

            $sheet->setCellValue('G' . $row, $item['total_perolehan']);
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode($formatRupiah);

            $sheet->setCellValue('H' . $row, '=F' . $row . '/' . $item['umur_aset']);
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode($formatRupiah);

            $sheet->setCellValue('I' . $row, '=F' . $row . '-((' . $tahun_ini . '-' . $item['tahun_pengadaan'] . ')' . '*H' . $row . ')');
            $sheet->getStyle('I' . $row)->getNumberFormat()->setFormatCode($formatRupiah);

            $sheet->setCellValue('J' . $row, '=I' . $row . '*' . $item['jumlah_aset']);
            $sheet->getStyle('J' . $row)->getNumberFormat()->setFormatCode($formatRupiah);

            $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray($borderStyle);

            $row++;
        }

        $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->getStartColor()->setARGB('FFCCCCCC');
        $sheet->mergeCells('A' . ($row + 1) . ':I' . ($row + 1));
        $sheet->setCellValue('A' . ($row + 1), 'Total Nominal Aset Tahun Berjalan');
        $sheet->getStyle('A' . ($row + 1))->getFont()->setBold(true);
        $sheet->setCellValue('J' . ($row + 1), '=SUM(J6:J' . $row . ')');
        $sheet->getStyle('J' . ($row + 1))->getNumberFormat()->setFormatCode($formatRupiah);
        $sheet->getStyle('J' . ($row + 1))->getFont()->setBold(true);
        $sheet->getStyle('A' . ($row + 1) . ':J' . ($row + 1))->applyFromArray($borderStyle);

        $writer = new Xlsx($spreadsheet);
        $filename = $titleLaporan  . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function rekap_kondisi()
    {
        $data['title'] = 'Rekapitulasi Kondisi Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/rekap_kondisi', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_kondisi_aset()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['get_subUnit'] = $this->inv->satu_sub_unit($id_subUnit);
        $data['dataKondisiAset'] = $this->inv->asetSubUnit_kondisi($id_subUnit);
        $this->load->view('admin/data_kondisiAset_bySubUnit', $data);
    }

    public function laporanRekapKondisi($id_subUnit)
    {

        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $titleLaporan = 'Laporan Data Pengecekan Aset';
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['get_subUnit'] = $this->inv->satu_sub_unit($id_subUnit);
        $kondisi_per_aset = $this->inv->asetSubUnit_kondisi($id_subUnit);
        $tahun_ini = date('Y');


        // Export Excel

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', $titleLaporan);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->mergeCells('A2:J2');
        $sheet->setCellValue('A2', 'Sub Unit ' . $data['get_subUnit']['nama_sub_unit']);
        $sheet->mergeCells('A3:J3');
        $sheet->setCellValue('A3', 'Tahun ' . $tahun_ini);

        // Set fill color

        $headerData = array(
            'A5' => array('No', 7),
            'B5' => array('Nama Aset', 30),
            'C5' => array('Lokasi Aset', 30),
            'D5' => array('Kondisi Aset', 18),
            'E5' => array('Tindakan', 70),
            'F5' => array('Tanggal Pengecekan', 15),
            'G5' => array('PIC Aset', 40)
        );
        // $wrapText = true;

        foreach ($headerData as $cell => $data) {
            $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('60e690');
            $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
        }

        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
                'inside' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000']
                ]
            ],
        ];

        $sheet->getStyle('A5:G5')->applyFromArray($borderStyle);

        $row = 6;
        $a = 1;
        foreach ($kondisi_per_aset as $item) {

            $sheet->setCellValue('A' . $row, $a++);
            $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            $sheet->setCellValue('B' . $row, $item['nama_sarana']);
            $sheet->getStyle('B')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            $sheet->setCellValue('C' . $row, $item['nama_sub_unit'] . ' | ' . $item['nama_unit']);
            $sheet->getStyle('C')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            if (empty($item['kondisi_aset'])) {
                $sheet->setCellValue('D' . $row, 'Belum Dilakukan Pengecekan');
                $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getStyle('D')->getAlignment()->setWrapText(true);
            } else {
                $sheet->setCellValue('D' . $row, $item['kondisi_aset']);
                $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getStyle('D')->getAlignment()->setWrapText(true);
            }

            if (empty($item['ket_kondisi_aset'])) {
                $sheet->setCellValue('E' . $row, 'Belum Dilakukan Pengecekan');
                $sheet->getStyle('E')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            } else {
                $sheet->setCellValue('E' . $row, $item['ket_kondisi_aset']);
                $sheet->getStyle('E')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }

            if (empty($item['tanggal_cek'])) {
                $sheet->setCellValue('F' . $row, 'Belum Dilakukan Pengecekan');
                $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getStyle('F')->getAlignment()->setWrapText(true);
            } else {
                $sheet->setCellValue('F' . $row, $item['tanggal_cek']);
                $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getStyle('F')->getAlignment()->setWrapText(true);
            }

            $sheet->setCellValue('G' . $row, $item['nama'] . ' - ' . $item['jabatan_pengguna']);
            $sheet->getStyle('G')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray($borderStyle);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = $titleLaporan  . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function AsetNonAktif()
    {
        $data['title'] = 'Rekapitulasi Aset Non Aktif';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['sub_unit'] = $this->inv->get_sub_unit();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/aset_nonAktif', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_AsetNonAktif()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['get_subUnit'] = $this->inv->satu_sub_unit($id_subUnit);
        $data['dataAsetNonAktif'] = $this->inv->AsetNonAktif($id_subUnit);
        $this->load->view('admin/data_asetNonAktif', $data);
    }

    public function penyerapan_atk()
    {
        $data['title'] = 'Rekapitulasi Penyerapan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('admin/rekap_penyerapan', $data);
        $this->load->view('template3/layout_footer');
    }
}
