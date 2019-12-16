<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class University extends CommonDash {
//controller universitas
	public function __construct()
	{
		parent::__construct();
	}

	public function index()//index university
	{
		$data = array(//generate js
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
						"dashboards/js/pages/university-index-script.js",
				)
			),
			'titleWeb' => "University | CBN Internship",//title web
			'breadcrumb' => explode(',', 'Data,University'),//bread crumb
			//ambil data universitas
			'dMaster' => $this->Mod_crud->getData('result','*', 't_university'),
		);
		$this->render('dashboard', 'pages/university/index', $data);//load view universitas index
	}

	public function modalAdd(){//modal tambah universitas
		$data = array(
				'modalTitle' => 'Add University ',//modal title
				'formAction' => base_url('university/save'),//url aksi
				'Req' => ''
			);
		$this->load->view('pages/university/form', $data);//load view modal add
	}

	public function save(){//aksi simpan
		//cek duplikasi universitas
		$cek = $this->Mod_crud->checkData('universityName', 't_university', array('universityName = "'.$this->input->post('Universityname').'"'));
		if ($cek){//jika ada
			echo json_encode(array('code' => 256, 'message' => 'University has been registered'));
		}else{
			//generate id univeristas
			$id 	= $this->Mod_crud->autoNumber('universityID','t_university','MUV-',3);
			//simpan universitas
			$save = $this->Mod_crud->insertData('t_university', array(
						'universityID' 		=> $id,
						'universityName' 	=> $this->input->post('Universityname'),
						'mou'				=> $this->input->post('Mou'),
						'createdBY'			=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 		=> date('Y-m-d H:i:s')
           			)
           		);
			//log tambah universitas
			helper_log('add','Add New University ( '.$this->input->post('Universityname').' )',$this->session->userdata('userlog')['sess_usrID']);
			//notifikasi
			create_notification('New','University',$this->input->post('Universityname'),'university/index');
			if ($save){//jika bernilai true
				//set alert
				$this->alert->set('bg-success', "Insert success ! ");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function modalEdit(){//modal edit universitas
		$ID = explode('~',$this->input->post('id'));//get id
		$data = array(
				'modalTitle' => 'Edit '.$ID[1],//title modal
				//ambil data universitas
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_university', null, null, null, array('universityID = "'.$ID[0].'"')),
				'formAction' => base_url('university/edit'),//url edit
				'Req' => ''
			);
		$this->load->view('pages/university/form', $data);//load view universitas form
	}

	public function edit(){//aksi edit universitas
		//cek duplikasi universitas
		$cek = $this->Mod_crud->checkData('universityName', 't_university', array('universityName = "'.$this->input->post('Universityname').'"', 'universityID != "'.$this->input->post('Universityid').'"'));
		if ($cek){//jika ada 
			echo json_encode(array('code' => 256, 'message' => 'University has been registered'));
		}else{
			//simpan perubahan
			$update = $this->Mod_crud->updateData('t_university', array(
						'universityName'	=> $this->input->post('Universityname'),
						'mou'				=> $this->input->post('Mou'),
						'createdBY'			=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 		=> date('Y-m-d H:i:s')
           			), array('universityID ' => $this->input->post('Universityid'))
           		);
			//log perubahan universitas
			helper_log('edit','Edit University ( '.$this->input->post('Universityname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($update){//jika bernilai true
				//set alert
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){//hapus universitas
		//delete universitas
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

}

/* End of file university.php */
/* Location: ./application/controllers/university.php */