<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Mahasiswa extends Container {
	private $filename = "import_data"; // Kita tentukan nama filenya

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('login')['sess_role']==33) {
			$universityID 	= $this->session->userdata('login')['sess_univID'];
			$getmahasiswa = $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.universityID = "'.$universityID.'"'), null, array('m.mahasiswaID ASC'));
			$getuniversity 	= $this->Mod_crud->getData('result', '*', 't_university',null,null,null,array('universityID = "'.$universityID.'"'));
			$getfaculty 	= $this->Mod_crud->getData('result', '*', 't_faculty');
			$getresidence 	= $this->Mod_crud->getData('result', '*', 't_residence');
			$getgender  	= $this->Mod_crud->getData('result','*','t_gender');

			$data = array(
					'_CSS' => generate_css(array(
								"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
								"dashboard/alert/sweetalert.css",
								"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css",
								"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css"
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
								"dashboard/alert/sweetalert.js",
								"dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
							)
					),
					'webTitle' 		=> 'Mahasiswa',
					'pageTitle' 	=> explode(',', 'Mahasiswa'),
					'breadcrumb'	=> explode(',', 'Dashboard, Mahasiswa'),
					'dtmahasiswa' 	=> $getmahasiswa,
					'university'	=> $getuniversity,
					'faculty'		=> $getfaculty,
					'residence'		=> $getresidence,
					'gender'		=> $getgender
				);
			$this->render('dashboard' , 'pages/mahasiswa/index',$data);	
		}elseif ($this->session->userdata('login')['sess_role']==44) {
			$universityID 	= $this->session->userdata('login')['sess_univID'];
			$facultyID 		= $this->session->userdata('login')['sess_facID'];
			$getmahasiswa = $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.universityID = "'.$universityID.'"','m.facultyID = "'.$facultyID.'"'), null, array('m.mahasiswaID ASC'));
			$getuniversity 	= $this->Mod_crud->getData('result', '*', 't_university',null,null,null,array('universityID = "'.$universityID.'"'));
			$getfaculty 	= $this->Mod_crud->getData('result', '*', 't_faculty',null,null,null,array('facultyID = "'.$facultyID.'"'));
			$getresidence 	= $this->Mod_crud->getData('result', '*', 't_residence');
			$getgender  	= $this->Mod_crud->getData('result','*','t_gender');

			$data = array(
					'_CSS' => generate_css(array(
								"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
								"dashboard/alert/sweetalert.css",
								"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css",
								"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css"
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
								"dashboard/alert/sweetalert.js",
								"dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
							)
					),
					'webTitle' 		=> 'Mahasiswa',
					'pageTitle' 	=> explode(',', 'Mahasiswa'),
					'breadcrumb'	=> explode(',', 'Dashboard, Mahasiswa'),
					'dtmahasiswa' 	=> $getmahasiswa,
					'university'	=> $getuniversity,
					'faculty'		=> $getfaculty,
					'residence'		=> $getresidence,
					'gender'		=> $getgender
				);
			$this->render('dashboard' , 'pages/mahasiswa/index',$data);
		}else{
			$getmahasiswa = $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), null, null, array('m.mahasiswaID ASC'));
			$getuniversity 	= $this->Mod_crud->getData('result', '*', 't_university');
			$getfaculty 	= $this->Mod_crud->getData('result', '*', 't_faculty');
			$getresidence 	= $this->Mod_crud->getData('result', '*', 't_residence');
			$getgender  	= $this->Mod_crud->getData('result','*','t_gender');

			$data = array(
					'_CSS' => generate_css(array(
								"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
								"dashboard/alert/sweetalert.css",
								"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css",
								"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css"
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
								"dashboard/alert/sweetalert.js",
								"dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
							)
					),
					'webTitle' 		=> 'Mahasiswa',
					'pageTitle' 	=> explode(',', 'Mahasiswa'),
					'breadcrumb'	=> explode(',', 'Dashboard, Mahasiswa'),
					'dtmahasiswa' 	=> $getmahasiswa,
					'university'	=> $getuniversity,
					'faculty'		=> $getfaculty,
					'residence'		=> $getresidence,
					'gender'		=> $getgender
				);
			$this->render('dashboard' , 'pages/mahasiswa/index',$data);
		}
	}


	public function save()
	{
		$mahasiswaNumber = $this->input->post('mahasiswaNumber');
		$email = $this->input->post('emaiL');
		$cekemail = $this->Mod_crud->checkData('emaiL', 't_login', array('emaiL = "'.$email.'"'));
		if ($cekemail) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Email already registered !</p>
                </div>');
			redirect('mahasiswa');
		}else{
		$cekmahasiswa = $this->Mod_crud->checkData('mahasiswaNumber', 't_mahasiswa', array('mahasiswaNumber = "'.$mahasiswaNumber.'"'));
		if ($cekmahasiswa) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Nomor Induk already registered !</p>
                </div>');
			redirect('mahasiswa');
		} else {
			//pic
			$mahasiswaID 	= $this->Mod_crud->autoNumber('mahasiswaID','t_mahasiswa','44',4);
				if ($_FILES['photofile']['name'] !== '') {
					$t = explode(".", $_FILES['photofile']['name']);
					$ext = end($t);
					$cfgfoto= array(
							'file_name' => 'pic_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/pic_mahasiswa',
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',
							'max_size' => 512,
						);

					$this->upload->initialize($cfgfoto);
					if (!$this->upload->do_upload('photofile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa');
					}else{
						$gbr 	 = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 			= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$pathPic = 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
				} else {
					$pathPic = '';
				}

				//cv
				if ($_FILES['cvfile']['name'] !== '') {
					$t = explode(".", $_FILES['cvfile']['name']);
					$ext = end($t);
					$cfgfile= array(
							'file_name' => 'resume_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgfile);
					if (!$this->upload->do_upload('cvfile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa');
					}
					$file 	 = $this->upload->data();
					$pathCv = 'assets/file/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathCv = '';
				}

				//transcipt
				if ($_FILES['acfile']['name'] !== '') {
					$t = explode(".", $_FILES['acfile']['name']);
					$ext = end($t);
					$cfgfile= array(
							'file_name' => 'transcipt_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgfile);
					if (!$this->upload->do_upload('acfile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa');
					}
					$file 	 = $this->upload->data();
					$pathAc = 'assets/file/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathAc = '';
				}

				$savemahasiswa 	= $this->Mod_crud->insertData('t_mahasiswa', array(
           				'mahasiswaID'		=> $mahasiswaID,
           				'loginID'			=> $mahasiswaID,
           				'universityID' 		=> $this->input->post('universityID'),
           				'facultyID' 		=> $this->input->post('facultyID'),
           				'emaiL'				=> $email,
           				'mahasiswaNumber'	=> $mahasiswaNumber,
           				'fullName' 			=> ucwords($this->input->post('fullName')),
           				'mobilePhone'		=> $this->input->post('mobilePhone'),
           				'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'createdTIME'		=> date('Y-m-d H:i:s')
           			)
           		);

           		$savefile = $this->Mod_crud->insertData('t_mahasiswa_file', array(
           				'mahasiswaID'		=> $mahasiswaID,
           				'photo' 			=> $pathPic,
           				'resume'			=> $pathCv,
           				'academicTranscipt' => $pathAc,
           				'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'createdTIME'		=> date('Y-m-d H:i:s')
           			)
           		);

	           	$savelogin = $this->Mod_crud->insertData('t_login', array(
					'loginID'		=> $mahasiswaID,
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
		    		helper_log('add','Added New Mahasiswa, '.$mahasiswaID,$this->session->userdata('login')['sess_usrID']);
		           	if ($this->email->send()){
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-success">
				                <h4>Success</h4>
				                <p>We have send an email to set a password!</p>
				            </div>');
		           		redirect('mahasiswa');
		           	}else{
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-danger">
				                <h4>Error</h4>
				                <p>an error occurred while saving data !</p>
				            </div>');
		           		redirect('mahasiswa');
		           	}
			}
		}
	}

	public function edit()
	{
		$mahasiswaID 	= $this->input->post('mahasiswaID');
		$email 			= $this->input->post('emaiL');

		$getfile		= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$mahasiswaID.'"'));
			//pic
			if ($_FILES['photofile']['name'] !== '') {
					if (!empty($getfile->photo)) {
							unlink(FCPATH . $getfile->photo);
						}
					$t = explode(".", $_FILES['photofile']['name']);
					$ext = end($t);
					$cfgfoto= array(
							'file_name' => 'pic_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/pic_mahasiswa',
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',
							'max_size' => 512,
						);

					$this->upload->initialize($cfgfoto);
					if (!$this->upload->do_upload('photofile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa');
					}else{
						$gbr 	 = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 			= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$pathPic = 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
				} else {
					$pathPic = $getfile->photo;
				}

				//cv
				if ($_FILES['cvfile']['name'] !== '') {
					if (!empty($getfile->resume)) {
							unlink(FCPATH . $getfile->resume);	
						}
					$t = explode(".", $_FILES['cvfile']['name']);
					$ext = end($t);
					$cfgfile= array(
							'file_name' => 'resume_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgfile);
					if (!$this->upload->do_upload('cvfile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa');
					}
					$file 	 = $this->upload->data();
					$pathCv = 'assets/file/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathCv = $getfile->resume;
				}

				//transcipt
				if ($_FILES['acfile']['name'] !== '') {
					if (!empty($getfile->academicTranscipt)) {
							unlink(FCPATH . $getfile->academicTranscipt);	
						}
					$t = explode(".", $_FILES['acfile']['name']);
					$ext = end($t);
					$cfgfile= array(
							'file_name' => 'transcipt_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgfile);
					if (!$this->upload->do_upload('acfile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa');
					}
					$file 	 = $this->upload->data();
					$pathAc = 'assets/file/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathAc = $getfile->academicTranscipt;
				}

				$updatemahasiswa = $this->Mod_crud->updateData('t_mahasiswa', array(
           				'universityID' 		=> $this->input->post('universityID'),
           				'facultyID' 		=> $this->input->post('facultyID'),
           				'residenceID'		=> $this->input->post('residenceID'),
           				'mahasiswaNumber'	=> $this->input->post('mahasiswaNumber'),
           				'emaiL'				=> $email,
           				'fullName' 			=> ucwords($this->input->post('fullName')),
           				'birthPlace'		=> $this->input->post('birthPlace'),
           				'birthDate'			=> $this->input->post('birthDate'),
           				'genderID'			=> $this->input->post('genderID'),
           				'religion'			=> $this->input->post('religion'),
           				'city'				=> $this->input->post('city'),
           				'zip'				=> $this->input->post('zip'),
           				'address'			=> $this->input->post('address'),
           				'fixedPhone'		=> $this->input->post('fixedPhone'),
           				'mobilePhone'		=> $this->input->post('mobilePhone'),
           				'hobby'				=> $this->input->post('hobby'),
           				'strength'			=> $this->input->post('strength'),
           				'weakness'			=> $this->input->post('weakness'),
           				'organizationExp'	=> $this->input->post('organizationExp'),
           				'projectEverMade'	=> $this->input->post('projectEverMade'),
           				'semester'			=> $this->input->post('semester'),
           				'sksTotal'			=> $this->input->post('sksTotal'),
           				'indexTotal'		=> $this->input->post('indexTotal'),
           				'statusActive'		=> '1',
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('mahasiswaID' => $mahasiswaID)
           		);

           		$updatefile = $this->Mod_crud->updateData('t_mahasiswa_file', array(
           				'mahasiswaID'		=> $mahasiswaID,
           				'photo' 			=> $pathPic,
           				'resume'			=> $pathCv,
           				'academicTranscipt' => $pathAc,
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			),array('mahasiswaID'=>$mahasiswaID)
           		);

           		$updateLogin = $this->Mod_crud->updateData('t_login', array(
		           		'emaiL' 		=> $email
           			), array('loginID' => $mahasiswaID)
           		);
					helper_log('edit','Edited Mahasiswa, '.$mahasiswaID,$this->session->userdata('login')['sess_usrID']);
		           	if ($updatefile){
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-success">
				                <h4>Success</h4>
				                <p>Mahasiswa Updated !</p>
				            </div>');
		           		redirect('mahasiswa');
		           	}else{
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-danger">
				                <h4>Error</h4>
				                <p>an error occurred while saving data !</p>
				            </div>');
		           		redirect('mahasiswa');
		           	}	
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$getmhs 		= $this->Mod_crud->getData('row','*','t_mahasiswa',null,null,null,array('mahasiswaID = "'.$id.'"'));
		$getfile 		= $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$id.'"'));

		$delete 		= $this->Mod_crud->deleteData('t_mahasiswa',array('mahasiswaID'=>$id));
		$deletereset	= $this->Mod_crud->deleteData('t_passwordreset',array('emaiL'=>$getmhs->emaiL));
		$deletefile 	= $this->Mod_crud->deleteData('t_mahasiswa_file',array('fileID'=>$getfile->fileID));
		$deletelog 		= $this->Mod_crud->deleteData('t_login',array('loginID'=>$id));
		if ($deletelog){
		unlink(FCPATH . $getfile->photo);
		unlink(FCPATH . $getfile->resume);
		unlink(FCPATH . $getfile->academicTranscipt);
		helper_log('delete','Deleted Mahasiswa, '.$id,$this->session->userdata('login')['sess_usrID']);
        redirect('mahasiswa');
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
           		redirect('mahasiswa');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('mahasiswa');
           	}
	}

	public function editprofile()
	{
			$mahasiswaID = $this->input->post('mahasiswaID');
			$getfile	 = $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$mahasiswaID.'"'));
			//pic
			if ($_FILES['photofile']['name'] !== '') {
					if (!empty($getfile->photo)) {
							unlink(FCPATH . $getfile->photo);	
						}
					$t = explode(".", $_FILES['photofile']['name']);
					$ext = end($t);
					$cfgfoto= array(
							'file_name' => 'pic_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/pic_mahasiswa',
							'allowed_types' => 'jpg|png|gif|jpeg|bmp',
							'max_size' => 512,
						);

					$this->upload->initialize($cfgfoto);
					if (!$this->upload->do_upload('photofile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa/profile');
					}else{
						$gbr 	 = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['maintain_ratio'] 	= FALSE;
						$config['quality'] 			= '50%';
						$config['width']         	= 200;
						$config['height']       	= 200;
						$config['new_image']	 	= 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
					$pathPic = 'assets/file/pic_mahasiswa/' . $gbr['file_name'];
				} else {
					$pathPic = $getfile->photo;
				}

				//cv
				if ($_FILES['cvfile']['name'] !== '') {
					if (!empty($getfile->resume)) {
							unlink(FCPATH . $getfile->resume);	
						}
					$t = explode(".", $_FILES['cvfile']['name']);
					$ext = end($t);
					$cfgfile= array(
							'file_name' => 'resume_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgfile);
					if (!$this->upload->do_upload('cvfile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa/profile');
					}
					$file 	 = $this->upload->data();
					$pathCv = 'assets/file/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathCv = $getfile->resume;
				}

				//transcipt
				if ($_FILES['acfile']['name'] !== '') {
					if (!empty($getfile->academicTranscipt)) {
							unlink(FCPATH . $getfile->academicTranscipt);	
						}
					$t = explode(".", $_FILES['acfile']['name']);
					$ext = end($t);
					$cfgfile= array(
							'file_name' => 'transcipt_'.$mahasiswaID.'.'.$ext,
							'upload_path' => 'assets/file/file_mahasiswa',
							'allowed_types' => 'pdf',
							'max_size' => 1024,
						);

					$this->upload->initialize($cfgfile);
					if (!$this->upload->do_upload('acfile')) {
						$this->session->set_flashdata('msg', 
		                '<div class="alert alert-danger">
		                    <h4>Error</h4>
		                    <p>"'.strip_tags($this->upload->display_errors()).'"</p>
		                </div>');
		                redirect('mahasiswa/profile');
					}
					$file 	 = $this->upload->data();
					$pathAc = 'assets/file/file_mahasiswa/' . $file['file_name'];
				} else {
					$pathAc = $getfile->academicTranscipt;
				}

				$updatemahasiswa = $this->Mod_crud->updateData('t_mahasiswa', array(
           				'facultyID' 		=> $this->input->post('facultyID'),
           				'residenceID'		=> $this->input->post('residenceID'),
           				'mahasiswaNumber'	=> $this->input->post('mahasiswaNumber'),
           				'fullName' 			=> ucwords($this->input->post('fullName')),
           				'birthPlace'		=> $this->input->post('birthPlace'),
           				'birthDate'			=> $this->input->post('birthDate'),
           				'genderID'			=> $this->input->post('genderID'),
           				'religion'			=> $this->input->post('religion'),
           				'city'				=> $this->input->post('city'),
           				'zip'				=> $this->input->post('zip'),
           				'address'			=> $this->input->post('address'),
           				'fixedPhone'		=> $this->input->post('fixedPhone'),
           				'mobilePhone'		=> $this->input->post('mobilePhone'),
           				'hobby'				=> $this->input->post('hobby'),
           				'strength'			=> $this->input->post('strength'),
           				'weakness'			=> $this->input->post('weakness'),
           				'organizationExp'	=> $this->input->post('organizationExp'),
           				'projectEverMade'	=> $this->input->post('projectEverMade'),
           				'semester'			=> $this->input->post('semester'),
           				'sksTotal'			=> $this->input->post('sksTotal'),
           				'indexTotal'		=> $this->input->post('indexTotal'),
           				'statusActive'		=> '1',
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('mahasiswaID' => $mahasiswaID)
           		);

           		$updatefile = $this->Mod_crud->updateData('t_mahasiswa_file', array(
           				'mahasiswaID'		=> $mahasiswaID,
           				'photo' 			=> $pathPic,
           				'resume'			=> $pathCv,
           				'academicTranscipt' => $pathAc,
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			),array('mahasiswaID'=>$mahasiswaID)
           		);
					helper_log('edit','Edited Profile',$this->session->userdata('login')['sess_usrID']);
		           	if ($updatefile){
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-success">
				                <h4>Success</h4>
				                <p>Profile Updated !</p>
				            </div>');
		           		redirect('mahasiswa/profile');
		           	}else{
		           		$this->session->set_flashdata('msg', 
				            '<div class="alert alert-danger">
				                <h4>Error</h4>
				                <p>an error occurred while saving data !</p>
				            </div>');
		           		redirect('mahasiswa/profile');
		           	}

	}

	public function changepass()
	{	
		$id 		= $this->input->post('mahasiswaID');
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
			redirect('mahasiswa/profile');
		}else{
			if ($newpass != $newpass2) {
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>New Password Not Same !</p>
                </div>');
				redirect('mahasiswa/profile');	
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
		           		redirect('mahasiswa/profile');
		        }else{
		           	$this->session->set_flashdata('msg', 
				        '<div class="alert alert-danger">
				            <h4>Error</h4>
				            <p>an error occurred while saving data !</p>
				        </div>');
		           	redirect('mahasiswa/profile');
		        }
			}
		}
 	}

	public function profile()
	{
		$id = $this->session->userdata('login')['sess_usrID'];
		$detail = $this->Mod_crud->getData('result', 'm.*,ff.*,l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.mahasiswaID = "'.$id.'"'));
		$getuniversity 	= $this->Mod_crud->getData('result','*','t_university');
		$getfaculty 	= $this->Mod_crud->getData('result','*','t_faculty');
		$getresidence 	= $this->Mod_crud->getData('result','*','t_residence');
		$getgender  	= $this->Mod_crud->getData('result','*','t_gender');

		if (! $detail){
			redirect(base_url('mahasiswa/index'),'refresh');
		}
		$data = array(
			'_CSS' => generate_css(array(
							"dashboard/plugins/superbox/css/superbox.min.css",
							"dashboard/plugins/lity/dist/lity.min.css",
							"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
							"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
							"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css",
							"dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css"
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
							"dashboard/js/demo/table-manage-autofill.demo.min.js",
							"dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"
						)
				),
				'webTitle' 		=> "Profile",
				'pageTitle' 	=> explode(',', 'Mahasiswa, Profile'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Mahasiswa, Profile'),
				'dtmahasiswa' 	=> $detail,
				'university'	=> $getuniversity,
				'faculty'		=> $getfaculty,
				'residence'		=> $getresidence,
				'gender'		=> $getgender
			);
		$this->render('dashboard' , 'pages/mahasiswa/profile',$data);
	}

	function download($mod=null,$id){
		$getFile = $this->Mod_crud->getData('row','*','t_mahasiswa_file',null,null,null,array('mahasiswaID = "'.$id.'"'));
		if ($mod=='resume') {
			helper_log('download','Download Resume, '.$id,$this->session->userdata('login')['sess_usrID']);
			$file = $getFile->resume;
			force_download($file,NULL);
		}elseif ($mod=='transcipt') {
			helper_log('download','Download Academic Transcipt, '.$id,$this->session->userdata('login')['sess_usrID']);
			$file = $getFile->academicTranscipt;
			force_download($file,NULL);
		}
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$getmahasiswa = $this->Mod_crud->getData('row', 'm.*, ff.*, l.roleID', 't_mahasiswa m', null, null, array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID','t_login l'=>'m.loginID = l.loginID'), array('m.mahasiswaID = "'.$id.'"'));

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
				'webTitle' 		=> "Detail",
				'pageTitle' 	=> explode(',', 'Mahasiswa, Detail'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Mahasiswa, Detail'),
				'dtmahasiswa' 	=> $getmahasiswa
			); 
		$this->render('dashboard' , 'pages/mahasiswa/detail',$data);
	}

	public function form(){
	    $data = array(); // Buat variabel $data sebagai array
	    
	    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
	      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
	      $upload = $this->Mod_crud->upload_file($this->filename);
	      
	      if($upload['result'] == "success"){ // Jika proses upload sukses
	        // Load plugin PHPExcel nya
	        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	        
	        $excelreader = new PHPExcel_Reader_Excel2007();
	        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
	        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	        
	        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
	        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
	        $data['sheet'] = $sheet; 
	      }else{ // Jika proses upload gagal
	        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
	      }
	    }
	    
		   $data = array(
				'_CSS' => generate_css(array(
								"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
								"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"
							)
					),
					'_JS' => generate_js(array(
								"dashboard/plugins/DataTables/media/js/jquery.dataTables.js",
								"dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
								"dashboard/plugins/DataTables/extensions/AutoFill/js/dataTables.autoFill.min.js",
								"dashboard/plugins/DataTables/extensions/AutoFill/js/autoFill.bootstrap.min.js",
								"dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
								"dashboard/js/demo/table-manage-autofill.demo.min.js"
							)
					),
					'webTitle' => "Import Data Mahasiswa ",
					'pageTitle' => explode(',', 'Import, Import Data Mahasiswa '),
					'breadcrumb' => explode(',', 'Dashboard, Import, Import Data Mahasiswa')
				);
			$this->render('dashboard' , 'pages/import_mhs',$data);
	  }
	  
	  public function import(){
	    // Load plugin PHPExcel nya
	    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
	    
	    $excelreader = new PHPExcel_Reader_Excel2007();
	    $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
	    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	    
	    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
	    $data = array();
	    
	    $numrow = 1;
	    foreach($sheet as $row){
	      // Cek $numrow apakah lebih dari 1
	      // Artinya karena baris pertama adalah nama-nama kolom
	      // Jadi dilewat saja, tidak usah diimport
	      if($numrow > 1){
	        // Kita push (add) array data ke variabel data
	        array_push($data, array(
	          'mahasiswaID'=>$row['A'], // Insert data nis dari kolom A di excel
	          'namamahasiswa'=>$row['B'], // Insert data nama dari kolom B di excel
	          'jeniskelamin'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
	          'tempatlahir'=>$row['D'], // Insert data alamat dari kolom D di excel
	          'tgllahir'=>$row['E'], // Insert data alamat dari kolom E di excel
	          'notelpseluler' => $row['F'],
	          'emailmahasiswa' => $row['G'],
	          'kodekelas' => $row['H'],
	          'kodejurusan' => $row['I'],
	          'semester_aktif' => $row['J']
	        ));
	      }
	      
	      $numrow++; // Tambah 1 setiap kali looping
	    }
	    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
	    $this->Mod_crud->insert_multiple($data);
	    
	    redirect("form"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	  }

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/staff/Mahasiswa.php */