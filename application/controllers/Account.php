<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Account extends CommonDash {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_crud');
	}

	public function do_resend()
	{
		$emaiL = $this->input->post('id');
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
		    $this->email->to($emaiL);
		    $this->email->subject('Account Setup Link');
		    $this->email->message($message);
		    helper_log('resend','Resend Setup Link to '.$emaiL,$this->session->userdata('userlog')['sess_usrID']);

           	if ($this->email->send()){
			$data = array(
					'code' => 200,
					'pesan' => 'Resend Link, Success!',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
	              	);
				echo json_encode($data);
			}else{
				echo '';
			}
	}

		public function do_revoke()
	{
		$emaiL 		= $this->input->post('id');
		$update 	= $this->Mod_crud->updateData('t_login', array(
		           		'passworD' 	=> NULL
           			), array('emaiL' => $emaiL)
           	);
		
		$delete 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$emaiL));
		helper_log('revoke','Revoke Setup Link for '.$emaiL,$this->session->userdata('userlog')['sess_usrID']);

           	if ($delete){
			$data = array(
					'code' => 200,
					'pesan' => 'Revoke Link, Success!',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
	              	);
				echo json_encode($data);
			}else{
				echo '';
			}
	}

	function delete(){
		$id 		= $this->input->post('id');
		$getlogin 	= $this->Mod_crud->getData('row','*','t_login',null,null,null,array('loginID = "'.$id.'"'));
		$email 		= $getlogin->emaiL;
		helper_log('delete','Deleted Account '.$email,$this->session->userdata('userlog')['sess_usrID']);

		if ($getlogin->roleID == 11) {
			$delete 	 = $this->Mod_crud->deleteData('t_admin',array('loginID'=>$id));
			$deletereset 	 = $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 	 = $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			if ($deletelog){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
			}else{
				echo '';
			}
		}elseif ($getlogin->roleID == 22 ) {
			$delete 		= $this->Mod_crud->deleteData('t_admin',array('loginID'=>$id));
			$deletereset 		= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));			
			if ($deletelog){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
			}else{
				echo '';
			}
		}elseif ($getlogin->roleID == 33 ) {
			$delete 		= $this->Mod_crud->deleteData('t_admin_university',array('loginID'=>$id));
			$deletereset 		= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));			
			if ($deletelog){
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
			}else{
				echo '';
			}
		}elseif ($getlogin->roleID == 44 ) {
			$getdosen		= $this->Mod_crud->getData('row','*','t_dosen',null,null,null,array('loginID = "'.$id.'"'));
			$delete 		= $this->Mod_crud->deleteData('t_dosen',array('loginID'=>$id));
			$deletereset 		= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			if ($deletelog){
			unlink(FCPATH . $getdosen->profilePic);
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
			}else{
				echo '';
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


}

/* End of file faculty.php */
/* Location: ./application/controllers/faculty.php */
