<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Dosen extends CommonDash {
//controller untuk mengelola Dosen
	public function __construct()
	{
		parent::__construct();
	}

	public function index()//load index dosen
	{
		if ($this->session->userdata('userlog')['sess_role']==33) {//jika role id =33 (admin kampus)
			$universityID 	= $this->session->userdata('userlog')['sess_univID'];//get session id universitas
			//get dosen per kampus
			$dosen 	= $this->Mod_crud->getData('result', 'd.*, l.roleID', 't_dosen d', null, null,array('t_login l'=>'d.loginID = l.loginID'), array('d.universityID = "'.$universityID.'"'), array('d.dosenID ASC'));
		}else{
			//get data dosen
			$dosen = $this->Mod_crud->getData('result','*', 't_dosen');
		}
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
						"dashboards/js/pages/dosen-index-script.js",
				)
			),
			'titleWeb' => "Dosen | CBN Internship",//title tab aplikasi
			'breadcrumb' => explode(',', 'Dosen, Dosen List'),//breadcrumb
			'dtdosen' => $dosen,//data

		);
		$this->render('dashboard', 'pages/dosen/index', $data);//load index dosen
	}

	public function add()//form tambah dosen
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
					"dashboards/js/pages/dosen-script.js",
				)
			),
		    'titleWeb' => "Add Dosen | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Dosen,Add New Dosen'),
		    'actionForm' => base_url('dosen/save'),//aksi form
		    'buttonForm' => 'Simpan',//button
		    'Req'	=> ''//request
		);

		$this->render('dashboard', 'pages/dosen/form', $data);//load view form dosen
	}

	public function save(){//tambah aksi
		//cek duplikasi email dosen
		$cekemail = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"'));
		if ($cekemail) {//jika ada
			echo json_encode(array('code' => 366, 'message' => 'Email has been registered'));
		}else{
			//cek nomor indux dosen
			$cekdosen = $this->Mod_crud->checkData('dosenNumber', 't_dosen', array('dosenNumber = "'.$this->input->post('Nid').'"'));
			if ($cekdosen) {//jika ada
				echo json_encode(array('code' => 367, 'message' => 'NID has been registered'));
			} else {
			//generate dosen id
			$dosenID 	= $this->Mod_crud->autoNumber('dosenID','t_dosen','44',4);
			//penyimpanan data dosen
			//jika file tidak kosong
			if ($_FILES['Userfile']['name'] !== '') {
					//konfigurasi file
					$t = explode(".", $_FILES['Userfile']['name']);//ambil ektensi file
					$ext = end($t);//set ektensi file
					$cfgFile= array(//arrya konfigurasi
							'file_name' => 'pic_'.$dosenID.'.'.$ext,//nama file
							'upload_path' => 'fileupload/pic_dosen',//upload path
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',//tipe file yang di perbolehkan
							'max_size' => 2000,//maks ukuran file
						);

					$this->upload->initialize($cfgFile);//inisialisasi file
					if (!$this->upload->do_upload('Userfile')) {//jika tidak melalkukan upload
						echo json_encode(array('code' => 267, 'message' => strip_tags($this->upload->display_errors())));
					}else{//jika melakukan upload
						$gbr 	 = $this->upload->data();//ambil data file yg di upload
						$config['image_library'] 	= 'gd2';//library
						$config['source_image'] 	= 'fileupload/pic_dosen/' . $gbr['file_name'];//path penyimpanan
						$config['create_thumb'] 	= FALSE;//tumbnail
						$config['maintain_ratio'] 	= FALSE;//ration
						$config['quality'] 		= '50%';//kualitas
						$config['width']         	= 200;//lebar
						$config['height']       	= 200;//tinggi
						$config['new_image']	 	= 'fileupload/pic_dosen/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();//resize ukuran file
					}
					$pathPic = 'fileupload/pic_dosen/' . $gbr['file_name'];//set lokasi gambar
				} else {
					$pathPic = '';
				}
				//simpan data dosen
				$saveDosen = $this->Mod_crud->insertData('t_dosen', array(
           				'dosenID' 	=> $dosenID,
           				'loginID'	=> $dosenID,
           				'universityID' 	=> $this->input->post('Universityid'),
           				'facultyID' 	=> $this->input->post('Facultyid'),
           				'emaiL'		=> $this->input->post('Email'),
           				'dosenNumber'	=> $this->input->post('Nid'),
           				'fullName' 	=> ucwords($this->input->post('Fullname')),
           				'fixedPhone'	=> $this->input->post('Fixedphone'),
           				'mobilePhone'	=> $this->input->post('Mobilephone'),
           				'city'		=> $this->input->post('City'),
           				'zip'		=> $this->input->post('Zip'),
           				'address'	=> $this->input->post('Address'),
           				'profilePic' 	=> $pathPic,
           				'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
           				'createdTIME'	=> date('Y-m-d H:i:s')
           			)
           		);
				//simpan login
	           	$savelogin = $this->Mod_crud->insertData('t_login', array(
					'loginID'		=> $dosenID,
					'roleID'		=> 44,
					'emaiL'			=> $this->input->post('Email'),
					'passworD'		=> 'null',
					'statuS'		=> 'new-user',
					'createdTime'	=> date('Y-m-d H:i:s')
					)
				);

			$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//set random string
			$tokeN 	= substr(str_shuffle($set), 0, 55);//generate token
			$create = time();
			$exp = 60*60;//1jam
			$done = $create+$exp;//masa expired
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
		 		
			    $this->load->library('email', $config);//load library email
			    $this->email->set_newline("\r\n");//set garis baru
			    $this->email->from($config['smtp_user']);//pengirim email
			    $this->email->to($this->input->post('Email'));//email tujuan
			    $this->email->subject('Account Setup Link');//subject email
			    $this->email->message($message);//set isi pesan
			    //log aktivitas
			    helper_log('add','Add New Dosen ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);
			    //notification
			    create_notification('New','Dosen',$this->input->post('Fullname'),'dosen/index');

			if ($this->email->send()){//jika terkirim
				//set alert sukses
				$this->alert->set('bg-success', "Insert success ! Setup link hes been send");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send', 'aksi' => "window.location.href='".base_url('dosen')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function form($id=null)//edit dosen
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
					"dashboards/js/pages/dosen-script.js",
				)
			),
		    'titleWeb' => "Edit Dosen | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Dosen,Edit Dosen ('.name_dosen($id).')'),
		    'dMaster'	 => $this->Mod_crud->getData('row', '*', 't_dosen', null, null,null, array('dosenID = "'.$id.'"')),//get dosen by id
		    'actionForm' => base_url('dosen/edit'),
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/dosen/form', $data);//load view dosen form
	}


	public function edit(){//aksi edit dosen
		$cek = $this->Mod_crud->checkData('fullName', 't_dosen', array('fullName = "'.$this->input->post('Fullname').'"', 'dosenID != "'.$this->input->post('Dosenid').'"'));
		if ($cek){
			echo json_encode(array('code' => 368, 'message' => 'Name has been registered'));
		}else{
			//ambil gambar lama
			$getImage 	= $this->Mod_crud->getData('row','profilePic','t_dosen',null,null,null,array('dosenID = "'.$this->input->post('Dosenid').'"'));

			if ($_FILES['Userfile']['name'] !== '') {
				$t = explode(".", $_FILES['Userfile']['name']);
				$ext = end($t);
				$cfgFile= array(
						'file_name' 	=> 'pic_'.$this->input->post('Dosenid').'.'.$ext,
						'upload_path' 	=> 'fileupload/pic_dosen/',
						'allowed_types' => 'jpg|png|gif|jpeg|bmp',
						'max_size'   	=> 2048,
					);

				$this->upload->initialize($cfgFile);
				if (!$this->upload->do_upload('Userfile')) {
					echo json_encode(array('code' => 269, 'message' => strip_tags($this->upload->display_errors())));
				}else{
					$gbr 	= $this->upload->data();
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= 'fileupload/pic_dosen/' . $gbr['file_name'];
					$config['create_thumb'] 	= FALSE;
					$config['maintain_ratio'] 	= FALSE;
					$config['quality'] 		= '50%';
					$config['width']         	= 200;
					$config['height']       	= 200;
					$config['new_image']	 	= 'fileupload/pic_dosen/' . $gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					if (!empty($getImage->profilePic)) {
						unlink(FCPATH . $getImage->profilePic);//hapus gambar lama	
					}
				}

				$pathPic = 'fileupload/pic_dosen/' . $gbr['file_name'];

			} else {
				$pathPic = $getImage->profilePic;
			}
			//update perubahan dosen
			$updateDosen = $this->Mod_crud->updateData('t_dosen', array(
	           				'universityID' 	=> $this->input->post('Universityid'),
	           				'facultyID' 	=> $this->input->post('Facultyid'),
	           				'emaiL'		=> $this->input->post('Email'),
	           				'dosenNumber'	=> $this->input->post('Nid'),
	           				'fullName' 	=> ucwords($this->input->post('Fullname')),
	           				'fixedPhone'	=> $this->input->post('Fixedphone'),
	           				'mobilePhone'	=> $this->input->post('Mobilephone'),
	           				'city'		=> $this->input->post('City'),
	           				'zip'		=> $this->input->post('Zip'),
	           				'address'	=> $this->input->post('Address'),
	           				'profilePic' 	=> $pathPic,
	           				'updatedBY'	=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'	=> date('Y-m-d H:i:s')
	           			), array('dosenID' => $this->input->post('Dosenid'))
	           	);

			$updateLogin = $this->Mod_crud->updateData('t_login', array(
			           		'emaiL' 		=> $this->input->post('Email')
	           			), array('loginID' => $this->input->post('Dosenid'))
	           	);
			helper_log('edit','Edit Dosen Data ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($updateLogin){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('dosen')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){//hapus dosen
		//log hapus
		helper_log('delete','Delete Dosen ( '.email($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//ambil data dosen
		$getdosen 	= $this->Mod_crud->getData('row','profilePic','t_dosen',null,null,null,array('dosenID = "'.$this->input->post('id').'"'));
		//hapus login
		$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$this->input->post('id')));
		//hapus dosen
		$query 		= $this->Mod_crud->deleteData('t_dosen', array('dosenID' => $this->input->post('id')));
		if ($query){//jika bernilai true
			if (!empty($getdosen)){//jika tidak kosong
			unlink(FCPATH . $getdosen->profilePic);//hapus gambar di pathnya
			}
			$data = array(//array sweatalert
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
				'modalTitle' => 'Reset Password '.$ID[1],//set modal title
				//ambil email dosen
				'dMaster' => $this->Mod_crud->getData('row', 'emaiL', 't_dosen', null, null, null, array('dosenID = "'.$ID[0].'"')),
				'formAction' => base_url('dosen/reset'),//modal form dosen
				'Req' => ''//request
			);
		$this->load->view('pages/dosen/reset', $data);//load modal view
	}

	function reset()//aksi reset password
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
				  		'charset'  => 'iso-8859-1',
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
		    //log set setup password
		    helper_log('reset','Send Email Setup Password To '.$email,$this->session->userdata('userlog')['sess_usrID']);

			if ($this->email->send()){
				$this->alert->set('bg-success', "Success ! Setup link hes been send");
       			echo json_encode(array('code' => 200, 'message' => 'Success ! Setup link hes been send'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
	}
// profile//////////////////////////////////////////////////////////////
			public function profile()//ke halaman profile
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];//ambil id dari session
		//ambil data detail dosen
		$detail = $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_dosen a', null, null, array('t_login l'=>'a.loginID = l.loginID'),array('a.dosenID = "'.$id.'"'));
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
						"dashboards/js/pages/dosen-script.js",
				)
			),
			'titleWeb' => "My Profile | CBN Internship",
			'breadcrumb' => explode(',', 'Profile,My Profile'),
			'dtdosen' => $detail
		);
		$this->render('dashboard', 'pages/dosen/profile', $data);//load view dosen profile
	}

		public function formProfile($id=null)//edit profile
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
					"dashboards/js/pages/dosen-script.js",
				)
			),
		    'titleWeb' => "Edit Profile | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'My Profile,Edit Profile ('.name_dosen($id).')'),
		    'dMaster'	 => $this->Mod_crud->getData('row', '*', 't_dosen', null, null,null, array('dosenID = "'.$id.'"')),
			'actionForm' => base_url('dosen/editProfile'),
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/dosen/formProfile', $data);//load view form profile
	}

	public function editProfile(){//aksi edit profile
		//cek duplikasi nama dosen
		$cek = $this->Mod_crud->checkData('fullName', 't_dosen', array('fullName = "'.$this->input->post('Fullname').'"', 'dosenID != "'.$this->input->post('Dosenid').'"'));
		if ($cek){
			echo json_encode(array('code' => 368, 'message' => 'Name has been registered'));
		}else{
			$getImage 	= $this->Mod_crud->getData('row','profilePic','t_dosen',null,null,null,array('dosenID = "'.$this->input->post('Dosenid').'"'));

			if ($_FILES['Userfile']['name'] !== '') {
				$t = explode(".", $_FILES['Userfile']['name']);
				$ext = end($t);
				$cfgFile= array(
						'file_name' 	=> 'pic_'.$this->input->post('Dosenid').'.'.$ext,
						'upload_path' 	=> 'fileupload/pic_dosen/',
						'allowed_types' => 'jpg|png|gif|jpeg|bmp',
						'max_size'   	=> 2048,
					);

				$this->upload->initialize($cfgFile);
				if (!$this->upload->do_upload('Userfile')) {
					echo json_encode(array('code' => 269, 'message' => strip_tags($this->upload->display_errors())));
				}else{
					$gbr 	= $this->upload->data();
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= 'fileupload/pic_dosen/' . $gbr['file_name'];
					$config['create_thumb'] 	= FALSE;
					$config['maintain_ratio'] 	= FALSE;
					$config['quality'] 		= '50%';
					$config['width']         	= 200;
					$config['height']       	= 200;
					$config['new_image']	 	= 'fileupload/pic_dosen/' . $gbr['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					if (!empty($getImage->profilePic)) {
						unlink(FCPATH . $getImage->profilePic);	
					}
				}

				$pathPic = 'fileupload/pic_dosen/' . $gbr['file_name'];

			} else {
				$pathPic = $getImage->profilePic;
			}
			
			$updateDosen = $this->Mod_crud->updateData('t_dosen', array(
	           				'universityID' 	=> $this->input->post('Universityid'),
	           				'facultyID' 	=> $this->input->post('Facultyid'),
	           				'emaiL'		=> $this->input->post('Email'),
	           				'dosenNumber'	=> $this->input->post('Nid'),
	           				'fullName' 	=> ucwords($this->input->post('Fullname')),
	           				'fixedPhone'	=> $this->input->post('Fixedphone'),
	           				'mobilePhone'	=> $this->input->post('Mobilephone'),
	           				'city'		=> $this->input->post('City'),
	           				'zip'		=> $this->input->post('Zip'),
	           				'address'	=> $this->input->post('Address'),
	           				'profilePic' 	=> $pathPic,
	           				'updatedBY'	=> $this->session->userdata('userlog')['sess_usrID'],
	           				'updatedTIME'	=> date('Y-m-d H:i:s')
	           			), array('dosenID' => $this->input->post('Dosenid'))
	           	);

			$updateLogin = $this->Mod_crud->updateData('t_login', array(
			           		'emaiL' 		=> $this->input->post('Email')
	           			), array('loginID' => $this->input->post('Dosenid'))
	           	);
			helper_log('edit','Edit Profile',$this->session->userdata('userlog')['sess_usrID']);

			if ($updateLogin){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('dosen/profile')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}

		public function changePass()//modal rubah password
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Change Password '.$ID[1],
				'dosenID' => $ID[0],
				'formAction' => base_url('dosen/do_change_pass'),
				'Req' => ''
			);
		$this->load->view('pages/dosen/changepass', $data);
	}

		public function do_change_pass()//aksi rubah password
	{
		//cek password
		$cek = $this->Mod_crud->checkData('passworD', 't_login', array('passworD = "'.md5($this->input->post('Password1')).'"', 'loginID = "'.$this->input->post('Dosenid').'"'));
		if ($cek){//jika sama dengan password lama
			echo json_encode(array('code' => 256, 'message' => 'The password you entered has been used before'));
		}else{
			//update login
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'passworD'		=> md5($this->input->post('Password1')),
						'statuS'		=> 'verified',
           			), array('loginID'  => $this->input->post('Dosenid'))
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

		public function modalDosen()//modal review dosen
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
			'modalTitle' => 'View '.$ID[1],
			'dMaster' => $this->Mod_crud->getData('row','*','t_dosen',null,null,null,array('dosenID = "'.$ID[0].'"')),
			'Req' => ''
			);
		$this->load->view('pages/dosen/reviewDosen', $data);
	}

}

/* End of file dosen.php */
/* Location: ./application/controllers/dosen.php */
