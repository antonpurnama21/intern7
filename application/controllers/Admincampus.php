<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Admincampus extends CommonDash {

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
						"dashboards/js/pages/admincampus-index-script.js",
				)
			),
			'titleWeb' => "admin Campus | CBN Internship",
			'breadcrumb' => explode(',', 'Account,Admin Campus'),
		);
		$this->render('dashboard', 'pages/admincampus/index', $data);
	}

	public function modalAdd(){
		$data = array(
				'modalTitle' => 'Add Account ',
				'formAction' => base_url('admincampus/save'),
				'Req' => ''
			);
		$this->load->view('pages/admincampus/form', $data);
	}

	public function save(){
		$cek = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Email has been registered'));
		}else{

			$id 	= $this->Mod_crud->autoNumber('adminCampusID','t_admin_campus','33',3);

			$save = $this->Mod_crud->insertData('t_admin_campus', array(
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
				'statuS'		=> 'new',
				'createdTime'	=> date('Y-m-d H:i:s')
				)
			); //insert login

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
			    helper_log('add','Add New Admin Campus Account ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($this->email->send()){
				$this->alert->set('bg-success', "Insert success ! Setup link hes been send");
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
				'modalTitle' => 'Edit Account '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l' => 'a.loginID = l.loginID'), array('admincampusID = "'.$ID[0].'"')),
				'formAction' => base_url('admincampus/edit'),
				'Req' => ''
			);
		$this->load->view('pages/admincampus/form', $data);
	}

	public function edit(){
		$cek = $this->Mod_crud->checkData('fullName', 't_admin_campus', array('fullName = "'.$this->input->post('Fullname').'"', 'adminCampusID != "'.$this->input->post('Admincampusid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Name has been registered'));
		}else{

			$update = $this->Mod_crud->updateData('t_admin_campus', array(
						'universityID'	=> $this->input->post('Universityid'),
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
			helper_log('edit','Edit Admin Campus Account ( '.$this->input->post('Email').' )',$this->session->userdata('userlog')['sess_usrID']);

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
		$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$this->input->post('id')));
		$query 		= $this->Mod_crud->deleteData('t_admin_campus', array('adminCampusID' => $this->input->post('id')));
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

		public function getCampus()
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

	public function getList()
	{
		$res = array();
		$admincampus = $this->Mod_crud->getData('result','a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l' => 'a.loginID = l.loginID'));
		if (!empty($admincampus)) {
			$no = 0;
			foreach ($admincampus as $key) {
				$no++;
				array_push($res, array(
							'',
							$no,
							"<div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>ID User :</div>
								<div class='col-md-8 text-semibold text-success'>".$key->loginID."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Admin Name :</div>
								<div class='col-md-8'>".$key->fullName."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Email :</div>
								<div class='col-md-8'>".$key->emaiL."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Phone Number :</div>
								<div class='col-md-8'>".$key->telePhone."</div>
							 </div>
							 <br/>
							 <div class='row nomargin' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>University :</div>
								<div class='col-md-8'>".name_university($key->universityID)."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Role User :</div>
								<div class='col-md-8'>".what_role($key->roleID)."</div>
							 </div>",
							'
							<a style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal(`'.base_url("admincampus/modalReset").'`, `'.$key->adminCampusID.'~'.$key->fullName.'`, `resetpass`);"><i class="icon-lock"></i></a>
							<a style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal(`'.base_url("admincampus/modalEdit").'`, `'.$key->adminCampusID.'~'.$key->fullName.'`, `editadmincampus`);"><i class="icon-quill4"></i></a>
							<a style="margin-bottom: 5px" class="btn btn-danger" onclick="confirms(`Delete`,`Admin Campus '.$key->fullName.'?`,`'.base_url("admincampus/delete").'`,`'.$key->adminCampusID.'`)"><i class="icon-trash"></i></a>
							'
							)
				);
			}
		}
		echo json_encode($res);
	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////
		public function modalReset()
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Reset Password Account '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row', 'emaiL', 't_admin_campus', null, null, null, array('adminCampusID = "'.$ID[0].'"')),
				'formAction' => base_url('admincampus/reset'),
				'Req' => ''
			);
		$this->load->view('pages/admincampus/reset', $data);
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
		           		'passworD' 	=> 'null',
					'statuS'	=> 'reset',
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
	
		public function profile()
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];
		$detail = $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l'=>'a.loginID = l.loginID'),array('a.adminCampusID = "'.$id.'"'));
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
						"dashboards/js/pages/admincampus-script.js",
				)
			),
			'titleWeb' => "My Profile | CBN Internship",
			'breadcrumb' => explode(',', 'Profile,My Profile'),
			'dtadmin' => $detail
		);
		$this->render('dashboard', 'pages/admincampus/profile', $data);
	}

		public function modalProfile()
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Update My Profile '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_campus a', null, null, array('t_login l' => 'a.loginID = l.loginID'), array('adminCampusID = "'.$ID[0].'"')),
				'formAction' => base_url('admincampus/editProfile'),
				'Req' => ''
			);
		$this->load->view('pages/admincampus/form', $data);
	}

		public function editProfile()
	{
		$cek = $this->Mod_crud->checkData('fullName', 't_admin_campus', array('fullName = "'.$this->input->post('Fullname').'"', 'adminCampusID != "'.$this->input->post('Admincampusid').'"'));
		if ($cek){
			echo json_encode(array('code' => 256, 'message' => 'Name has been registered'));
		}else{

			$update = $this->Mod_crud->updateData('t_admin_campus', array(
						'universityID'	=> $this->input->post('Universityid'),
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
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
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
				'adminID' => $ID[0],
				'formAction' => base_url('admincampus/do_change_pass'),
				'Req' => ''
			);
		$this->load->view('pages/admincampus/changepass', $data);
	}

		public function do_change_pass()
	{
		$cek = $this->Mod_crud->checkData('passworD', 't_login', array('passworD = "'.md5($this->input->post('Password1')).'"', 'loginID = "'.$this->input->post('Admincampusid').'"'));
		if ($cek){
			echo json_encode(array('code' => 367, 'message' => 'The password you entered has been used before'));
		}else{
			$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'passworD'		=> md5($this->input->post('Password1')),
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
