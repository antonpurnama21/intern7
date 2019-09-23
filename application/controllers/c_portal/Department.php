<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Department extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$getdept = $this->Mod_crud->getData('result','*','t_department');

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
				'webTitle' 		=> 'Department | Website Portal Internship',
				'pageTitle' 	=> explode(',', 'Master, Department'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Master, Department'),
				'dtdept'		=> $getdept
			);
		$this->render('dashboard' , 'pages/department/index',$data);
	}

	public function save()
	{
		$name = $this->input->post('deptName');
		if ($this->Mod_crud->getData('result','deptName','t_department',null,null,null,array('deptName = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Department already registered !</p>
                </div>');
			redirect('department');
		}else{
		$code = $this->Mod_crud->autoNumber('deptID','t_department','MDT-',3);
		$save = $this->Mod_crud->insertData('t_department', array(
				'deptID'		=> $code,
           		'deptName' 		=> $this->input->post('deptName'),
           		'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added New Department, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Department added !</p>
		            </div>');
           		redirect('department');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('department');
           	}
        }
	}

	public function edit()
	{
		$id = $this->input->post('deptID');
		
		$edit = $this->Mod_crud->updateData('t_department', array(
           				'deptName' 		=> $this->input->post('deptName'),
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('deptID' => $id)
           	);
		helper_log('edit','Edited Department, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Department updated !</p>
		        </div>');
           		redirect('department');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('department');
         }
	}

	function delete(){
		$id = $this->input->post('id');
		$delete = $this->Mod_crud->deleteData('t_department',array('deptID'=>$id));
		helper_log('delete','Deleted Department, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('department');
	}

}

/* End of file department.php */
/* Location: ./application/controllers/department.php */