<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_crud'); //memanggil model mod crud
	}

	public function index()
	{
		
	}

	public function login() //fungsi kehalaman login
	{			
		if ($this->session->userdata('userlog')['is_login'] == TRUE) : //jika session is_login sama bernilain true
			redirect(base_url('dashboard')) ; //redirect ke controller dashboard
		endif;

		update_workscope(); //update workscope secara otomatis
		update_project_scope(); //update project scope secara otomatis
		update_task(); //update task secara otomatis

		$data = array(
		    'titleWeb' => 'Login page | CBN Internship', //title website
		);
		$this->template->load('login', null, $data); //load view login
	}

	public function do_login() //aksi login
	{
		$cekUser = $this->Mod_crud->getData('row', '*', 't_login', null, null, null, array('emaiL = "'.$this->input->post('email').'"')); //cek email pengguna pada tabel login
		if ($cekUser == false){ //jika tak ada menampilkan pesan alert
			echo json_encode(array('code' => 366, 'message' => 'Email not found'));
		}else{
			$cekPass = $this->Mod_crud->getData('row', '*', 't_login', null, null, null, array('emaiL = "'.$this->input->post('email').'"', 'passworD = "'.MD5($this->input->post('password')).'"')); //cek password pengguna pada tabel login
			if ($cekPass == false){ //jika tak ada menampilkan pesan alert
				echo json_encode(array('code' => 369, 'message' => 'Wrong password'));
			}else{
					//$avatar = base_url('assets/dashboards/images/avatars/default_avatar.png');
			if ($this->input->post("chkremember")){ //remember me pada login
                        $this->input->set_cookie('u_mail', $this->input->post('email'), 86500); //86500 = 24 jam /* Create cookie for store emailid */
                        $this->input->set_cookie('u_pass', $this->input->post('password'), 86500); //86500 = 24 jam /* Create cookie for password */
                    }

                	if ($cekPass->roleID == 11 OR $cekPass->roleID == 22) { //cek role ID untuk admin department
						$user 	= $this->Mod_crud->getData('row', '*', 't_admin', null, null, null, array('emaiL = "'.$cekPass->emaiL.'"')); //ambil data admin department pada tabel admin department
						$login['sess_usrID']  = $user->adminID;
						$login['sess_deptID'] = $user->deptID;
						$avatar = base_url('fileupload/pic_admin/default.png');
					}elseif ($cekPass->roleID == 33) { //cek role id untuk admin campus
						$user 	= $this->Mod_crud->getData('row', '*', 't_admin_campus', null, null, null, array('emaiL = "'.$cekPass->emaiL.'"')); //ambil data admin campus pada table admin campus
						$login['sess_usrID'] 	= $user->adminCampusID;
						$login['sess_univID'] 	= $user->universityID;
						$avatar = base_url('fileupload/pic_admin/default.png');
					}elseif ($cekPass->roleID == 44) { //cek role id untuk dosen
						$user 	= $this->Mod_crud->getData('row', '*', 't_dosen', null, null, null, array('emaiL = "'.$cekPass->emaiL.'"')); //ambil data dosen pada tabel dosen
						$login['sess_usrID'] 	= $user->dosenID;
						$login['sess_univID'] 	= $user->universityID;
						$login['sess_facID'] 	= $user->facultyID;
						$avatar = base_url('fileupload/pic_dosen/default.png');
					}else { //trakhir untuk mahasiswa
						$user 	= $this->Mod_crud->getData('row', '*', 't_mahasiswa', null, null, null, array('emaiL = "'.$cekPass->emaiL.'"')); //ambil data mahasiswa pada tabel mahasiswa
						$login['sess_usrID'] 	= $user->mahasiswaID;
						$login['sess_univID'] 	= $user->universityID;
						$login['sess_facID'] 	= $user->facultyID;
						$avatar = base_url('fileupload/pic_mahasiswa/default.png');
					}

						$login['sess_name']		= $user->fullName;
						$login['sess_email'] 	= $cekPass->emaiL;
						$login['sess_role'] 	= $cekPass->roleID;
						$login['is_login'] 		= TRUE;
						$login['sess_pass'] 	= md5($this->input->post('password'));
						$login['sess_avatar'] 	= $avatar;


				$lokasi = base_url('dashboard'); //set lokasi
				$this->Mod_crud->updateData('t_login', array('lastLog' => date('Y/m/d H:i:s')),array('emaiL' => $this->input->post('email') ));//log pada tabel login
				$this->session->set_userdata('userlog',$login); //set session
				helper_log('login','Login Application',$this->session->userdata('userlog')['sess_usrID']);//membuat log aktivitas

				$this->alert->set('bg-success', 'Welcome '.$login['sess_name'].', you login as '.what_role($login['sess_role']).' !');//pesan alert
				echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'")); //diarahkan pada lokasi
			
			}
		}
	}

	/////////////////////////////////////////////////////////////////////////

		public function reset($token=null)//halaman untuk reset password
	{	
		//cek email pada table reset password
		$getreset = $this->Mod_crud->getData('row','*','t_passwordreset',null,null,null,array('tokeN = "'.$token.'"'));
		if ($getreset == false) { //jika tak ada
			echo "Link has been Expired !";
		}else{
		$dtmulai = date('Y-m-d H:i:s'); //waktu saat di akses
		$dtakhir = $getreset->expired_at; //waktu expired
		if ($dtmulai >= $dtakhir) { //mengecek expired token, jika sudah expired
			$delete 	= $this->Mod_crud->deleteData('t_passwordreset',array('tokeN'=>$token));
			echo "Lnik has been Expired !";
		}else{ //jika belum

		$data = array(
		    'titleWeb' 	=> 'Reset Page | CBN Internship',
		    'email'	=> $getreset->emaiL
		);
		$this->template->load('reset', null, $data); //load view reset
		}
	  }
	}

	public function do_reset()//reset aksi
	{
		$email = $this->input->post('email');
		$pass1 = $this->input->post('pass1');
		$pass2 = $this->input->post('pass2');

		//cek email
		$cekemail = $this->Mod_crud->getData('row', '*', 't_login', null, null, null, array('emaiL = "'.$email.'"'));
		if ($cekemail == false){ //jika ada
			echo json_encode(array('code' => 366, 'message' => 'Email not found !'));
		}else{
			if ($pass1 != $pass2){ //jika password tak sama
				echo json_encode(array('code' => 368, 'message' => 'Password not same !'));
			}else{

				$delete  = $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$email));//menghapus email pada table password reset

				if ($cekemail->roleID == 11 OR $cekemail->roleID == 22) {
					$user 	= $this->Mod_crud->getData('row', '*', 't_admin', null, null, null, array('emaiL = "'.$email.'"'));
					$login['sess_usrID']  = $user->adminID;
					$login['sess_deptID'] = $user->deptID;
					$avatar = base_url('fileupload/pic_admin/default.png');
				}elseif ($cekemail->roleID == 33) {
					$user 	= $this->Mod_crud->getData('row', '*', 't_admin_university', null, null, null, array('emaiL = "'.$email.'"'));
					$login['sess_usrID'] 	= $user->adminCampusID;
					$login['sess_univID'] 	= $user->universityID;
					$avatar = base_url('fileupload/pic_admin/default.png');
				}elseif ($cekemail->roleID == 44) {
					$user 	= $this->Mod_crud->getData('row', '*', 't_dosen', null, null, null, array('emaiL = "'.$email.'"'));
					$login['sess_usrID'] 	= $user->dosenID;
					$login['sess_univID'] 	= $user->universityID;
					$login['sess_facID'] 	= $user->facultyID;
					$avatar = base_url('fileupload/pic_dosen/default.png');
				}else {
					$user 	= $this->Mod_crud->getData('row', '*', 't_mahasiswa', null, null, null, array('emaiL = "'.$email.'"'));
					$login['sess_usrID'] 	= $user->mahasiswaID;
					$login['sess_univID'] 	= $user->universityID;
					$login['sess_facID'] 	= $user->facultyID;
					$avatar = base_url('fileupload/pic_mahasiswa/default.png');
				}

					$login['sess_name']	= $user->fullName;
					$login['sess_email'] 	= $cekemail->emaiL;
					$login['sess_role'] 	= $cekemail->roleID;
					$login['is_login'] 	= TRUE;
					$login['sess_pass'] 	= md5($this->input->post('password'));
					$login['sess_avatar'] 	= $avatar;
				
				$lokasi = base_url('dashboard');
				
				$this->Mod_crud->updateData('t_login', array(
					'passworD' 	=> md5($pass1),
					'statuS'	=> 'verified',
					'lastLog' => date('Y/m/d H:i:s')
					),array('emaiL' => $this->input->post('email'))
				);

				$this->session->set_userdata('userlog',$login);
				helper_log('reset','Success reset password ',$this->session->userdata('userlog')['sess_usrID']);

				$this->alert->set('bg-success', 'Welcome '.$login['sess_name'].', you login as '.what_role($login['sess_role']).' !');
				echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
			}
		}
	}

	////////////////////////////////////////////////////////////////////////////
	public function forgot() //ke halaman forgot password
	{				
		$data = array(
		    'titleWeb' => 'Forgot Page | CBN Internship',
		);
		$this->template->load('forgot', null, $data);//load view forgot password
	}

	public function do_forgot() //forgot password aksi
	{
		$emaiL 		= $this->input->post('email');
		//delete email pada table reset terlebih dahulu apa bila sudah ada
		$delete 	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$emaiL));
		//cek email pada table login
		$cekemail 	= $this->Mod_crud->getData('row', '*', 't_login', null, null, null, array('emaiL = "'.$emaiL.'"'));

		if ($cekemail == false){ //jika tak ada
			echo json_encode(array('code' => 366, 'message' => 'Email not found !'));

		}else{

		$set 	= '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //set string
		$tokeN 	= substr(str_shuffle($set), 0, 55); //generate token
		$create = time();
		$exp = 60*60; //satu jam
		$done = $create+$exp;
		$expired_at = date('Y-m-d H:i:s',$done);//set waktu expired

		$t_passwordreset = $this->Mod_crud->insertData('t_passwordreset', array(
				'emaiL'		=> $emaiL,
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
							<title>Forgot Password</title>
						</head>
						<body>
							<h2>CBN Internship Web Portal</h2>
							<p>Please click the link below to set new password ".base_url('auth/reset/'.$tokeN)." <br/>( warning: this link will expire after one hour )<br/><br/></p>
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
		    $this->email->subject('Forgot Password');
		    $this->email->message($message);

		    helper_log('forgot','Send link setup password to '.$emaiL);
		    
		    $lokasi = base_url('auth/login');
           	if ($this->email->send()){ //jika email berhasil di kirim
           		$this->alert->set('bg-success', 'Success , your setup link has been send !');
				echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
           	}else{
           		$this->alert->set('bg-danger', 'Error, an error while send the link !');
				echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));           	
        	}
        }
	}

	/////////////////////////////////////////////////////////////////////////////

		public function register()//ke halaman register
	{				
		$data = array(
		    'titleWeb' => 'Register Page | CBN Internship',
		);
		$this->template->load('register', null, $data); //load view register
	}

		public function getFaculty()//get faculty
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'facultyID, facultyName', 't_faculty');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->facultyID;
				$mk['text'] = $key->facultyName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getUniv()//get universitas
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'universityID, universityName', 't_university',null,null,null,array('mou = "YES"'));
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->universityID;
				$mk['text'] = $key->universityName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function do_register()//register aksi
	{
		
		$cekemail = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$this->input->post('Email').'"'));
		if ($cekemail) {
			echo json_encode(array('code' => 366, 'message' => 'Email has been registered'));
		}else{
			//cek nim mahasiswa
		$cekmahasiswa = $this->Mod_crud->checkData('mahasiswaNumber', 't_mahasiswa', array('mahasiswaNumber = "'.$this->input->post('Nim').'"'));
		if ($cekmahasiswa) {//jika sudah terdaftar
			echo json_encode(array('code' => 367, 'message' => 'Your nim has been registered'));
		} else {
			//pic
			//set mahasiswa id secara otomatis
			$mahasiswaID 	= $this->Mod_crud->autoNumber('mahasiswaID','t_mahasiswa','55',4);
				
				$savemahasiswa 	= $this->Mod_crud->insertData('t_mahasiswa', array(
           				'mahasiswaID'		=> $mahasiswaID,
           				'loginID'		=> $mahasiswaID,
           				'universityID' 		=> $this->input->post('Universityid'),
           				'facultyID' 		=> $this->input->post('Facultyid'),
           				'emaiL'			=> $this->input->post('Email'),
           				'mahasiswaNumber'	=> $this->input->post('Nim'),
           				'fullName' 		=> ucwords($this->input->post('Fullname')),
           				'mobilePhone'		=> $this->input->post('Mobilephone'),
           				'createdBY'		=> 'Register',
           				'createdTIME'		=> date('Y-m-d H:i:s')
           			)
           		);

	           	$savelogin = $this->Mod_crud->insertData('t_login', array(
					'loginID'		=> $mahasiswaID,
					'roleID'		=> 55,
					'emaiL'			=> $this->input->post('Email'),
					'passworD'		=> 'null',
					'statuS'		=> 'new-mahasiswa',
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
				    
				    helper_log('register','New application mahasiswa '.$this->input->post('Email'));
				    create_notification('New','Mahasiswa',$this->input->post('Fullname'),'mahasiswa/index');
		    
			    $lokasi = base_url('auth/login');
	           	if ($this->email->send()){
	           		$this->alert->set('bg-success', 'Register success , Setup link has been send to your email !');
					echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));
	           	}else{
	           		$this->alert->set('bg-danger', 'Error, an error while saving data !');
					echo json_encode(array('code' => 200, 'aksi' => "window.location.href = '".$lokasi."'"));           	
	        	}
			}
		}
	}
	//////////////////////////////////////////////////////////////////////////////

	public function logout(){//untuk logout keluar
		helper_log('logout','Logout Application',$this->session->userdata('userlog')['sess_usrID']);

		$this->session->unset_userdata('userlog');//destroy session
		redirect(base_url('dashboard'));//load view dashboard
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
