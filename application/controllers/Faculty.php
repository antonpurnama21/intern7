<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Faculty extends CommonDash {
//controller fakultas
	public function __construct()
	{
		parent::__construct();
	}
	//index fakultas
	public function index()
	{
		//generate js 
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
			'titleWeb' => "Faculty | CBN Internship",//title web aplikasi
			'breadcrumb' => explode(',', 'Data,Faculty'),//bread crumb
			//ambil data fakultas
			'dMaster' => $this->Mod_crud->getData('result','*', 't_faculty'),
		);
		$this->render('dashboard', 'pages/faculty/index', $data);//load view fakultas index
	}

	public function modalAdd(){//modal tambar
		$data = array(
				'modalTitle' => 'Add Faculty ',//modal title
				'formAction' => base_url('faculty/save'),//aksi form modal
				'Req' => ''
			);
		$this->load->view('pages/faculty/form', $data);//view modal form
	}

	public function save(){//aksi tambah fakultas
		//cek duplikasi nama fakultas
		$cek = $this->Mod_crud->checkData('facultyName', 't_faculty', array('facultyName = "'.$this->input->post('Facultyname').'"'));
		if ($cek){//jika ada
			echo json_encode(array('code' => 256, 'message' => 'Faculty has been registered'));
		}else{
			//generate fakultas id
			$id 	= $this->Mod_crud->autoNumber('facultyID','t_faculty','FAC-',2);
			//simpan data fakultas
			$save = $this->Mod_crud->insertData('t_faculty', array(
						'facultyID' 		=> $id,
						'facultyName' 		=> $this->input->post('Facultyname')
           			)
           		);
			//log simpan fakultas
			helper_log('add','Add New Faculty ( '.$this->input->post('Facultyname').' )',$this->session->userdata('userlog')['sess_usrID']);
			//set notifikasi
			create_notification('New','Faculty',$this->input->post('Facultyname'),'faculty/index');
			if ($save){//jika bernilai true
				//set alert
				$this->alert->set('bg-success', "Insert success ! ");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function modalEdit(){//modal edit
		$ID = explode('~',$this->input->post('id'));//get id
		$data = array(
				'modalTitle' => 'Edit '.$ID[1],//modal title
				//get data by id
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_faculty', null, null, null, array('facultyID = "'.$ID[0].'"')),
				'formAction' => base_url('faculty/edit'), //aksi form modal
				'Req' => ''
			);
		$this->load->view('pages/faculty/form', $data);//view load modal form
	}

	public function edit(){//aksi edit fakultas
		//cek duplikasi nama yang sama
		$cek = $this->Mod_crud->checkData('facultyName', 't_faculty', array('facultyName = "'.$this->input->post('Facultyname').'"', 'facultyID != "'.$this->input->post('Facultyid').'"'));
		if ($cek){//jika cek bernilai true
			echo json_encode(array('code' => 256, 'message' => 'Faculty has been registered'));
		}else{
			//simpan perubahan
			$update = $this->Mod_crud->updateData('t_faculty', array(
						'facultyName'	=> $this->input->post('Facultyname'),
           			), array('facultyID ' => $this->input->post('Facultyid'))
           		);
			//log perubahan fakultas
			helper_log('edit','Edit Faculty ( '.$this->input->post('Facultyname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($update){//jika bernilai true
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){//hapus data fakultas
		//hapus fakultas
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