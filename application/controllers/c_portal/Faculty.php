<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Faculty extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$get = $this->Mod_crud->getData('result','*','t_faculty');

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
				'webTitle' 		=> 'Faculty',
				'pageTitle' 	=> explode(',', 'Master, faculty'),
				'breadcrumb' 	=> explode(',', 'Dashboard, master, faculty'),
				'data'			=> $get
			);
		$this->render('dashboard' , 'pages/faculty/index',$data);
	}

	public function save()
	{
		$name = $this->input->post('facultyName');
		if ($this->Mod_crud->getData('result','facultyName','t_faculty',null,null,null,array('facultyName = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Faculty already registered !</p>
                </div>');
			redirect('faculty');
		}else{
		$id 	= $this->Mod_crud->autoNumber('facultyID','t_faculty','FAC-',2);
		$save = $this->Mod_crud->insertData('t_faculty', array(
				'facultyID'		=> $id,
           		'facultyName' 	=> $this->input->post('facultyName')
           		)
           	);
		    helper_log('add','Added New Faculty, '.$id,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Faculty added !</p>
		            </div>');
           		redirect('faculty');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('faculty');
           	}
        }
	}

	public function edit()
	{
		$id = $this->input->post('facultyID');
		
		$edit = $this->Mod_crud->updateData('t_faculty', array(
           				'facultyName' 	=> $this->input->post('facultyName')
           			), array('facultyID' => $id)
           	);
		helper_log('edit','Edited Faculty, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Faculty updated !</p>
		        </div>');
           		redirect('faculty');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('faculty');
         }
	}

	function delete(){
		$id = $this->input->post('id');
		$delete = $this->Mod_crud->deleteData('t_faculty',array('facultyID'=>$id));
		helper_log('delete','Deleted Faculty, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('faculty');
		
	}

}

/* End of file setting.php */
/* Location: ./application/controllers/setting.php */