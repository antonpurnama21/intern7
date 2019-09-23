<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class University extends CommonDash {

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
						"dashboards/js/pages/university-index-script.js",
				)
			),
			'titleWeb' => "University | CBN Internship",
			'breadcrumb' => explode(',', 'Data,University'),
		);
		$this->render('dashboard', 'pages/university/index', $data);
	}

	public function modalAdd(){
		$data = array(
				'modalTitle' => 'Add University ',
				'formAction' => base_url('university/save'),
				'Req' => ''
			);
		$this->load->view('pages/university/form', $data);
	}

	public function save(){
		$cek = $this->Mod_crud->checkData('universityName', 't_university', array('universityName = "'.$this->input->post('Universityname').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'University has been registered'));
		}else{

			$id 	= $this->Mod_crud->autoNumber('universityID','t_university','MUV-',3);

			$save = $this->Mod_crud->insertData('t_university', array(
						'universityID' 		=> $id,
						'universityName' 	=> $this->input->post('Universityname'),
						'createdBY'			=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 		=> date('Y-m-d H:i:s')
           			)
           		);
			helper_log('add','Add New University ( '.$this->input->post('Universityname').' )',$this->session->userdata('userlog')['sess_usrID']);
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
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_university', null, null, null, array('universityID = "'.$ID[0].'"')),
				'formAction' => base_url('university/edit'),
				'Req' => ''
			);
		$this->load->view('pages/university/form', $data);
	}

	public function edit(){
		$cek = $this->Mod_crud->checkData('universityName', 't_university', array('universityName = "'.$this->input->post('Universityname').'"', 'universityID != "'.$this->input->post('Universityid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'University has been registered'));
		}else{

			$update = $this->Mod_crud->updateData('t_university', array(
						'universityName'	=> $this->input->post('Universityname'),
						'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			), array('universityID ' => $this->input->post('Universityid'))
           		);
			helper_log('edit','Edit University ( '.$this->input->post('Universityname').' )',$this->session->userdata('userlog')['sess_usrID']);

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
		$query 		= $this->Mod_crud->deleteData('t_university', array('universityID' => $this->input->post('id')));
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
		$university = $this->Mod_crud->getData('result','*', 't_university');
		if (!empty($university)) {
			$no = 0;
			foreach ($university as $key) {
				$no++;
				array_push($res, array(
							'',
							$no,
							$key->universityID,
							$key->universityName,
							'
							<a style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal(`'.base_url("university/modalEdit").'`, `'.$key->universityID.'~'.$key->universityName.'`, `edituniversity`);"><i class="icon-quill4"></i> Edit</a>
							<a style="margin-bottom: 5px" class="btn btn-danger" onclick="confirms(`Delete`,`Admin campus '.$key->universityName.'?`,`'.base_url("university/delete").'`,`'.$key->universityID.'`)"><i class="icon-trash"></i> Delete</a>
							'
							)
				);
			}
		}
		echo json_encode($res);
	}

}

/* End of file university.php */
/* Location: ./application/controllers/university.php */