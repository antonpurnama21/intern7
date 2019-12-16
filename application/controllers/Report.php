<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
//controller report /laporan

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userlog')['is_login'] == FALSE) : //jika islogin ==  false
			redirect(base_url('auth')) ;//kembali ke login
		endif;
		$this->load->model('Mod_crud');//load model mod_crud
		$this->load->library('Fpdf');//load library fpdf
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));//set font path 
	}

	public function index()
	{

	}

		public function reportAdmin()//report admin
	{		
		$data = array(
				'title' => "REKAPITULASI DATA ADMIN DEPARTMENT", //title report
				//get data admin
				'dMaster' => $this->Mod_crud->getData('result', 'a.*, l.roleID','t_admin a', null, null, array('t_login l'=>'l.loginID = a.loginID'), null, null, array('adminID ASC'))
			);
		$this->load->view('pages/report/ReportAdmin', $data);//load view report admin
	}

	public function reportAdmincampus()//report admin campus
	{		
		$data = array(
				'title' => "REKAPITULASI DATA ADMIN CAMPUS",
				//get data acmin campus
				'dMaster' => $this->Mod_crud->getData('result', 'a.*, l.roleID','t_admin_campus a', null, null, array('t_login l'=>'l.loginID = a.loginID'), null, null, array('adminCampusID ASC'))
			);
		$this->load->view('pages/report/ReportAdminCampus', $data);//load view report admin campus
	}

	public function reportDosen()//report dosen
	{		
		$data = array(
				'title' => "REKAPITULASI DATA DOSEN",
				//get data dosen
				'dtdosen' => $this->Mod_crud->getData('result', '*','t_dosen', null, null, null, null, null, array('dosenID ASC'))
			);
		$this->load->view('pages/report/ReportDosen', $data);//load view report dosen
	}

	public function reportMahasiswa()//report mahasiswa
	{
		$data = array(
				'title' => "REKAPITULASI DATA MAHASISWA",
				//get mahasiswa
				'dMaster' => $this->Mod_crud->getData('result', 'm.*,ff.photo,ff.resume,ff.academicTranscipt,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), null, null, array('m.mahasiswaID ASC'))
			);
		$this->load->view('pages/report/ReportMahasiswa', $data);//load view report mahasiswa
	}

	public function printScope($id=null)//report project scope
	{
		$data = array(
				'title' => "PROJECT SCOPE ".name_projectscope($id),//title report
				//get data scope
				'dtscope' => $this->Mod_crud->getData('row', '*','t_project_scope',null,null,null,array('projectScopeID = "'.$id.'"'))
			);
		$this->load->view('pages/report/PrintScope', $data);//load view report scope
	}

	public function printLogbyID()//report berdasarkan log id
	{
		$id = $this->input->post('iduser');//get post id user

		if ($id == 'adm') {//jika id = adm (admin hc & department)
			$title = 'Admin Department';
			$like[] = 'logUsrID LIKE "11%"';
			$like[]	= 'logUsrID LIKE "22%"';
			$lk = implode(' OR ', $like);
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,null,null,array('logID DESC'),$lk);
		}elseif ($id == 'admcampus') {//jika id = admcampus (admincampus)
			$title = 'Admin Campus';
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "33%"'),null,array('logID DESC'));
		}elseif ($id == 'dsn') {//jika id = dsn (dosen)
			$title = 'Dosen';
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "44%"'),null,array('logID DESC'));
		}elseif ($id == 'mhs') {//jika id = mhs (mahasiswa)
			$title = 'Mahasiswa';
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "55%"'),null,array('logID DESC'));
		}else{
			$ii = substr($id,0,2);
			if ($ii == '11' OR $ii == '22')
				$name = name_admin($id);
			}elseif ($ii == '33') {
				$name = name_admincampus($id);
			}elseif ($ii == '44') {
				$name = name_dosen($id);
			}else{
				$name = name_mhs($id);
			}
			$title = $name;
			$dt = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$id.'"'),null,array('logID DESC'));
		}
		$data = array(
				'title' => "Activity Log ".$title,
				'data' => $dt,
			);
		$this->load->view('pages/report/PrintLogbyID', $data);//load view print log by id
		//echo json_encode($data);
	}

		public function printLogAll()//print semua log
	{
		$data = array(
				'title' => "Activity Log",
				'data' => $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,null,null,array('logID DESC'))
			);
		$this->load->view('pages/report/PrintLogAll', $data);//load view printlogall
		//echo json_encode($data);
	}


}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */