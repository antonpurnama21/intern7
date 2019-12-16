<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Department extends CommonDash {
//controller untuk mengelola department
	public function __construct()
	{
		parent::__construct();
	}

	public function index()//halaman index department
	{
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
						"dashboards/js/pages/department-index-script.js",
				)
			),
			'titleWeb' => "Department CBN | CBN Internship",
			'breadcrumb' => explode(',', 'Data,Department'),
			'dMaster' => $this->Mod_crud->getData('result','*', 't_department'),
		);
		$this->render('dashboard', 'pages/department/index', $data);//view load index/department
	}

	public function modalAdd(){//modal tambah department
		$data = array(
				'modalTitle' => 'Add Department ',//title modal
				'formAction' => base_url('department/save'),//aksi form modal
				'Req' => ''//request
			);
		$this->load->view('pages/department/form', $data);//load view modal form
	}

	public function save(){//aksi tambah department
		//cek nama department
		$cek = $this->Mod_crud->checkData('deptName', 't_department', array('deptName = "'.$this->input->post('Deptname').'"'));
		if ($cek){//jika ada
			echo json_encode(array('code' => 256, 'message' => 'Department has been registered'));
		}else{
			//generate id department
			$id 	= $this->Mod_crud->autoNumber('deptID','t_department','MDT-',3);
			//simpan department
			$save = $this->Mod_crud->insertData('t_department', array(
						'deptID' 		=> $id,
						'deptName' 		=> $this->input->post('Deptname'),
						'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			)
           		);
			//log aktivitas
			helper_log('add','Add New Department ( '.$this->input->post('Deptname').' )',$this->session->userdata('userlog')['sess_usrID']);
			//create notifikasi
			create_notification('New','Department',$this->input->post('Deptname'),'department/index');
			if ($save){//jika save bernilai true
				//set alert
				$this->alert->set('bg-success', "Insert success ! ");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function modalEdit(){//modal edit
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Edit '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_department', null, null, null, array('deptID = "'.$ID[0].'"')),//get department by id
				'formAction' => base_url('department/edit'),
				'Req' => ''
			);
		$this->load->view('pages/department/form', $data);
	}

	public function edit(){
		//cek duplikasi nama
		$cek = $this->Mod_crud->checkData('deptName', 't_department', array('deptName = "'.$this->input->post('Deptname').'"', 'deptID != "'.$this->input->post('Deptid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Department has been registered'));
		}else{
			//simpan perubahan
			$update = $this->Mod_crud->updateData('t_department', array(
						'deptName'	=> $this->input->post('Deptname'),
						'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			), array('deptID ' => $this->input->post('Deptid'))
           		);
			//log aktivitas
			helper_log('edit','Edit Department ( '.$this->input->post('Deptname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($update){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){//menghapus data department
		//hapus data department
		$query 		= $this->Mod_crud->deleteData('t_department', array('deptID' => $this->input->post('id')));
		if ($query){//jika bernilai true
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

}

/* End of file department.php */
/* Location: ./application/controllers/department.php */