<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Scope extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if ($this->session->userdata('login')['sess_role'] == 22){
		$deptID = $this->session->userdata('login')['sess_deptID'];
		$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null, array('isApproved = "Y"','deptID = "'.$deptID.'"'), null, array('projectScopeID ASC'));

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
				'webTitle' 		=> 'Project Scope',
				'pageTitle' 	=> explode(',', 'Project scope'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Project scope'),
				'dtscope'		=> $getscope
			);
		$this->render('dashboard' , 'pages/scope/index',$data);	
		}else{
		$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null, array('isApproved = "Y"'), null, array('projectScopeID ASC'));

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
				'webTitle' 		=> 'Project Scope',
				'pageTitle' 	=> explode(',', 'Project scope'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Project scope'),
				'dtscope'		=> $getscope
			);
		$this->render('dashboard' , 'pages/scope/index',$data);
		}
	}

		public function manage()
	{
		$deptID = $this->session->userdata('login')['sess_deptID'];
		$getscope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null, array('deptID = "'.$deptID.'"'), null, array('projectScopeID ASC'));
		$getcategory 	= $this->Mod_crud->getData('result', '*', 't_category');
		$getproject 	= $this->Mod_crud->getData('result', '*', 't_project');


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
				'webTitle' 		=> 'Manage',
				'pageTitle' 	=> explode(',', 'Project Scope, Manage'),
				'breadcrumb' 	=> explode(',', 'Dashboard, Project scope, manage'),
				'dtscope'		=> $getscope,
				'dtcategory'	=> $getcategory,
				'dtproject'		=> $getproject
			);
		$this->render('dashboard' , 'pages/scope/manage',$data);
	}

	public function save()
	{
		$ps = $this->input->post('projectScope');
		$pID = $this->input->post('projectID');
		if ($this->Mod_crud->getData('result','projectID,projectScope','t_project_scope',null,null,null,array('projectID = "'.$ps.'" AND projectScope = "'.$pID.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Project Scope already added !</p>
                </div>');
			redirect('scope');
		}else{
		$deptID = get_deptID($this->session->userdata('login')['sess_usrID']);
		$code = $this->Mod_crud->autoNumber('projectScopeID','t_project_scope','PSC-',3);
		$save = $this->Mod_crud->insertData('t_project_scope', array(
				'projectScopeID'		=> $code,
				'deptID'			=> $deptID,
				'categoryID'		=> $this->input->post('categoryID'),
				'projectID'			=> $this->input->post('projectID'),
				'projectScope'		=> $ps,
				'description'		=> $this->input->post('description'),
				'qualification'		=> $this->input->post('qualification'),
				'startDate'			=> $this->input->post('startDate'),
				'endDate'			=> $this->input->post('endDate'),
				'reqQuantity'		=> $this->input->post('reqQuantity'),
				'isTaken'			=> $this->input->post('isTaken'),
				'isApproved'		=> 'P',
				'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added New Project Scope, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Project Scope added !</p>
		            </div>');
           		redirect('scope/manage');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('scope/manage');
           	}
        }
	}

	public function savecategory()
	{
		$name = $this->input->post('categoryName');
		if ($this->Mod_crud->getData('result','categoryName','t_category',null,null,null,array('categoryName = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Cateogry already added !</p>
                </div>');
			redirect('scope/manage');
		}else{
		$code = $this->Mod_crud->autoNumber('categoryID','t_category','CAT-',3);
		$save = $this->Mod_crud->insertData('t_category', array(
				'categoryID'	=> $code,
           		'categoryName'	=> $name,
           		'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added New Category, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Cateogry added !</p>
		            </div>');
           		redirect('scope/manage');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('scope/manage');
           	}
        }
	}

		public function saveproject()
	{
		$name = $this->input->post('projectName');
		if ($this->Mod_crud->getData('result','projectName','t_project',null,null,null,array('projectName = "'.$name.'"'))) {
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Error</h4>
                    <p>Project already added !</p>
                </div>');
			redirect('scope/manage');
		}else{
		$code = $this->Mod_crud->autoNumber('projectID','t_project','PRJ-',3);
		$save = $this->Mod_crud->insertData('t_project', array(
				'projectID'		=> $code,
           		'projectName'	=> $name,
           		'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added New Project, '.$code,$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Project added !</p>
		            </div>');
           		redirect('scope/manage');
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('scope/manage');
           	}
        }
	}

	public function edit()
	{
		$id = $this->input->post('projectScopeID');
		
		$edit = $this->Mod_crud->updateData('t_project_scope', array(
           				'categoryID'		=> $this->input->post('categoryID'),
						'projectID'			=> $this->input->post('projectID'),
						'projectScope'		=> $this->input->post('projectScope'),
						'description'		=> $this->input->post('description'),
						'qualification'		=> $this->input->post('qualification'),
						'startDate'			=> $this->input->post('startDate'),
						'endDate'			=> $this->input->post('endDate'),
						'reqQuantity'		=> $this->input->post('reqQuantity'),
						'isTaken'			=> $this->input->post('isTaken'),
						'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('projectScopeID' => $id)
           	);
		helper_log('edit','Edited Project Scope, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Project Scope updated !</p>
		        </div>');
           		redirect('scope/manage');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('scope/manage');
         }
	}

	public function editcategory()
	{
		$id = $this->input->post('categoryID');
		
		$edit = $this->Mod_crud->updateData('t_category', array(
           				'categoryName' 	=> $this->input->post('categoryName'),
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('categoryID' => $id)
           	);
		helper_log('edit','Edited Category, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Cateogry updated !</p>
		        </div>');
           		redirect('scope/manage');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('scope/manage');
         }
	}

	public function editproject()
	{
		$id = $this->input->post('projectID');
		
		$edit = $this->Mod_crud->updateData('t_project', array(
           				'projectName' 	=> $this->input->post('projectName'),
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('projectID' => $id)
           	);
		helper_log('edit','Edited Project, '.$id,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-success">
		            <h4>Success</h4>
		            <p>Project updated !</p>
		        </div>');
           		redirect('scope/manage');
        }else{
           	$this->session->set_flashdata('msg', 
		        '<div class="alert alert-danger">
		            <h4>Error</h4>
		            <p>an error occurred while saving data !</p>
		        </div>');
           	redirect('scope/manage');
         }
	}

	function delete(){
		$mod = $this->input->post('mod');
		$id = $this->input->post('id');
		if ($mod == 'category') {
			$delete = $this->Mod_crud->deleteData('t_category',array('categoryID'=>$id));
			helper_log('delete','Deleted Category, '.$id,$this->session->userdata('login')['sess_usrID']);
			redirect('scope/manage');
		}elseif ($mod == 'project') {
			$delete = $this->Mod_crud->deleteData('t_project',array('projectID'=>$id));
			helper_log('delete','Deleted Project, '.$id,$this->session->userdata('login')['sess_usrID']);
			redirect('scope/manage');
		}elseif ($mod == 'scope'){
			$delete 	= $this->Mod_crud->deleteData('t_project_scope',array('projectScopeID'=>$id));
			$delete_tmp = $this->Mod_crud->deleteData('t_project_scope_temp',array('projectScopeID'=>$id));
			$delete_work = $this->Mod_crud->deleteData('t_workscope',array('projectScopeID'=>$id));
			helper_log('delete','Deleted Project Scope, '.$id,$this->session->userdata('login')['sess_usrID']);
			redirect('scope/manage');
		}else{
			$delete 	= $this->Mod_crud->deleteData('t_project_scope',array('projectScopeID'=>$id));
			$delete_tmp = $this->Mod_crud->deleteData('t_project_scope_temp',array('projectScopeID'=>$id));
			redirect('scope');
		}
	}

	function approve(){
		$mod = $this->input->post('mod');
		$id = $this->input->post('id');
		if ($mod == 'approve') {
			$edit = $this->Mod_crud->updateData('t_project_scope', array(
           				'isApproved' 	=> 'Y',
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('projectScopeID' => $id)
			);
			helper_log('approve','Approved Project Scope, '.$id,$this->session->userdata('login')['sess_usrID']);
		}else{
			$edit = $this->Mod_crud->updateData('t_project_scope', array(
           				'isApproved' 	=> 'N'
           			), array('projectScopeID' => $id)
			);
			helper_log('notapprove','Not Approved, '.$id,$this->session->userdata('login')['sess_usrID']);
		}
		redirect('scope');
	}

		function do_approve()
	{
		$approve = $this->Mod_crud->updateData('t_project_scope', array(
        		'isApproved' 	=> 'Y',
        		'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
        		'updatedTIME'	=> date('Y-m-d H:i:s')
        	), array('projectScopeID' => $this->input->post('id'))
		);

		helper_log('approve','Denied Project Scope ( '.name_projectscope($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);

		if ($approve){
			$data = array(
					'code' => 200,
					'pesan' => 'Denied Scope Success !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
	}

	function apply(){
		$mod = $this->input->post('mod');
		$id = $this->input->post('id');
		$mahasiswaID = $this->session->userdata('login')['sess_usrID'];

		if ($mod == 'apply') {
			$save = $this->Mod_crud->insertData('t_project_scope_temp', array(
				'projectScopeID' 	=> $id,
           		'mahasiswaID'	 	=> $mahasiswaID,
           		'type'				=> 'Applied',
           		'date'				=> date('Y-m-d h:i:s')
           		)
           	);
           	helper_log('apply','Applied Project Scope, '.$id,$this->session->userdata('login')['sess_usrID']);
		}else{
			$edit = $this->Mod_crud->updateData('t_project_scope_temp', array(
           				'type' 	=> 'Canceled'
           			), array('projectScopeID' => $id,'mahasiswaID' => $mahasiswaID)
           	);
           	helper_log('cancel','Canceled apply, '.$id,$this->session->userdata('login')['sess_usrID']);
		}
		redirect('scope');
	}

		public function detail()
	{
				$id = $this->uri->segment(3);
				$detail = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null,array('projectScopeID = "'.$id.'"'));
				$temp = $this->Mod_crud->getData('result', 't.*,m.*', 't_project_scope_temp t', null, null,array('t_mahasiswa m'=>'t.mahasiswaID = m.mahasiswaID'),array('t.projectScopeID = "'.$id.'"'));
				$getmahasiswa = $this->Mod_crud->getData('result','m.*,ff.*','t_mahasiswa m',null,null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'));

				if (! $detail){
					redirect(base_url('scope/index'),'refresh');
				}
				$data = array(
					'_CSS' => generate_css(array(
									"dashboard/plugins/superbox/css/superbox.min.css",
									"dashboard/plugins/lity/dist/lity.min.css",
									"dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
									"dashboard/plugins/DataTables/extensions/AutoFill/css/autoFill.bootstrap.min.css",
									"dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
									"dashboard/alert/sweetalert.css"
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
									"dashboard/alert/sweetalert.min.js",
									"dashboard/alert/sweetalert.js"
								)
						),
						'webTitle' 		=> "Detail",
						'pageTitle' 	=> explode(',', 'Project Scope, Detail'),
						'breadcrumb' 	=> explode(',', 'Dashboard, Project scope, detail '),
						'dtscope' 		=> $detail,
						'dtmp'			=> $temp,
						'dtmahasiswa'	=> $getmahasiswa
					);
				$this->render('dashboard' , 'pages/scope/detail',$data);		
	}

		public function do_accept()
	{
		$tempID = $this->input->post('tempID');
		$getmp	= $this->Mod_crud->getData('result','*','t_project_scope_temp',null,null,null,array('tempID = "'.$tempID.'"'));
		foreach ($getmp as $key) {
			$projectScopeID = $key->projectScopeID;
			$mahasiswaID	= $key->mahasiswaID;
		}
		$getscope	= $this->Mod_crud->getData('result','*','t_project_scope',null,null,null,array('projectScopeID = "'.$projectScopeID.'"'));
		foreach ($getscope as $key) {
			$projectName 	= name_project($key->projectID);
			$projectScope	= $key->projectScope;
			$deptName		= name_dept($key->deptID);
		}
		$getmhs		= $this->Mod_crud->getData('result','*','t_mahasiswa',null,null,null,array('mahasiswaID = "'.$mahasiswaID.'"'));
		foreach ($getmhs as $key) {
			$mhsName = $key->fullName;
			$email 	 = $key->emaiL;
		}
		$code = $this->Mod_crud->autoNumber('workscopeID','t_workscope','WSC-',3);
		$save = $this->Mod_crud->insertData('t_workscope', array(
				'workscopeID'		=> $code,
				'projectScopeID'	=> $projectScopeID,
           		'mahasiswaID'		=> $mahasiswaID,
           		'statusWorkscope'	=> 'pending',
           		'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
		$edit = $this->Mod_crud->updateData('t_project_scope_temp', array(
           				'statusTemp' 	=> 'accepted'
           			), array('tempID' => $tempID)
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
							<title>CBN Internship</title>
						</head>
						<body>
							<h2>CBN Internship Web Portal</h2>
							<p>Hai, ".$mhsName." <br/>Kamu di terima untuk mengisi bagian ".$projectScope." ( ".$projectName." ) <br/><br/></p>
							<p><hr />".$deptName."<hr /><br/></p>
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
		    $this->email->subject('CBN Internship');
		    $this->email->message($message);
		    helper_log('accept','Accepted Applier '.$mhsName.' for '.$projectScope.' ( '.$projectName.' )',$this->session->userdata('login')['sess_usrID']);

           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have send an email to '.$mhsName.'!</p>
		            </div>');
           		redirect('scope/detail/'.$projectScopeID);
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('scope/detail/'.$projectScopeID);
        	}
	}

			public function do_reject()
	{
		$tempID = $this->input->post('tempID');
		$getmp	= $this->Mod_crud->getData('result','*','t_project_scope_temp',null,null,null,array('tempID = "'.$tempID.'"'));
		foreach ($getmp as $key) {
			$projectScopeID = $key->projectScopeID;
			$mahasiswaID	= $key->mahasiswaID;
		}
		$getscope	= $this->Mod_crud->getData('result','*','t_project_scope',null,null,null,array('projectScopeID = "'.$projectScopeID.'"'));
		foreach ($getscope as $key) {
			$projectName 	= name_project($key->projectID);
			$projectScope	= $key->projectScope;
			$deptName		= name_dept($key->deptID);
		}
		$getmhs		= $this->Mod_crud->getData('result','*','t_mahasiswa',null,null,null,array('mahasiswaID = "'.$mahasiswaID.'"'));
		foreach ($getmhs as $key) {
			$mhsName = $key->fullName;
			$email 	 = $key->emaiL;
		}
		$edit = $this->Mod_crud->updateData('t_project_scope_temp', array(
           				'statusTemp' 	=> 'rejected'
           			), array('tempID' => $tempID)
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
							<title>CBN Internship</title>
						</head>
						<body>
							<h2>CBN Internship Web Portal</h2>
							<p>Hai, ".$mhsName." <br/>Maaf, kamu di tolak untuk mengisi ".$projectScope." ( ".$projectName." ) <br/><br/></p>
							<p><hr />".$deptName."<hr /><br/></p>
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
		    $this->email->subject('CBN Internship');
		    $this->email->message($message);
		    helper_log('reject','Rejected Applier '.$mhsName.' for '.$projectScope.' ( '.$projectName.' )',$this->session->userdata('login')['sess_usrID']);

           	if ($this->email->send()){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>We have send an email to '.$mhsName.'!</p>
		            </div>');
           		redirect('scope/detail/'.$projectScopeID);
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('scope/detail/'.$projectScopeID);
        	}
	}

	public function download($id=null){
		$getscope = $this->Mod_crud->getData('result', '*','t_project_scope',null,null,null,array('projectScopeID = "'.$id.'"'));
		foreach ($getscope as $key) {
			$projectScope = $key->projectScope;
			$projectName = name_project($key->projectID);
		}
		$data['dtscope'] = $getscope;
		$html = $this->load->view('pages/scope/prnt',$data,TRUE);
		$this->pdfgenerator->generate($html,$projectScope.'_( '.$projectName.' )_'.date('ymdhis'));
	}
}

/* End of file scope.php */
/* Location: ./application/controllers/scope.php */