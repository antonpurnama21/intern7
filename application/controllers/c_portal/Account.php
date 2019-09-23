<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Account extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$getaccount = $this->Mod_crud->getData('result', '*', 't_login', null, null, null,array('passworD = "null"'));

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
				'webTitle' 		=> 'Pending Account | Website Portal Internship',
				'pageTitle' 	=> explode(',', 'Accounts, Pending Account'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Accounts, Pending Account'),
				'dtaccount' 	=> $getaccount
			);
		$this->render('dashboard' , 'pages/account/index',$data);
	}

	public function do_resend()
	{
		$emaiL = $this->input->post('emaiL');
		$delete 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$emaiL));

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
		    helper_log('resend','Resend Setup Link to '.$emaiL,$this->session->userdata('login')['sess_usrID']);

           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have resend an email to set a password!</p>
		            </div>');
           		redirect('account');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('account');
           	
        	}
	}

	public function do_revoke()
	{
		$emaiL 		= $this->input->post('emaiL');
		$update 	= $this->Mod_crud->updateData('t_login', array(
		           		'passworD' 	=> NULL
           			), array('emaiL' => $emaiL)
           	);
		
		$delete 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$emaiL));
		helper_log('revoke','Revoke Setup Link for '.$emaiL,$this->session->userdata('login')['sess_usrID']);

           	if ($delete){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have revoke link !</p>
		            </div>');
           		redirect('account');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('account');
           	
        }
	}

	function delete(){
		$id 		= $this->input->post('id');
		$getlogin 	= $this->Mod_crud->getData('row','*','t_login',null,null,null,array('loginID = "'.$id.'"'));
		$email 		= $getlogin->emaiL;
		helper_log('delete','Deleted Account '.$emaiL,$this->session->userdata('login')['sess_usrID']);

		if ($getlogin->roleID == 11) {
			$delete 	 = $this->Mod_crud->deleteData('t_admin',array('loginID'=>$id));
			$deletereset = $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 	 = $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			redirect('account');
		}elseif ($getlogin->roleID == 22 ) {
			$delete 		= $this->Mod_crud->deleteData('t_admin',array('loginID'=>$id));
			$deletereset 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));			
			redirect('account');
		}elseif ($getlogin->roleID == 33 ) {
			$delete 		= $this->Mod_crud->deleteData('t_admin_university',array('loginID'=>$id));
			$deletereset 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));			
			redirect('account');
		}elseif ($getlogin->roleID == 44 ) {
			$getdosen		= $this->Mod_crud->getData('row','*','t_dosen',null,null,null,array('loginID = "'.$id.'"'));
			$delete 		= $this->Mod_crud->deleteData('t_dosen',array('loginID'=>$id));
			$deletereset 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			if ($deletelog){
			unlink(FCPATH . $getdosen->profilePic);
           	redirect('account');
			}
		}else{
			$getmhs 	= $this->Mod_crud->getData('row','*','t_mahasiswa',null,null,null,array('loginID = "'.$id.'"'));
			$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$getmhs->mahasiswaID.'"'));
			$delete 	= $this->Mod_crud->deleteData('t_mahasiswa',array('loginID'=>$id));
			$delete 	= $this->Mod_crud->deleteData('t_mahasiswa_file',array('fileID'=>$getfile->fileID));
			$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			if ($deletelog){
			unlink(FCPATH . $getfile->photo);
			unlink(FCPATH . $getfile->resume);
			unlink(FCPATH . $getfile->academicTranscipt);
           	redirect('account');
			}
		}
	}
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */