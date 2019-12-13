<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Admincampus extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() //fungsi index
	{
		$data = array(
			'_JS' => generate_js(array( //generate js
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
						"dashboards/js/pages/admincampus-index-script.js",
				)
			),
			'titleWeb' => "admin Campus | CBN Internship", //title web
			'breadcrumb' => explode(',', 'Account,Admin Campus'), //breadcrumb
			'dMaster'	=> $this->Mod_crud->getData('result','a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l' => 'a.loginID = l.loginID')), //get data admin campus
		);
		$this->render('dashboard', 'pages/admincampus/index', $data); //view load admincampus index.php
	}

		public function add() //fungsi tambah admin kampus
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
					"dashboards/js/pages/admincampus-script.js",
				)
			),
		    'titleWeb' => "Add Admin Campus | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Admin Campus,Add Admin Campus '),
		    'actionForm' => base_url('admincampus/save'),//set action form
		    'buttonForm' => 'Simpan'//set button
		);

		$this->render('dashboard', 'pages/admincampus/add', $data);//view load admincampus add.php 
	}

	public function save(){ //save admin campus
		$cek = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"')); //cek email ganda
		if ($cek){ //jika ada
			echo json_encode(array('code' => 366, 'message' => 'Email has been registered')); //alert
		}else{

			$id 	= $this->Mod_crud->autoNumber('adminCampusID','t_admin_campus','33',3); //set id admin kampus

			$save = $this->Mod_crud->insertData('t_admin_campus', array( //simpan admin campus
						'adminCampusID' => $id,
						'loginID' 	=> $id,
						'universityID' 	=> $this->input->post('Universityid'),
						'emaiL' 	=> $this->input->post('Email'),
						'fullName' 	=> $this->input->post('Fullname'),
						'telePhone' 	=> $this->input->post('Telephone'),
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			)
           		); //insert admincampus

			$savelogin = $this->Mod_crud->insertData('t_login', array(
				'loginID'		=> $id,
				'roleID'		=> '33',
				'emaiL'			=> $this->input->post('Email'),
				'passworD'		=> 'null',
				'statuS'		=> 'new-user',
				'createdTime'	=> date('Y-m-d H:i:s')
				)
			); //insert login

			$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //set random string
			$tokeN 	= substr(str_shuffle($set), 0, 55); //generate token
			$create = time();//set waktu
			$exp = 60*60;//set jangka waktu kadaluarsa
			$done = $create+$exp;//kadaluarsa
			$expired_at = date('Y-m-d H:i:s',$done);//set kadaluarsa setelah terkirim

			$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(//insert email ke table password-reset
					'emaiL'		=> $this->input->post('Email'),
					'tokeN'		=> $tokeN,
					'created_at'	=> date('Y-m-d H:i:s'),
					'expired_at'	=> $expired_at
					)
				);

			$config = array(
			  				'protocol' => 'ssmtp',//protokol
							'smtp_host' => 'ssl://mail.intern7.iex.or.id', //change it to yours
							'smtp_port' => 465,//port
							'smtp_user' => 'info@intern7.iex.or.id', // change it to yours
							'smtp_pass' => 'Infocbn123', // change it to yours
					  		//'smtp_username' => 'armg3295',
					  		'mailtype' => 'html',//mail type
					  		'charset' => 'iso-8859-1', //set karakter huruf
					  		'wordwrap' => TRUE//wordwrap
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
							";//isi pesan
		 		
			    $this->load->library('email', $config);//load library email
			    $this->email->set_newline("\r\n");
			    $this->email->from($config['smtp_user']);//dari
			    $this->email->to($this->input->post('Email'));//ke
			    $this->email->subject('Account Setup Link');//subject
			    $this->email->message($message);//pesan
			    helper_log('add','Add New Admin Campus Account ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);//create log new admin
			    create_notification('New','Admin Campus',$this->input->post('Fullname'),'admincampus/index');//create notification

			if ($this->email->send()){ //jika terkirim
				$this->alert->set('bg-success', "Insert success ! Setup link hes been send"); //set alert
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send', 'aksi' => "window.location.href='".base_url('admincampus')."';"));//alert
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function form($id=null)//edit admin kampus
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
					"dashboards/js/pages/admin-script.js",
				)
			),
		    'titleWeb' => "Edit Admin Campus | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Admin Campus,Edit Admin ('.name_admincampus($id).')'),
		    'dMaster' => $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l' => 'a.loginID = l.loginID'), array('admincampusID = "'.$id.'"')),//admin campus per id
			'actionForm' => base_url('admincampus/edit'),//form action
		    'buttonForm' => 'Simpan',//button
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/admincampus/add', $data);//load view admincampus add.php
	}

	public function edit(){//simpan perubahan
		$cek = $this->Mod_crud->checkData('fullName', 't_admin_campus', array('fullName = "'.$this->input->post('Fullname').'"', 'adminCampusID != "'.$this->input->post('Admincampusid').'"'));//cek nama
		if ($cek){//jika ada
			echo json_encode(array('code' => 367, 'message' => 'Name has been registered'));//alert
		}else{

			$update = $this->Mod_crud->updateData('t_admin_campus', array(//update perubahan
						'universityID'	=> $this->input->post('Universityid'),
						'emaiL' 	=> $this->input->post('Email'),
						'fullName' 	=> $this->input->post('Fullname'),
						'telePhone' 	=> $this->input->post('Telephone'),
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			), array('adminCampusID ' => $this->input->post('Admincampusid'))
           		);
			$updateLogin = $this->Mod_crud->updateData('t_login', array(//update data login
		           		'emaiL' 	=> $this->input->post('Email')
           			), array('loginID'  => $this->input->post('Admincampusid'))
           	);
			helper_log('edit','Edit Admin Campus Account ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);//create log update kampus

			if ($update){ //jika berhsil di update
				$this->alert->set('bg-success', "Update success !");//set alert
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('admincampus')."';"));//alert
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){//hapus admin kampus
		$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$this->input->post('id')));//delete data login
		$query 		= $this->Mod_crud->deleteData('t_admin_campus', array('adminCampusID' => $this->input->post('id')));//delete admin campus
		if ($query){//jika berhasil
			$data = array(//set sweat alert sukses
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
		public function modalReset()//pop up modal reset
	{
		$ID = explode('~',$this->input->post('id'));//ambil id
		$data = array(//set modal
				'modalTitle' => 'Reset Password Account '.$ID[1],//modal title
				'dMaster' => $this->Mod_crud->getData('row', 'emaiL', 't_admin_campus', null, null, null, array('adminCampusID = "'.$ID[0].'"')),//get data per id
				'formAction' => base_url('admincampus/reset'),//action
				'Req' => ''
			);
		$this->load->view('pages/admincampus/reset', $data);//load modal
	}

	function reset()//reset password
	{
		$email = $this->input->post('Email');

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
		$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
				'emaiL'			=> $email,
				'tokeN'			=> $tokeN,
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
	
		public function profile()//tampil profile
	{
		$id = $this->session->userdata('userlog')['sess_usrID']; //get id
		$detail = $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l'=>'a.loginID = l.loginID'),array('a.adminCampusID = "'.$id.'"'));//detail admin kampus
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
						"dashboards/js/plugins/forms/styling/uniform.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/admincampus-script.js",
				)
			),
			'titleWeb' => "My Profile | CBN Internship",
			'breadcrumb' => explode(',', 'Profile,My Profile'),
			'dtadmin' => $detail//data
		);
		$this->render('dashboard', 'pages/admincampus/profile', $data); //load view admin kampus profile
	}

		//form_update_profile
		public function profile_update()
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];//get id dari session
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
					"dashboards/js/pages/admincampus-script.js",
				)
			),
		    'titleWeb' => "Update Profile | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Profile,Update Profile'),
		    'dMaster' => $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l' => 'a.loginID = l.loginID'), array('adminCampusID = "'.$id.'"')), //get_data_by_id
			'actionForm' => base_url('admincampus/editProfile'),
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/admincampus/add', $data);
	}

		public function editProfile()//update profile
	{
		$cek = $this->Mod_crud->checkData('fullName', 't_admin_campus', array('fullName = "'.$this->input->post('Fullname').'"', 'adminCampusID != "'.$this->input->post('Admincampusid').'"')); //cel nama
		if ($cek){//jika ada
			echo json_encode(array('code' => 256, 'message' => 'Name has been registered'));//alert
		}else{

			$update = $this->Mod_crud->updateData('t_admin_campus', array(
						'emaiL' 	=> $this->input->post('Email'),
						'fullName' 	=> $this->input->post('Fullname'),
						'telePhone' 	=> $this->input->post('Telephone'),
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			), array('adminCampusID ' => $this->input->post('Admincampusid'))
           		);
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 	=> $this->input->post('Email')
           			), array('loginID'  => $this->input->post('Admincampusid'))
           	);
			helper_log('edit','Edit Profile',$this->session->userdata('userlog')['sess_usrID']);

			if ($update){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('admincampus/profile')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}

		public function changePass()//modal reset password
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Change Password '.$ID[1],
				'adminID' => $ID[0],
				'formAction' => base_url('admincampus/do_change_pass'),
				'Req' => ''
			);
		$this->load->view('pages/admincampus/changepass', $data);
	}

		public function do_change_pass()//rubah password 
	{
		$cek = $this->Mod_crud->checkData('passworD', 't_login', array('passworD = "'.md5($this->input->post('Password1')).'"', 'loginID = "'.$this->input->post('Admincampusid').'"'));
		if ($cek){
			echo json_encode(array('code' => 367, 'message' => 'The password you entered has been used before'));
		}else{
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'passworD'		=> md5($this->input->post('Password1')),
						'statuS'		=> 'verified',
           			), array('loginID'  => $this->input->post('Admincampusid'))
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

}

/* End of file admincampus.php */
/* Location: ./application/controllers/admincampus.php */
