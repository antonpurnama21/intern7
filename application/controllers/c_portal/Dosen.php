<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Dosen extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{	

		if ($this->session->userdata('login')['sess_role']==33) {
			$universityID 	= $this->session->userdata('login')['sess_univID'];
			$getdosen 		= $this->Mod_crud->getData('result', 'd.*, l.roleID', 't_dosen d', null, null,array('t_login l'=>'d.loginID = l.loginID'), array('d.universityID = "'.$universityID.'"'), array('d.dosenID ASC'));
			$getuniversity 	= $this->Mod_crud->getData('result','*','t_university',null,null,null,array('universityID = "'.$universityID.'"'));
			$getfaculty 	= $this->Mod_crud->getData('result','*','t_faculty');	

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
				'webTitle' 		=> 'Dosen',
				'pageTitle' 	=> explode(',', 'Dosen'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Dosen'),
				'dtdosen' 		=> $getdosen,
				'university' 	=> $getuniversity,
				'faculty'		=> $getfaculty,
			);
		$this->render('dashboard' , 'pages/dosen/index',$data);	
		}else{
			$getdosen 		= $this->Mod_crud->getData('result', 'd.*, l.roleID', 't_dosen d', null, null,array('t_login l'=>'d.loginID = l.loginID'),null, array('dosenID ASC'));
			$getuniversity 	= $this->Mod_crud->getData('result','*','t_university');
			$getfaculty 	= $this->Mod_crud->getData('result','*','t_faculty');	

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
				'webTitle' 		=> 'Dosen',
				'pageTitle' 	=> explode(',', 'Dosen'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Dosen'),
				'dtdosen' 		=> $getdosen,
				'university' 	=> $getuniversity,
				'faculty'		=> $getfaculty,
			);
		$this->render('dashboard' , 'pages/dosen/index',$data);
		}
	}

	public function save()
	{
		$dosenNumber = $this->input->post('dosenNumber');
		$email = $this->input->post('emaiL');
		$cekemail = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$email.'"'));
		if ($cekemail) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Email already registered !</p>
                </div>');
			redirect('dosen');
		}else{
		$cekdosen = $this->Mod_crud->checkData('dosenNumber', 't_dosen', array('dosenNumber = "'.$dosenNumber.'"'));
		if ($cekdosen) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>NID already registered !</p>
                </div>');
			redirect('dosen');
		} else {
			$dosenID 	= $this->Mod_crud->autoNumber('dosenID','t_dosen','44',4);
			if ($_FILES['profilePic']['name'] !== '') {
					$t = explode(".", $_FILES['profilePic']['name']);
					$ext = end($t);
					$cfgFile= array(
							'file_name' => 'pic_'.$dosenID.'.'.$ext,
							'upload_path' => 'assets/file/pic_dosen',
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',
							'max_size' => 2000,
						);

					$this->upload->initialize($cfgFile);
					if (!$this->upload->do_upload('profilePic')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('dosen');
					}else{
						$gbr 	 = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'assets/file/pic_dosen/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 			= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'assets/file/pic_dosen/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$pathPic = 'assets/file/pic_dosen/' . $gbr['file_name'];
				} else {
					$pathPic = '';
				}

				$saveDosen = $this->Mod_crud->insertData('t_dosen', array(
           				'dosenID' 		=> $dosenID,
           				'loginID'		=> $dosenID,
           				'universityID' 	=> $this->input->post('universityID'),
           				'facultyID' 	=> $this->input->post('facultyID'),
           				'emaiL'			=> $email,
           				'dosenNumber'	=> $dosenNumber,
           				'fullName' 		=> ucwords($this->input->post('fullName')),
           				'fixedPhone'	=> $this->input->post('fixedPhone'),
           				'mobilePhone'	=> $this->input->post('mobilePhone'),
           				'city'			=> $this->input->post('city'),
           				'zip'			=> $this->input->post('zip'),
           				'address'		=> $this->input->post('address'),
           				'profilePic' 	=> $pathPic,
           				'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'createdTIME'	=> date('Y-m-d H:i:s')
           			)
           		);

	           	$savelogin = $this->Mod_crud->insertData('t_login', array(
					'loginID'		=> $dosenID,
					'roleID'		=> 44,
					'emaiL'			=> $email,
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
				    $this->email->to($email);
				    $this->email->subject('Account Setup Link');
				    $this->email->message($message);
		    		helper_log('add','Added New Dosen, '.$dosenID,$this->session->userdata('login')['sess_usrID']);
		           	if ($this->email->send()){
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-success">
				                <h4>Success</h4>
				                <p>We have send an email to set a password!</p>
				            </div>');
		           		redirect('dosen');
		           	}else{
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-danger">
				                <h4>Error</h4>
				                <p>an error occurred while saving data !</p>
				            </div>');
		           		redirect('dosen');
		        }   
			}
		}
	}

	public function edit()
	{	
		$dosenID 	= $this->input->post('dosenID');
		$email 		= $this->input->post('emaiL');
		$getImage 	= $this->Mod_crud->getData('row','profilePic','t_dosen',null,null,null,array('dosenID = "'.$dosenID.'"'));

		if ($_FILES['profilePic']['name'] !== '') {
			$t = explode(".", $_FILES['profilePic']['name']);
			$ext = end($t);
			$cfgFile= array(
					'file_name' => 'pic_'.$dosenID.'.'.$ext,
					'upload_path' => 'assets/file/pic_dosen/',
					'allowed_types' => 'jpg|png|gif|jpeg|bmp',
					'max_size'   => 2048,
				);

			$this->upload->initialize($cfgFile);
			if (!$this->upload->do_upload('profilePic')) {
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
                </div>');
                redirect('dosen');
			}else{
				$gbr 	= $this->upload->data();
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= 'assets/file/pic_dosen/' . $gbr['file_name'];
				$config['create_thumb'] 	= FALSE;
				$config['maintain_ratio'] 	= FALSE;
				$config['quality'] 			= '50%';
				$config['width']         	= 200;
				$config['height']       	= 200;
				$config['new_image']	 	= 'assets/file/pic_dosen/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				if (!empty($getImage->profilePic)) {
					unlink(FCPATH . $getImage->profilePic);	
				}
			}

			$pathPic = 'assets/file/pic_dosen/' . $gbr['file_name'];

		} else {
			$pathPic = $getImage->profilePic;
		}
		
		$updateDosen = $this->Mod_crud->updateData('t_dosen', array(
           				'facultyID' 	=> $this->input->post('facultyID'),
           				'emaiL'			=> $email,
           				'dosenNumber'	=> $this->input->post('dosenNumber'),
           				'fullName' 		=> ucwords($this->input->post('fullName')),
           				'fixedPhone'	=> $this->input->post('fixedPhone'),
           				'mobilePhone'	=> $this->input->post('mobilePhone'),
           				'city'			=> $this->input->post('city'),
           				'zip'			=> $this->input->post('zip'),
           				'address'		=> $this->input->post('address'),
           				'profilePic' 	=> $pathPic,
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('dosenID' => $dosenID)
           	);

		$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $email
           			), array('loginID' => $dosenID)
           	);
		helper_log('edit','Edited Dosen, '.$dosenID,$this->session->userdata('login')['sess_usrID']);
		if ($updateLogin){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Dosen updated !</p>
		        </div>');
           		redirect('dosen');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('dosen');
        }
	}

	public function editprofile()
	{	
		$dosenID 	= $this->input->post('dosenID');
		$email 		= $this->input->post('emaiL');
		$getImage 	= $this->Mod_crud->getData('row','profilePic','t_dosen',null,null,null,array('dosenID = "'.$dosenID.'"'));

		if ($_FILES['profilePic']['name'] !== '') {
			$t = explode(".", $_FILES['profilePic']['name']);
			$ext = end($t);
			$cfgFile= array(
					'file_name' => 'pic_'.$dosenID.'.'.$ext,
					'upload_path' => 'assets/file/pic_dosen/',
					'allowed_types' => 'jpg|png|gif|jpeg|bmp',
					'max_size'   => 2048,
				);

			$this->upload->initialize($cfgFile);
			if (!$this->upload->do_upload('profilePic')) {
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
                </div>');
                redirect('dosen/profile');
			}else{
				$gbr 	= $this->upload->data();
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= 'assets/file/pic_dosen/' . $gbr['file_name'];
				$config['create_thumb'] 	= FALSE;
				$config['maintain_ratio'] 	= FALSE;
				$config['quality'] 			= '50%';
				$config['width']         	= 200;
				$config['height']       	= 200;
				$config['new_image']	 	= 'assets/file/pic_dosen/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				if (!empty($getImage->profilePic)) {
					unlink(FCPATH . $getImage->profilePic);	
				}
			}

			$pathPic = 'assets/file/pic_dosen/' . $gbr['file_name'];

		} else {
			$pathPic = $getImage->profilePic;
		}
		
		$updateDosen = $this->Mod_crud->updateData('t_dosen', array(
           				'facultyID' 	=> $this->input->post('facultyID'),
           				'emaiL'			=> $email,
           				'dosenNumber'	=> $this->input->post('dosenNumber'),
           				'fullName' 		=> ucwords($this->input->post('fullName')),
           				'fixedPhone'	=> $this->input->post('fixedPhone'),
           				'mobilePhone'	=> $this->input->post('mobilePhone'),
           				'city'			=> $this->input->post('city'),
           				'zip'			=> $this->input->post('zip'),
           				'address'		=> $this->input->post('address'),
           				'profilePic' 	=> $pathPic,
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('dosenID' => $dosenID)
           	);

		$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $email
           			), array('loginID' => $dosenID)
           	);
		helper_log('edit','Edited Profile',$this->session->userdata('login')['sess_usrID']);
		if ($updateLogin){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Profile updated !</p>
		        </div>');
           		redirect('dosen/profile');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('dosen/profile');
        }
	}

	public function changepass()
	{	
		$id 		= $this->input->post('dosenID');
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
			redirect('dosen/profile');
		}else{
			if ($newpass != $newpass2) {
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>New Password Not Same !</p>
                </div>');
				redirect('dosen/profile');	
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
		           		redirect('dosen/profile');
		        }else{
		           	$this->session->set_flashdata('msg', 
				        '<div class="alert alert-danger">
				            <h4>Error</h4>
				            <p>an error occurred while saving data !</p>
				        </div>');
		           	redirect('dosen/profile');
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
		    helper_log('reset','Send Setup Link for reset Password to '.$email,$this->session->userdata('login')['sess_usrID']);
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($config['smtp_user']);
		    $this->email->to($email);
		    $this->email->subject('Password Reset');
		    $this->email->message($message);

           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have send an email to reset password!</p>
		            </div>');
           		redirect('dosen');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('dosen');
           	}
	}

	public function delete()
	{	
		$id 			= $this->input->post('id');
		$getdosen 		= $this->Mod_crud->getData('row','profilePic,emaiL','t_dosen',null,null,null,array('dosenID = "'.$id.'"'));
		$deletereset	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$getdosen->emaiL));
		$deletelog 	 	= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
		$delete 		= $this->Mod_crud->deleteData('t_dosen',array('dosenID'=>$id));
		helper_log('delete','Deleted Dosen, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($delete){
			unlink(FCPATH . $getdosen->profilePic);
           	redirect('dosen');
		}
	}


	public function detail()
	{
		$id = $this->uri->segment(3);
		$detail = $this->Mod_crud->getData('row', 'd.*, l.roleID', 't_dosen d', null, null, array('t_login l'=>'d.emaiL = l.emaiL'),array('d.dosenID = "'.$id.'"'));

		if (! $detail){
			redirect(base_url('dosen/index'),'refresh');
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
				'webTitle' => "Detail ".$detail->fullName." ",
				'pageTitle' => explode(',', 'Dosen, Detail '.$detail->fullName),
				'breadcrumb' => explode(',', 'Dashboard, Dosen, Detail '.$detail->fullName),
				'dtdosen' 		=> $detail
			);
		$this->render('dashboard' , 'pages/dosen/detail',$data);
	}

	public function profile()
	{
		$id = $this->session->userdata('login')['sess_usrID'];
		$detail = $this->Mod_crud->getData('result', 'd.*, l.roleID', 't_dosen d', null, null, array('t_login l'=>'d.emaiL = l.emaiL'),array('d.dosenID = "'.$id.'"'));
		$getuniversity 	= $this->Mod_crud->getData('result','*','t_university');
		$getfaculty 	= $this->Mod_crud->getData('result','*','t_faculty');

		if (! $detail){
			redirect(base_url('dosen/index'),'refresh');
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
				'webTitle' => "Profile",
				'pageTitle' => explode(',', 'Dosen, Profile'),
				'breadcrumb' => explode(',', 'Dashboard, Dosen, Profile'),
				'dtdosen' 		=> $detail,
				'university'	=> $getuniversity,
				'faculty'		=> $getfaculty
			);
		$this->render('dashboard' , 'pages/dosen/profile',$data);
	}
	
}

/* End of file Dosen.php */
/* Location: ./application/controllers/staff/Dosen.php */