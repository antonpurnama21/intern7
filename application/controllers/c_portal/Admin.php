<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Admin extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$getadmin = $this->Mod_crud->getData('result', 'a.*, l.roleID', 't_admin a', null, null, array('t_login l'=>'a.loginID = l.loginID'));
		$getdept = $this->Mod_crud->getData('result','*','t_department');
		$getrole = $this->Mod_crud->getData('result','*','t_role',2,null,null,null,null,array('roleID ASC'));

		$data = array(
				'_CSS' => generate_css(array(
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/alert/sweetalert.css"
						)
				),
				'_JS' => generate_js(array(
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/alert/sweetalert.min.js",
							"dashboard/alert/sweetalert.js"
						)
				),
				'webTitle' 		=> 'Admin Account | Website Portal Internship',
				'pageTitle' 	=> explode(',', 'Accounts, Admin Department'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Accounts, Admin Department'),
				'dtadmin' 		=> $getadmin,
				'dept'			=> $getdept,
				'role'			=> $getrole
			);
		$this->render('dashboard' , 'pages/admin/index',$data);
	}

	public function save()
	{
		$emaiL = $this->input->post('emaiL');
		$role = $this->input->post('roleID');
		if ($this->Mod_crud->getData('result','emaiL','t_login',null,null,null,array('emaiL = "'.$emaiL.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Email already registered !</p>
                </div>');
			redirect('admin');
		}else{
			if ($role==11) {
				$adminID 	= $this->Mod_crud->autoNumber('adminID','t_admin','11',3);
			}elseif ($role==22) {
				$adminID 	= $this->Mod_crud->autoNumber('adminID','t_admin','22',3);	
			}

		$save = $this->Mod_crud->insertData('t_admin', array(
				'adminID'		=> $adminID,
				'loginID'		=> $adminID,
           		'emaiL' 		=> $emaiL,
           		'fullName'		=> $this->input->post('fullName'),
           		'telePhone'		=> $this->input->post('telePhone'),
           		'deptID'		=> $this->input->post('deptID'),
           		'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'	=> date('Y-m-d H:i:s')
           		)
			);

		$savelogin = $this->Mod_crud->insertData('t_login', array(
				'loginID'		=> $adminID,
				'roleID'		=> $role,
				'emaiL'			=> $emaiL,
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
				'emaiL'			=> $emaiL,
				'tokeN'			=> $tokeN,
				'created_at'	=> date('Y-m-d H:i:s'),
				'expired_at'	=> $expired_at
				)
			);

		$config = array(
		  				'protocol' => 'smtp',
				  		'smtp_host' => 'ssl://smtp.gmail.com',
				  		'smtp_port' => 465,
				  		'smtp_user' => 'midaspurnama@gmail.com', // change it to yours
				  		'smtp_pass' => 'midaspurnama123456789', // change it to yours
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
							<p>Please click the link below to set your password ".base_url('login/passwordreset/'.$tokeN)." <br/>( warning: this link will expire after one hour )<br/><br/></p>
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
		    $this->email->to($emaiL);
		    $this->email->subject('Account Setup Link');
		    $this->email->message($message);
		    helper_log('add','Added New Admin Department, '.$adminID,$this->session->userdata('login')['sess_usrID']);

           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have send an email to set a password!</p>
		            </div>');
           		redirect('admin');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('admin');
           	}
        }
	}

	public function edit()
	{
		$id  		= $this->input->post('adminID');
		$email 		= $this->input->post('emaiL');
		$get 		= $this->Mod_crud->getData('row','emaiL','t_admin',null,null,null,array('adminID = "'.$id.'"'));
		$emailOLD 	= $get->emaiL;
		$getlog 	= $this->Mod_crud->getData('row','loginID','t_login',null,null,null,array('emaiL = "'.$emailOLD.'"'));
		$loginID 	= $getlog->loginID;

		$edit = $this->Mod_crud->updateData('t_admin', array(
		           		'emaiL' 		=> $this->input->post('emaiL'),
		           		'fullName'		=> $this->input->post('fullName'),
		           		'telePhone'		=> $this->input->post('telePhone'),
		           		'deptID'		=> $this->input->post('deptID'),
		           		'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('adminID'	=> $id)
           	);
		$updateLogin = $this->Mod_crud->updateData('t_login', array(
						'roleID'		=> $this->input->post('roleID'),
		           		'emaiL' 		=> $this->input->post('emaiL')
           			), array('loginID'  => $loginID)
           	);
		helper_log('edit','Edited Admin Department, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($updateLogin){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Data updated !</p>
		        </div>');
           		redirect('admin');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('admin');
        }
 	}

 	public function editprofile()
	{
		$id  		= $this->input->post('adminID');
		$email 		= $this->input->post('emaiL');
		$get 		= $this->Mod_crud->getData('row','emaiL','t_admin',null,null,null,array('adminID = "'.$id.'"'));
		$emailOLD 	= $get->emaiL;
		$getlog 	= $this->Mod_crud->getData('row','loginID','t_login',null,null,null,array('emaiL = "'.$emailOLD.'"'));
		$loginID 	= $getlog->loginID;

		$edit = $this->Mod_crud->updateData('t_admin', array(
		           		'emaiL' 		=> $this->input->post('emaiL'),
		           		'fullName'		=> $this->input->post('fullName'),
		           		'telePhone'		=> $this->input->post('telePhone'),
		           		'deptID'		=> $this->input->post('deptID'),
		           		'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('adminID'	=> $id)
           	);
		$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $this->input->post('emaiL')
           			), array('loginID'  => $loginID)
           	);
		helper_log('edit','Edited Profile',$this->session->userdata('login')['sess_usrID']);
		if ($updateLogin){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Data updated !</p>
		        </div>');
           		redirect('admin/profile');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('admin/profile');
        }
 	}

 	public function changepass()
	{	
		$id 		= $this->input->post('adminID');
		$old 		= md5($this->input->post('oldpass'));
		$newpass 	= $this->input->post('newpass');
		$newpass2 	= $this->input->post('newpass2');

		$getold = $this->Mod_crud->getData('row', 'passworD', 't_login', null, null, null, array('loginID = "'.$id.'"'));

		if ($old != $getold->passworD) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Old Password Not Same !</p>
                </div>');
			redirect('admin/profile');
		}else{
			if ($newpass != $newpass2) {
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>New Password Not Same !</p>
                </div>');
				redirect('admin/profile');	
			}else{

				$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'passworD' 		=> md5($newpass)
           			), array('loginID'  => $id)
		        );
				helper_log('edit','Edited Password',$this->session->userdata('login')['sess_usrID']);
				if ($updateLogin){
		           	$this->session->set_flashdata('msg', 
				        '<div class="alert alert-success">
				            <h4>Success</h4>
				            <p>Password updated !</p>
				        </div>');
		           		redirect('admin/profile');
		        }else{
		           	$this->session->set_flashdata('msg', 
				        '<div class="alert alert-danger">
				            <h4>Error</h4>
				            <p>an error occurred while saving data !</p>
				        </div>');
		           	redirect('admin/profile');
		        }
			}
		}
 	}

	function reset(){
		$email = $this->input->post('emaiL');

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
		$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
				'emaiL'			=> $email,
				'tokeN'			=> $tokeN,
				'created_at'	=> date('Y-m-d H:i:s'),
				'expired_at'	=> $expired_at
				)
			);

		$config = array(
				  		'protocol' => 'smtp',
				  		'smtp_host' => 'ssl://smtp.gmail.com',
				  		'smtp_port' => 465,
				  		'smtp_user' => 'midaspurnama@gmail.com', // change it to yours
				  		'smtp_pass' => 'midaspurnama123456789', // change it to yours
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
							<p>Please click the link below to set your password ".base_url('login/passwordreset/'.$tokeN)." <br/>( warning: this link will expire after one hour )<br/><br/></p>
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
		    helper_log('reset','Send Setup Link for reset Password to '.$email,$this->session->userdata('login')['sess_usrID']);
           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have send an email to reset password!</p>
		            </div>');
           		redirect('admin');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('admin');
           	}
	}

	function delete(){
		$id = $this->input->post('id');
		$getdosen 		= $this->Mod_crud->getData('row','emaiL','t_admin',null,null,null,array('adminID = "'.$id.'"'));
		$deletereset	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$getdosen->emaiL));
		$delete 		= $this->Mod_crud->deleteData('t_admin',array('adminID'=>$id));
		$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
		helper_log('delete','Deleted Admin Department, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('admin');
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$detail = $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin a', null, null, array('t_login l'=>'a.emaiL = l.emaiL'),array('a.adminID = "'.$id.'"'));

		if (! $detail){
			redirect(base_url('admin/index'),'refresh');
		}
		$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/superbox/css/superbox.min.css",
							"dashboard/plugins/lity/dist/lity.min.css",
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"
						)
				),
				'_JS' => generate_js(array(
							"dashboard/plugins/superbox/js/jquery.superbox.min.js",
							"dashboard/plugins/lity/dist/lity.min.js",
							"dashboard/js/demo/profile.demo.min.js",
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js"
						)
				),
				'webTitle' => "Profile ".$detail->fullName." ",
				'pageTitle' => explode(',', 'Admin Department, Profile '.$detail->fullName),
				'breadcrumb' => explode(',', 'Dashboard, Admin Department, Profile '.$detail->fullName),
				'dtadmin' 		=> $detail
			);
		$this->render('dashboard' , 'pages/admin/detail',$data);
	}

	public function profile()
	{
		$id = $this->session->userdata('login')['sess_usrID'];
		$detail = $this->Mod_crud->getData('result', 'a.*, l.roleID', 't_admin a', null, null, array('t_login l'=>'a.loginID = l.loginID'),array('a.adminID = "'.$id.'"'));
		$getdept = $this->Mod_crud->getData('result','*','t_department');

		if (! $detail){
			redirect(base_url('admin/index'),'refresh');
		}
		$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/superbox/css/superbox.min.css",
							"dashboard/plugins/lity/dist/lity.min.css",
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"
						)
				),
				'_JS' => generate_js(array(
							"dashboard/plugins/superbox/js/jquery.superbox.min.js",
							"dashboard/plugins/lity/dist/lity.min.js",
							"dashboard/js/demo/profile.demo.min.js",
							"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
							"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
							"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
							"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
							"dashboard/js/demo/table-manage-autofill.demo.min.js"
						)
				),
				'webTitle' 		=> "Profile",
				'pageTitle' 	=> explode(',', 'Admin Department, Profile'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Admin Department, Profile'),
				'dtadmin' 		=> $detail,
				'dept'			=> $getdept
			);
		$this->render('dashboard' , 'pages/admin/profile',$data);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */