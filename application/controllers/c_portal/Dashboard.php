<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Dashboard extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{	
		if ($this->session->userdata('login')['sess_role']==11) {
		$getaccount = $this->Mod_crud->getData('result', '*', 't_login', null, null, null,array('passworD = "null"'));
		$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null, null, array('isApproved = "P"'), null, array('projectScopeID ASC'));
		$getlog = $this->Mod_crud->getData('result','*','t_log_activity','30',null,null,null,null,array('logID DESC'));
		$jmlmhs = $this->Mod_crud->countData('result','*','t_mahasiswa');
		$jmldsn = $this->Mod_crud->countData('result','*','t_dosen');
		$jmlprj = $this->Mod_crud->countData('result','*','t_project');
		$jmlscp = $this->Mod_crud->countData('result','*','t_project_scope');
		$chart1 = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_mahasiswa.universityID) / (SELECT COUNT(*) FROM `t_mahasiswa`))*100,0) as value, universityName as label FROM `t_university`LEFT JOIN t_mahasiswa ON t_mahasiswa.universityID = t_university.universityID GROUP BY t_university.universityName');
		$chart2 = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID) / (SELECT COUNT(*) FROM `t_project_scope_temp`))*100,0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID GROUP BY t_project_scope.projectScope');
		$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css",
							"dashboard/plugins/morris/morris.css"
						)
				),
			'_JS' => generate_js(array(
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/alert/sweetalert.min.js",
							"dashboard/alert/sweetalert.js",
							"dashboard/plugins/morris/raphael.min.js",
							"dashboard/plugins/morris/morris.min.js",
							"dashboard/plugins/highlight/highlight.common.js",
							"dashboard/js/demo/render.highlight.js"
						)
				),
				'webTitle'  => 'Website Portal Internship',
				'pageTitle' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'breadcrumb' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'jmlmhs' 	=> $jmlmhs,
				'jmlprj' 	=> $jmlprj,
				'jmldsn' 	=> $jmldsn,
				'jmlscp'	=> $jmlscp,
				'dtaccount' => $getaccount,
				'dtscope'	=> $getscope,
				'dtlog'		=> $getlog,
				'dtchart1'	=> json_encode($chart1),
				'dtchart2'	=> json_encode($chart2)
			);
		$this->render('dashboard', 'pages/index', $data);
		}elseif ($this->session->userdata('login')['sess_role']==22) {
			$deptID = $this->session->userdata('login')['sess_deptID'];
			$usrID = $this->session->userdata('login')['sess_usrID'];
			$chart1 = $this->Mod_crud->qry('result','SELECT ROUND((COUNT(t_project_scope_temp.projectScopeID) / (SELECT COUNT(*) FROM `t_project_scope_temp`))*100,0) as value, projectScope as label FROM `t_project_scope`LEFT JOIN t_project_scope_temp ON t_project_scope_temp.projectScopeID = t_project_scope.projectScopeID WHERE t_project_scope.deptID = "'.$deptID.'" GROUP BY t_project_scope.projectScope');
			$getlog = $this->Mod_crud->getData('result','*','t_log_activity','30',null,null,array('logUsrID = "'.$usrID.'"'),null,array('logID DESC'));

			$chart2 = $this->Mod_crud->qry('result','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value, ps.projectScope as label FROM t_project_scope as ps LEFT JOIN t_workscope as ws ON ps.projectScopeID = ws.projectScopeID LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID WHERE ps.deptID = "'.$deptID.'" GROUP BY ps.projectScope');

			$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css",
							"dashboard/plugins/morris/morris.css"
						)
				),
			'_JS' => generate_js(array(
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/alert/sweetalert.min.js",
							"dashboard/alert/sweetalert.js",
							"dashboard/plugins/morris/raphael.min.js",
							"dashboard/plugins/morris/morris.min.js",
							"dashboard/plugins/highlight/highlight.common.js",
							"dashboard/js/demo/render.highlight.js"
						)
				),
				'webTitle'  => 'Website Portal Internship',
				'pageTitle' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'breadcrumb' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'dtlog'		=> $getlog,
				'dtchart1'	=> json_encode($chart1),
				'dtchart2'	=> json_encode($chart2)
			);
		$this->render('dashboard', 'pages/index_admin', $data);
		}elseif ($this->session->userdata('login')['sess_role']==33) {
			$usrID = $this->session->userdata('login')['sess_usrID'];
			$getlog = $this->Mod_crud->getData('result','*','t_log_activity','30',null,null,array('logUsrID = "'.$usrID.'"'),null,array('logID DESC'));
			$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css",
							"dashboard/plugins/morris/morris.css"
						)
				),
			'_JS' => generate_js(array(
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/alert/sweetalert.min.js",
							"dashboard/alert/sweetalert.js",
							"dashboard/plugins/morris/raphael.min.js",
							"dashboard/plugins/morris/morris.min.js",
							"dashboard/plugins/highlight/highlight.common.js",
							"dashboard/js/demo/render.highlight.js"
						)
				),
				'webTitle'  => 'Website Portal Internship',
				'pageTitle' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'breadcrumb' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'dtlog'		=> $getlog
			);
		$this->render('dashboard', 'pages/index_university', $data);
		}elseif ($this->session->userdata('login')['sess_role']==44) {
			$usrID = $this->session->userdata('login')['sess_usrID'];
			$getlog = $this->Mod_crud->getData('result','*','t_log_activity','30',null,null,array('logUsrID = "'.$usrID.'"'),null,array('logID DESC'));
			$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css",
							"dashboard/plugins/morris/morris.css"
						)
				),
			'_JS' => generate_js(array(
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/alert/sweetalert.min.js",
							"dashboard/alert/sweetalert.js",
							"dashboard/plugins/morris/raphael.min.js",
							"dashboard/plugins/morris/morris.min.js",
							"dashboard/plugins/highlight/highlight.common.js",
							"dashboard/js/demo/render.highlight.js"
						)
				),
				'webTitle'  => 'Website Portal Internship',
				'pageTitle' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'breadcrumb' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'dtlog'		=> $getlog,
			);
		$this->render('dashboard', 'pages/index_dosen', $data);
		}elseif ($this->session->userdata('login')['sess_role']==55) {
			$id = $this->session->userdata('login')['sess_usrID'];
			$getlog = $this->Mod_crud->getData('result','*','t_log_activity','30',null,null,array('logUsrID = "'.$id.'"'),null,array('logID DESC'));
			$get = $this->Mod_crud->getData('result', '*', 't_workscope', null, null,null, array('mahasiswaID = "'.$id.'"'));
			if ($get) {
				foreach ($get as $key) {
					$workscopeID = $key->workscopeID;
				}
			}else{
				$workscopeID = '';
			}
			$getnotice = $this->Mod_crud->getData('result', 'nc.*,adm.deptID', 't_notice nc', null, null, array('t_admin adm'=>'nc.createdBY = adm.adminID') ,null,null,array('noticeID DESC'));
			$getask = $this->Mod_crud->getData('result','*','t_task',null,null,null,array('workscopeID = "'.$workscopeID.'"'),null,array('startDate ASC'));

			$getpersen = $this->Mod_crud->qry('row','SELECT COALESCE(ROUND(((SELECT COUNT(taskID) FROM `t_task` WHERE (statusTask = "done" OR statusTask = "done-delay") AND (workscopeID = ws.workscopeID)) / (SELECT COUNT(*) FROM `t_task` WHERE workscopeID = ws.workscopeID))*100,0),0) as value  FROM t_workscope as ws LEFT JOIN t_task as ts ON ws.workscopeID = ts.workscopeID WHERE ws.mahasiswaID = "'.$id.'"');

			$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css",
							"dashboard/plugins/morris/morris.css"
						)
				),
			'_JS' => generate_js(array(
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/alert/sweetalert.min.js",
							"dashboard/alert/sweetalert.js",
							"dashboard/plugins/morris/raphael.min.js",
							"dashboard/plugins/morris/morris.min.js",
							"dashboard/plugins/highlight/highlight.common.js",
							"dashboard/js/demo/render.highlight.js"
						)
				),
				'webTitle'  => 'Website Portal Internship',
				'pageTitle' => explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'breadcrumb'=> explode(',', 'Dashboard, '.what_role($this->session->userdata('login')['sess_role']).''),
				'dtlog'		=> $getlog,
				'dtask' 	=> $getask,
				'dtpersen'	=> $getpersen,
				'dtnotice'	=> $getnotice
			);
		$this->render('dashboard', 'pages/index_mhs', $data);
		}
	}
	
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/staff/Dashboard.php */
