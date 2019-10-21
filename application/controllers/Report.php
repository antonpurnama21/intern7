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

	public function printLogbyID()
	{
		$id = $this->input->post('iduser');

		if ($id == 'adm') {
			$title = 'Admin Department';
			$like[] = 'logUsrID LIKE "11%"';
			$like[]	= 'logUsrID LIKE "22%"';
			$lk = implode(' OR ', $like);
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,null,null,null,$lk);
		}elseif ($id == 'admcampus') {
			$title = 'Admin Campus';
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "33%"'));
		}elseif ($id == 'dsn') {
			$title = 'Dosen';
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "44%"'));
		}elseif ($id == 'mhs') {
			$title = 'Mahasiswa';
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "55%"'));
		}else{
			$ii = substr($id,0,2);
			if ($ii == '11' OR $ii == '22') {
				$name = name_admin($id);
			}elseif ($ii == '33') {
				$name = name_admincampus($id);
			}elseif ($ii == '44') {
				$name = name_dosen($id);
			}else{
				$name = name_mhs($id);
			}
			$title = $name;
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$id.'"'));
		}
		$data = array(
				'title' => "Activity Log ".$title,
				'data' => $dt,
			);
		$this->load->view('pages/report/PrintLogbyID', $data);
		//echo json_encode($data);
	}

		public function printLogAll()
	{
		$data = array(
				'title' => "Activity Log",
				'data' => $this->Mod_crud->getData('result', '*','t_log_activity')
			);
		$this->load->view('pages/report/PrintLogAll', $data);
		//echo json_encode($data);
	}


}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */