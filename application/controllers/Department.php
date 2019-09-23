<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Department extends CommonDash {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_crud');
	}

	public function index()
	{
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
		);
		$this->render('dashboard', 'pages/department/index', $data);
	}

	public function modalAdd(){
		$data = array(
				'modalTitle' => 'Add Department ',
				'formAction' => base_url('department/save'),
				'Req' => ''
			);
		$this->load->view('pages/department/form', $data);
	}

	public function save(){
		$cek = $this->Mod_crud->checkData('deptName', 't_department', array('deptName = "'.$this->input->post('Deptname').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Department has been registered'));
		}else{

			$id 	= $this->Mod_crud->autoNumber('deptID','t_department','MDT-',3);

			$save = $this->Mod_crud->insertData('t_department', array(
						'deptID' 		=> $id,
						'deptName' 		=> $this->input->post('Deptname'),
						'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			)
           		);
			helper_log('add','Add New Department ( '.$this->input->post('Deptname').' )',$this->session->userdata('userlog')['sess_usrID']);
			if ($save){
				$this->alert->set('bg-success', "Insert success ! ");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function modalEdit(){
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Edit '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_department', null, null, null, array('deptID = "'.$ID[0].'"')),
				'formAction' => base_url('department/edit'),
				'Req' => ''
			);
		$this->load->view('pages/department/form', $data);
	}

	public function edit(){
		$cek = $this->Mod_crud->checkData('deptName', 't_department', array('deptName = "'.$this->input->post('Deptname').'"', 'deptID != "'.$this->input->post('Deptid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Department has been registered'));
		}else{

			$update = $this->Mod_crud->updateData('t_department', array(
						'deptName'	=> $this->input->post('Deptname'),
						'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			), array('deptID ' => $this->input->post('Deptid'))
           		);
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
	public function delete(){
		$query 		= $this->Mod_crud->deleteData('t_department', array('deptID' => $this->input->post('id')));
		if ($query){
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

	public function getList()
	{
		$res = array();
		$department = $this->Mod_crud->getData('result','*', 't_department');
		if (!empty($department)) {
			$no = 0;
			foreach ($department as $key) {
				$no++;
				array_push($res, array(
							'',
							$no,
							$key->deptID,
							$key->deptName,
							'
							<a style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal(`'.base_url("department/modalEdit").'`, `'.$key->deptID.'~'.$key->deptName.'`, `editdepartment`);"><i class="icon-quill4"></i> Edit</a>
							<a style="margin-bottom: 5px" class="btn btn-danger" onclick="confirms(`Delete`,` '.$key->deptName.'?`,`'.base_url("department/delete").'`,`'.$key->deptID.'`)"><i class="icon-trash"></i> Delete</a>
							'
							)
				);
			}
		}
		echo json_encode($res);
	}

}

/* End of file department.php */
/* Location: ./application/controllers/department.php */