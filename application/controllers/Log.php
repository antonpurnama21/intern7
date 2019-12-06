<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Log extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
						"dashboards/js/plugins/forms/selects/select2.min.js",
						"dashboards/js/pages/datatables_responsive.js",
						"dashboards/js/plugins/forms/styling/switch.min.js",
						"dashboards/js/plugins/forms/styling/switchery.min.js",
						"dashboards/js/plugins/forms/styling/uniform.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/log-index-script.js",
				)
			),
			'titleWeb' => "Log Activities | CBN Internship",
			'breadcrumb' => explode(',', 'Log Activity, Log List'),
			'dMaster'	=> $this->Mod_crud->getData('result','*', 't_log_activity',null,null,null,null,null,array('logID DESC')),
		);
		$this->render('dashboard', 'pages/log/index', $data);
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){
		$query 		= $this->Mod_crud->deleteData('t_log_activity', array('logID' => $this->input->post('id')));
		if ($query){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
		
	}


	public function result($id = null)
	{
		if ($id == 'adm') {
			if ($this->input->post('Admin') == 'alladmin') {
				$usr = 'Admin Department';
				$idusr = 'adm';
				$like[] = 'logUsrID LIKE "11%"';
				$like[]	= 'logUsrID LIKE "22%"';
				$lk = implode(' OR ', $like);
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,null,null,array('logID DESC'),$lk);
			}else{
				$usr = name_admin($this->input->post('Admin'));
				$idusr = $this->input->post('Admin');
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$this->input->post('Admin').'"'),null,array('logID DESC'));
			}

			$data = array(
				'_JS' => generate_js(array(
							"dashboards/js/plugins/ui/moment/moment.min.js",
							"dashboards/js/plugins/tables/datatables/datatables.min.js",
							"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
							"dashboards/js/plugins/forms/selects/select2.min.js",
							"dashboards/js/pages/datatables_responsive.js",
							"dashboards/js/plugins/forms/styling/switch.min.js",
							"dashboards/js/plugins/forms/styling/switchery.min.js",
							"dashboards/js/plugins/forms/styling/uniform.min.js",
							"dashboards/js/plugins/pickers/pickadate/picker.js",
							"dashboards/js/plugins/pickers/pickadate/picker.date.js",
							"dashboards/js/plugins/forms/validation/validate.min.js",
							"dashboards/js/pages/log-index-script.js",
					)
				),
				'titleWeb' => "Log Activities | CBN Internship",
				'breadcrumb' => explode(',', 'Log Activity, Log List '.$usr),
				'dMaster' => $log,
				'id'	=> $idusr,
			);
			$this->render('dashboard', 'pages/log/result', $data);
		}
		
		if ($id == 'admcampus') {
			if ($this->input->post('Admincampus') == 'alladmincampus') {
				$usr = 'Admin Campus';
				$idusr = 'admcampus';
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "33%"'),null,array('logID DESC'));
			}else{
				$idusr = $this->input->post('Admincampus');
				$usr = name_admincampus($this->input->post('Admincampus'));
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$this->input->post('Admincampus').'"'),null,array('logID DESC'));
			}
			$data = array(
				'_JS' => generate_js(array(
							"dashboards/js/plugins/ui/moment/moment.min.js",
							"dashboards/js/plugins/tables/datatables/datatables.min.js",
							"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
							"dashboards/js/plugins/forms/selects/select2.min.js",
							"dashboards/js/pages/datatables_responsive.js",
							"dashboards/js/plugins/forms/styling/switch.min.js",
							"dashboards/js/plugins/forms/styling/switchery.min.js",
							"dashboards/js/plugins/forms/styling/uniform.min.js",
							"dashboards/js/plugins/pickers/pickadate/picker.js",
							"dashboards/js/plugins/pickers/pickadate/picker.date.js",
							"dashboards/js/plugins/forms/validation/validate.min.js",
							"dashboards/js/pages/log-index-script.js",
					)
				),
				'titleWeb' => "Log Activities | CBN Internship",
				'breadcrumb' => explode(',', 'Log Activity, Log List '.$usr),
				'dMaster' => $log,
				'id'	=> $idusr,
			);
			$this->render('dashboard', 'pages/log/result', $data);
		}

		if ($id == 'dsn') {
			if ($this->input->post('Dosen') == 'alldosen') {
				$usr = 'Dosen';
				$idusr = 'dsn';
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "44%"'),null,array('logID DESC'));
			}else{
				$idusr = $this->input->post('Dosen');
				$usr = name_dosen($this->input->post('Dosen'));
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$this->input->post('Dosen').'"'),null,array('logID DESC'));
			}
			$data = array(
				'_JS' => generate_js(array(
							"dashboards/js/plugins/ui/moment/moment.min.js",
							"dashboards/js/plugins/tables/datatables/datatables.min.js",
							"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
							"dashboards/js/plugins/forms/selects/select2.min.js",
							"dashboards/js/pages/datatables_responsive.js",
							"dashboards/js/plugins/forms/styling/switch.min.js",
							"dashboards/js/plugins/forms/styling/switchery.min.js",
							"dashboards/js/plugins/forms/styling/uniform.min.js",
							"dashboards/js/plugins/pickers/pickadate/picker.js",
							"dashboards/js/plugins/pickers/pickadate/picker.date.js",
							"dashboards/js/plugins/forms/validation/validate.min.js",
							"dashboards/js/pages/log-index-script.js",
					)
				),
				'titleWeb' => "Log Activities | CBN Internship",
				'breadcrumb' => explode(',', 'Log Activity, Log List '.$usr),
				'dMaster' => $log,
				'id'	=> $idusr,
			);
			$this->render('dashboard', 'pages/log/result', $data);
		}

		if ($id == 'mhs') {
			if ($this->input->post('Mahasiswa') == 'allmahasiswa') {
				$idusr = 'mhs';
				$usr = 'Mahasiswa';
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "55%"'),null,array('logID DESC'));
			}else{
				$idusr = $this->input->post('Mahasiswa');
				$usr = name_mhs($this->input->post('Mahasiswa'));
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$this->input->post('Mahasiswa').'"'),null,array('logID DESC'));
			}
			$data = array(
				'_JS' => generate_js(array(
							"dashboards/js/plugins/ui/moment/moment.min.js",
							"dashboards/js/plugins/tables/datatables/datatables.min.js",
							"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
							"dashboards/js/plugins/forms/selects/select2.min.js",
							"dashboards/js/pages/datatables_responsive.js",
							"dashboards/js/plugins/forms/styling/switch.min.js",
							"dashboards/js/plugins/forms/styling/switchery.min.js",
							"dashboards/js/plugins/forms/styling/uniform.min.js",
							"dashboards/js/plugins/pickers/pickadate/picker.js",
							"dashboards/js/plugins/pickers/pickadate/picker.date.js",
							"dashboards/js/plugins/forms/validation/validate.min.js",
							"dashboards/js/pages/log-index-script.js",
					)
				),
				'titleWeb' => "Log Activities | CBN Internship",
				'breadcrumb' => explode(',', 'Log Activity, Log List '.$usr),
				'dMaster' => $log,
				'id'	=> $idusr,
			);
			$this->render('dashboard', 'pages/log/result', $data);
		}
		//echo json_encode($log);
	}

	public function getListByid()
	{
		$res = array();
		$id = $this->session->userdata('userlog')['sess_usrID'];
		$Log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$id.'"'),null,array('logID DESC'));
		if (!empty($Log)) {
			$no = 0;
			foreach ($Log as $key) {
				$no++;
				$waktu = timestep($key->logTime);
                $email1 = email($key->logUsrID);
                if ($email1 == $this->session->userdata('userlog')['sess_email']) {
                    $email = 'you';
                }else{
                    $email = $email1;
                }
				array_push($res, array(
							$no,
							$email,
							$waktu,
							$key->logBrowser,
							$key->logIP,
							$key->logPlatform,
							ucwords(logtype($key->logTypeID)),
							$key->logDesc
							)
				);
			}
		}
		echo json_encode($res);
	}


	public function getAdmin()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'adminID, fullName, deptID', 't_admin');
		if (!empty($data)) {
				$mk['id'] = 'alladmin';
				$mk['text'] = 'Print All';
				array_push($resp, $mk);
			foreach ($data as $key) {
				$mk['id'] = $key->adminID;
				$mk['text'] = $key->fullName.' ['.name_dept($key->deptID).']';
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function getAdminCampus()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'adminCampusID, fullName, universityID', 't_admin_campus');
		if (!empty($data)) {
				$mk['id'] = 'alladmincampus';
				$mk['text'] = 'Print All';
				array_push($resp, $mk);
			foreach ($data as $key) {
				$mk['id'] = $key->adminCampusID;
				$mk['text'] = $key->fullName.' ['.name_university($key->universityID).']';
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function getDosen()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'dosenID, fullName, universityID', 't_dosen');
		if (!empty($data)) {
				$mk['id'] = 'alldosen';
				$mk['text'] = 'Print All';
				array_push($resp, $mk);
			foreach ($data as $key) {
				$mk['id'] = $key->dosenID;
				$mk['text'] = $key->fullName.' ['.name_university($key->universityID).']';
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function getMahasiswa()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'mahasiswaID, fullName, universityID', 't_mahasiswa');
		if (!empty($data)) {
				$mk['id'] = 'allmahasiswa';
				$mk['text'] = 'Print All';
				array_push($resp, $mk);
			foreach ($data as $key) {
				$mk['id'] = $key->mahasiswaID;
				$mk['text'] = $key->fullName.' ['.name_university($key->universityID).']';
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

}


/* End of file Log.php */
/* Location: ./application/controllers/Log.php */
