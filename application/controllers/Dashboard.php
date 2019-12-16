<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Dashboard extends CommonDash {
//controller untuk mengelola halaman depan aplikasi/dashboard
	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()//halaman utama admin dashboard
	{
		if ($this->session->userdata('userlog')['sess_role']==11) { //untuk role id = 11 admin HC
			qrysession();//set query session sql_mode = ""
			//ambil data account yang memiliki password null
			$getaccount = $this->Mod_crud->getData('result', '*', 't_login', null, null, null,array('passworD = "null"'));
			//ambil data project scope yang belum di upprove
			$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null, null, array('isApproved = "P"'), null, array('projectScopeID ASC'));
			//ambil data mahasiswa untuk statistic
			$dataMhs = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(mhs.mahasiswaID)),0) as value, us.universityName as label FROM `t_university` as us LEFT JOIN t_mahasiswa as mhs ON mhs.universityID = us.universityID GROUP BY us.universityName');
			//ambil data project untuk statistic
			$dataProject = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(b.projectID)),0) as value, a.deptName as label FROM `t_department` as a LEFT JOIN `t_project` as b ON b.deptID = a.deptID GROUP BY a.deptName');
			//ambil data projec scope untuk sttistik
			$dataScope = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(b.projectScopeID)),0) as value, a.projectName as label FROM `t_project` as a LEFT JOIN `t_project_scope` as b ON b.projectID = a.projectID GROUP BY a.projectName');
			//menghitung jml apply pada project scope
			$applyJumlah = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID)),0) as value, projectScope as label, projectID as project FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.isApproved = "Y" GROUP BY t_project_scope.projectScope');
			//menghitung persen total apply
			$applyPersen = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID) / (SELECT COUNT(*) FROM `t_project_scope_temp`))*100,0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID GROUP BY t_project_scope.projectScope');
			//progressproject scope yang sedang berjalan atau di kerjakan
			$progressProject = $this->Mod_crud->qry('result','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value, ps.projectScope as label FROM t_project_scope as ps LEFT JOIN t_workscope as ws ON ps.projectScopeID = ws.projectScopeID LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID GROUP BY ps.projectScope');

			$jmlMhs = $this->Mod_crud->countData('row','*','t_mahasiswa'); //jumlah mahasiswa
			$jmlProject = $this->Mod_crud->countData('row','*','t_project'); //jumlah project
			$jmlScope = $this->Mod_crud->countData('row','*','t_project_scope'); //jumlah project scope

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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/plugins/visualization/echarts/echarts.min.js",
						"dashboards/js/pages/index-script.js",
					)
				),
				'titleWeb' 	=> 'Home | CBN Internship',
				'breadcrumb'=> explode(',', 'Dashboard, Main Page'),
				'dtaccount' => $getaccount,
				'dtscope'	=> $getscope,
				'dtmhs'		=> $dataMhs,
				'dtprj'		=> $dataProject,
				'dtscp'		=> $dataScope,
				'dtpersen'	=> $applyPersen,
				'dtjumlah'	=> $applyJumlah,
				'dtprogress'=> $progressProject,
				'jmlMhs'	=> $jmlMhs,
				'jmlProject'=> $jmlProject,
				'jmlScope'	=> $jmlScope,

			);
			$this->render('dashboard', 'index', $data);//view index

		}elseif ($this->session->userdata('userlog')['sess_role']==22) {//untuk role id = 22 admin department
			$deptID = $this->session->userdata('userlog')['sess_deptID'];//get session id department
			$usrID = $this->session->userdata('userlog')['sess_usrID'];//get session user id
			qrysession();
			//total apply perdepartment
			$applyJumlah = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID)),0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.deptID = "'.$deptID.'" AND t_project_scope.isApproved = "Y" GROUP BY t_project_scope.projectScope');
			//apply persen perdepartment
			$applyPersen = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID) / (SELECT COUNT(*) FROM `t_project_scope_temp`))*100,0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.deptID = "'.$deptID.'" GROUP BY t_project_scope.projectScope');
			//scope per department
			$progressProject = $this->Mod_crud->qry('result','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value, ps.projectScope as label FROM t_project_scope as ps LEFT JOIN t_workscope as ws ON ps.projectScopeID = ws.projectScopeID LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID WHERE ps.deptID = "'.$deptID.'" GROUP BY ps.projectScope');
			//ambil data scope per department
			$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null, null, array('deptID = "'.$deptID.'"','isApproved = "P"'), null, array('projectScopeID ASC'));

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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/plugins/visualization/echarts/echarts.min.js",
						"dashboards/js/pages/index-script.js",
					)
				),
				'titleWeb' 		=> 'Home | CBN Internship',
				'breadcrumb' 	=> explode(',', 'Dashboard, Main Page'),
				'dtpersen'		=> $applyPersen,
				'dtjumlah'		=> $applyJumlah,
				'dtprogress'	=> $progressProject,
				'dtscope'		=> $getscope,
			);
			$this->render('dashboard', 'indexAdm', $data);//view load indexAdm
			
		}elseif ($this->session->userdata('userlog')['sess_role']==33) {//untuk role id 33 admin campus
			qrysession();
			$universityID = $this->session->userdata('userlog')['sess_univID'];//get session id unversity
			//jumlah mahasiswa
			$jmlMhs = $this->Mod_crud->countData('row','*','t_mahasiswa',null,null,null,array('universityID = "'.$universityID.'"'));
			//jumlah dosen
			$jmlDsn = $this->Mod_crud->countData('row','*','t_dosen',null,null,null,array('universityID = "'.$universityID.'"'));
			//mahasiswa per fakultas
			$mhsPerFaculty = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(mhs.mahasiswaID)),0) as value, us.facultyName as label FROM `t_faculty` as us LEFT JOIN `t_mahasiswa` as mhs ON mhs.facultyID = us.facultyID WHERE mhs.universityID = "'.$universityID.'" GROUP BY us.facultyID');
			//dosen per fakultas
			$dsnPerFaculty = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(mhs.dosenID)),0) as value, us.facultyName as label FROM `t_faculty` as us LEFT JOIN `t_dosen` as mhs ON mhs.facultyID = us.facultyID WHERE mhs.universityID = "'.$universityID.'" GROUP BY us.facultyID');
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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/plugins/visualization/echarts/echarts.min.js",
						"dashboards/js/pages/index-script.js",
					)
				),
				'titleWeb' 	=> 'Home | CBN Internship',
				'breadcrumb'=> explode(',', 'Dashboard, Main Page'),
				'dtjml'	=> $jmlMhs,
				'mhsFac' => $mhsPerFaculty,
				'dsjml' => $jmlDsn,
				'dsnFac' => $dsnPerFaculty,
			);
			$this->render('dashboard', 'indexAdmcampus', $data);//view load indexCampus
			
		}elseif ($this->session->userdata('userlog')['sess_role']==44) {//untuk role id = 44 untuk dosen
			qrysession();
			$universityID = $this->session->userdata('userlog')['sess_univID'];
			$jmlMhs = $this->Mod_crud->countData('row','*','t_mahasiswa',null,null,null,array('universityID = "'.$universityID.'"'));
			$jmlDsn = $this->Mod_crud->countData('row','*','t_dosen',null,null,null,array('universityID = "'.$universityID.'"'));
			$mhsPerFaculty = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(mhs.mahasiswaID)),0) as value, us.facultyName as label FROM `t_faculty` as us LEFT JOIN `t_mahasiswa` as mhs ON mhs.facultyID = us.facultyID WHERE mhs.universityID = "'.$universityID.'" GROUP BY us.facultyID');
			$dsnPerFaculty = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(mhs.dosenID)),0) as value, us.facultyName as label FROM `t_faculty` as us LEFT JOIN `t_dosen` as mhs ON mhs.facultyID = us.facultyID WHERE mhs.universityID = "'.$universityID.'" GROUP BY us.facultyID');
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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/plugins/visualization/echarts/echarts.min.js",
						"dashboards/js/pages/index-script.js",
					)
				),
				'titleWeb' 	=> 'Home | CBN Internship',
				'breadcrumb'=> explode(',', 'Dashboard, Main Page'),
				'dtjml'	=> $jmlMhs,
				'mhsFac' => $mhsPerFaculty,
				'dsjml' => $jmlDsn,
				'dsnFac' => $dsnPerFaculty,
			);
			$this->render('dashboard', 'indexDosen', $data);//view load indexDosen
			
		}else{//trakhir untuk role id 55 mahasiswa
			$id = $this->session->userdata('userlog')['sess_usrID'];
			qrysession();
			//get progress workscope
			$getpersen = $this->Mod_crud->qry('row','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value, ws.projectScopeID as id  FROM t_workscope as ws LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID WHERE ws.mahasiswaID = "'.$id.'" GROUP BY ws.mahasiswaID');
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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/plugins/visualization/echarts/echarts.min.js",
						"dashboards/js/pages/index-script.js",
						////////////////////////////////////////////////////////////
						"dashboards/js/plugins/ui/fullcalendar/fullcalendar.min.js",

						"dashboards/js/pages/timeline.js",
					)
				),
				'titleWeb' 	=> 'Home | CBN Internship',
				'breadcrumb'=> explode(',', 'Dashboard, Main Page'),
				'dtpersen' 	=> $getpersen,
			);
			$this->render('dashboard', 'indexMhs', $data);//view load indexMhs

		}
		
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
