<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Admin extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}

	// index_list_admin
	public function index()
	{
		$data = array(
			'_JS' => generate_js(array( //menggenerate js
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
						"dashboards/js/pages/admin-index-script.js",
				)
			),
			'titleWeb' => "Admin Department | CBN Internship", //title web
			'breadcrumb' => explode(',', 'Account,Admin Department'), //breadcrumb
			'dMaster'	=> $this->Mod_crud->getData('result','a.*, l.roleID', 't_admin a', null, null, array('t_login l' => 'a.loginID = l.loginID')), //mengambil data admin pada table admin
		);
		$this->render('dashboard', 'pages/admin/index', $data); //load view admin index.php
	}


	// form_tambah_admin
		public function add()
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
		    'titleWeb' => "Add Admin Department | CBN Internship",
		    'breadcrumb' => explode(',', 'Admin Department,Add Admin Department '),
		    'actionForm' => base_url('admin/save'), //set action pada form tambah
		    'buttonForm' => 'Simpan' //set button
		);

		$this->render('dashboard', 'pages/admin/add', $data); //load view admin add.php
	}

	// menyimpan_data_admin
	public function save(){
		$cek = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"')); //cek_email_yg_sama
		if ($cek){ //jika ada
			echo json_encode(array('code' => 366, 'message' => 'Email has been registered'));
		}else{
			
			if ($this->input->post('Roleid')==11) { //jika role id 11
				$id 	= $this->Mod_crud->autoNumber('adminID','t_admin','11',3); //create id otomatis pada table admin
			}elseif ($this->input->post('Roleid')==22) { //jika role id 22
				$id 	= $this->Mod_crud->autoNumber('adminID','t_admin','22',3);	
			}

			$save = $this->Mod_crud->insertData('t_admin', array( //simpan data pada table admin
						'adminID' 	=> $id,
						'loginID' 	=> $id,
						'emaiL' 	=> $this->input->post('Email'),
						'fullName' 	=> $this->input->post('Fullname'),
						'telePhone' => $this->input->post('Telephone'),
						'deptID'	=> $this->input->post('Deptid'),
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' => date('Y-m-d H:i:s')
           			)
           		);

			$savelogin = $this->Mod_crud->insertData('t_login', array( //simpan data login pada table login
				'loginID'		=> $id,
				'roleID'		=> $this->input->post('Roleid'),
				'emaiL'			=> $this->input->post('Email'),
				'passworD'		=> 'null',
				'statuS'		=> 'new-user',
				'createdTime'		=> date('Y-m-d H:i:s')
				)
			); //insert login

			$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //set random string
			$tokeN 	= substr(str_shuffle($set), 0, 55); //membuat_token_untuk_email setup pasword
			$create = time();//set waktu
			$exp = 60*60;//set jangka waktu kadaluarsa
			$done = $create+$exp;//set waktu kadaluarsa
			$expired_at = date('Y-m-d H:i:s',$done); //set waktu kadaluara setelah berhasil dikirim

			$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array( //simpan email pada table password reset
					'emaiL'		=> $this->input->post('Email'),
					'tokeN'		=> $tokeN,
					'created_at'	=> date('Y-m-d H:i:s'),
					'expired_at'	=> $expired_at
					)
				); //insert_email_pada_tabel_password_reset

			$config = array(
			  				'protocol' => 'ssmtp', //protoco;
							'smtp_host' => 'ssl://mail.intern7.iex.or.id', //rubah ke host kamu
							'smtp_port' => 465, //port
							'smtp_user' => 'info@intern7.iex.or.id', // change it to yours
							'smtp_pass' => 'Infocbn123', // change it to yours
					  		//'smtp_username' => 'armg3295',
					  		'mailtype' => 'html', //type email
					  		'charset' => 'iso-8859-1', //set karakter huruf
					  		'wordwrap' => TRUE //wordwrap
				); //setup_email

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
							"; //isi pesan
		 		
			    $this->load->library('email', $config); //load library email
			    $this->email->set_newline("\r\n");
			    $this->email->from($config['smtp_user']);//email dari
			    $this->email->to($this->input->post('Email'));//kirim ke
			    $this->email->subject('Account Setup Link'); //subjek email
			    $this->email->message($message); //isi pesan
			    helper_log('add','Add New Admin Department Account ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']); //catat aktivitas log_simpan_admin
			    create_notification('New','Admin Department',$this->input->post('Fullname'),'admin/index'); //sreate notifikasi

			if ($this->email->send()){ //jika terkirim
				$this->alert->set('bg-success', "Insert success ! Setup link hes been send"); //set alert
       			echo json_encode(array('code' => 200, 'message' => 'Insert success ! Setup link hes been send', 'aksi' => "window.location.href='".base_url('admin')."';")); //alert berhasil
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !')); //alert gagal
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//form_edit_admin
		public function form($id=null)
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
		    'titleWeb' => "Edit Admin Department | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Admin Department,Edit Admin ('.name_admin($id).')'),
		    'dMaster' => $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin a', null, null, array('t_login l' => 'a.loginID = l.loginID'), array('adminID = "'.$id.'"')), //ambil_data_admin_per_id
			'actionForm' => base_url('admin/edit'), //set form action
		    'buttonForm' => 'Simpan', //set button
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/admin/add', $data); // load admin add
	}

	public function edit(){
		$cek = $this->Mod_crud->checkData('fullName', 't_admin', array('fullName = "'.$this->input->post('Fullname').'"', 'adminID != "'.$this->input->post('Adminid').'"')); //cek_nama_yg_sama
		if ($cek){ //jika ada
			echo json_encode(array('code' => 367, 'message' => 'Name has been registered'));
		}else{
			$update = $this->Mod_crud->updateData('t_admin', array(
						'emaiL' 	=> $this->input->post('Email'),
						'fullName' 	=> $this->input->post('Fullname'),
						'telePhone' => $this->input->post('Telephone'),
						'deptID'	=> $this->input->post('Deptid'),
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' => date('Y-m-d H:i:s')
           			), array('adminID ' => $this->input->post('Adminid'))
           		); //updata_admin
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
					'roleID'		=> $this->input->post('Roleid'),
		           		'emaiL' 		=> $this->input->post('Email')
           			), array('loginID'  => $this->input->post('Adminid'))
           	); //update_login
			helper_log('edit','Edit Admin Department Account ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']); //log_update_admin

			if ($update){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('admin')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//delete_admin
	public function delete(){
		helper_log('delete','Delete Account ( '.email($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']); //log_delete_admin
		$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$this->input->post('id'))); //delete_login
		$query 		= $this->Mod_crud->deleteData('t_admin', array('adminID' => $this->input->post('id'))); //delete_admin
		if ($query){ //jika di eksekusi
			$data = array(//sweat alert berhasil
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
	//modal_reset_password
		public function modalReset()
	{
		$ID = explode('~',$this->input->post('id')); //get id
		$data = array(
				'modalTitle' => 'Reset Password Account '.$ID[1], //modal title
				'dMaster' => $this->Mod_crud->getData('row', 'emaiL', 't_admin', null, null, null, array('adminID = "'.$ID[0].'"')), //get data admin perid
				'formAction' => base_url('admin/reset'),
				'Req' => ''
			);
		$this->load->view('pages/admin/reset', $data);//view load admin reset
	}

	//reset_password
	function reset()
	{
		$email = $this->input->post('Email');

		$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tokeN 	= substr(str_shuffle($set), 0, 55); //membuat_token
		$create = time();
		$exp = 60*60;
		$done = $create+$exp;
		$expired_at = date('Y-m-d H:i:s',$done);

		$update = $this->Mod_crud->updateData('t_login', array(
		           		'passworD' 	=> 'null',
						'statuS'	=> 'reset-password',
           			), array('emaiL' => $email)
           	); //update_login
		$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
				'emaiL'		=> $email,
				'tokeN'		=> $tokeN,
				'created_at'	=> date('Y-m-d H:i:s'),
				'expired_at'	=> $expired_at
				)
			); //insert_password_reset

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
			); //config_email

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
	//halaman_profile
	public function profile()
	{
		$id = $this->session->userdata('userlog')['sess_usrID']; //ambil id
		$detail = $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin a', null, null, array('t_login l'=>'a.loginID = l.loginID'),array('a.adminID = "'.$id.'"')); //get admin by id
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
						"dashboards/js/pages/admin-script.js",
				)
			),
			'titleWeb' => "My Profile | CBN Internship",
			'breadcrumb' => explode(',', 'Profile,My Profile'),
			'dtadmin' => $detail
		);
		$this->render('dashboard', 'pages/admin/profile', $data);//view load admin profile
	}

	//form_update_profile
		public function profile_update()
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];
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
		    'titleWeb' => "Update Profile | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Profile,Update Profile'),
		    'dMaster' => $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin a', null, null, array('t_login l' => 'a.loginID = l.loginID'), array('adminID = "'.$id.'"')), //get_data_by_id
			'actionForm' => base_url('admin/editProfile'), //action form
		    'buttonForm' => 'Simpan',
		    'Req' => ''
		);

		$this->render('dashboard', 'pages/admin/add', $data); //view load admin add
	}

	//update_profile
		public function editProfile()
	{
		$cek = $this->Mod_crud->checkData('fullName', 't_admin', array('fullName = "'.$this->input->post('Fullname').'"', 'adminID != "'.$this->input->post('Adminid').'"'));// cek nama yang sama
		if ($cek){ //jika ada
			echo json_encode(array('code' => 367, 'message' => 'Name has been registered'));
		}else{
			$update = $this->Mod_crud->updateData('t_admin', array(
						'emaiL' 	=> $this->input->post('Email'),
						'fullName' 	=> $this->input->post('Fullname'),
						'telePhone' 	=> $this->input->post('Telephone'),
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTime' 	=> date('Y-m-d H:i:s')
           			), array('adminID ' => $this->input->post('Adminid'))
           		); //update_admin
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $this->input->post('Email')
           			), array('loginID'  => $this->input->post('Adminid'))
           	); //update_profile
			helper_log('edit','Edit Profile',$this->session->userdata('userlog')['sess_usrID']); //log_update_profile

			if ($update){ //jika berhasil
				$this->alert->set('bg-success', "Update success !"); //alert berhasil
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('admin/profile')."';")); 
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}

	//modal_ganti_password
	public function changePass()
	{
		$ID = explode('~',$this->input->post('id')); //ambil id
		$data = array(
				'modalTitle' => 'Change Password '.$ID[1],
				'adminID' => $ID[0],
				'formAction' => base_url('admin/do_change_pass'),
				'Req' => ''
			);
		$this->load->view('pages/admin/changepass', $data);//load view changepass
	}

	//ganti_password
		public function do_change_pass()
	{
		$cek = $this->Mod_crud->checkData('passworD', 't_login', array('passworD = "'.md5($this->input->post('Password1')).'"', 'loginID = "'.$this->input->post('Adminid').'"')); //cek_password
		if ($cek){ //jika sama
			echo json_encode(array('code' => 367, 'message' => 'The password you entered has been used before'));
		}else{ //jika tidak ada
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'passworD'		=> md5($this->input->post('Password1')),
						'statuS'		=> 'verified',
           			), array('loginID'  => $this->input->post('Adminid')) //create data pada table login
           	);
			helper_log('edit','Change Password',$this->session->userdata('userlog')['sess_usrID']); //create log aktiviti ubah password

			if ($updateLogin){ //jika berhasil
				$this->alert->set('bg-success', "Update success !");//set alert success
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
		}
	}


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
