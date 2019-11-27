<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Faculty extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
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
						"dashboards/js/pages/faculty-index-script.js",
				)
			),
			'titleWeb' => "Faculty | CBN Internship",
			'breadcrumb' => explode(',', 'Data,Faculty'),
			'dMaster' => $this->Mod_crud->getData('result','*', 't_faculty'),
		);
		$this->render('dashboard', 'pages/faculty/index', $data);
	}

	public function modalAdd(){
		$data = array(
				'modalTitle' => 'Add Faculty ',
				'formAction' => base_url('faculty/save'),
				'Req' => ''
			);
		$this->load->view('pages/faculty/form', $data);
	}

	public function save(){
		$cek = $this->Mod_crud->checkData('facultyName', 't_faculty', array('facultyName = "'.$this->input->post('Facultyname').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Faculty has been registered'));
		}else{

			$id 	= $this->Mod_crud->autoNumber('facultyID','t_faculty','FAC-',2);

			$save = $this->Mod_crud->insertData('t_faculty', array(
						'facultyID' 		=> $id,
						'facultyName' 		=> $this->input->post('Facultyname')
           			)
           		);
			helper_log('add','Add New Faculty ( '.$this->input->post('Facultyname').' )',$this->session->userdata('userlog')['sess_usrID']);
			if ($save){
				$this->alert->set('bg-success', "Insert success ! ");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send'));
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
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_faculty', null, null, null, array('facultyID = "'.$ID[0].'"')),
				'formAction' => base_url('faculty/edit'),
				'Req' => ''
			);
		$this->load->view('pages/faculty/form', $data);
	}

	public function edit(){
		$cek = $this->Mod_crud->checkData('facultyName', 't_faculty', array('facultyName = "'.$this->input->post('Facultyname').'"', 'facultyID != "'.$this->input->post('Facultyid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Faculty has been registered'));
		}else{

			$update = $this->Mod_crud->updateData('t_faculty', array(
						'facultyName'	=> $this->input->post('Facultyname'),
           			), array('facultyID ' => $this->input->post('Facultyid'))
           		);
			helper_log('edit','Edit Faculty ( '.$this->input->post('Facultyname').' )',$this->session->userdata('userlog')['sess_usrID']);

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
		$query 		= $this->Mod_crud->deleteData('t_faculty', array('facultyID' => $this->input->post('id')));
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

}

/* End of file faculty.php */
/* Location: ./application/controllers/faculty.php */