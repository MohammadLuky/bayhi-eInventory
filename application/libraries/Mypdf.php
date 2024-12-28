<?php


defined('BASEPATH') or exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;


class Mypdf
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'potrait')
    {
        // $option = new Options();
        // $option->set('chroot', realpath(''));

        // $dompdf = new Dompdf($option);
        $dompdf = new Dompdf();
        $html = $this->ci->load->view($view, $data, true);
        $css = file_get_contents(base_url('assets/admin_lte/dist/css/adminlte.min.css'));
        $html = '<i>' . $css . '</style>' . $html;
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));
    }

    public function generateLandscape($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'landscape')
    {
        $dompdf = new Dompdf();
        $html = $this->ci->load->view($view, $data, true);
        $css = file_get_contents(base_url('assets/admin_lte/dist/css/adminlte.min.css'));
        $html = '<i>' . $css . '</style>' . $html;
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));
    }
}
