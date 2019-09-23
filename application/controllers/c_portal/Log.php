<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Log extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$get = $this->Mod_crud->getData('result','*','t_log_activity',null,null,null,null,null,array('logID DESC'));

		$data = array(
				'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css"
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
							"dashboard/alert/sweetalert.js"
						)
				),
				'webTitle' 		=> 'Log Activity',
				'pageTitle' 	=> explode(',', 'Log Activity'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Log Activity'),
				'data'			=> $get
			);
		$this->render('dashboard' , 'pages/log/index',$data);
	}

	function delete(){
		$table = $this->input->post('table');
		$delete = $this->Mod_crud->delete_all($table);
		helper_log('delete','Deleted All Activity, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('log');
	}

}

/* End of file setting.php */
/* Location: ./application/controllers/setting.php */