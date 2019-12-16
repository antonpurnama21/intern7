<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Mahasiswa extends CommonDash {
//controller untuk mengelola mahasiswa
	public function __construct()
	{
		parent::__construct();
	}

	public function index()//index mahasiswa
	{
		if ($this->session->userdata('userlog')['sess_role']==33) {//jika role id == 33 (admin campus)

			$universityID 	= $this->session->userdata('userlog')['sess_univID'];//get id universitas
			//get data mahasiswa per id universitas
			$mahasiswa 	= $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.universityID = "'.$universityID.'"'), null, array('m.mahasiswaID ASC'));

		}elseif ($this->session->userdata('userlog')['sess_role']==44) {//jika role id == 44 (dosen)
			//get id universitas
			$universityID 	= $this->session->userdata('userlog')['sess_univID'];
			//get if fakultas
			$facultyID 	= $this->session->userdata('userlog')['sess_facID'];
			//get data mahasiswa
			$mahasiswa	= $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.universityID = "'.$universityID.'"','m.facultyID = "'.$facultyID.'"'), null, array('m.mahasiswaID ASC'));
		}elseif ($this->session->userdata('userlog')['sess_role']==55) {//jika role id = 55(mahasiswa)
			$this->alert->set('bg-danger', "Access denied !");
		}else{//untuk sisa role id
			//get data mahasiswa
			$mahasiswa = $this->Mod_crud->getData('result', 'm.*, ff.photo, l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), null, null, array('m.mahasiswaID ASC'));
		
		}
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
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/mahasiswa-index-script.js",
				)
			),
			'titleWeb' => "Mahasiswa | CBN Internship",//title web
			'breadcrumb' => explode(',', 'Mahasiswa, Mahasiswa List'),//breadcrumb
			'dtmahasiswa' => $mahasiswa//data mahasiswa
		);
		$this->render('dashboard', 'pages/mahasiswa/index', $data);//load view mahasiswa index
	}

		public function add()//tambah mahasiswa
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
		    'actionForm' => base_url('mahasiswa/save'),//aksi form tambah mahasiswa
		    'buttonForm' => 'Simpan'
		);

		$this->render('dashboard', 'pages/mahasiswa/add', $data);//load view mahasiswa add
	}


	public function save(){//aksi tambah mahasiswa
		//cek duplikasi email
		$cekemail = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"'));
		if ($cekemail) {//jika ada
			echo json_encode(array('code' => 366, 'message' => 'Email has been registered'));
		}else{
			//cek duplikasi nim mahasiswa
			$cekmahasiswa = $this->Mod_crud->checkData('mahasiswaNumber', 't_mahasiswa', array('mahasiswaNumber = "'.$this->input->post('Nim').'"'));
			if ($cekmahasiswa) {//jika ada
				echo json_encode(array('code' => 367, 'message' => 'NIM has been registered'));
			} else {
			//generate id mahasiswa
			$mahasiswaID 	= $this->Mod_crud->autoNumber('mahasiswaID','t_mahasiswa','55',4);
				//simpan mahasiswa
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
				//simpan login
	           	$savelogin = $this->Mod_crud->insertData('t_login', array(
					'loginID'		=> $mahasiswaID,
					'roleID'		=> 55,
					'emaiL'			=> $this->input->post('Email'),
					'passworD'		=> 'null',
					'statuS'		=> 'new-mahasiswa',
					'createdTime'	=> date('Y-m-d H:i:s')
					)
				);

			$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//set random string
			$tokeN 	= substr(str_shuffle($set), 0, 55);//set token
			$create = time();
			$exp = 60*60;//1jam
			$done = $create+$exp;//masa ekpired
			$expired_at = date('Y-m-d H:i:s',$done);//waktu expired
			//simpan ke table password reset
			$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
					'emaiL'		=> $this->input->post('Email'),
					'tokeN'		=> $tokeN,
					'created_at'	=> date('Y-m-d H:i:s'),
					'expired_at'	=> $expired_at
					)
				);
			//konfigurasi email
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
				//isi pesan
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
		 		
			    $this->load->library('email', $config);//get library
			    $this->email->set_newline("\r\n");
			    $this->email->from($config['smtp_user']);//dari email
			    $this->email->to($this->input->post('Email'));//ke email
			    $this->email->subject('Account Setup Link');//subjek email
			    $this->email->message($message);//pesan
			    //log aktivitas
			    helper_log('add','Add New Mahasiswa ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);
			    //notifikasi
			    create_notification('New','Mahasiswa',$this->input->post('Fullname'),'mahasiswa/index');

			if ($this->email->send()){//jika email terkirim
				//set alert sukses
				$this->alert->set('bg-success', "Insert success ! Setup link hes been send");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send', 'aksi' => "window.location.href='".base_url('mahasiswa')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function form($id=null)//form edit mahasiswa
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
					"dashboards/js/plugins/uploaders/fileinput.min.js",
					"dashboards/js/plugins/pickers/pickadate/picker.js",
					"dashboards/js/plugins/pickers/pickadate/picker.date.js",
					"dashboards/js/plugins/pickers/anytime.min.js",
					"dashboards/js/plugins/forms/validation/validate.min.js",
					"dashboards/js/pages/mahasiswa-script.js",
				)
			),
		    'titleWeb' => "Edit Mahasiswa | CBN Internship",
		    'breadcrumb' => explode(',', 'Mahasiswa,Edit Mahasiswa ('.name_mhs($id).')'),
		    //ambil data mahasiswa per id
		    'dMaster'	 => $this->Mod_crud->getData('row', 'm.*,ff.photo,ff.resume,ff.academicTranscipt', 't_mahasiswa m', null, null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'), array('m.mahasiswaID = "'.$id.'"')),
			'actionForm' => base_url('mahasiswa/edit'),//aksi form
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/mahasiswa/form', $data);//load mahasiswa form
	}

	public function edit()//aksi edit mahasiswa
	{
			//cek duplikasi nama
			$cek = $this->Mod_crud->checkData('fullName', 't_mahasiswa', array('fullName = "'.$this->input->post('Fullname').'"', 'mahasiswaID != "'.$this->input->post('Mahasiswaid').'"'));
			if ($cek){//jika ada
				echo json_encode(array('code' => 368, 'message' => 'Name has been registered'));
			}else{
				//get file mahasiswa
				$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$this->input->post('Mahasiswaid').'"'));
				//jika file tidak kosong
				if ($_FILES['Photofile']['name'] !== '') {
					if (!empty($getfile->photo)) {//jika file photo tidak kosong
							unlink(FCPATH . $getfile->photo);//hapus photo lama
						}
					$t = explode(".", $_FILES['Photofile']['name']);//get ektensi
					$ext = end($t);//ektensi
					$cfgFile= array(//array file configurasu
							'file_name' => 'pic_'.$this->input->post('Mahasiswaid').'.'.$ext,//nama file
							'upload_path' => 'fileupload/pic_mahasiswa',//path upload
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',//tipe yang di perbolehkan
							'max_size' => 512,//ukuran maksimal
						);

					$this->upload->initialize($cfgFile);//iniliasisasi file config
					if (!$this->upload->do_upload('Photofile')) {//jika gagal upload
						//display errors
						echo json_encode(array('code' => 370, 'message' => strip_tags($this->upload->display_errors())));
					}else{//jika di upload
						$gbr 	 = $this->upload->data();//ambil data upload
						$config['image_library'] 	= 'gd2';//library
						$config['source_image'] 	= 'fileupload/pic_mahasiswa/' . $gbr['file_name'];//source path
						$config['create_thumb'] 	= FALSE;//thumbnail
						$config['maintain_ratio'] 	= FALSE;//rasio
						$config['quality'] 		= '50%';//kualitas
						$config['width']         	= 200;//lebar
						$config['height']       	= 200;//tinggi
						$config['new_image']	 	= 'fileupload/pic_mahasiswa/' . $gbr['file_name'];//new path
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();//resize ukuran gambar
					}
					$pathPic = 'fileupload/pic_mahasiswa/' . $gbr['file_name'];//file baru
				} else {
					$pathPic = $getfile->photo;//file baru
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
				//simpan mahasiswa
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
	           	//jik getfile kosong
				if (empty($getfile)) {
					//simpan file
					$insertfile = $this->Mod_crud->insertData('t_mahasiswa_file', array(
	           				'mahasiswaID'		=> $this->input->post('Mahasiswaid'),
	           				'photo' 		=> $pathPic,
	           				'resume'		=> $pathCv,
	           				'academicTranscipt' 	=> $pathAc,
	           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'		=> date('Y-m-d H:i:s')
	           			)
	           		);
				}else{//jika ada
					//simpan perubahan file
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
			//update login
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
			           		'emaiL' 	=> $this->input->post('Email')
	           			), array('loginID' => $this->input->post('Mahasiswaid'))
	           	);
			//log edit mahasiswa
			helper_log('edit','Edit Mahasiswa Data ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($updatefile){//jika bernilai true
				//set alert sukses
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('mahasiswa')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function delete(){//hapus mahaisswa
		//leog hapus
		helper_log('delete','Delete Mahasiswa ( '.email($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//ambil file mahasiswa
		$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$this->input->post('id').'"'));
		//delete login
		$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$this->input->post('id')));
		//hapus mahasiswa
		$query 		= $this->Mod_crud->deleteData('t_mahasiswa', array('mahasiswaID' => $this->input->post('id')));
		if ($query){//jika bernilai true
			if (!empty($getfile)){//jika tak kosong
			unlink(FCPATH . $getfile->photo);//hapus file photo
			unlink(FCPATH . $getfile->resume);//hapus file resume
			unlink(FCPATH . $getfile->academicTranscipt);//hapus file transcipt
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

	///////////////////////////////////////////////////////////////////////////////////////////////////////
		public function modalReset()//modal reset password
	{
		$ID = explode('~',$this->input->post('id'));//get id
		$data = array(
				'modalTitle' => 'Reset Password '.$ID[1],//title modal
				//get email mahasiswa
				'dMaster' => $this->Mod_crud->getData('row', 'emaiL', 't_mahasiswa', null, null, null, array('mahasiswaID = "'.$ID[0].'"')),
				'formAction' => base_url('mahasiswa/reset'),
				'Req' => ''
			);
		$this->load->view('pages/mahasiswa/reset', $data);//load modal view
	}

	function reset()//reset aksi
	{
		$email = $this->input->post('Email');//get email

		$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tokeN 	= substr(str_shuffle($set), 0, 55);
		$create = time();
		$exp = 60*60;
		$done = $create+$exp;
		$expired_at = date('Y-m-d H:i:s',$done);

		$update = $this->Mod_crud->updateData('t_login', array(
		           		'passworD' 	=> 'null',
						'statuS'	=> 'reset-password',
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
		public function profile()//profile mahasiswa
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];//ambil id dari session
		//get detail mahasiswa
		$detail = $this->Mod_crud->getData('row', 'm.*, ff.photo,ff.resume,ff.academicTranscipt, l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.mahasiswaID = "'.$id.'"'));
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
						"dashboards/js/pages/mahasiswa-script.js",
				)
			),
			'titleWeb' => "My Profile | CBN Internship",
			'breadcrumb' => explode(',', 'Profile,My Profile'),
			'dtmahasiswa' => $detail
		);
		$this->render('dashboard', 'pages/mahasiswa/profile', $data);
	}

		public function formProfile($id=null)//form edit mahasiswa
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

	public function editProfile()//aksi edit profile
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

		public function changePass()//rubah password
	{
		$ID = explode('~',$this->input->post('id'));//get id
		$data = array(
				'modalTitle' => 'Change Password '.$ID[1],//title modal
				'mahasiswaID' => $ID[0],
				'formAction' => base_url('mahasiswa/do_change_pass'),//aksi form modal
				'Req' => ''
			);
		$this->load->view('pages/mahasiswa/changepass', $data);//load changepass modal
	}

		public function do_change_pass()//aksi rubah password
	{
		//cek password
		$cek = $this->Mod_crud->checkData('passworD', 't_login', array('passworD = "'.md5($this->input->post('Password1')).'"', 'loginID = "'.$this->input->post('Mahasiswaid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'The password you entered has been used before'));
		}else{
			//update login
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'passworD'		=> md5($this->input->post('Password1')),
						'statuS'		=> 'verified',
           			), array('loginID'  => $this->input->post('Mahasiswaid'))
           	);

           	//log change password
			helper_log('edit','Change Password',$this->session->userdata('userlog')['sess_usrID']);

			if ($updateLogin){//jika bernilai true
				//set alert
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}

		public function modalMahasiswa()//modal review mahasiswa
	{
		$ID = explode('~',$this->input->post('id'));//get id
		$data = array(
			'modalTitle' => 'View '.$ID[1],
			//data mahasisa + file
			'dMaster' => $this->Mod_crud->getData('row','m.*,ff.photo,ff.resume,ff.academicTranscipt','t_mahasiswa m',null,null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'),array('m.mahasiswaID = "'.$ID[0].'"')),
			//data workdcope
			'dtworkscope' => $this->Mod_crud->getData('result','ws.*,ps.*','t_workscope ws',null,null,array('t_project_scope ps'=>'ps.projectScopeID = ws.projectScopeID'),array('ws.mahasiswaID = "'.$ID[0].'"')),
			'Req' => ''
			);
		$this->load->view('pages/mahasiswa/reviewMahasiswa', $data);//load modal review mahasiswa
	}

	function download($mod=null,$id)//download file
	{
		//ambil file
		$getFile = $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$id.'"'));
		if ($mod=='resume') {//jika mod = resume
			//log download
			helper_log('download','Download Resume, '.$id,$this->session->userdata('login')['sess_usrID']);
			//file
			$file = $getFile->resume;
			force_download($file,NULL);//download
		}elseif ($mod=='transcipt') {//jika mod = transcipt nilai
			helper_log('download','Download Academic Transcipt, '.$id,$this->session->userdata('login')['sess_usrID']);
			$file = $getFile->academicTranscipt;
			force_download($file,NULL);
		}
	}

	
}

/* End of file mahasiswa.php */
/* Location: ./application/controllers/mahasiswa.php */
