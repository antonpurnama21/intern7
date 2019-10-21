<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Dashboard extends CommonDash {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if ($this->session->userdata('userlog')['sess_role']==11) {
			qrysession();
			$getaccount = $this->Mod_crud->getData('result', '*', 't_login', null, null, null,array('passworD = "null"'));
			$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null, null, array('isApproved = "P"'), null, array('projectScopeID ASC'));
			$dataMhs = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(mhs.mahasiswaID)),0) as value, us.universityName as label FROM `t_university` as us LEFT JOIN t_mahasiswa as mhs ON mhs.universityID = us.universityID GROUP BY us.universityName');
			$dataProject = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(b.projectID)),0) as value, a.deptName as label FROM `t_department` as a LEFT JOIN `t_project` as b ON b.deptID = a.deptID GROUP BY a.deptName');

			$dataScope = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(b.projectScopeID)),0) as value, a.deptName as label FROM `t_department` as a LEFT JOIN `t_project_scope` as b ON b.deptID = a.deptID GROUP BY a.deptName');

			$applyJumlah = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID)),0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.isApproved = "Y" GROUP BY t_project_scope.projectScope');

			$applyPersen = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID) / (SELECT COUNT(*) FROM `t_project_scope_temp`))*100,0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID GROUP BY t_project_scope.projectScope');

			$progressProject = $this->Mod_crud->qry('result','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value, ps.projectScope as label FROM t_project_scope as ps LEFT JOIN t_workscope as ws ON ps.projectScopeID = ws.projectScopeID LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID GROUP BY ps.projectScope');

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

			);
			$this->render('dashboard', 'index', $data);

		}elseif ($this->session->userdata('userlog')['sess_role']==22) {
			$deptID = $this->session->userdata('userlog')['sess_deptID'];
			$usrID = $this->session->userdata('userlog')['sess_usrID'];
			qrysession();
			$applyJumlah = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID)),0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.deptID = "'.$deptID.'" AND t_project_scope.isApproved = "Y" GROUP BY t_project_scope.projectScope');
			
			$applyPersen = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID) / (SELECT COUNT(*) FROM `t_project_scope_temp`))*100,0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.deptID = "'.$deptID.'" GROUP BY t_project_scope.projectScope');

			$progressProject = $this->Mod_crud->qry('result','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value, ps.projectScope as label FROM t_project_scope as ps LEFT JOIN t_workscope as ws ON ps.projectScopeID = ws.projectScopeID LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID WHERE ps.deptID = "'.$deptID.'" GROUP BY ps.projectScope');

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
			$this->render('dashboard', 'indexAdm', $data);
			
		}elseif ($this->session->userdata('userlog')['sess_role']==33) {
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
			$this->render('dashboard', 'indexAdmcampus', $data);
			
		}elseif ($this->session->userdata('userlog')['sess_role']==44) {
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
			$this->render('dashboard', 'indexDosen', $data);
			
		}else{
			$id = $this->session->userdata('userlog')['sess_usrID'];
			qrysession();
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
			$this->render('dashboard', 'indexMhs', $data);

		}
		
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
