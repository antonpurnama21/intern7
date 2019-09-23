<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userlog')['is_login'] == FALSE) :
			redirect(base_url('auth')) ;
		endif;
		$this->load->model('Mod_crud');
		$this->load->library('Fpdf');
		define('FPDF_FONTPATH',$this->config->item('fonts_path')); 
	}

	public function index()
	{

	}

public function reportDosen()
	{		
		$data = array(
				'title' => "REKAPITULASI DATA DOSEN",
				'dtdosen' => $this->Mod_crud->getData('result', '*','t_dosen', null, null, null, null, null, array('dosenID ASC'))
			);
		$this->load->view('pages/report/ReportDosen', $data);
	}

	public function reportMahasiswa()
	{
		$data = array(
				'title' => "REKAPITULASI DATA MAHASISWA",
				'dtdosen' => $this->Mod_crud->getData('result', 'm.*,ff.photo,ff.resume,ff.academicTranscipt,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), null, null, array('m.mahasiswaID ASC'))
			);
		$this->load->view('pages/report/ReportMahasiswa', $data);
	}

	public function printScope($id=null)
	{
		$data = array(
				'title' => "PROJECT SCOPE",
				'dtscope' => $this->Mod_crud->getData('row', '*','t_project_scope',null,null,null,array('projectScopeID = "'.$id.'"'))
			);
		$this->load->view('pages/report/PrintScope', $data);
	}


}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */