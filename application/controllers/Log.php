<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Log extends CommonDash {
//controller log aktivitas
	public function __construct()
	{
		parent::__construct();
	}
	//load index log
	public function index()
	{
		$data = array(//generate js
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
			'titleWeb' => "Log Activities | CBN Internship",//title web aplikasi
			'breadcrumb' => explode(',', 'Log Activity, Log List'),//breadcrumb
			//ambil data log aktivitas
			'dMaster'	=> $this->Mod_crud->getData('result','*', 't_log_activity',null,null,null,null,null,array('logID DESC')),
		);
		$this->render('dashboard', 'pages/log/index', $data);//load log index
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){//hapus log aktivitas (tak digunakan)
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


	public function result($id = null)//hasil filter combobox
	{
		if ($id == 'adm') {//jika id == adm (untuk admin hc dan admin department)
			if ($this->input->post('Admin') == 'alladmin') {//jika post == alladmin
				$usr = 'Admin Department';
				$idusr = 'adm';
				$like[] = 'logUsrID LIKE "11%"';
				$like[]	= 'logUsrID LIKE "22%"';
				$lk = implode(' OR ', $like);
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,null,null,array('logID DESC'),$lk);
			}else{//jika per id
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
			$this->render('dashboard', 'pages/log/result', $data);//load view result
		}
		
		if ($id == 'admcampus') {//jika id = admcampus (untuk admin campus)
			if ($this->input->post('Admincampus') == 'alladmincampus') {//jika post = alladmincampus
				$usr = 'Admin Campus';
				$idusr = 'admcampus';
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "33%"'),null,array('logID DESC'));
			}else{//jika per id
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

		if ($id == 'dsn') {//jika id == dsn (untuk dosen)
			if ($this->input->post('Dosen') == 'alldosen') {//jika post = alldosen
				$usr = 'Dosen';
				$idusr = 'dsn';
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "44%"'),null,array('logID DESC'));
			}else{//jika per id
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

		if ($id == 'mhs') {//jika id = mhs (untuk mahasiswa)
			if ($this->input->post('Mahasiswa') == 'allmahasiswa') {//jika post = all mahasiswa
				$idusr = 'mhs';
				$usr = 'Mahasiswa';
				$log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID LIKE "55%"'),null,array('logID DESC'));
			}else{//jika per id
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

	public function getListByid()//log berdasarkan id user
	{
		$res = array();//set array
		$id = $this->session->userdata('userlog')['sess_usrID'];//get id dari seesion
		//get log data
		$Log = $this->Mod_crud->getData('result', '*','t_log_activity',null,null,null,array('logUsrID = "'.$id.'"'),null,array('logID DESC'));
		if (!empty($Log)) {//jika log kosong
			$no = 0;//set number
			foreach ($Log as $key) {//looping log
				$no++;//number
				$waktu = timestep($key->logTime);//timestep log
                $email1 = email($key->logUsrID);//email user
                if ($email1 == $this->session->userdata('userlog')['sess_email']) {//jika email sama dengan session email maka ganti menjadi you
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


	public function getAdmin()//get data admin
	{
		$resp = array();
		//get data
		$data = $this->Mod_crud->getData('result', 'adminID, fullName, deptID', 't_admin');
		if (!empty($data)) {//jika kosong
				$mk['id'] = 'alladmin';
				$mk['text'] = 'Print All';
				array_push($resp, $mk);
			foreach ($data as $key) {//looping data
				$mk['id'] = $key->adminID;
				$mk['text'] = $key->fullName.' ['.name_dept($key->deptID).']';
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function getAdminCampus()//get data admin deprtment
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

	public function getDosen()//get data dosen
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

	public function getMahasiswa()//get data mahasiswa
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
