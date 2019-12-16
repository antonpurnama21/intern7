<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Account extends CommonDash {
//controller untuk mengelola permintaan reset password
	public function __construct()
	{
		parent::__construct();
	}

	public function do_resend() // fungsi untuk mengirim ulang email setup password
	{
		$emaiL 	= $this->input->post('id'); //ambil email
		$delete = $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$emaiL)); //menghapus email pada tabel reset password

		$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //string untuk generate token
		$tokeN 	= substr(str_shuffle($set), 0, 55); //buat token
		$create = time(); //set waktu
		$exp = 60*60; //set jangka waktu kadaluarsa
		$done = $create+$exp; //set kadaluarsa
		$expired_at = date('Y-m-d H:i:s',$done); //set kadaluarsa setelah di kirim

		$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
				'emaiL'		=> $emaiL,
				'tokeN'		=> $tokeN,
				'created_at'	=> date('Y-m-d H:i:s'),
				'expired_at'	=> $expired_at
				) // create data pada t_password_reset
			);

			$config = array(
				  		'protocol' => 'ssmtp',//protocol
				  		'smtp_host' => 'ssl://mail.intern7.iex.or.id', //rubah ke host kamu
				  		'smtp_port' => 465, //port
				  		'smtp_user' => 'info@intern7.iex.or.id', // rubah ke email user kamu
				  		'smtp_pass' => 'Infocbn123', // rubah ke password kamu
				  		//'smtp_username' => 'armg3295',
				  		'mailtype' => 'html', //type email
				  		'charset' => 'iso-8859-1', //karakter huruf
				  		'wordwrap' => TRUE //wordwap
			);

			$message = 	'
						<html>
						<head>
							<title>Account Setup Link</title>
						</head>
						<body>
							<h2>CBN Internship Web Portal</h2>
							<p>Please click the link below to set your password '.base_url('auth/reset/'.$tokeN).' <br/>( warning: this link will expire after one hour )<br/><br/></p>
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
						'; //isi pesan
	 		
		    $this->load->library('email', $config); //load library
		    $this->email->set_newline("\r\n");
		    $this->email->from($config['smtp_user']);
		    $this->email->to($emaiL);
		    $this->email->subject('Account Setup Link'); //subjek email
		    $this->email->message($message);
		    helper_log('resend','Resend Setup Link to '.$emaiL,$this->session->userdata('userlog')['sess_usrID']); //create log aktivitas

           	if ($this->email->send()){ //jika terkirim
			$data = array( //menampilkan sweatalert
					'code' => 200,
					'pesan' => 'Resend Setup Link, Success!',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
	              	);
				echo json_encode($data);
			}else{
				echo '';
			}
	}

		public function do_revoke() //email untuk membatalkan perubahan password
	{
		$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$tokeN 	= substr(str_shuffle($set), 0, 12);
		$emaiL 		= $this->input->post('id');
		$update 	= $this->Mod_crud->updateData('t_login', array(
		           	'passworD' 	=> md5($tokeN),
					'statuS'	=> 'revoke',
           			), array('emaiL' => $emaiL)
           	);
		
		$delete 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$emaiL));

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

			$message = 	'
						<html>
						<head>
							<title>Revoke Setup Link</title>
						</head>
						<body>
							<h2>CBN Internship Web Portal</h2>
							<p>The request to change your account password has been canceled by HC Admin, please use the random password <b><i>'.$tokeN.'</i></b> to continue being able to access your account.<br/><br/></p>
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
						';
	 		
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($config['smtp_user']);
		    $this->email->to($emaiL);
		    $this->email->subject('Revoke Setup Link');
		    $this->email->message($message);
		    helper_log('revoke','Revoke Setup Link for '.$emaiL,$this->session->userdata('userlog')['sess_usrID']);

           	if ($this->email->send()){
			$data = array(
					'code' => 200,
					'pesan' => 'Send Revoke Link, Success!',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
	              	);
				echo json_encode($data);
			}else{
				echo '';
			}
	}

	function delete(){ //fungsi untuk menghapus
		$id 		= $this->input->post('id'); //ambil id login
		$getlogin 	= $this->Mod_crud->getData('row','*','t_login',null,null,null,array('loginID = "'.$id.'"')); //ambil data login pada table t_login
		$email 		= $getlogin->emaiL; //ambil email
		helper_log('delete','Deleted Account '.$email,$this->session->userdata('userlog')['sess_usrID']); //create log delete

		if ($getlogin->roleID == 11) { //jika role id = 11
			$delete 	 = $this->Mod_crud->deleteData('t_admin',array('loginID'=>$id)); //delete data admin pd table t-admin
			$deletereset 	 = $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email)); //delete email pada table t-password-reset
			$deletelog 	 = $this->Mod_crud->deleteData('t_login',array('loginID'=>$id)); //delete data login pada table login
			if ($deletelog){ //jika di eksekusi $deletelog maka..
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
			}else{
				echo '';
			}
		}elseif ($getlogin->roleID == 22 ) { //jika role id = 22
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
		}elseif ($getlogin->roleID == 33 ) { //jika role id = 33
			$delete 		= $this->Mod_crud->deleteData('t_admin_university',array('loginID'=>$id)); //delete data pd table t_admin_university
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
		}elseif ($getlogin->roleID == 44 ) { //jika role id = 44
			$getdosen		= $this->Mod_crud->getData('row','*','t_dosen',null,null,null,array('loginID = "'.$id.'"')); //delete data pada table dosen
			$delete 		= $this->Mod_crud->deleteData('t_dosen',array('loginID'=>$id));
			$deletereset 		= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));
			$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			if ($deletelog){
			unlink(FCPATH . $getdosen->profilePic); //menghapus gambar pada direktori project
			$data = array(
					'code' => 200,
					'pesan' => 'Success Delete !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
			}else{
				echo '';
			}
		}else{ //untuk role id = 55
			//$getmhs 	= $this->Mod_crud->getData('row','*','t_mahasiswa',null,null,null,array('loginID = "'.$id.'"'));
			$getfile 	= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$id.'"')); // ambil data file mahasiswa pada table t-mahasiswa-file
			$delete 	= $this->Mod_crud->deleteData('t_mahasiswa',array('loginID'=>$id));//hapus data mahasiswa pada table mahasiswa
			$delete 	= $this->Mod_crud->deleteData('t_mahasiswa_file',array('fileID'=>$getfile->fileID));//menghapus data pada table t-file-mahasiswa
			$deletelog 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
			if ($deletelog){
			unlink(FCPATH . $getfile->photo); //hapus file foto pada dir projek
			unlink(FCPATH . $getfile->resume); //hapus file resume pda dir projek
			unlink(FCPATH . $getfile->academicTranscipt); //hapus file transcipt pada dir projek
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

/* End of file account.php */
/* Location: ./application/controllers/account.php */
