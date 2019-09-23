<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class University extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$getuniversity = $this->Mod_crud->getData('result','*','t_university');

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
				'webTitle' 		=> 'Universities | Website Portal Internship',
				'pageTitle' 	=> explode(',', 'Master, Universities'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Master, Universities'),
				'dtuniversity'		=> $getuniversity
			);
		$this->render('dashboard' , 'pages/university/index',$data);
	}

	public function save()
	{
		$name = $this->input->post('universityName');
		if ($this->Mod_crud->getData('result','universityName','t_university',null,null,null,array('universityName = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>University already registered !</p>
                </div>');
			redirect('university');
		}else{
		$code = $this->Mod_crud->autoNumber('universityID','t_university','MUV-',3);
		$save = $this->Mod_crud->insertData('t_university', array(
				'universityID'		=> $code,
           		'universityName'	=> $this->input->post('universityName'),
           		'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added New University, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>University added !</p>
		            </div>');
           		redirect('university');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('university');
           	}
        }
	}

	public function edit()
	{
		$id = $this->input->post('universityID');
		
		$edit = $this->Mod_crud->updateData('t_university', array(
           				'universityName' 	=> $this->input->post('universityName'),
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('universityID' => $id)
           	);
		helper_log('edit','Edited University, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>University updated !</p>
		        </div>');
           		redirect('university');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('university');
         }
	}

	function delete(){
		$id = $this->input->post('id');
		$delete = $this->Mod_crud->deleteData('t_university',array('universityID'=>$id));
		helper_log('delete','Deleted University, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('university');
	}

}

/* End of file university.php */
/* Location: ./application/controllers/university.php */