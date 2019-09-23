<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Admuniversity extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$getdata = $this->Mod_crud->getData('result', 'a.*, l.roleID', 't_admin_university a', null, null, array('t_login l'=>'a.loginID = l.loginID'));
		$getuniversity = $this->Mod_crud->getData('result','*','t_university');

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
				'webTitle' 		=> 'Admin University',
				'pageTitle' 	=> explode(',', 'Accounts, Admin university'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Accounts, Admin university'),
				'dtadmin' 		=> $getdata,
				'university'	=> $getuniversity
			);
		$this->render('dashboard' , 'pages/admuniversity/index',$data);
	}

	public function save()
	{
		$emaiL = $this->input->post('emaiL');
		if ($this->Mod_crud->getData('result','emaiL','t_login',null,null,null,array('emaiL = "'.$emaiL.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Email already registered !</p>
                </div>');
			redirect('admuniversity');
		}else{

		$code 	= $this->Mod_crud->autoNumber('adminUniversityID','t_admin_university','33',3);

		$save = $this->Mod_crud->insertData('t_admin_university', array(
				'adminUniversityID'	=> $code,
				'loginID'			=> $code,
				'universityID'		=> $this->input->post('universityID'),
           		'emaiL' 			=> $emaiL,
           		'fullName'			=> $this->input->post('fullName'),
           		'telePhone'			=> $this->input->post('telePhone'),
           		'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'		=> date('Y-m-d H:i:s')
           		)
			);

		$savelogin = $this->Mod_crud->insertData('t_login', array(
				'loginID'		=> $code,
				'roleID'		=> 33,
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
		    helper_log('add','Added New Admin University, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have send an email to set a password!</p>
		            </div>');
           		redirect('admuniversity');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('admuniversity');
           	}
        }
	}

	public function edit()
	{
		$id  		= $this->input->post('adminUniversityID');

		$edit = $this->Mod_crud->updateData('t_admin_university', array(
						'universityID'	=> $this->input->post('universityID'),
		           		'emaiL' 		=> $this->input->post('emaiL'),
		           		'fullName'		=> $this->input->post('fullName'),
		           		'telePhone'		=> $this->input->post('telePhone'),
		           		'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('adminUniversityID'	=> $id)
           	);
		$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $this->input->post('emaiL')
           			), array('loginID'  => $id)
           	);
		helper_log('edit','Edited Admin University, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($updateLogin){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Data updated !</p>
		        </div>');
           		redirect('admuniversity');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('admuniversity');
        }
 	}

 	public function editprofile()
	{
		$id  		= $this->input->post('adminUniversityID');

		$edit = $this->Mod_crud->updateData('t_admin_university', array(
						'universityID'	=> $this->input->post('universityID'),
		           		'emaiL' 		=> $this->input->post('emaiL'),
		           		'fullName'		=> $this->input->post('fullName'),
		           		'telePhone'		=> $this->input->post('telePhone'),
		           		'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('adminUniversityID'	=> $id)
           	);
		$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $this->input->post('emaiL')
           			), array('loginID'  => $id)
           	);
		helper_log('edit','Edited Profile',$this->session->userdata('login')['sess_usrID']);
		if ($updateLogin){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Data updated !</p>
		        </div>');
           		redirect('admuniversity/profile');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('admuniversity/profile');
        }
 	}

 	public function changepass()
	{	
		$id 		= $this->input->post('adminUniversityID');
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
			redirect('admuniversity/profile');
		}else{
			if ($newpass != $newpass2) {
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>New Password Not Same !</p>
                </div>');
				redirect('admuniversity/profile');	
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
		           		redirect('admuniversity/profile');
		        }else{
		           	$this->session->set_flashdata('msg', 
				        '<div class="alert alert-danger">
				            <h4>Error</h4>
				            <p>an error occurred while saving data !</p>
				        </div>');
		           	redirect('admuniversity/profile');
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
           		redirect('admuniversity');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('admuniversity');
           	}
  
	}

	function delete(){
		$id = $this->input->post('id');
		$getdata 		= $this->Mod_crud->getData('row','emaiL','t_admin_university',null,null,null,array('adminUniversityID = "'.$id.'"'));
		$deletereset	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$getdata->emaiL));
		$delete 		= $this->Mod_crud->deleteData('t_admin_university',array('adminUniversityID'=>$id));
		$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
		helper_log('delete','Deleted Admin University, '.$id,$this->session->userdata('login')['sess_usrID']);
		redirect('admuniversity');
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$detail = $this->Mod_crud->getData('row', 'a.*, l.roleID', 't_admin_university a', null, null, array('t_login l'=>'a.emaiL = l.emaiL'),array('a.adminUniversityID = "'.$id.'"'));

		if (! $detail){
			redirect(base_url('admuniversity/index'),'refresh');
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
				'webTitle' 		=> "Profile ".$detail->fullName." ",
				'pageTitle' 	=> explode(',', 'Admin university, Profile '.$detail->fullName),
				'breadcrumb' 	=> explode(',', 'Dashboard, Admin university, Profile '.$detail->fullName),
				'dtadmin' 		=> $detail
			);
		$this->render('dashboard' , 'pages/admuniversity/detail',$data);
	}

	public function profile()
	{
		$id = $this->session->userdata('login')['sess_usrID'];
		$detail = $this->Mod_crud->getData('result', 'a.*, l.roleID', 't_admin_university a', null, null, array('t_login l'=>'a.emaiL = l.emaiL'),array('a.adminUniversityID = "'.$id.'"'));
		$getuniversity = $this->Mod_crud->getData('result','*','t_university');

		if (! $detail){
			redirect(base_url('admuniversity/index'),'refresh');
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
				'pageTitle' 	=> explode(',', 'Admin university, Profile'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Admin university, Profile'),
				'dtadmin' 		=> $detail,
				'university'			=> $getuniversity
			);
		$this->render('dashboard' , 'pages/admuniversity/profile',$data);
	}

}

/* End of file admuniversity.php */
/* Location: ./application/controllers/admuniversity.php */