<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Logtype extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$get = $this->Mod_crud->getData('result','*','t_log_type');

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
				'webTitle' 		=> 'Log Type',
				'pageTitle' 	=> explode(',', 'Master, Log type'),
				'breadcrumb' 	=> explode(',', 'Dashboard, master, log type'),
				'data'			=> $get
			);
		$this->render('dashboard' , 'pages/logtype/index',$data);
	}

	public function save()
	{
		$name = $this->input->post('typeName');
		if ($this->Mod_crud->getData('result','typeName','t_log_type',null,null,null,array('typeName = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Type Name already registered !</p>
                </div>');
			redirect('logtype');
		}else{
		$id 	= $this->Mod_crud->autoNumber('logTypeID','t_log_type','TYP-',2);
		$save 	= $this->Mod_crud->insertData('t_log_type', array(
				'logTypeID'		=> $id,
           		'typeName' 		=> $this->input->post('typeName')
           		)
           	);
		    helper_log('add','Added New Log type, '.$id,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Log Type added !</p>
		            </div>');
           		redirect('logtype');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('typelog');
           	}
        }
	}

	public function edit()
	{
		$id = $this->input->post('logTypeID');
		
		$edit = $this->Mod_crud->updateData('t_log_type', array(
           				'typeName' 		=> $this->input->post('typeName')
           			), array('logTypeID' => $id)
           	);
		helper_log('edit','Edited Log type, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Log Type updated !</p>
		        </div>');
           		redirect('logtype');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('logtype');
         }
	}

	function delete(){
		$id = $this->input->post('id');
		$delete = $this->Mod_crud->deleteData('t_log_type',array('logTypeID'=>$id));
		helper_log('delete','Deleted Log type, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('logtype');
		
	}

}

/* End of file setting.php */
/* Location: ./application/controllers/setting.php */