<?php
require FCPATH . 'vendor/autoload.php';


defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class Subunit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inventory_model', 'inv');
        is_login('5');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['peran'] = $this->inv->JoinPeranPengguna($this->session->userdata('username'));
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['jumlah_gedung'] = $this->inv->count_rows('inventory_gedung');
        if ($data['GETsub_unit'] != null) {
            $data['jumlah_aset'] = $this->inv->count_dataByID('inventory_input_aset', 'aset_sub_unit_id', $data['GETsub_unit']['id_sub_unit']);
            $data['jumlah_pengajuanATK'] = $this->inv->count_dataByID('inventory_pengajuan_atk', 'unit_pengajuan_id', $data['GETsub_unit']['unit_id']);

            $jumlahPengajuanUnit = HitungTotalNilai($data['GETsub_unit']['unit_id'], 'total_pengajuan_atk', 'unit_pengajuan_id', 'inventory_pengajuan_atk');
            $jumlahPengambilanUnit = HitungTotalNilai($data['GETsub_unit']['unit_id'], 'total_pengambilan_atk', 'unit_pengambilan_id', 'inventory_pengambilan_atk');

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
        $this->load->view('subunit/index', $data);
        $this->load->view('template3/layout_footer');
    }

    public function profil_pengguna()
    {
        $data['title'] = 'Profil Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');

        $this->form_validation->set_rules('nama_profil', 'Nama Pengguna', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/profil_pengguna', $data);
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
            return redirect('subunit/profil_pengguna');
        }
    }

    public function ubah_password()
    {
        $data['title'] = 'Profil Pengguna';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengguna'] = $this->inv->join2_tables('inventory_pengguna', 'inventory_peran_pengguna', 'id_peran', 'peran_id');
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');

        $this->form_validation->set_rules('pass_sekarang', 'Password Aktif', 'required|trim');
        $this->form_validation->set_rules('pass_new1', 'Password Baru', 'required|trim|min_length[5]|matches[pass_new2]');
        $this->form_validation->set_rules('pass_new2', 'Konfirmasi Password Baru', 'required|trim|min_length[5]|matches[pass_new1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/profil_pengguna', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $pass_sekarang = $this->input->post('pass_sekarang');
            $new_password = $this->input->post('pass_new1');
            if (!password_verify($pass_sekarang, $data['peran']['password'])) {
                $this->session->set_flashdata('message_password', 'Password Aktif Anda Salah!');
                redirect('subunit/ubah_password');
            } else {
                if ($pass_sekarang == $new_password) {
                    $this->session->set_flashdata('message_password', 'Password Baru tidak Boleh sama dengan Password Aktif!');
                    redirect('subunit/ubah_password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->set('pass_tampil', $new_password);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('inventory_pengguna');

                    $this->session->set_flashdata('message_password_ok', 'Password Berhasil Diubah!');
                    redirect('subunit/ubah_password');
                }
            }
        }
    }

    public function input_aset()
    {
        $data['title'] = 'Input Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['sub_unit'] = $this->inv->get_subUnit($data['GETsub_unit']['id_sub_unit']);
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
        $this->form_validation->set_rules('tahun_pengadaan', 'Tahun Pengadaan', 'required|trim');
        $this->form_validation->set_rules('ket_aset', 'Keterangan Aset', 'required|trim');
        $this->form_validation->set_rules('satuan_aset', 'Satuan Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/input_aset', $data);
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
                'harga_perolehan' => '0',
                'tahun_pengadaan' => htmlspecialchars($this->input->post('tahun_pengadaan')),
                'pic_id' => htmlspecialchars($this->input->post('value_aset_input4')),
                'total_perolehan' => '0',
                'keterangan_aset' => htmlspecialchars($this->input->post('ket_aset')),
                'aset_aktif' => 1,
                'label_aset' => $kodeAset . '/INV/' . htmlspecialchars($this->input->post('namaUnit')) . '/' . htmlspecialchars($this->input->post('tahun_pengadaan')),
            ];
            $this->inv->insert_data($data, 'inventory_input_aset');

            $this->session->set_flashdata('message', 'Aset Baru Telah Ditambahkan');
            return redirect('subunit/input_aset');
        }
    }

    // Format sesuaikan dengan Subunit yang login, jadi tinggal memilih jenis aset nya.
    // public function DownloadFormatAset()
    // {
    //     $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
    //     $JudulImportData = 'Format Input Data Aset';
    //     $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
    //     // $DataSubUnit = $this->inv->show_data('inventory_sub_unit');
    //     $DataSubUnit = $this->inv->get_sub_unit();
    //     $DataJenisAset = $this->inv->show_data('inventory_jenis_aset');

    //     // eksport Excel
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $sheet->mergeCells('A1:Q1');
    //     $sheet->setCellValue('A1', $JudulImportData);
    //     $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //     $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

    //     // Set fill color
    //     $headerData1 = array(
    //         'A3' => array('NO', 5),
    //         'B3' => array('LETAK LOKASI ASET (SUB UNIT)', 20),
    //         'C3' => array('ID SUB UNIT', 12),
    //         'D3' => array('ID GEDUNG', 12),
    //         'E3' => array('ID RUANG', 12),
    //         'F3' => array('ID UNIT', 12),
    //         'G3' => array('ID PIC PENGGUNA', 12),
    //         'H3' => array('NAMA UNIT', 12),
    //         'I3' => array('JENIS ASET', 20),
    //         'J3' => array('ID JENIS', 12),
    //         'K3' => array('ID KELOMPOK', 12),
    //         'L3' => array('NAMA SARANA', 35),
    //         'M3' => array('JUMLAH ASET', 15),
    //         'N3' => array('SATUAN ASET', 15),
    //         'O3' => array('STATUS KEPEMILIKAN', 17),
    //         'P3' => array('TAHUN PENGADAAN', 17)
    //         // 'Q3' => array('HARGA PEROLEHAN', 17)
    //     );

    //     // $formatRupiah = '#,##0';
    //     foreach ($headerData1 as $cell => $data) {
    //         $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
    //         $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    //         $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    //         $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('70deb1');
    //         $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
    //         $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
    //     }
    //     // $sheet->getStyle('P:P')->getNumberFormat()->setFormatCode($formatRupiah);
    //     $kolomHide1 = ['C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'U', 'V', 'W', 'X', 'Y'];
    //     foreach ($kolomHide1 as $hide1) {
    //         $sheet->getColumnDimension($hide1)->setVisible(false);
    //     }


    //     // Batas Data Ke Data Sub Unit
    //     $sheet->setCellValue('Q1', '')->getColumnDimension('Q')->setWidth(3);
    //     $sheet->setCellValue('R1', '')->getColumnDimension('R')->setWidth(3);

    //     $sheet->mergeCells('S1:Y1');
    //     $sheet->getStyle('S1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //     $sheet->setCellValue('S1', 'Data Sub Unit');
    //     $sheet->getStyle('S1')->getFont()->setBold(true)->setSize(16);


    //     // HEADER DATA SUB UNIT
    //     $headerData2 = array(
    //         'S3' => array('NAMA SUB UNIT', 30),
    //         'T3' => array('NAMA UNIT', 20),
    //         'U3' => array('ID SUB UNIT', 12),
    //         'V3' => array('ID GEDUNG', 12),
    //         'W3' => array('ID RUANG', 12),
    //         'X3' => array('ID UNIT', 12),
    //         'Y3' => array('ID PIC PENGGUNA', 12)
    //     );

    //     foreach ($headerData2 as $cell => $data) {
    //         $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
    //         $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    //         $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    //         $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('70deb1');
    //         $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
    //         $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
    //     }

    //     $sheet->setCellValue('Z1', '')->getColumnDimension('Z')->setWidth(3);

    //     $sheet->mergeCells('AA1:AC1');
    //     $sheet->getStyle('AA1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //     $sheet->setCellValue('AA1', 'Data Jenis Aset');
    //     $sheet->getStyle('AA1')->getFont()->setBold(true)->setSize(16);


    //     // HEADER DATA JENIS ASET
    //     $headerData3 = array(
    //         'AA3' => array('JENIS ASET', 38),
    //         'AB3' => array('ID JENIS', 12),
    //         'AC3' => array('ID KELOMPOK', 12)
    //     );

    //     foreach ($headerData3 as $cell => $data) {
    //         $sheet->setCellValue($cell, $data[0])->getColumnDimension(substr($cell, 0, 1))->setWidth($data[1]);
    //         $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->getStyle($cell)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    //         $sheet->getStyle($cell)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    //         $sheet->getStyle($cell)->getFill()->getStartColor()->setARGB('70deb1');
    //         $sheet->getStyle($cell)->getAlignment()->setWrapText(true);
    //         $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(12);
    //     }

    //     $borderStyle = [
    //         'borders' => [
    //             'outline' => [
    //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                 'color' => ['argb' => '00000000'],
    //             ],
    //             'inside' => [
    //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                 'color' => ['argb' => '00000000']
    //             ]
    //         ],
    //     ];

    //     $sheet->getStyle('A3:Q250')->applyFromArray($borderStyle);
    //     $sheet->getStyle('S3:Y3')->applyFromArray($borderStyle);
    //     $sheet->getStyle('AA3:AC3')->applyFromArray($borderStyle);


    //     // DOWNLOAD DATA SUB UNIT
    //     $row = 4;
    //     foreach ($DataSubUnit as $itemSubUnit) {
    //         $sheet->setCellValue('S' . $row, $itemSubUnit['nama_sub_unit']);
    //         $sheet->setCellValue('T' . $row, $itemSubUnit['nama_unit']);
    //         // $sheet->getStyle('T' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->setCellValue('U' . $row, $itemSubUnit['id_sub_unit']);
    //         $sheet->getStyle('U' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->setCellValue('V' . $row, $itemSubUnit['gedung_sub_unit_id']);
    //         $sheet->getStyle('V' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->setCellValue('W' . $row, $itemSubUnit['ruang_sub_unit_id']);
    //         $sheet->getStyle('W' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->setCellValue('X' . $row, $itemSubUnit['unit_id']);
    //         $sheet->getStyle('X' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->setCellValue('Y' . $row, $itemSubUnit['subunit_pic_id']);
    //         $sheet->getStyle('Y' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //         $sheet->getStyle('S' . $row . ':Y' . $row)->applyFromArray($borderStyle);
    //         $DataSubUnitLookUp = '$S$4:$Y$' . $row;

    //         $row++;
    //     }


    //     // DOWNLOAD DATA ASET
    //     $row = 4;
    //     foreach ($DataJenisAset as $itemJenisAset) {
    //         $sheet->setCellValue('AA' . $row, $itemJenisAset['jenis_aset']);
    //         $sheet->setCellValue('AB' . $row, $itemJenisAset['id_jenis']);
    //         $sheet->getStyle('AB' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //         $sheet->setCellValue('AC' . $row, $itemJenisAset['kelompok_id']);
    //         $sheet->getStyle('AC' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //         $sheet->getStyle('AA' . $row . ':AC' . $row)->applyFromArray($borderStyle);

    //         $DataJenisLookUp = '$AA$4:$AC$' . $row;
    //         $row++;
    //     }

    //     // Unprotect pada cell tertentu
    //     $sheet->getProtection()->setSheet(true);
    //     $sheet->getStyle('A4:Q250')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
    //     $sheet->getProtection()->setPassword('hanyaAdminSaja');

    //     // Memberikan Formula Vlookup
    //     for ($barisFormAset = 4; $barisFormAset <= 250; $barisFormAset++) {
    //         $sheet->setCellValue('C' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',3,FALSE),"")');
    //         $sheet->setCellValue('D' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',4,FALSE),"")');
    //         $sheet->setCellValue('E' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',5,FALSE),"")');
    //         $sheet->setCellValue('F' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',6,FALSE),"")');
    //         $sheet->setCellValue('G' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',7,FALSE),"")');
    //         $sheet->setCellValue('H' . $barisFormAset, '=IFERROR(VLOOKUP($B' . $barisFormAset . ',' . $DataSubUnitLookUp . ',2,FALSE),"")');
    //         $sheet->setCellValue('J' . $barisFormAset, '=IFERROR(VLOOKUP($I' . $barisFormAset . ',' . $DataJenisLookUp . ',2,FALSE),"")');
    //         $sheet->setCellValue('K' . $barisFormAset, '=IFERROR(VLOOKUP($I' . $barisFormAset . ',' . $DataJenisLookUp . ',3,FALSE),"")');
    //     }


    //     $writer = new Xlsx($spreadsheet);
    //     $filename = $JudulImportData  . '.xlsx';

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save('php://output');
    // }

    // public function upload_InputDataAset()
    // {
    //     $config['upload_path'] = './assets/file_upload/';
    //     $config['allowed_types'] = 'xlsx|xls';
    //     $config['max_size'] = 2048;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('import_data_aset')) {
    //         $error = $this->upload->display_errors();
    //         $this->session->set_flashdata('error', $error);
    //         redirect('subunit/input_aset');
    //     } else {
    //         $file = $this->upload->data();
    //         $file_path = './assets/file_upload/' . $file['file_name'];

    //         $spreadsheet = IOFactory::load($file_path);
    //         $worksheet = $spreadsheet->getActiveSheet();

    //         $row = 4;

    //         $importDataAset = array();
    //         while ($worksheet->getCell('B' . $row)->getValue() !== null) {
    //             $IDsubunit = $worksheet->getCell('C' . $row)->getCalculatedValue();
    //             $IDgedung = $worksheet->getCell('D' . $row)->getCalculatedValue();
    //             $IDruang = $worksheet->getCell('E' . $row)->getCalculatedValue();
    //             $IDunit = $worksheet->getCell('F' . $row)->getCalculatedValue();
    //             $IDpicpengguna = $worksheet->getCell('G' . $row)->getCalculatedValue();
    //             $namaUnit = $worksheet->getCell('H' . $row)->getCalculatedValue();
    //             $IDjenis = $worksheet->getCell('J' . $row)->getCalculatedValue();
    //             $IDkelompok = $worksheet->getCell('K' . $row)->getCalculatedValue();
    //             $namaSarana = $worksheet->getCell('L' . $row)->getValue();
    //             $jumlahAset = $worksheet->getCell('M' . $row)->getValue();
    //             $satuanAset = $worksheet->getCell('N' . $row)->getValue();
    //             $statusKepemilikan = $worksheet->getCell('O' . $row)->getValue();
    //             $tahunPengadaan = $worksheet->getCell('P' . $row)->getValue();
    //             $hargaPerolehan = $worksheet->getCell('Q' . $row)->getValue();

    //             $jumlahAset_perUnit = $this->inv->count_dataByID('inventory_input_aset', 'aset_unit_id', $IDunit);

    //             $kodeAset = $jumlahAset_perUnit + 1;

    //             $importDataAset[] = array(
    //                 'aset_unit_id' => $IDunit,
    //                 'aset_sub_unit_id' => $IDsubunit,
    //                 'lokasi_gedung_id' => $IDgedung,
    //                 'lokasi_ruang_id' => $IDruang,
    //                 'pic_id' => $IDpicpengguna,
    //                 'jenis_aset_id' => $IDjenis,
    //                 'jenis_kelompok_id' => $IDkelompok,
    //                 'nama_sarana' => $namaSarana,
    //                 'jumlah_aset' => $jumlahAset,
    //                 'satuan_aset' => $satuanAset,
    //                 'status_kepemilikan' => $statusKepemilikan,
    //                 'tahun_pengadaan' => $tahunPengadaan,
    //                 'harga_perolehan' => $hargaPerolehan,
    //                 'total_perolehan' => $hargaPerolehan * $jumlahAset,
    //                 'label_aset' => $kodeAset . '/INV/' . $namaUnit . '/' . $tahunPengadaan
    //             );

    //             $row++;
    //         }
    //         foreach ($importDataAset as $data) {
    //             $this->inv->insert_data($data, 'inventory_input_aset');
    //         }

    //         if (file_exists($file_path)) {
    //             unlink($file_path);
    //         }

    //         $this->session->set_flashdata('message', 'Aset Baru Berhasil Diupload');
    //         return redirect('subunit/input_aset');
    //     }
    // }
    // Format sesuaikan dengan Subunit yang login, jadi tinggal memilih jenis aset nya.

    public function edit_aset($id_input_aset)
    {
        $data['title'] = 'Edit Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['get_aset'] = $this->inv->get_input_aset($id_input_aset);
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['sub_unit'] = $this->inv->get_subUnit($data['GETsub_unit']['id_sub_unit']);
        $data['kepemilikan'] = ['Milik', 'Sewa'];
        $data['jenis'] = $this->inv->join2_tables('inventory_jenis_aset', 'inventory_kelompok_aset', 'id_kelompok', 'kelompok_id');
        $data['satuan_aset'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'set', 'tube', 'unit'];
        $data['ket_aset'] = ['Baru', 'Lama/Second'];
        $jumlahAset_perUnit = $this->inv->count_dataByID('inventory_input_aset', 'aset_unit_id', $this->input->post('value_aset_input2'));

        $kodeAset = $jumlahAset_perUnit + 1;

        $this->form_validation->set_rules('jenis_aset_id', 'Jenis Aset dan Kelompok', 'required|trim');
        $this->form_validation->set_rules('nama_sarana', 'Nama Sarana', 'required|trim');
        $this->form_validation->set_rules('jumlah_aset', 'Jumlah Sarana', 'required|trim');
        $this->form_validation->set_rules('status_kepemilikan', 'Kepemilikan', 'required|trim');
        $this->form_validation->set_rules('tahun_pengadaan', 'Tahun Pengadaan', 'required|trim');
        $this->form_validation->set_rules('ket_aset', 'Keterangan Aset', 'required|trim');
        $this->form_validation->set_rules('satuan_aset', 'Satuan Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/edit_aset', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'nama_sarana' => htmlspecialchars($this->input->post('nama_sarana')),
                'jenis_aset_id' => htmlspecialchars($this->input->post('jenis_aset_id')),
                'jenis_kelompok_id' => htmlspecialchars($this->input->post('jenis_aset_id_text')),
                'jumlah_aset' => htmlspecialchars($this->input->post('jumlah_aset')),
                'satuan_aset' => htmlspecialchars($this->input->post('satuan_aset')),
                'status_kepemilikan' => htmlspecialchars($this->input->post('status_kepemilikan')),
                'tahun_pengadaan' => htmlspecialchars($this->input->post('tahun_pengadaan')),
                'keterangan_aset' => htmlspecialchars($this->input->post('ket_aset')),
            ];
            $this->inv->update_data('id_input_aset', $id_input_aset, 'inventory_input_aset', $data);

            $this->session->set_flashdata('message', 'Aset Baru Telah DiUbah');
            return redirect('subunit/input_aset');
        }
    }

    public function hasil_input_aset()
    {
        $data['title'] = 'Input Aset Yayasan';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['aset_bySubUnit'] = $this->inv->get_aset_sub_unit($data['GETsub_unit']['id_sub_unit']);
        $data['input_aset'] = $this->inv->join_input_aset();

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('subunit/input_aset_tabel', $data);
        $this->load->view('template3/layout_footer');
    }

    public function hapus_aset($id_input_aset)
    {
        $this->inv->delete_data('inventory_kondisi_aset', 'aset_id', $id_input_aset);
        $this->inv->delete_data('inventory_input_aset', 'id_input_aset', $id_input_aset);
        $this->session->set_flashdata('message', 'Aset Telah Dihapus');
        return redirect('subunit/hasil_input_aset');
    }

    public function nonaktif_aset($id_input_aset)
    {
        $data = [
            'aset_aktif' => 0,
        ];
        $this->inv->update_data('id_input_aset', $id_input_aset, 'inventory_input_aset', $data);
        $this->session->set_flashdata('message', 'Aset Telah Di Non Aktifkan');
        return redirect('subunit/hasil_input_aset');
    }

    public function mutasi_aset()
    {
        $data['title'] = 'Mutasi Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');

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
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['aset_bySubUnit'] = $this->inv->get_aset_sub_unit($data['GETsub_unit']['id_sub_unit']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('subunit/kondisi_aset', $data);
        $this->load->view('template3/layout_footer');
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
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['get_aset'] = $this->inv->get_input_aset($id_aset);
        $data['kondisi_per_aset'] = $this->inv->get_cek_kondisi($id_aset);
        $data['all_aset'] = $this->inv->join_input_aset();
        $data['pilih_kondisi'] = ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Perbaikan'];

        $this->form_validation->set_rules('tanggal_cek', 'Tanggal Cek', 'required|trim');
        $this->form_validation->set_rules('kondisi_aset', 'Kondisi Aset', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/cek_kondisi_aset', $data);
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
            return redirect('subunit/cek_kondisi_aset/' . $id_aset);
        }
    }

    public function hapus_kondisi($id_kondisi)
    {
        $aset_id = $this->input->post('aset_id');
        $this->inv->delete_data('inventory_kondisi_aset', 'id_kondisi', $id_kondisi);
        $this->session->set_flashdata('message', 'Catatan Kondisi Berhasil Dihapus');
        return redirect('subunit/cek_kondisi_aset/' . $aset_id);
    }

    public function PengajuanATK()
    {
        $data['title'] = 'Data Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['GETunit'] = $this->inv->getId_data($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');
        $data['DataPengajuanATK'] = $this->inv->getDetailPengajuanUnitAll($data['GETsub_unit']['unit_id']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('subunit/data_pengajuan', $data);
        $this->load->view('template3/layout_footer');
    }

    public function input_pengajuanATK()
    {
        $data['title'] = 'Input Barang ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['BarangATK'] = $this->inv->show_data('inventory_barang_atk');
        $data['satuan_barang'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'tube', 'unit'];
        $data['DataUnit'] = $this->inv->DatabyKategori($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');

        $this->form_validation->set_rules('pilih_unit_atk', 'Unit', 'required|trim');
        $this->form_validation->set_rules('pilih_atk', 'Barang ATK', 'required|trim');
        $this->form_validation->set_rules('jumlah_atk', 'Jumlah Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_barang', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal_pengajuan_atk', 'Tanggal Pengajuan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/input_pengajuan_atk', $data);
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
            return redirect('subunit/PengajuanATK');
        }
    }

    public function hapus_pengajuanATK($id_pengajuan)
    {
        $this->inv->delete_data('inventory_pengajuan_atk', 'id_pengajuan', $id_pengajuan);
        $this->session->set_flashdata('message', 'Barang Pengajuan Berhasil Dihapus');
        return redirect('subunit/PengajuanATK');
    }

    public function detail_pengajuanATKUnit()
    {
        $data['title'] = 'Data Validasi Pengajuan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['DataPengajuanUnit'] = $this->inv->getDetailPengajuanUnitAll($data['GETsub_unit']['unit_id']);
        $data['getUnit'] = $this->inv->getId_data($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('subunit/detail_pengajuan_unit', $data);
        $this->load->view('template3/layout_footer');
    }

    public function cetakExcelPengajuanATKUnit()
    {
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $pengguna = $this->inv->show_data('inventory_pengguna');

        $titleLaporan = 'Pengajuan ATK';
        $getUnit = $this->inv->getDataUnitCetakLaporan($data['GETsub_unit']['unit_id']);
        $DataPengajuanUnit = $this->inv->getDetailPengajuanUnitAll($data['GETsub_unit']['unit_id']);
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

    public function prosesPengajuan()
    {
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $dataUnit = [
            'status_pengajuan' => 'pengajuan',
        ];
        $this->inv->update_data('id_unit', $data['GETsub_unit']['unit_id'], 'inventory_unit', $dataUnit);

        $dataPengajuan = [
            'status_pengajuan_atk' => 'pengajuan',
        ];
        $this->inv->update_data('unit_pengajuan_id', $data['GETsub_unit']['unit_id'], 'inventory_pengajuan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Proses Pengajuan Barang Berhasil Diubah.');
        return redirect('subunit/detail_pengajuanATKUnit');
    }

    public function input_pengambilanATK()
    {
        $data['title'] = 'Input Pengambilan ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['GETunit'] = $this->inv->getId_data($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');
        $data['DataATK'] = $this->inv->DataPengajuanATKUnit($data['GETsub_unit']['unit_id']);
        $data['DataPengambilanATK'] = $this->inv->getPengambilanUnit($data['GETsub_unit']['unit_id']);
        $data['getUnit'] = $this->inv->getId_data($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');
        $data['satuan_barang'] = ['botol', 'buah', 'centimeter', 'dos', 'eksemplar', 'galon', 'gram', 'kaleng', 'kantong', 'kg', 'lembar', 'liter', 'lusin', 'meter', 'milimeter', 'pak', 'paket', 'pcs', 'per buku', 'rim', 'roll', 'stel', 'tube', 'unit'];

        $this->form_validation->set_rules('pilih_atk_pengambilan', 'Barang ATK', 'required|trim');
        $this->form_validation->set_rules('jumlah_atk_pengambilan', 'Jumlah Barang', 'required|trim');
        $this->form_validation->set_rules('satuan_barang_pengambilan', 'Satuan Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal_pengambilan_atk', 'Tanggal Pengajuan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template3/layout_header', $data);
            $this->load->view('template3/layout_sidebar', $data);
            $this->load->view('subunit/input_pengambilan_atk', $data);
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
            return redirect('subunit/input_pengambilanATK/' . $data['GETsub_unit']['unit_id']);
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
            $this->load->view('subunit/edit_pengambilan_atk', $data);
            $this->load->view('template3/layout_footer');
        } else {
            $data = [
                'jumlah_pengambilan_atk' => htmlspecialchars($this->input->post('jumlah_atk_pengambilan2')),
                'tanggal_pengambilan' => htmlspecialchars($this->input->post('tanggal_pengambilan_atk')),
                'total_pengambilan_atk' => htmlspecialchars($this->input->post('total_harga_pengambilan3')),
            ];
            $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $data);

            $this->session->set_flashdata('message', 'Pengambilan Barang Berhasil Diubah.');
            return redirect('subunit/input_pengambilanATK/' . $id_unit);
        }
    }

    public function hapus_pengambilanATK($id_pengambilan)
    {
        $id_unit = $this->input->post('id_unit_pengambilan');
        $this->inv->delete_data('inventory_pengambilan_atk', 'id_pengambilan', $id_pengambilan);
        $this->session->set_flashdata('message', 'Barang Berhasil Dihapus');
        return redirect('subunit/input_pengambilanATK/' . $id_unit);
    }

    public function pengajuan_pengambilanATK($id_pengambilan)
    {
        $id_unit = $this->input->post('id_unit_pengambilan');
        $dataPengajuan = [
            'status_pengambilan_atk' => 'pengajuan',
        ];
        $this->inv->update_data('id_pengambilan', $id_pengambilan, 'inventory_pengambilan_atk', $dataPengajuan);
        $this->session->set_flashdata('message', 'Proses Mengajukan Pengambilan Barang Berhasil.');
        return redirect('subunit/input_pengambilanATK/' . $id_unit);
    }

    public function DataATKunit()
    {
        $data['title'] = 'Data ATK';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['GETunit'] = $this->inv->getId_data($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');
        $data['DataATKUnit'] = $this->inv->DataPengajuanATKUnit($data['GETsub_unit']['unit_id']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('subunit/data_atk_unit', $data);
        $this->load->view('template3/layout_footer');
    }

    public function AsetNonAktif()
    {
        $data['title'] = 'Rekapitulasi Kondisi Aset';
        $data['peran'] = $this->db->get_where('inventory_pengguna', ['username' => $this->session->userdata('username')])->row_array();
        $data['ket_peran'] = $this->inv->show_data('inventory_peran_pengguna');
        $data['GETsub_unit'] = $this->inv->getId_data($data['peran']['id_pengguna'], 'inventory_sub_unit', 'subunit_pic_id');
        $data['GETunit'] = $this->inv->getId_data($data['GETsub_unit']['unit_id'], 'inventory_unit', 'id_unit');
        $data['dataAsetNonAktif'] = $this->inv->AsetNonAktifSubUnit($data['GETsub_unit']['id_sub_unit']);

        $this->load->view('template3/layout_header', $data);
        $this->load->view('template3/layout_sidebar', $data);
        $this->load->view('subunit/aset_nonAktif', $data);
        $this->load->view('template3/layout_footer');
    }
}
