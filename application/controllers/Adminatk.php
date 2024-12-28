<?php
require FCPATH . 'vendor/autoload.php';

defined('BASEPATH') or exit('No direct script access allowed');

// Render to Excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
// Render to PDF
use Mpdf\Mpdf;

class AdminAtk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model', 'inv');
        is_login('3');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['peran'] = $this->inv->JoinPeranPengguna($this->session->userdata('username'));
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['jumlah_unit'] = $this->inv->count_rows('inventory_unit');
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
        $this->load->view('adminatk/index', $data);
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
            $this->load->view('adminatk/profil_pengguna', $data);
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
            return redirect('adminatk/profil_pengguna');
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
            $this->load->view('adminatk/profil_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $pass_sekarang = $this->input->post('pass_sekarang');
            $new_password = $this->input->post('pass_new1');
            if (!password_verify($pass_sekarang, $data['peran']['password'])) {
                $this->session->set_flashdata('message_password', 'Password Aktif Anda Salah!');
                redirect('adminatk/ubah_password');
            } else {
                if ($pass_sekarang == $new_password) {
                    $this->session->set_flashdata('message_password', 'Password Baru tidak Boleh sama dengan Password Aktif!');
                    redirect('adminatk/ubah_password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->set('pass_tampil', $new_password);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('inventory_pengguna');

                    $this->session->set_flashdata('message_password_ok', 'Password Berhasil Diubah!');
                    redirect('adminatk/ubah_password');
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

    public function unit()
    {
        $data['title'] = 'Unit Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['pengguna'] = $this->inv->show_data('inventory_pengguna');
        $data['unit'] = $this->inv->DataUnitJoin();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminatk/unit', $data);
        $this->load->view('template3/layout_footer');
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
            $this->load->view('adminatk/barang_atk', $data);
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
            return redirect('adminatk/atk');
        }
    }

    // public function UploadBarangATK()
    // {
    //     $config['upload_path'] = './assets/file_upload/';
    //     $config['allowed_types'] = 'xlsx|xls';
    //     $config['max_size'] = 2048;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('import_data_aset')) {
    //         $error = $this->upload->display_errors();
    //         $this->session->set_flashdata('error', $error);
    //         redirect('adminatk/atk');
    //     } else {
    //         $file = $this->upload->data();
    //         $file_path = './assets/file_upload/' . $file['file_name'];

    //         $spreadsheet = IOFactory::load($file_path);
    //         $worksheet = $spreadsheet->getActiveSheet();

    //         $row = 4;
    //         $importDataATK = array();
    //         while ($worksheet->getCell('A' . $row)->getValue() !== null) {
    //             $kodeKelompok = $worksheet->getCell('B' . $row)->getValue();
    //             $standartHarga = $worksheet->getCell('C' . $row)->getValue();
    //             $kodebarangpemerintah = $worksheet->getCell('D' . $row)->getValue();
    //             $koderekening = $worksheet->getCell('E' . $row)->getValue();
    //             $kodebarang = $worksheet->getCell('F' . $row)->getValue();
    //             $namabarang = $worksheet->getCell('G' . $row)->getValue();
    //             $satuanbarang = $worksheet->getCell('H' . $row)->getValue();
    //             $satuanharga = $worksheet->getCell('I' . $row)->getValue();

    //             $importDataATK[] = array(
    //                 'kode_kelompok_barang' => $kodeKelompok,
    //                 'id_standart_harga' => $standartHarga,
    //                 'kode_barang_dari_pemerintah' => $kodebarangpemerintah,
    //                 'kode_rekening' => $koderekening,
    //                 'kode_barang' => $kodebarang,
    //                 'nama_barang' => $namabarang,
    //                 'satuan_barang' => $satuanbarang,
    //                 'satuan_harga' => $satuanharga,
    //                 'ket_barang' => 'pemerintah'
    //             );

    //             $row++;
    //         }

    //         foreach ($importDataATK as $data) {
    //             $this->inv->insert_data($data, 'inventory_barang_atk');
    //         }

    //         if (file_exists($file_path)) {
    //             unlink($file_path);
    //         }

    //         $this->session->set_flashdata('message', 'ATK Baru Berhasil Diupload');
    //         return redirect('adminatk/atk');
    //     }
    // }

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
            $this->load->view('adminatk/barang_atk', $data);
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
            return redirect('adminatk/atk');
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
        return redirect('adminatk/atk');
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
            $this->load->view('adminatk/stok_atk', $data);
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
            return redirect('adminatk/stokATK');
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
        $this->load->view('adminatk/riwayat_pembelian_atk', $data);
        $this->load->view('template3/layout_footer');
    }

    public function hapuspembelianATK($id_history_beli)
    {
        $this->inv->delete_data('inventory_pembelian_atk', 'id_history_beli', $id_history_beli);
        $this->session->set_flashdata('message', 'Pembelian ATK Telah Dihapus');
        return redirect('adminatk/pembelianATK');
    }

    public function PengajuanATK()
    {
        $data['title'] = 'Data Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataPengajuanATK'] = $this->inv->JoinPengajuanATK();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminatk/data_pengajuan', $data);
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
            $this->load->view('adminatk/input_pengajuan_atk', $data);
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
            return redirect('adminatk/PengajuanATK');
        }
    }

    public function edit_pengajuanATK($id_pengajuan)
    {
        $data['title'] = 'Edit Pengajuan Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GetPengajuan'] = $this->inv->getPengajuanID($id_pengajuan);
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
            $this->load->view('adminatk/edit_pengajuan_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $idPengajuan = $this->input->post('id_pengajuan');
            $data = [
                'unit_pengajuan_id' => htmlspecialchars($this->input->post('pilih_unit_atk')),
                'atk_pengajuan_id' => htmlspecialchars($this->input->post('pilih_atk')),
                'jumlah_pengajuan_atk' => htmlspecialchars($this->input->post('jumlah_atk')),
                'tanggal_pengajuan' => htmlspecialchars($this->input->post('tanggal_pengajuan_atk')),
                'satuan_atk_pengajuan' => htmlspecialchars($this->input->post('satuan_barang')),
                'harga_pengajuan_atk' => htmlspecialchars($this->input->post('harga_satuan_atk_pengajuan')),
                'total_pengajuan_atk' => htmlspecialchars($this->input->post('total_harga_pengajuan')),
                'tahun_pengajuan' => htmlspecialchars($this->input->post('tahun_periode')),
            ];
            $this->inv->update_data('id_pengajuan', $idPengajuan, 'inventory_pengajuan_atk', $data);
            $this->session->set_flashdata('message', 'Pengajuan Barang Berhasil Diubah.');
            return redirect('adminatk/PengajuanATK');
        }
    }

    public function hapus_pengajuanATK($id_pengajuan)
    {
        $this->inv->delete_data('inventory_pengajuan_atk', 'id_pengajuan', $id_pengajuan);
        $this->session->set_flashdata('message', 'Barang Pengajuan Berhasil Dihapus');
        return redirect('adminatk/PengajuanATK');
    }

    public function PengambilanATK()
    {
        $data['title'] = 'Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminatk/data_pengambilan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function input_pengambilanATK($id_unit)
    {
        $data['title'] = 'Input Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataATK'] = $this->inv->getDetailPengajuanUnitAll($id_unit);
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
            $this->load->view('adminatk/input_pengambilan_atk', $data);
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
            return redirect('adminatk/input_pengambilanATK/' . $id_unit);
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
            $this->load->view('adminatk/edit_pengambilan_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'jumlah_pengambilan_atk' => htmlspecialchars($this->input->post('jumlah_atk_pengambilan2')),
                'tanggal_pengambilan' => htmlspecialchars($this->input->post('tanggal_pengambilan_atk')),
                'total_pengambilan_atk' => htmlspecialchars($this->input->post('total_harga_pengambilan3')),
            ];
            $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $data);

            $this->session->set_flashdata('message', 'Pengambilan Barang Berhasil Diubah.');
            return redirect('adminatk/input_pengambilanATK/' . $id_unit);
        }
    }

    public function hapus_pengambilanATK($id_pengambilan)
    {
        $id_unit = $this->input->post('id_unit_pengambilan');
        $this->inv->delete_data('inventory_pengambilan_atk', 'id_pengambilan', $id_pengambilan);
        $this->session->set_flashdata('message', 'Barang Berhasil Dihapus');
        return redirect('adminatk/input_pengambilanATK/' . $id_unit);
    }

    public function pengajuan_pengambilanATK($id_pengambilan)
    {
        $id_unit = $this->input->post('id_unit_pengambilan');
        $dataPengajuan = [
            'status_pengambilan_atk' => 'pengajuan',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Proses Mengajukan Pengambilan Barang Berhasil.');
        return redirect('adminatk/input_pengambilanATK/' . $id_unit);
    }

    public function DataValidasiPengajuanATK()
    {
        $data['title'] = 'Data Validasi Pengajuan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminatk/validasi_pengajuan', $data);
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
        $this->load->view('adminatk/detail_pengajuan_unit', $data);
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
        return redirect('adminatk/DataValidasiPengajuanATK');
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
        return redirect('adminatk/DataValidasiPengajuanATK');
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
        $this->load->view('adminatk/validasi_pengambilan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function load_pengambilanATK()
    {
        $IDunit = $this->input->post('selectedValue');
        $data['DataPengambilanATK'] = $this->inv->getPengambilanUnit($IDunit);
        $this->load->view('adminatk/data_pengambilan_filter', $data);
    }

    public function approve_pengambilanATK($id_pengambilan)
    {
        $dataPengajuan = [
            'status_pengambilan_atk' => 'approval',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Approval Pengambilan Barang Berhasil.');
        return redirect('adminatk/DataValidasiPengambilanATK');
    }

    public function revisi_pengambilanATK($id_pengambilan)
    {
        $dataPengajuan = [
            'status_pengambilan_atk' => 'revisi',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Revisi Pengambilan Barang Berhasil.');
        return redirect('adminatk/DataValidasiPengambilanATK');
    }

    public function penyerapan_atk()
    {
        $data['title'] = 'Rekapitulasi Penyerapan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['DataUnit'] = $this->inv->show_data('inventory_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('adminatk/rekap_penyerapan', $data);
        $this->load->view('template3/layout_footer');
    }
}
