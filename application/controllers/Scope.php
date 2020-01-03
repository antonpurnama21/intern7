<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Scope extends CommonDash {
//controller projec scope 
	public function __construct()
	{
		parent::__construct();
	}

	public function index()//index project scope
	{
		if ($this->session->userdata('userlog')['sess_role']==22) {//ika session role = 22 (admin department)
		//get department id
		$deptID = $this->session->userdata('userlog')['sess_deptID'];
		//get data project scope
		$scope 	= $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null, array('isApproved = "Y"','deptID = "'.$deptID.'"'), null, array('projectScopeID ASC'));

		}else{
		//get data project scope
		$scope = $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null, array('isApproved = "Y"'), null, array('projectScopeID ASC'));
		
		}
		$data = array(//generate js
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
						"dashboards/js/plugins/forms/selects/select2.min.js",
						"dashboards/js/pages/datatables_responsive.js",
						"dashboards/js/plugins/forms/styling/switch.min.js",
						"dashboards/js/plugins/forms/styling/switchery.min.js",
						"dashboards/js/plugins/forms/styling/uniform.min.js",
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/scope-index-script.js",
				)
			),
			'titleWeb' => "Project Scope | CBN Internship",//title web
			'breadcrumb' => explode(',', 'Project Scope, Project Scope List'),//breadcrumb
			'dtscope'	=> $scope//data scope
		);
		$this->render('dashboard', 'pages/scope/index', $data);//load view scope index
	}

	public function manage()//manage project scope
	{
		//get department id
		$deptID 	= $this->session->userdata('userlog')['sess_deptID'];
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
						"dashboards/js/plugins/forms/selects/select2.min.js",
						"dashboards/js/pages/datatables_responsive.js",
						"dashboards/js/plugins/forms/styling/switch.min.js",
						"dashboards/js/plugins/forms/styling/switchery.min.js",
						"dashboards/js/plugins/forms/styling/uniform.min.js",
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/scope-manage-script.js",
				)
			),
			'titleWeb' 	=> "Manage Project Scope | CBN Internship",//title web
			'breadcrumb' 	=> explode(',', 'Project Scope, Manage Project Scope'),//breadcrumb
			'dtcategory' 	=> $this->Mod_crud->getData('result','*', 't_category'),//data kategory
			'dtproject' 	=> $this->Mod_crud->getData('result','*', 't_project'),//data projek
			//data project scope
			'dtscope'	=> $this->Mod_crud->getData('result', '*', 't_project_scope', null, null,null, array('deptID = "'.$deptID.'"'), null, array('projectScopeID ASC'))
		);
		$this->render('dashboard', 'pages/scope/manage', $data); //load view manage
	}

	public function detilScope($id=null)//detil project scope
	{	
		//ambil detail project scope
		$detail = $this->Mod_crud->getData('row', 'a.*,p.*', 't_project_scope a', null, null,array('t_project p'=>'a.projectID = p.projectID'),array('a.projectScopeID = "'.$id.'"'));
		//ambil temp project scope
		$temp = $this->Mod_crud->getData('result', 't.*,m.*', 't_project_scope_temp t', null, null,array('t_mahasiswa m'=>'t.mahasiswaID = m.mahasiswaID'),array('t.projectScopeID = "'.$id.'"'));

		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
						"dashboards/js/plugins/forms/selects/select2.min.js",
						"dashboards/js/pages/datatables_responsive.js",
						"dashboards/js/plugins/forms/styling/switch.min.js",
						"dashboards/js/plugins/forms/styling/switchery.min.js",
						"dashboards/js/plugins/forms/styling/uniform.min.js",
						"dashboards/js/plugins/uploaders/fileinput.min.js",
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/pickers/anytime.min.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/scope-manage-script.js",
				)
			),
			'titleWeb' 		=> "Project Scope Detail | CBN Internship",//title web
			'breadcrumb' 	=> explode(',', 'Project Scope, Project Scope Detail'),//bread crumb
			'dtscope'		=> $detail,//data project scope
			'dtmp'			=> $temp,//data temp project scope
		);
		$this->render('dashboard', 'pages/scope/detil', $data);//load view project scope detail
	}

	public function add()//form tambah project scope
	{
		$data = array(
			'_JS' => generate_js(array(
					"dashboards/js/plugins/ui/moment/moment.min.js",
					"dashboards/js/plugins/tables/datatables/datatables.min.js",
					"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
					"dashboards/js/plugins/forms/selects/select2.min.js",
					"dashboards/js/pages/datatables_responsive.js",
					"dashboards/js/plugins/forms/styling/switch.min.js",
					"dashboards/js/plugins/forms/styling/switchery.min.js",
					"dashboards/js/plugins/forms/styling/uniform.min.js",
					"dashboards/js/plugins/uploaders/fileinput.min.js",
					"dashboards/js/plugins/pickers/pickadate/picker.js",
					"dashboards/js/plugins/pickers/pickadate/picker.date.js",
					"dashboards/js/plugins/pickers/anytime.min.js",
					"dashboards/js/plugins/forms/validation/validate.min.js",
					"dashboards/js/pages/scope-script.js",
				)
			),
		    'titleWeb' 		=> "Add Project Scope | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' 	=> explode(',', 'Project Scope,Add Project Scope'),
		    'actionForm' 	=> base_url('scope/saveScope'),//form aksi
		    'buttonForm' 	=> 'Simpan',
		    'Req'		=> ''
		);

		$this->render('dashboard', 'pages/scope/form', $data);//load view form
	}

	public function saveScope()//aksi tambah project scope
	{
		//cek duplikasi project scope
		$cekscope = $this->Mod_crud->getData('result','projectID,projectScope','t_project_scope',null,null,null,array('projectID = "'.$this->input->post('Projectid').'" AND projectScope = "'.$this->input->post('Projectscope').'"'));
		if ($cekscope) {//jika ada
			echo json_encode(array('code' => 366, 'message' => 'Projectscope already added!'));
		}else{
			//get department id
			$deptID = get_deptID($this->session->userdata('userlog')['sess_usrID']);
			//generate id project scope
			$code = $this->Mod_crud->autoNumber('projectScopeID','t_project_scope','PSC-',3);
			//simpan project scope
			$save = $this->Mod_crud->insertData('t_project_scope', array(
				'projectScopeID'	=> $code,
				'deptID'		=> $deptID,
				'categoryID'		=> $this->input->post('Categoryid'),
				'projectID'		=> $this->input->post('Projectid'),
				'projectScope'		=> $this->input->post('Projectscope'),
				'description'		=> $this->input->post('Description'),
				'qualification'		=> $this->input->post('Qualification'),
				'startDate'		=> date_format(date_create($this->input->post('Startdate_submit')), 'Y-m-d'),
				'endDate'		=> date_format(date_create($this->input->post('Enddate_submit')), 'Y-m-d'),
				'reqQuantity'		=> $this->input->post('Quantity'),
				'isTaken'		=> $this->input->post('Istaken'),
				'isApproved'		=> 'P',
				'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           			'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
			//log tambah project scope
			helper_log('add','Add New Project Scope ( '.$this->input->post('Projectscope').' )',$this->session->userdata('userlog')['sess_usrID']);
			//notifikasi
			create_notification('New','Project Scope',$this->input->post('Projectscope'),'');

			if ($save){//jika bernilai true
				//set alert
				$this->alert->set('bg-success', "Insert success !");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !', 'aksi' => "window.location.href='".base_url('scope/manage')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       		}
	}

	public function form($id=null)//form edit project scope
	{
		$data = array(
			'_JS' => generate_js(array(
					"dashboards/js/plugins/ui/moment/moment.min.js",
					"dashboards/js/plugins/tables/datatables/datatables.min.js",
					"dashboards/js/plugins/tables/datatables/extensions/scroller.min.js",
					"dashboards/js/plugins/forms/selects/select2.min.js",
					"dashboards/js/pages/datatables_responsive.js",
					"dashboards/js/plugins/forms/styling/switch.min.js",
					"dashboards/js/plugins/forms/styling/switchery.min.js",
					"dashboards/js/plugins/forms/styling/uniform.min.js",
					"dashboards/js/plugins/uploaders/fileinput.min.js",
					"dashboards/js/plugins/pickers/pickadate/picker.js",
					"dashboards/js/plugins/pickers/pickadate/picker.date.js",
					"dashboards/js/plugins/pickers/anytime.min.js",
					"dashboards/js/plugins/forms/validation/validate.min.js",
					"dashboards/js/pages/scope-script.js",
				)
			),
		    'titleWeb' 	 => "Edit Project Scope | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Project Scope,Edit ('.name_projectscope($id).')'),
		    //ambil data project scope
		    'dMaster'	 => $this->Mod_crud->getData('row','*','t_project_scope', null, null,null, array('projectScopeID = "'.$id.'"')),
		    'actionForm' => base_url('scope/editScope'),//url aksi
		    'buttonForm' => 'Simpan',
		    'Req' 	 => ''
		);

		$this->render('dashboard', 'pages/scope/form', $data);//load view form edit
	}

	public function editScope()//aksi form edit project scope
	{
		//cek duplikasi project scope
			$cek = $this->Mod_crud->checkData('projectScope', 't_project_scope', array('projectScope = "'.$this->input->post('Projectscope').'"', 'projectScopeID != "'.$this->input->post('Projectscopeid').'"'));
			if ($cek){
				echo json_encode(array('code' => 366, 'message' => 'Project scope has been added!'));
			}else{
				//simpan perubahan
				$edit = $this->Mod_crud->updateData('t_project_scope', array(
           				'categoryID'		=> $this->input->post('Categoryid'),
					'projectID'		=> $this->input->post('Projectid'),
					'projectScope'	=> $this->input->post('Projectscope'),
					'description'	=> $this->input->post('Description'),
					'qualification'	=> $this->input->post('Qualification'),
					'startDate'		=> date_format(date_create($this->input->post('Startdate_submit')), 'Y-m-d'),
					'endDate'		=> date_format(date_create($this->input->post('Enddate_submit')), 'Y-m-d'),
					'reqQuantity'	=> $this->input->post('Quantity'),
					'isTaken'		=> $this->input->post('Istaken'),
					'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           			'updatedTIME'	=> date('Y-m-d H:i:s')
           		), array('projectScopeID' => $this->input->post('Projectscopeid'))
           	);
				//log edit prject scope
			helper_log('edit','Edit Project Scope ( '.$this->input->post('Projectscope').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($edit){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !', 'aksi' => "window.location.href='".base_url('scope/manage')."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function modalCategory()//modal tambah category
	{
		$data = array(
				'modalTitle' => 'Add Category ',//modal title
				'formAction' => base_url('scope/saveCategory'),//url aksi,
				'Req' => ''
			);
		$this->load->view('pages/scope/formCategory', $data);////load modal category
	}

	public function saveCategory()//aski tambah category
	{
		//cek duplikasi nama ketegori
		$cekscope = $this->Mod_crud->getData('result','categoryName','t_category',null,null,null,array('categoryName = "'.$this->input->post('Categoryname').'"'));
		if ($cekscope) {//jika ada
			echo json_encode(array('code' => 266, 'message' => 'Category already added!'));
		}else{
			//set id kategori
			$code = $this->Mod_crud->autoNumber('categoryID','t_category','CAT-',3);
			//simpan category
			$save = $this->Mod_crud->insertData('t_category', array(
				'categoryID'	=> $code,
				'categoryName'	=> $this->input->post('Categoryname'),
				'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
				'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
			//log tambah kategori
			helper_log('add','Add New Category ( '.$this->input->post('Categoryname').' )',$this->session->userdata('userlog')['sess_usrID']);
			//notifikasi
			create_notification('New','Category',$this->input->post('Categoryname'),'scope/manage');

			if ($save){//jika bernilai true
				//set alert
				$this->alert->set('bg-success', "Insert success !");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       		}
	}

	public function modalEditCategory()//modal edit kategori
	{
		$ID = explode('~',$this->input->post('id'));//get post id
		$data = array(
				'modalTitle' 	=> 'Edit Category '.$ID[1],//title modal
				//ambil data kategori
				'dMaster' 	=> $this->Mod_crud->getData('row','*','t_category', null, null,null, array('categoryID = "'.$ID[0].'"')),
				'formAction' 	=> base_url('scope/editCategory'),//url aksi
				'Req' 		=> ''
			);
		$this->load->view('pages/scope/formCategory', $data);//load view modal kategori
	}

	public function editCategory()//aksi edit kategori
	{
			$cek = $this->Mod_crud->checkData('categoryName', 't_category', array('categoryName = "'.$this->input->post('Categoryname').'"', 'categoryID != "'.$this->input->post('Categoryid').'"'));
			if ($cek){
				echo json_encode(array('code' => 266, 'message' => 'Category has been added!'));
			}else{
				//simpan perubahan kategori
				$edit = $this->Mod_crud->updateData('t_category', array(
           			'categoryName' 	=> $this->input->post('Categoryname'),
           			'updatedBY'	=> $this->session->userdata('userlog')['sess_usrID'],
           			'updatedTIME'	=> date('Y-m-d H:i:s')
           		), array('categoryID' 	=> $this->input->post('Categoryid'))
           	);
			//log edit kategori
			helper_log('edit','Edit Category ( '.$this->input->post('Categoryname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($edit){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       	}
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function modalProject()//modal tambah project
	{
		$data = array(
				'modalTitle' => 'Add Project ',
				'formAction' => base_url('scope/saveProject'),
				'Req' 	     => ''
			);
		$this->load->view('pages/scope/formProject' , $data);//load view modal project
	}

	public function saveProject()//aksi tambah project
	{
		//cek duplikasi
		$cekscope = $this->Mod_crud->getData('result','projectName','t_project',null,null,null,array('projectName = "'.$this->input->post('Projectname').'"'));
		if ($cekscope) {
			echo json_encode(array('code' => 267, 'message' => 'Project already added!'));
		}else{
			//generate id project
			$code = $this->Mod_crud->autoNumber('projectID','t_project','PRJ-',3);
 			//simpan project
 			$save = $this->Mod_crud->insertData('t_project', array(
				'projectID'	=> $code,
				'deptID'	=> $this->input->post('Deptid'),
				'adminID'	=> $this->input->post('Adminid'),
				'projectName'	=> $this->input->post('Projectname'),
				'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
				'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
 			//log tambah
			helper_log('add','Add New Project ( '.$this->input->post('Projectname').' )',$this->session->userdata('userlog')['sess_usrID']);
			//notifikasi
			create_notification('New','Project',$this->input->post('Projectname'),'faculty/index');

			if ($save){
				$this->alert->set('bg-success', "Insert success !");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       		}
	}

	public function modalEditProject()//modal edit project
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle'	=> 'Edit Project '.$ID[1],
				'dMaster' 	=> $this->Mod_crud->getData('row','*','t_project', null, null,null, array('projectID = "'.$ID[0].'"')),
				'formAction'	=> base_url('scope/editProject'),
				'Req' 		=> ''
			);
		$this->load->view('pages/scope/formProject', $data);//load view modal project
	}

	public function editProject()//aksi edit project
	{
			$cek = $this->Mod_crud->checkData('projectName', 't_project', array('projectName = "'.$this->input->post('Projectname').'"', 'projectID != "'.$this->input->post('Projectid').'"'));
			if ($cek){
				echo json_encode(array('code' => 267, 'message' => 'Project has been added!'));
			}else{
				$edit = $this->Mod_crud->updateData('t_project', array(
					'deptID'	=> $this->input->post('Deptid'),
					'adminID'	=> $this->input->post('Adminid'),
           			'projectName' 	=> $this->input->post('Projectname'),
           			'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           			'updatedTIME'	=> date('Y-m-d H:i:s')
           		), array('projectID'	=> $this->input->post('Projectid'))
           	);
			//log edit project
			helper_log('edit','Edit Project ( '.$this->input->post('Projectname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($edit){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
       		}
	}



	

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function delete()//hapus project scope
	{
		//log delete project scope
		helper_log('delete','Delete Project Scope ( '.email($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//hapus project scope temp
		$deltemp = $this->Mod_crud->deleteData('t_project_scope_temp', array('projectScopeID' => $this->input->post('id')));
		//hapus workscope
		$delworkscope = $this->Mod_crud->deleteData('t_workscope', array('projectScopeID' => $this->input->post('id')));
		//hapus project scope
		$query	 = $this->Mod_crud->deleteData('t_project_scope', array('projectScopeID' => $this->input->post('id')));
		if ($query){//jika bernilai true
			$data = array(
					'code' 	=> 200,
					'pesan' => 'Success Delete !',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
		
	}

	public function deleteCategory()//delete /hapus kategori
	{
		//log hapus kategori
		helper_log('delete','Delete Category ( '.name_category($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//delte kategori
		$query 		= $this->Mod_crud->deleteData('t_category', array('categoryID' => $this->input->post('id')));
		if ($query){
			$data = array(
					'code' 	=> 200,
					'pesan' => 'Success Delete !',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}	
	}

	public function deleteProject()//hapus project
	{
		//log hapus project
		helper_log('delete','Delete Project ( '.name_project($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//hapus project
		$query 		= $this->Mod_crud->deleteData('t_project', array('projectID' => $this->input->post('id')));
		if ($query){
			$data = array(
					'code' 	=> 200,
					'pesan' => 'Success Delete !',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
	}

	public function cancelScope()//batalkan apply project scope untuk mahasiswa
	{
		//log batal apply
		helper_log('cancel','Canceled Project Scope ( '.name_projectscope($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//batalkan
		$cancel = $this->Mod_crud->updateData('t_project_scope_temp', array(
           				'type' 	=> 'canceled'
           			), array('projectScopeID' => $this->input->post('id'),'mahasiswaID' => $this->session->userdata('userlog')['sess_usrID'])
           	);
		if ($cancel){//jika bernilai true
			$data = array(
					'code' => 200,
					'pesan' => 'Canceled Scope Success !',
					'aksi' => 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
		
	}

	public function applyScope()//apply scope untuk mahasiswa
	{
		//log apply scope
		helper_log('cancel','Applied Project Scope ( '.name_projectscope($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);
		//applied
		$apply = $this->Mod_crud->insertData('t_project_scope_temp', array(
				'projectScopeID' 	=> $this->input->post('id'),
				'mahasiswaID'	 	=> $this->session->userdata('userlog')['sess_usrID'],
				'type'			=> 'applied',
				'date'			=> date('Y-m-d h:i:s')
           		)
           	);
		if ($apply){
			$data = array(
					'code' 	=> 200,
					'pesan' => 'Applied Scope Success !',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
		
	}

		function do_approve()//approve project scope di lakukan admin hc
	{
		//approve
		$approve = $this->Mod_crud->updateData('t_project_scope', array(
        		'isApproved' 		=> 'Y',
        		'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
        		'updatedTIME'		=> date('Y-m-d H:i:s')
        	), array('projectScopeID' => $this->input->post('id'))
		);
		//log approve
		helper_log('approve','Approved Project Scope ( '.name_projectscope($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);

		if ($approve){
			$data = array(
					'code'	=> 200,
					'pesan' => 'Approved Scope Success !',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
	}

		function not_approve()//tidak di approve
	{
		//tidak di approve
		$notapprove = $this->Mod_crud->updateData('t_project_scope', array(
        		'isApproved' 	=> 'N',
        		'updatedBY'	=> $this->session->userdata('login')['sess_usrID'],
        		'updatedTIME'	=> date('Y-m-d H:i:s')
        	), array('projectScopeID' => $this->input->post('id'))
		);

		helper_log('notapprove','Denied Project Scope ( '.name_projectscope($this->input->post('id')).' )',$this->session->userdata('userlog')['sess_usrID']);

		if ($notapprove){
			$data = array(
					'code' 	=> 200,
					'pesan' => 'Denied Scope Success !',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
              	);
			echo json_encode($data);
		}else{
			echo '';
		}
	}

	public function download($id=null)//download project scope
	{
		//get project scope
		$getscope = $this->Mod_crud->getData('result', '*','t_project_scope',null,null,null,array('projectScopeID = "'.$id.'"'));
		foreach ($getscope as $key) { //looping data
			$projectScope = $key->projectScope;
			$projectName = name_project($key->projectID);
		}
		$data['dtscope'] = $getscope;
		$html = $this->load->view('pages/scope/prnt',$data,TRUE);//load view scope print
		$this->pdfgenerator->generate($html,$projectScope.'_( '.$projectName.' )_'.date('ymdhis'));//generate ke pdf
	}

		public function do_accept()//menyetujui apply yang di lakukakan mahasiswa
	{
		$tempID = $this->input->post('id');//ambil temp id
		//ambil data temp by id
		$getmp	= $this->Mod_crud->getData('result','*','t_project_scope_temp',null,null,null,array('tempID = "'.$tempID.'"'));
		foreach ($getmp as $key) {//looping temp
			$projectScopeID = $key->projectScopeID;
			$mahasiswaID	= $key->mahasiswaID;
		}
		//ambil data project scope
		$getscope	= $this->Mod_crud->getData('result','*','t_project_scope',null,null,null,array('projectScopeID = "'.$projectScopeID.'"'));
		foreach ($getscope as $key) {
			$projectName 	= name_project($key->projectID);
			$projectScope	= $key->projectScope;
			$deptName	= name_dept($key->deptID);
		}
		//ambil data mahasiswa
		$getmhs		= $this->Mod_crud->getData('result','*','t_mahasiswa',null,null,null,array('mahasiswaID = "'.$mahasiswaID.'"'));
		foreach ($getmhs as $key) {
			$mhsName = $key->fullName;
			$email 	 = $key->emaiL;
		}
		//generate id workscope
		$code = $this->Mod_crud->autoNumber('workscopeID','t_workscope','WSC-',3);
		//save ke workscope
		$save = $this->Mod_crud->insertData('t_workscope', array(
				'workscopeID'		=> $code,
				'projectScopeID'	=> $projectScopeID,
           		'mahasiswaID'		=> $mahasiswaID,
           		'statusWorkscope'	=> 'pending',
           		'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
		//edit temp
		$edit = $this->Mod_crud->updateData('t_project_scope_temp', array(
           				'statusTemp' 	=> 'accepted'
           			), array('tempID' => $tempID)
			);
		//configurasi email
			$config = array(
				  		'protocol' => 'ssmtp',
				  		'smtp_host' => 'ssl://mail.intern7.iex.or.id',
				  		'smtp_port' => 465,
				  		'smtp_user' => 'info@intern7.iex.or.id', // change it to yours
				  		'smtp_pass' => 'Infocbn123', // change it to yours
				  		//'smtp_username' => 'armg3295',
				  		'mailtype' => 'html',
				  		'charset'  => 'iso-8859-1',
				  		'wordwrap' => TRUE
			);
			//isi pesan
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
		    $this->email->from($config['smtp_user']); //dari email
		    $this->email->to($email);//untuk email
		    $this->email->subject('CBN Internship');//subject
		    $this->email->message($message);//pesan
		    //log persetujuan
		    helper_log('accept','Accepted Applier '.$mhsName.' for '.$projectScope.' ( '.$projectName.' )',$this->session->userdata('login')['sess_usrID']);

           	if ($this->email->send()){//jika di kirim
			$data = array(
					'code'  => 200,
					'pesan' => 'Mahasiswa Accepted, Success!',
					'aksi'  => 'setTimeout("window.location.reload();",1500)'
	              	);
				echo json_encode($data);
			}else{
				echo '';
			}
	}

		public function do_reject()//batal/menolak
	{
		$tempID = $this->input->post('id');//temp id
		//ambil data temp
		$getmp	= $this->Mod_crud->getData('result','*','t_project_scope_temp',null,null,null,array('tempID = "'.$tempID.'"'));
		foreach ($getmp as $key) {
			$projectScopeID = $key->projectScopeID;
			$mahasiswaID	= $key->mahasiswaID;
		}
		//ambil data project scope
		$getscope	= $this->Mod_crud->getData('result','*','t_project_scope',null,null,null,array('projectScopeID = "'.$projectScopeID.'"'));
		foreach ($getscope as $key) {
			$projectName 	= name_project($key->projectID);
			$projectScope	= $key->projectScope;
			$deptName	= name_dept($key->deptID);
		}
		//ambil data mahasiswa
		$getmhs		= $this->Mod_crud->getData('result','*','t_mahasiswa',null,null,null,array('mahasiswaID = "'.$mahasiswaID.'"'));
		foreach ($getmhs as $key) {
			$mhsName = $key->fullName;
			$email 	 = $key->emaiL;
		}
		//edit temp
		$edit = $this->Mod_crud->updateData('t_project_scope_temp', array(
           				'statusTemp' 	=> 'rejected'
           			), array('tempID' => $tempID)
			);
		//konfigurasi email
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
		    //log reject
		    helper_log('reject','Rejected Applier '.$mhsName.' for '.$projectScope.' ( '.$projectName.' )',$this->session->userdata('login')['sess_usrID']);

           	if ($this->email->send()){
			$data = array(
					'code' 	=> 200,
					'pesan' => 'Mahasiswa Rejected, Success!',
					'aksi' 	=> 'setTimeout("window.location.reload();",1500)'
	              	);
				echo json_encode($data);
			}else{
				echo '';
			}
	}

	//modal preview project scope
	public function modalScope(){
		$ID = explode('~',$this->input->post('id'));//get post id
		$data = array(
				'modalTitle' 	=> 'Review '.$ID[1],//title modal
				//ambil data project scope
				'dMaster' 	=> $this->Mod_crud->getData('row','a.*,p.*','t_project_scope a', null, null,array('t_project p'=>'a.projectID = p.projectID'), array('a.projectScopeID = "'.$ID[0].'"')),
				'Req' 		=> ''
			);
		$this->load->view('pages/scope/reviewScope', $data);//load view modal review scope
	}

	public function modalMahasiswa()//modal review mahasiswa
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
			'modalTitle' 	=> 'View '.$ID[1],
			//ambil data mahasiswa
			'dMaster' 	=> $this->Mod_crud->getData('row','m.*,ff.*','t_mahasiswa m',null,null,array('t_mahasiswa_file ff'=>'m.mahasiswaID = ff.mahasiswaID'),array('m.mahasiswaID = "'.$ID[0].'"')),
			//ambil data workscope
			'dtworkscope' 	=> $this->Mod_crud->getData('result','ws.*,ps.*','t_workscope ws',null,null,array('t_project_scope ps'=>'ps.projectScopeID = ws.projectScopeID'),array('ws.mahasiswaID = "'.$ID[0].'"')),
			'Req' 		=> ''
			);
		$this->load->view('pages/scope/reviewMahasiswa', $data);//load view modal review mahasiswa
	}

}

/* End of file Scope.php */
/* Location: ./application/controllers/Scope.php */
