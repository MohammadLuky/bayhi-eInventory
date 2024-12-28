<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Eror | E-Inventory';
		$this->load->view('not_found', $data);
	}
}
