<?php
require FCPATH . 'vendor/autoload.php';

defined('BASEPATH') or exit('No direct script access allowed');

// Render to Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
// Render to PDF
use Mpdf\Mpdf;

class AdminAset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model', 'inv');
        is_login('2');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['peran'] = $this->inv->JoinPeranPengguna($this->session->userdata('username'));
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['jumlah_gedung'] = $this->inv->count_rows('inventory_gedung');
        $data['jumlah_ruang'] = $this->inv->count_rows('inventory_ruang');
        $data['jumlah_aset'] = $this->inv->count_rows('inventory_input_aset');
        $data['jumlah_asetRusak'] = $this->inv->HitungAsetRusak();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminaset/index', $data);
        $this->load->view('template3/layout_footer');
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
            $this->load->view('adminaset/profil_pengguna', $data);
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
            return redirect('adminaset/profil_pengguna');
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
            $this->load->view('adminaset/profil_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $pass_sekarang = $this->input->post('pass_sekarang');
            $new_password = $this->input->post('pass_new1');
            if (!password_verify($pass_sekarang, $data['peran']['password'])) {
                $this->session->set_flashdata('message_password', 'Password Aktif Anda Salah!');
                redirect('adminaset/ubah_password');
            } else {
                if ($pass_sekarang == $new_password) {
                    $this->session->set_flashdata('message_password', 'Password Baru tidak Boleh sama dengan Password Aktif!');
                    redirect('adminaset/ubah_password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->set('pass_tampil', $new_password);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('inventory_pengguna');

                    $this->session->set_flashdata('message_password_ok', 'Password Berhasil Diubah!');
                    redirect('adminaset/ubah_password');
                }
            }
        }
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
            $this->load->view('adminaset/gedung', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_gedung' => htmlspecialchars($this->input->post('nama_gedung')),
            ];
            $this->inv->insert_data($data, 'inventory_gedung');
            $this->session->set_flashdata('message', 'Gedung Baru Telah Ditambahkan');
            return redirect('adminaset/gedung');
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
            $this->load->view('adminaset/gedung', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_gedung' => htmlspecialchars($this->input->post('nama_gedung')),
            ];
            $this->inv->update_data('id_gedung', $this->input->post('id_gedung'), 'inventory_gedung', $data);
            $this->session->set_flashdata('message', 'Gedung Telah Diubah');
            return redirect('adminaset/gedung');
        }
    }

    public function hapus_gedung($id_gedung)
    {
        $this->inv->delete_data('inventory_gedung', 'id_gedung', $id_gedung);
        $this->session->set_flashdata('message', 'Gedung Telah Dihapus');
        return redirect('adminaset/gedung');
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
            $this->load->view('adminaset/ruang', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_ruang' => htmlspecialchars($this->input->post('nama_ruang')),
                'gedung_id' => htmlspecialchars($this->input->post('gedung_id')),
            ];
            $this->inv->insert_data($data, 'inventory_ruang');
            $this->session->set_flashdata('message', 'Ruang Baru Telah Ditambahkan');
            return redirect('adminaset/ruang');
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
            $this->load->view('adminaset/ruang', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_ruang' => htmlspecialchars($this->input->post('nama_ruang')),
                'gedung_id' => htmlspecialchars($this->input->post('gedung_id1')),
            ];
            $this->inv->update_data('id_ruang', $this->input->post('id_ruang'), 'inventory_ruang', $data);
            $this->session->set_flashdata('message', 'Ruang Telah Diubah');
            return redirect('adminaset/ruang');
        }
    }

    public function hapus_ruang($id_ruang)
    {
        $this->inv->delete_data('inventory_ruang', 'id_ruang', $id_ruang);
        $this->session->set_flashdata('message', 'Ruang Telah Dihapus');
        return redirect('adminaset/ruang');
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
            $this->load->view('adminaset/unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'kepala_unit_id' => htmlspecialchars($this->input->post('kepala_unit')),
                'sarpras_unit_id' => htmlspecialchars($this->input->post('sarpras_unit')),
            ];
            $this->inv->insert_data($data, 'inventory_unit');
            $this->session->set_flashdata('message', 'Unit Baru Telah Ditambahkan');
            return redirect('adminaset/unit');
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
            $this->load->view('adminaset/unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_unit' => htmlspecialchars($this->input->post('nama_unit')),
                'kepala_unit_id' => htmlspecialchars($this->input->post('kepala_unit2')),
                'sarpras_unit_id' => htmlspecialchars($this->input->post('sarpras_unit2')),
            ];
            $this->inv->update_data('id_unit', $this->input->post('id_unit'), 'inventory_unit', $data);
            $this->session->set_flashdata('message', 'Unit Telah Diubah');
            return redirect('adminaset/unit');
        }
    }

    public function hapus_unit($id_unit)
    {
        $this->inv->delete_data('inventory_unit', 'id_unit', $id_unit);
        $this->session->set_flashdata('message', 'Unit Telah Dihapus');
        return redirect('adminaset/unit');
    }

    public function sub_unit()
    {
        $data['title'] = 'Sub Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['unit'] = $this->inv->show_data('inventory_unit');
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
            $this->load->view('adminaset/sub_unit', $data);
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
            return redirect('adminaset/sub_unit');
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
            $this->load->view('adminaset/sub_unit', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_sub_unit' => htmlspecialchars($this->input->post('nama_sub_unit')),
                'gedung_sub_unit_id' => htmlspecialchars($this->input->post('ruang_sub_unit1_text')),
                'subunit_pic_id' => htmlspecialchars($this->input->post('pic_subunit1')),
            ];

            $this->inv->update_data('id_sub_unit', $this->input->post('id_sub_unit'), 'inventory_sub_unit', $data);

            $this->session->set_flashdata('message', 'Sub Unit Telah Diubah');
            return redirect('adminaset/sub_unit');
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
        return redirect('adminaset/sub_unit');
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
            $this->load->view('adminaset/kelompok_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_kelompok' => htmlspecialchars($this->input->post('nama_kelompok')),
                'umur_aset' => htmlspecialchars($this->input->post('umur_aset')),
            ];
            $this->inv->insert_data($data, 'inventory_kelompok_aset');
            $this->session->set_flashdata('message', 'Kelompok Aset Baru Telah Ditambahkan');
            return redirect('adminaset/kelompok_aset');
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
            $this->load->view('adminaset/kelompok_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_kelompok' => htmlspecialchars($this->input->post('nama_kelompok')),
                'umur_aset' => htmlspecialchars($this->input->post('umur_aset')),
            ];
            $this->inv->update_data('id_kelompok', $this->input->post('id_kelompok'), 'inventory_kelompok_aset', $data);
            $this->session->set_flashdata('message', 'Kelompok Aset Telah Diubah');
            return redirect('adminaset/kelompok_aset');
        }
    }

    public function hapus_kelompok($id_kelompok)
    {
        $this->inv->delete_data('inventory_kelompok_aset', 'id_kelompok', $id_kelompok);
        $this->session->set_flashdata('message', 'Kelompok Aset Telah Dihapus');
        return redirect('adminaset/kelompok_aset');
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
            $this->load->view('adminaset/jenis_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id')),
                'kode_aset' => htmlspecialchars($this->input->post('kode_aset')),
                'jenis_aset' => htmlspecialchars($this->input->post('jenis_aset')),
            ];
            $this->inv->insert_data($data, 'inventory_jenis_aset');
            $this->session->set_flashdata('message', 'Jenis Aset Baru Telah Ditambahkan');
            return redirect('adminaset/jenis_aset');
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
            $this->load->view('adminaset/jenis_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'kelompok_id' => htmlspecialchars($this->input->post('kelompok_id1')),
                'kode_aset' => htmlspecialchars($this->input->post('kode_aset')),
                'jenis_aset' => htmlspecialchars($this->input->post('jenis_aset')),
            ];
            $this->inv->update_data('id_jenis', $this->input->post('id_jenis'), 'inventory_jenis_aset', $data);
            $this->session->set_flashdata('message', 'Jenis Aset Baru Telah Ditambahkan');
            return redirect('adminaset/jenis_aset');
        }
    }

    public function hapus_jenis_aset($id_jenis)
    {
        $this->inv->delete_data('inventory_jenis_aset', 'id_jenis', $id_jenis);
        $this->session->set_flashdata('message', 'Kelompok Aset Telah Dihapus');
        return redirect('adminaset/jenis_aset');
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
            $this->load->view('adminaset/input_aset', $data);
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
            return redirect('adminaset/input_aset');
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
            redirect('adminaset/input_aset');
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
            return redirect('adminaset/input_aset');
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
        $this->load->view('adminaset/input_aset_tabel', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_all_aset()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['aset_bySubUnit'] = $this->inv->get_aset_sub_unit($id_subUnit);
        $this->load->view('adminaset/data_all_aset', $data);
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
            $this->load->view('adminaset/edit_aset', $data);
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
            return redirect('adminaset/hasil_input_aset');
        }
    }

    public function hapus_aset($id_input_aset)
    {
        $this->inv->delete_data('inventory_kondisi_aset', 'aset_id', $id_input_aset);
        $this->inv->delete_data('inventory_input_aset', 'id_input_aset', $id_input_aset);
        $this->session->set_flashdata('message', 'Aset Telah Dihapus');
        return redirect('adminaset/hasil_input_aset');
    }

    public function nonaktif_aset($id_input_aset)
    {
        $data = [
            'aset_aktif' => 0,
        ];
        $this->inv->update_data('id_input_aset', $id_input_aset, 'inventory_input_aset', $data);
        $this->session->set_flashdata('message', 'Aset Telah Di Non Aktifkan');
        return redirect('adminaset/hasil_input_aset');
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
        $this->load->view('adminaset/kondisi_aset', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_data_aset()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['aset_bySubUnit'] = $this->inv->get_aset_sub_unit($id_subUnit);
        $this->load->view('adminaset/data_aset_bySubUnit', $data);
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
            $this->load->view('adminaset/cek_kondisi_aset', $data);
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
            return redirect('adminaset/cek_kondisi_aset/' . $id_aset);
        }
    }

    public function hapus_kondisi($id_kondisi)
    {
        $aset_id = $this->input->post('aset_id');
        $this->inv->delete_data('inventory_kondisi_aset', 'id_kondisi', $id_kondisi);
        $this->session->set_flashdata('message', 'Catatan Kondisi Berhasil Dihapus');
        return redirect('admin/cek_kondisi_aset/' . $aset_id);
    }

    public function rekap_aset()
    {
        $data['title'] = 'Rekapitulasi Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['units'] = $this->inv->DataUnitJoin();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminaset/rekap_aset', $data);
        $this->load->view('template3/layout_footer');
    }

    public function aset_rekapByUnit()
    {
        $getIDunit = $this->input->post('getIDunit');
        $data['get_unit'] = $this->inv->satu_dataUnit($getIDunit);
        $data['aset_unit'] = $this->inv->get_unit_aset($getIDunit);

        $this->load->view('adminaset/rekap_asetByUnit', $data);
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
        $this->load->view('adminaset/rekap_kondisi', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_kondisi_aset()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['get_subUnit'] = $this->inv->satu_sub_unit($id_subUnit);
        $data['dataKondisiAset'] = $this->inv->asetSubUnit_kondisi($id_subUnit);
        $this->load->view('adminaset/data_kondisiAset_bySubUnit', $data);
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
        $this->load->view('adminaset/aset_nonAktif', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_AsetNonAktif()
    {
        $id_subUnit = $this->input->post('selectedValue');
        $data['get_subUnit'] = $this->inv->satu_sub_unit($id_subUnit);
        $data['dataAsetNonAktif'] = $this->inv->AsetNonAktif($id_subUnit);
        $this->load->view('adminaset/data_asetNonAktif', $data);
    }
}
