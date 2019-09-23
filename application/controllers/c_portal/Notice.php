<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class notice extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$getnot = $this->Mod_crud->getData('result','*','t_notice');

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
				'webTitle' 		=> 'Notice | Website Portal Internship',
				'pageTitle' 	=> explode(',', 'Master, Notice'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Master, Notice'),
				'dtnotice'		=> $getnot
			);
		$this->render('dashboard' , 'pages/notice/index',$data);
	}

	public function save()
	{
		$name = $this->input->post('title');
		if ($this->Mod_crud->getData('result','title','t_notice',null,null,null,array('title = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>notice already registered !</p>
                </div>');
			redirect('notice');
		}else{
		$code = $this->Mod_crud->autoNumber('noticeID','t_notice','NOTE-',3);
		$save = $this->Mod_crud->insertData('t_notice', array(
				'noticeID'		=> $code,
           		'title' 		=> $this->input->post('title'),
           		'notice'		=> $this->input->post('notice'),
           		'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added New notice, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>notice added !</p>
		            </div>');
           		redirect('notice');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('notice');
           	}
        }
	}

	public function edit()
	{
		$id = $this->input->post('noticeID');
		
		$edit = $this->Mod_crud->updateData('t_notice', array(
           				'title' 		=> $this->input->post('title'),
           				'notice'		=> $this->input->post('notice'),
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('noticeID' => $id)
           	);
		helper_log('edit','Edited notice, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>notice updated !</p>
		        </div>');
           		redirect('notice');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('notice');
         }
	}

	function delete(){
		$id = $this->input->post('id');
		$delete = $this->Mod_crud->deleteData('t_notice',array('noticeID'=>$id));
		helper_log('delete','Deleted notice, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('notice');
	}

}

/* End of file notice.php */
/* Location: ./application/controllers/notice.php */