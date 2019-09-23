<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Mahasiswa extends CommonDash {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_crud');
	}

	public function index()
	{
		if ($this->session->userdata('userlog')['sess_role']==33) {

			$universityID 	= $this->session->userdata('userlog')['sess_univID'];
			$mahasiswa 	= $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.universityID = "'.$universityID.'"'), null, array('m.mahasiswaID ASC'));

		}elseif ($this->session->userdata('userlog')['sess_role']==44) {

			$universityID 	= $this->session->userdata('userlog')['sess_univID'];
			$facultyID 	= $this->session->userdata('userlog')['sess_facID'];
			$mahasiswa	= $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.universityID = "'.$universityID.'"','m.facultyID = "'.$facultyID.'"'), null, array('m.mahasiswaID ASC'));

		}else{

			$mahasiswa = $this->Mod_crud->getData('result', 'm.*, ff.photo, l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), null, null, array('m.mahasiswaID ASC'));
		
		}
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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/mahasiswa-index-script.js",
				)
			),
			'titleWeb' => "Mahasiswa | CBN Internship",
			'breadcrumb' => explode(',', 'Mahasiswa, Mahasiswa List'),
			'dtmahasiswa' => $mahasiswa
		);
		$this->render('dashboard', 'pages/mahasiswa/index', $data);
	}

		public function add()
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
					"dashboards/js/plugins/uploaders/fileinput.min.js",
					"dashboards/js/plugins/pickers/pickadate/picker.js",
					"dashboards/js/plugins/pickers/pickadate/picker.date.js",
					"dashboards/js/plugins/pickers/anytime.min.js",
					"dashboards/js/plugins/forms/validation/validate.min.js",
					"dashboards/js/pages/mahasiswa-script.js",
				)
			),
		    'titleWeb' => "Add Mahasiswa | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Mahasiswa,Add New Mahasiswa'),
		    'actionForm' => base_url('mahasiswa/save'),
		    'buttonForm' => 'Simpan'
		);

		$this->render('dashboard', 'pages/mahasiswa/add', $data);
	}


	public function save(){
		$cekemail = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"'));
		if ($cekemail) {
			echo json_encode(array('code' => 366, 'message' => 'Email has been registered'));
		}else{
			$cekmahasiswa = $this->Mod_crud->checkData('mahasiswaNumber', 't_mahasiswa', array('mahasiswaNumber = "'.$this->input->post('Nim').'"'));
			if ($cekmahasiswa) {
				echo json_encode(array('code' => 367, 'message' => 'NIM has been registered'));
			} else {
			
			$mahasiswaID 	= $this->Mod_crud->autoNumber('mahasiswaID','t_mahasiswa','55',4);

				$savemahasiswa = $this->Mod_crud->insertData('t_mahasiswa', array(
           				'mahasiswaID'		=> $mahasiswaID,
           				'loginID'		=> $mahasiswaID,
           				'universityID' 		=> $this->input->post('Universityid'),
           				'facultyID' 		=> $this->input->post('Facultyid'),
           				'emaiL'			=> $this->input->post('Email'),
           				'mahasiswaNumber'	=> $this->input->post('Nim'),
           				'fullName' 		=> ucwords($this->input->post('Fullname')),
           				'mobilePhone'		=> $this->input->post('Mobilephone'),
           				'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           				'createdTIME'		=> date('Y-m-d H:i:s')
           			)
           		);

	           	$savelogin = $this->Mod_crud->insertData('t_login', array(
					'loginID'		=> $mahasiswaID,
					'roleID'		=> 55,
					'emaiL'			=> $this->input->post('Email'),
					'passworD'		=> 'null',
					'createdTime'	=> date('Y-m-d H:i:s')
					)
				);

			$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$tokeN 	= substr(str_shuffle($set), 0, 55);
			$create = time();
			$exp = 60*60;
			$done = $create+$exp;
			$expired_at = date('Y-m-d H:i:s',$done);

			$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
					'emaiL'		=> $this->input->post('Email'),
					'tokeN'		=> $tokeN,
					'created_at'	=> date('Y-m-d H:i:s'),
					'expired_at'	=> $expired_at
					)
				);

			$config = array(
			  				'protocol' => 'ssmtp',
							'smtp_host' => 'ssl://mail.intern7.iex.or.id',
							'smtp_port' => 465,
							'smtp_user' => 'info@intern7.iex.or.id', // change it to yours
							'smtp_pass' => 'Infocbn123', // change it to yours
					  		//'smtp_username' => 'armg3295',
					  		'mailtype' => 'html',
					  		'charset' => 'iso-8859-1',
					  		'wordwrap' => TRUE
				);

				$message = 	"
							<html>
							<head>
								<title>Account Setup Link</title>
							</head>
							<body>
								<h2>CBN Internship Web Portal</h2>
								<p>Please click the link below to set your password ".base_url('auth/reset/'.$tokeN)." <br/>( warning: this link will expire after one hour )<br/><br/></p>
								<p><hr />Do Not reply to this message<hr /><br/></p>
								<p>CBN Internet<br/>
									PT. Cyberindo Aditama<br/>
									Jalan. HR Rasuna Said Blok X5, No. 13<br/>
									Jakarta Selatan - 12950<br/>
									Telp. (021) 2996-4900<br/>
									Fax : +62 21 574-2481<br/>
									Web : www.cbn.net.id<br/>
								</p>							
							</body>
							</html>
							";
		 		
			    $this->load->library('email', $config);
			    $this->email->set_newline("\r\n");
			    $this->email->from($config['smtp_user']);
			    $this->email->to($this->input->post('Email'));
			    $this->email->subject('Account Setup Link');
			    $this->email->message($message);
			    helper_log('add','Add New Mahasiswa ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($this->email->send()){
				$this->alert->set('bg-success', "Insert success ! Setup link hes been send");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send', 'aksi' => "window.location.href='".base_url('mahasiswa')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function form($id=null)
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
					"dashboards/js/plugins/uploaders/fileinput.min.js",
					"dashboards/js/plugins/pickers/pickadate/picker.js",
					"dashboards/js/plugins/pickers/pickadate/picker.date.js",
					"dashboards/js/plugins/pickers/anytime.min.js",
					"dashboards/js/plugins/forms/validation/validate.min.js",
					"dashboards/js/pages/mahasiswa-script.js",
				)
			),
		    'titleWeb' => "Edit Mahasiswa | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Mahasiswa,Edit Mahasiswa ('.name_mhs($id).')'),
		    'dMaster'	 => $this->Mod_crud->getData('row', 'm.*,ff.photo,ff.resume,ff.academicTranscipt', 't_mahasiswa m', null, null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'), array('m.mahasiswaID = "'.$id.'"')),
			'actionForm' => base_url('mahasiswa/edit'),
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/mahasiswa/form', $data);
	}

	public function edit()
	{
			$cek = $this->Mod_crud->checkData('fullName', 't_mahasiswa', array('fullName = "'.$this->input->post('Fullname').'"', 'mahasiswaID != "'.$this->input->post('Mahasiswaid').'"'));
			if ($cek){
				echo json_encode(array('code' => 368, 'message' => 'Name has been registered'));
			}else{
				$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$this->input->post('Mahasiswaid').'"'));

				if ($_FILES['Photofile']['name'] !== '') {
					if (!empty($getfile->photo)) {
							unlink(FCPATH . $getfile->photo);
						}
					$t = explode(".", $_FILES['Photofile']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' => 'pic_'.$this->input->post('Mahasiswaid').'.'.$ext,
							'upload_path' => 'fileupload/pic_mahasiswa',
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',
							'max_size' => 512,
						);

					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('Photofile')) {
						echo json_encode(array('code' => 370, 'message' => strip_tags($this->upload->display_errors())));
					}else{
						$gbr 	 = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'fileupload/pic_mahasiswa/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 		= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'fileupload/pic_mahasiswa/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$pathPic = 'fileupload/pic_mahasiswa/' . $gbr['file_name'];
				} else {
					$pathPic = $getfile->photo;
				}

				//cv
				if ($_FILES['Cvfile']['name'] !== '') {
					if (!empty($getfile->resume)) {
							unlink(FCPATH . $getfile->resume);	
						}
					$t = explode(".", $_FILES['Cvfile']['name']);
					$ext = end($t);
					$cfgCv= array(
							'file_name' => 'resume_'.$this->input->post('Mahasiswaid').'.'.$ext,
							'upload_path' => 'fileupload/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgCv);
					if (!$this->upload->do_upload('Cvfile')) {
						echo json_encode(array('code' => 371, 'message' => strip_tags($this->upload->display_errors())));
					}
					$file 	= $this->upload->data();
					$pathCv = 'fileupload/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathCv = $getfile->resume;
				}

				//transcipt
				if ($_FILES['Acfile']['name'] !== '') {
					if (!empty($getfile->academicTranscipt)) {
							unlink(FCPATH . $getfile->academicTranscipt);	
						}
					$t = explode(".", $_FILES['Acfile']['name']);
					$ext = end($t);
					$cfgAc= array(
							'file_name' => 'transcipt_'.$this->input->post('Mahasiswaid').'.'.$ext,
							'upload_path' => 'fileupload/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgAc);
					if (!$this->upload->do_upload('Acfile')) {
						echo json_encode(array('code' => 372, 'message' => strip_tags($this->upload->display_errors())));
					}
					$file 	= $this->upload->data();
					$pathAc = 'fileupload/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathAc = $getfile->academicTranscipt;
				}
			
				$updatemahasiswa = $this->Mod_crud->updateData('t_mahasiswa', array(
	           			'universityID' 		=> $this->input->post('Universityid'),
           				'facultyID' 		=> $this->input->post('Facultyid'),
           				'residenceID'		=> $this->input->post('Residenceid'),
           				'mahasiswaNumber'	=> $this->input->post('Nim'),
           				'emaiL'			=> $this->input->post('Email'),
           				'fullName' 		=> ucwords($this->input->post('Fullname')),
           				'birthPlace'		=> $this->input->post('Birthplace'),
           				'birthDate'		=> date_format(date_create($this->input->post('Birthdate_submit')), 'Y-m-d'),
           				'gender'		=> $this->input->post('Gender'),
           				'religion'		=> $this->input->post('Religion'),
           				'city'			=> $this->input->post('City'),
           				'zip'			=> $this->input->post('Zip'),
           				'address'		=> $this->input->post('Address'),
           				'fixedPhone'		=> $this->input->post('Fixedphone'),
           				'mobilePhone'		=> $this->input->post('Mobilephone'),
           				'hobby'			=> $this->input->post('Hobby'),
           				'strength'		=> $this->input->post('Strength'),
           				'weakness'		=> $this->input->post('Weakness'),
           				'organizationExp'	=> $this->input->post('Organizationexp'),
           				'projectEverMade'	=> $this->input->post('Projectevermade'),
           				'semester'		=> $this->input->post('Semester'),
           				'sksTotal'		=> $this->input->post('Skstotal'),
           				'indexTotal'		=> $this->input->post('Indextotal'),
           				'statusActive'		=> '1',
           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			), array('mahasiswaID' => $this->input->post('Mahasiswaid'))
	           	);
				if (empty($getfile)) {
					$updatefile = $this->Mod_crud->insertData('t_mahasiswa_file', array(
	           				'mahasiswaID'		=> $this->input->post('Mahasiswaid'),
	           				'photo' 		=> $pathPic,
	           				'resume'		=> $pathCv,
	           				'academicTranscipt' 	=> $pathAc,
	           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			)
	           		);
				}else{
					$updatefile = $this->Mod_crud->updateData('t_mahasiswa_file', array(
	           				'mahasiswaID'		=> $this->input->post('Mahasiswaid'),
	           				'photo' 		=> $pathPic,
	           				'resume'		=> $pathCv,
	           				'academicTranscipt' 	=> $pathAc,
	           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			),array('mahasiswaID' => $this->input->post('Mahasiswaid'))
	           		);
				}

			$updateLogin = $this->Mod_crud->updateData('t_login', array(
			           		'emaiL' 	=> $this->input->post('Email')
	           			), array('loginID' => $this->input->post('Mahasiswaid'))
	           	);
			helper_log('edit','Edit Mahasiswa Data ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($updatefile){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('mahasiswa')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function delete(){
		helper_log('delete','Delete Mahasiswa ( '.email($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$this->input->post('id').'"'));
		$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$this->input->post('id')));
		$query 		= $this->Mod_crud->deleteData('t_mahasiswa', array('mahasiswaID' => $this->input->post('id')));
		if ($query){
			if (!empty($getfile)){
			unlink(FCPATH . $getfile->photo);
			unlink(FCPATH . $getfile->resume);
			unlink(FCPATH . $getfile->academicTranscipt);
			}
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

	public function getFaculty()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'facultyID, facultyName', 't_faculty');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->facultyID;
				$mk['text'] = $key->facultyName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getResidence()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'residenceID, residenceName', 't_residence');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->residenceID;
				$mk['text'] = $key->residenceName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getUniv()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'universityID, universityName', 't_university');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->universityID;
				$mk['text'] = $key->universityName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////
		public function modalReset()
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Reset Password '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row', 'emaiL', 't_mahasiswa', null, null, null, array('mahasiswaID = "'.$ID[0].'"')),
				'formAction' => base_url('mahasiswa/reset'),
				'Req' => ''
			);
		$this->load->view('pages/mahasiswa/reset', $data);
	}

	function reset()
	{
		$email = $this->input->post('Email');

		$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tokeN 	= substr(str_shuffle($set), 0, 55);
		$create = time();
		$exp = 60*60;
		$done = $create+$exp;
		$expired_at = date('Y-m-d H:i:s',$done);

		$update = $this->Mod_crud->updateData('t_login', array(
		           		'passworD' 	=> 'null'
           			), array('emaiL' => $email)
           	);
		
		$delete  = $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$this->input->post('Email')));

		$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
				'emaiL'		=> $email,
				'tokeN'		=> $tokeN,
				'created_at'	=> date('Y-m-d H:i:s'),
				'expired_at'	=> $expired_at
				)
			);

		$config = array(
				  		'protocol' => 'ssmtp',
				  		'smtp_host' => 'ssl://mail.intern7.iex.or.id',
				  		'smtp_port' => 465,
				  		'smtp_user' => 'info@intern7.iex.or.id', // change it to yours
				  		'smtp_pass' => 'Infocbn123', // change it to yours
				  		//'smtp_username' => 'armg3295',
				  		'mailtype' => 'html',
				  		'charset' => 'iso-8859-1',
				  		'wordwrap' => TRUE
			);

			$message = 	"
						<html>
						<head>
							<title>Password Reset</title>
						</head>
						<body>
							<h2>CBN Internship Web Portal</h2>
							<p>Please click the link below to set your password ".base_url('auth/reset/'.$tokeN)." <br/>( warning: this link will expire after one hour )<br/><br/></p>
							<p><hr />Do Not reply to this message<hr /><br/></p>
							<p>CBN Internet<br/>
								PT. Cyberindo Aditama<br/>
								Jalan. HR Rasuna Said Blok X5, No. 13<br/>
								Jakarta Selatan - 12950<br/>
								Telp. (021) 2996-4900<br/>
								Fax : +62 21 574-2481<br/>
								Web : www.cbn.net.id<br/>
							</p>
						</body>
						</html>
						";
	 		
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($config['smtp_user']);
		    $this->email->to($email);
		    $this->email->subject('Password Reset');
		    $this->email->message($message);
		    helper_log('reset','Send Email Setup Password To '.$email,$this->session->userdata('userlog')['sess_usrID']);

			if ($this->email->send()){
				$this->alert->set('bg-success', "Success ! Setup link hes been send");
       			echo json_encode(array('code' => 200, 'message' => 'Success ! Setup link hes been send'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
		public function profile()
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];
		$detail = $this->Mod_crud->getData('row', 'm.*, ff.photo,ff.resume,ff.academicTranscipt, l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.mahasiswaID = "'.$id.'"'));
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
						"dashboards/js/plugins/forms/styling/uniform.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/mahasiswa-script.js",
				)
			),
			'titleWeb' => "My Profile | CBN Internship",
			'breadcrumb' => explode(',', 'Profile,My Profile'),
			'dtmahasiswa' => $detail
		);
		$this->render('dashboard', 'pages/mahasiswa/profile', $data);
	}

		public function formProfile($id=null)
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
					"dashboards/js/plugins/uploaders/fileinput.min.js",
					"dashboards/js/plugins/pickers/pickadate/picker.js",
					"dashboards/js/plugins/pickers/pickadate/picker.date.js",
					"dashboards/js/plugins/pickers/anytime.min.js",
					"dashboards/js/plugins/forms/validation/validate.min.js",
					"dashboards/js/pages/mahasiswa-script.js",
				)
			),
		    'titleWeb' => "Edit Profile | CBN Internship",
		    'breadcrumb' => explode(',', 'My Profile,Edit Profile ('.name_mhs($id).')'),
		    'dMaster'	 => $this->Mod_crud->getData('row', 'm.*,ff.photo,ff.resume,ff.academicTranscipt', 't_mahasiswa m', null, null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'), array('m.mahasiswaID = "'.$id.'"')),
			'actionForm' => base_url('mahasiswa/editProfile'),
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/mahasiswa/formProfile', $data);
	}

	public function editProfile()
	{
		$cek = $this->Mod_crud->checkData('fullName', 't_mahasiswa', array('fullName = "'.$this->input->post('Fullname').'"', 'mahasiswaID != "'.$this->input->post('Mahasiswaid').'"'));
			if ($cek){
				echo json_encode(array('code' => 368, 'message' => 'Name has been registered'));
			}else{
				$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$this->input->post('Mahasiswaid').'"'));

				if ($_FILES['Photofile']['name'] !== '') {
					if (!empty($getfile->photo)) {
							unlink(FCPATH . $getfile->photo);
						}
					$t = explode(".", $_FILES['Photofile']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' => 'pic_'.$this->input->post('Mahasiswaid').'.'.$ext,
							'upload_path' => 'fileupload/pic_mahasiswa',
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',
							'max_size' => 512,
						);

					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('Photofile')) {
						echo json_encode(array('code' => 370, 'message' => strip_tags($this->upload->display_errors())));
					}else{
						$gbr 	 = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'fileupload/pic_mahasiswa/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 		= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'fileupload/pic_mahasiswa/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$pathPic = 'fileupload/pic_mahasiswa/' . $gbr['file_name'];
				} else {
					$pathPic = $getfile->photo;
				}

				//cv
				if ($_FILES['Cvfile']['name'] !== '') {
					if (!empty($getfile->resume)) {
							unlink(FCPATH . $getfile->resume);	
						}
					$t = explode(".", $_FILES['Cvfile']['name']);
					$ext = end($t);
					$cfgCv= array(
							'file_name' => 'resume_'.$this->input->post('Mahasiswaid').'.'.$ext,
							'upload_path' => 'fileupload/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgCv);
					if (!$this->upload->do_upload('Cvfile')) {
						echo json_encode(array('code' => 371, 'message' => strip_tags($this->upload->display_errors())));
					}
					$file 	= $this->upload->data();
					$pathCv = 'fileupload/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathCv = $getfile->resume;
				}

				//transcipt
				if ($_FILES['Acfile']['name'] !== '') {
					if (!empty($getfile->academicTranscipt)) {
							unlink(FCPATH . $getfile->academicTranscipt);	
						}
					$t = explode(".", $_FILES['Acfile']['name']);
					$ext = end($t);
					$cfgAc= array(
							'file_name' => 'transcipt_'.$this->input->post('Mahasiswaid').'.'.$ext,
							'upload_path' => 'fileupload/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgAc);
					if (!$this->upload->do_upload('Acfile')) {
						echo json_encode(array('code' => 372, 'message' => strip_tags($this->upload->display_errors())));
					}
					$file 	= $this->upload->data();
					$pathAc = 'fileupload/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathAc = $getfile->academicTranscipt;
				}
			
				$updatemahasiswa = $this->Mod_crud->updateData('t_mahasiswa', array(
	           			'universityID' 		=> $this->input->post('Universityid'),
           				'facultyID' 		=> $this->input->post('Facultyid'),
           				'residenceID'		=> $this->input->post('Residenceid'),
           				'mahasiswaNumber'	=> $this->input->post('Nim'),
           				'emaiL'			=> $this->input->post('Email'),
           				'fullName' 		=> ucwords($this->input->post('Fullname')),
           				'birthPlace'		=> $this->input->post('Birthplace'),
           				'birthDate'		=> date_format(date_create($this->input->post('Birthdate_submit')), 'Y-m-d'),
           				'gender'		=> $this->input->post('Gender'),
           				'religion'		=> $this->input->post('Religion'),
           				'city'			=> $this->input->post('City'),
           				'zip'			=> $this->input->post('Zip'),
           				'address'		=> $this->input->post('Address'),
           				'fixedPhone'		=> $this->input->post('Fixedphone'),
           				'mobilePhone'		=> $this->input->post('Mobilephone'),
           				'hobby'			=> $this->input->post('Hobby'),
           				'strength'		=> $this->input->post('Strength'),
           				'weakness'		=> $this->input->post('Weakness'),
           				'organizationExp'	=> $this->input->post('Organizationexp'),
           				'projectEverMade'	=> $this->input->post('Projectevermade'),
           				'semester'		=> $this->input->post('Semester'),
           				'sksTotal'		=> $this->input->post('Skstotal'),
           				'indexTotal'		=> $this->input->post('Indextotal'),
           				'statusActive'		=> '1',
           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			), array('mahasiswaID' => $this->input->post('Mahasiswaid'))
	           	);
				if (empty($getfile)) {
					$updatefile = $this->Mod_crud->insertData('t_mahasiswa_file', array(
	           				'mahasiswaID'		=> $this->input->post('Mahasiswaid'),
	           				'photo' 		=> $pathPic,
	           				'resume'		=> $pathCv,
	           				'academicTranscipt' => $pathAc,
	           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			)
	           		);
				}else{
					$updatefile = $this->Mod_crud->updateData('t_mahasiswa_file', array(
	           				'mahasiswaID'		=> $this->input->post('Mahasiswaid'),
	           				'photo' 		=> $pathPic,
	           				'resume'		=> $pathCv,
	           				'academicTranscipt' => $pathAc,
	           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			),array('mahasiswaID' => $this->input->post('Mahasiswaid'))
	           		);
				}

			$updateLogin = $this->Mod_crud->updateData('t_login', array(
			           		'emaiL' 		=> $this->input->post('Email')
	           			), array('loginID' => $this->input->post('Mahasiswaid'))
	           	);
			helper_log('edit','Edit Profile',$this->session->userdata('userlog')['sess_usrID']);

			if ($updatefile){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('mahasiswa/profile')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
	}

		public function changePass()
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Change Password '.$ID[1],
				'mahasiswaID' => $ID[0],
				'formAction' => base_url('mahasiswa/do_change_pass'),
				'Req' => ''
			);
		$this->load->view('pages/mahasiswa/changepass', $data);
	}

		public function do_change_pass()
	{
		$cek = $this->Mod_crud->checkData('passworD', 't_login', array('passworD = "'.md5($this->input->post('Password1')).'"', 'loginID = "'.$this->input->post('Mahasiswaid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'The password you entered has been used before'));
		}else{
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'passworD'		=> md5($this->input->post('Password1')),
           			), array('loginID'  => $this->input->post('Mahasiswaid'))
           	);
			helper_log('edit','Change Password',$this->session->userdata('userlog')['sess_usrID']);

			if ($updateLogin){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}

		public function modalMahasiswa()
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
			'modalTitle' => 'View '.$ID[1],
			'dMaster' => $this->Mod_crud->getData('row','m.*,ff.photo,ff.resume,ff.academicTranscipt','t_mahasiswa m',null,null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'),array('m.mahasiswaID = "'.$ID[0].'"')),
			'dtworkscope' => $this->Mod_crud->getData('result','ws.*,ps.*','t_workscope ws',null,null,array('t_project_scope ps'=>'ps.projectScopeID = ws.projectScopeID'),array('ws.mahasiswaID = "'.$ID[0].'"')),
			'Req' => ''
			);
		$this->load->view('pages/mahasiswa/reviewMahasiswa', $data);
	}

	function download($mod=null,$id)
	{
		$getFile = $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$id.'"'));
		if ($mod=='resume') {
			helper_log('download','Download Resume, '.$id,$this->session->userdata('login')['sess_usrID']);
			$file = $getFile->resume;
			force_download($file,NULL);
		}elseif ($mod=='transcipt') {
			helper_log('download','Download Academic Transcipt, '.$id,$this->session->userdata('login')['sess_usrID']);
			$file = $getFile->academicTranscipt;
			force_download($file,NULL);
		}
	}

	
}

/* End of file mahasiswa.php */
/* Location: ./application/controllers/mahasiswa.php */
