<?php
require FCPATH . 'vendor/autoload.php';


defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model', 'inv');
        is_login('4');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['peran'] = $this->inv->JoinPeranPengguna($this->session->userdata('username'));
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['jumlah_gedung'] = $this->inv->count_rows('inventory_gedung');

        if ($data['GETunit'] != null) {
            $data['jumlah_aset'] = $this->inv->count_dataByID('inventory_input_aset', 'aset_unit_id', $data['GETunit']['id_unit']);
            $data['jumlah_pengajuanATK'] = $this->inv->count_dataByID('inventory_pengajuan_atk', 'unit_pengajuan_id', $data['GETunit']['id_unit']);

            $jumlahPengajuanUnit = HitungTotalNilai($data['GETunit']['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
            $jumlahPengambilanUnit = HitungTotalNilai($data['GETunit']['id_unit'], 'total_pengambilan_atk', 'unit_pengambilan_id', 'inventory_pengambilan_atk');

            if ($jumlahPengambilanUnit > 0) {
                $data['persentase_perUnit'] = ($jumlahPengambilanUnit / $jumlahPengajuanUnit) * 100;
            } else {
                $data['persentase_perUnit'] = 0;
            }
        } else {
            $data['jumlah_aset'] = 0;
            $data['jumlah_pengajuanATK'] = 0;
        }

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('unit/index', $data);
        $this->load->view('template3/layout_footer');
    }

    public function profil_pengguna()
    {
        $data['title'] = 'Profil Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');

        $this->form_validation->set_rules('nama_profil', 'Nama Pengguna', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('unit/profil_pengguna', $data);
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
            return redirect('unit/profil_pengguna');
        }
    }

    public function ubah_password()
    {
        $data['title'] = 'Profil Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');

        $this->form_validation->set_rules('pass_sekarang', 'Password Aktif', 'required|trim');
        $this->form_validation->set_rules('pass_new1', 'Password Baru', 'required|trim|min_length[5]|matches[pass_new2]');
        $this->form_validation->set_rules('pass_new2', 'Konfirmasi Password Baru', 'required|trim|min_length[5]|matches[pass_new1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('unit/profil_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $pass_sekarang = $this->input->post('pass_sekarang');
            $new_password = $this->input->post('pass_new1');
            if (!password_verify($pass_sekarang, $data['peran']['password'])) {
                $this->session->set_flashdata('message_password', 'Password Aktif Anda Salah!');
                redirect('unit/ubah_password');
            } else {
                if ($pass_sekarang == $new_password) {
                    $this->session->set_flashdata('message_password', 'Password Baru tidak Boleh sama dengan Password Aktif!');
                    redirect('unit/ubah_password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->set('pass_tampil', $new_password);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('inventory_pengguna');

                    $this->session->set_flashdata('message_password_ok', 'Password Berhasil Diubah!');
                    redirect('unit/ubah_password');
                }
            }
        }
    }

    public function rekap_aset()
    {
        $data['title'] = 'Rekapitulasi Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['aset_unit'] = $this->inv->get_unit_aset($data['GETunit']['id_unit']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('unit/rekap_aset', $data);
        $this->load->view('template3/layout_footer');
    }

    public function rekap_kondisi()
    {
        $data['title'] = 'Rekapitulasi Kondisi Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['dataKondisiAset'] = $this->inv->asetUnit_kondisi($data['GETunit']['id_unit']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('unit/rekap_kondisi', $data);
        $this->load->view('template3/layout_footer');
    }

    public function AsetNonAktif()
    {
        $data['title'] = 'Rekapitulasi Kondisi Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['dataAsetNonAktif'] = $this->inv->AsetNonAktifUnit($data['GETunit']['id_unit']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('unit/aset_nonAktif', $data);
        $this->load->view('template3/layout_footer');
    }

    public function PengajuanATK()
    {
        $data['title'] = 'Pengajuan Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['getUnit'] = $this->inv->getId_data($data['GETunit']['id_unit'], 'inventory_unit', 'id_unit');
        $data['DataPengajuanUnit'] = $this->inv->getDetailPengajuanUnitAll($data['GETunit']['id_unit']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('unit/detail_pengajuan_unit', $data);
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

    public function PengambilanATK()
    {
        $data['title'] = 'Pengambilan Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETunit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_unit', 'kepala_unit_id');
        $data['getUnit'] = $this->inv->getId_data($data['GETunit']['id_unit'], 'inventory_unit', 'id_unit');
        $data['DataATK'] = $this->inv->getDetailPengajuanUnitAll($data['GETunit']['id_unit']);
        $data['DataPengambilanATK'] = $this->inv->getPengambilanUnit($data['GETunit']['id_unit']);

        $seluruhtotalpengajuanUnit = 0;
        $data['JumlahPengajuanATKUnit'] = HitungTotalNilai($data['GETunit']['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
        $seluruhtotalpengajuanUnit += $data['JumlahPengajuanATKUnit'];

        $jumlahPengajuanUnit = HitungTotalNilai($data['GETunit']['id_unit'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
        $jumlahPengambilanUnit = HitungTotalNilai($data['GETunit']['id_unit'], 'total_pengambilan_atk', 'unit_pengambilan_id', 'inventory_pengambilan_atk');

        if ($jumlahPengambilanUnit > 0) {
            $data['persentase_perUnit'] = ($jumlahPengambilanUnit / $jumlahPengajuanUnit) * 100;
        } else {
            $data['persentase_perUnit'] = 0;
        }

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('unit/detail_pengambilan_unit', $data);
        $this->load->view('template3/layout_footer', $data);
    }
}
