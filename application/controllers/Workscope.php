<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Workscope extends CommonDash {
	//controller untuk mengelola workscope
	public function __construct()
	{
		parent::__construct();
	}

	public function index()//halaman index workscope
	{
		if ($this->session->userdata('userlog')['sess_role']==11) {//jika role id = 11 (admin hc)
			//ambil semua data workscope
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), null, null, array('workscopeID ASC'));
		
		}elseif ($this->session->userdata('userlog')['sess_role']==22) {//jika role id = 22 (admin department)
			$deptID = $this->session->userdata('userlog')['sess_deptID'];//ambil id department
			//ambil data workscope berdasarkan department id
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('ps.deptID = "'.$deptID.'"'), null, array('w.workscopeID ASC'));
		
		}elseif ($this->session->userdata('userlog')['sess_role']==33) {//jika role id = 33 (admin campus)
			//get universitas id
			$univID = $this->session->userdata('userlog')['sess_univID'];
			//ambil data workscope beradasarkan universitas id
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*,m.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID','t_mahasiswa m'=>'w.mahasiswaID = m.mahasiswaID'), array('m.universityID = "'.$univID.'"'), null, array('w.workscopeID ASC'));
		
		}elseif ($this->session->userdata('userlog')['sess_role']==44) {//jika role id = 44 (dosen)
			//get id universitas
			$univID = $this->session->userdata('userlog')['sess_univID'];
			//get id fakultas
			$facID = $this->session->userdata('userlog')['sess_facID'];
			//ambil data workscope berdasrkan univeristas id  dan fakultas id
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*,m.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID','t_mahasiswa m'=>'w.mahasiswaID = m.mahasiswaID'), array('m.universityID = "'.$univID.'"','m.facultyID = "'.$facID.'"'), null, array('w.workscopeID ASC'));
		
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
						"dashboards/js/pages/workscope-index-script.js",
				)
			),
			'titleWeb' 	=> "Workscope | CBN Internship",//tiitle web
			'breadcrumb' 	=> explode(',', 'Workscope, Workscope List'),//bread crumb
			'dtworkscope'	=> $getworkscope//data workscope
		);
		$this->render('dashboard', 'pages/workscope/index', $data);//load view workscope index
	}

// DETAIL
	public function detail($id=null)
	{	
		//ambil workscope detail
		$detail = $this->Mod_crud->getData('row', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('w.workscopeID = "'.$id.'"'), null, array('workscopeID ASC'));
		
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
						//"dashboards/js/pages/workscope-script.js",
						"dashboards/js/plugins/ui/fullcalendar/fullcalendar.min.js",

						"dashboards/js/pages/timeline.js",
				)
			),
			'titleWeb' 	=> "Detail Workscope | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, Detail Workscope'),
			'dtworkscope'	=> $detail
		);
		$this->render('dashboard', 'pages/workscope/detil', $data);//load view workscope detil
	}

		public function getTimeline()//calender timeline
	{
		//ambil user id
		$id = $this->session->userdata('userlog')['sess_usrID'];
		//ambil id workscope
		$wsID = $this->Mod_crud->getData('row','workscopeID','t_workscope',null,null,null,array('mahasiswaID = "'.$id.'"'));
		$resp = array();//set array
		//ambil data task
		$data = $this->Mod_crud->getData('result', '*', 't_task', null,null,null,array('workscopeID = "'.$wsID->workscopeID.'"'));
		if (!empty($data)) {//jika tidak kosong
			foreach ($data as $key) {//looping data
				//set url
				$base = base_url('workscope/progress/'.$key->taskID);
					
				if ($key->statusTask=='pending') {//jika status pending
					$status = 'Pending';
					$color = 'gray';
					$url = '';
				}elseif ($key->statusTask=='on-progress') {//jik status on progress
					$status = 'On Progress';
					$color = 'green';
					$url = $base;
				}elseif ($key->statusTask=='done-delay') {//jika status done delay
					$status = 'Done Delay';
					$color = 'orange';
					$url = $base;
				}elseif ($key->statusTask=='done') {//jika status done
					$status = 'Done';
					$color = 'blue';
					$url = $base;
				}else{//jika status delay
					$status = 'Delay';
					$color = 'red';
					$url = $base;
				}

				$mk['title'] 		= $key->taskName.' [ '.$status.' ] ';//set title 
				$mk['description'] 	= $key->taskDesc;//set deskripsi
				$mk['start'] 		= $key->startDate."T00:00:00";//set waktu mulai
				$mk['end'] 			= $key->endDate."T23:59:00";//set waktu berakhir
				$mk['color'] 		= $color;//set warna
				$mk['url'] 			= $url;//url
				array_push($resp, $mk);
				if ($key->startDelay != null){//jika tidak null
					$color2 = 'red';//warna
					$status2 = 'Delay Date';//status

					$md['title'] 	   = $key->taskName.' [ '.$status2.' ] ';
					$md['description'] = $key->taskDesc;
					$md['start'] 	   = $key->startDelay."T00:00:00";
					$md['end'] 		   = $key->endDelay."T23:59:00";
					$md['color'] 	   = $color2;
					$md['url'] 		   = $url;
					array_push($resp, $md);
				}
			}
		}
		echo json_encode($resp);
	}

		public function TimelineByid($id=null)//timeline by id
	{
		$resp = array();//set array
		//ambil data task by id
		$data = $this->Mod_crud->getData('result', '*', 't_task', null,null,null,array('workscopeID = "'.$id.'"'));
		if (!empty($data)) {
			foreach ($data as $key) {
				$base = base_url('workscope/logProgress/'.$key->taskID);
				
				if ($key->statusTask=='pending') {
					$status = 'Pending';
					$color = 'gray';
					$url = '';
				}elseif ($key->statusTask=='on-progress') {
					$status = 'On Progress';
					$color = 'green';
					$url = $base;
				}elseif ($key->statusTask=='done-delay') {
					$status = 'Done Delay';
					$color = 'orange';
					$url = $base;
				}elseif ($key->statusTask=='done') {
					$status = 'Done';
					$color = 'blue';
					$url = $base;
				}else{
					$status = 'Delay';
					$color = 'red';
					$url = $base;
				}

				$mk['title'] = $key->taskName.' [ '.$status.' ] ';
				$mk['description'] = $key->taskDesc;
				$mk['start'] = $key->startDate."T00:00:00";
				$mk['end'] = $key->endDate."T23:59:00";
				$mk['color'] = $color;
				$mk['url'] = $url;
				array_push($resp, $mk);
				if ($key->startDelay != null){
					$color2 = 'red';
					$status2 = 'Delay Date';

					$md['title'] = $key->taskName.' [ '.$status2.' ] ';
					$md['description'] = $key->taskDesc;
					$md['start'] = $key->startDelay."T00:00:00";
					$md['end'] = $key->endDelay."T23:59:00";
					$md['color'] = $color2;
					$md['url'] = $url;
					array_push($resp, $md);
				}
			}
		}
		echo json_encode($resp);
	}

	public function myworkscope()//workscope mahasiswa
	{	
		//ambil id user
		$id = $this->session->userdata('userlog')['sess_usrID'];
		//get workscope
		$mywork = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('w.mahasiswaID = "'.$id.'"'), null, array('workscopeID ASC'));
		
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
						//"dashboards/js/pages/workscope-script.js",
						"dashboards/js/plugins/ui/fullcalendar/fullcalendar.min.js",

						"dashboards/js/pages/timeline.js",

				)
			),
			'titleWeb' 		=> "My Workscope | CBN Internship",//title web
			'breadcrumb' 	=> explode(',', 'Workscope, My Workscope'),//breadcrumb
			'dtworkscope'	=> $mywork
		);
		$this->render('dashboard', 'pages/workscope/mywork', $data);//load view workscope mywork
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function manageTask($id=null)//kelola task
	{	
		//ambil data task
		$getask = $this->Mod_crud->getData('result', 't.*,w.*', 't_task t', null, null,array('t_workscope w'=>'t.workscopeID = w.workscopeID'), array('t.workscopeID = "'.$id.'"'), null, array('t.taskID ASC'));
		
		$data = array( //generate js
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
						"dashboards/js/pages/task-index-script.js",
				)
			),
			'titleWeb' 	=> "My Task | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, My Task'),
			'dtask'	=> $getask,
			'workscopeID' => $id
		);
		$this->render('dashboard', 'pages/workscope/indextask', $data);//load view workscope indextask
	}

		public function addTask($id=null)//tambah task
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
					"dashboards/js/pages/task-script.js",
				)
			),
		    'titleWeb' => "Add Task Timeline | CBN Internship",//title web
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Workscope,Add Task Timeline'),
		    'actionForm' => base_url('workscope/saveTask'),//url aksi
		    'buttonForm' => 'Simpan',
		    'workscopeID' => $id,
		    'Req'	=> ''
		);

		$this->render('dashboard', 'pages/workscope/addTask', $data);//load view add task
	}

		public function saveTask()//simpan add task
	{
			$wsid		 = $this->input->post('Wsid');
			$workscopeID = $this->input->post('Workscopeid');
			$taskName	 = $this->input->post('Taskname');
			$taskDesc 	 = $this->input->post('Taskdesc');
			$startDate	 = $this->input->post('Startdate');
			$endDate 	 = $this->input->post('Enddate');

			$data = array();//set array

			$index = 0;
			foreach ($taskName as $key) {//looping total index
				array_push($data, array(
						'workscopeID'	=> $workscopeID[$index],
						'taskName' 		=> $taskName[$index],
						'taskDesc' 		=> $taskDesc[$index],
						'startDate'		=> $startDate[$index],
						'endDate' 		=> $endDate[$index],
						'statusTask'	=> 'pending',
						'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTIME'	=> date('Y-m-d h:i:s')
					));
				//log new task
				helper_log('add','Add New Task ( '.$taskName[$index].' )',$this->session->userdata('userlog')['sess_usrID']);
				$index++;			
			}
			//insert multiple
			$insertBatch = $this->Mod_crud->insertBatch('t_task',$data);

			if ($insertBatch){//jika bernilai true
				$this->alert->set('bg-success', "Insert success !");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !', 'aksi' => "window.location.href='".base_url('workscope/manageTask/').$wsid."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
	}

	public function modalEditTask()//modal edit task
	{
		$ID = explode('~',$this->input->post('id'));//ambil id
		$data = array(
				'modalTitle' => 'Edit Task '.$ID[1],//modal title
				//ambil data task
				'dMaster' => $this->Mod_crud->getData('row','*','t_task', null, null,null, array('taskID = "'.$ID[0].'"')),
				'formAction' => base_url('workscope/editTask'),
				'Req' => ''
			);
		$this->load->view('pages/workscope/modalTask', $data);//load view modal task
	}

		public function editTask()//aksi edit task
	{
			$edit = $this->Mod_crud->updateData('t_task', array(
           			'taskName' 	=> $this->input->post('Taskname'),
           			'taskDesc'	=> $this->input->post('Taskdesc'),
           			'updatedBY'	=> $this->session->userdata('userlog')['sess_usrID'],
           			'updatedTIME'	=> date('Y-m-d H:i:s')
           		), array('taskID' => $this->input->post('Taskid'))
           	);
			//log edit task
			helper_log('edit','Edit Task ( '.$this->input->post('Taskname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($edit){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}

	}

		public function modalReviewTask()//modal review task
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Review '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row','*','t_task', null, null,null, array('taskID = "'.$ID[0].'"')),
				'Req' => ''
			);
		$this->load->view('pages/workscope/reviewTask', $data);
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function progress($id=null)//list progress workscope/task
	{	
		//ambil data tanggal pada table task
		$getClose = $this->Mod_crud->getData('row', 'startDate,endDate, startDelay, endDelay, closeDate', 't_task', null, null,null, array('taskID = "'.$id.'"'));
		
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
						"dashboards/js/pages/progress-index-script.js",
				)
			),
			'titleWeb' 	=> "Progress Task | CBN Internship",//title web
			'breadcrumb' 	=> explode(',', 'Workscope, Progress Task'),
			'taskID' 	=> $id,//id task
			'getDate'	=> $getClose//data
		);
		$this->render('dashboard', 'pages/workscope/indexprogress', $data);//load view workscope indexprogress
	}

	public function getListProgress($id=null)//list progress
	{
		$res = array();
		//ambil data progress
		$getprogress = $this->Mod_crud->getData('result', '*', 't_task_progress', null, null,null, array('taskID = "'.$id.'"'), null, array('progressID DESC'));

		if (!empty($getprogress)) {//jika tidak kosong
			$no = 0;
			foreach ($getprogress as $key) {//looping get progress
				$no++;
				array_push($res, array(
					$no,
					$key->progress,
					$key->finding,
					date_format(date_create($key->date), 'd F Y'),
					'
					<a class="btn btn-primary" style="margin: 5px" onclick="showModal(`'.base_url("workscope/modalEditProgress").'`, `'.$key->progressID.'~'.$id.'`, `edit`);"><i class="icon-quill4"></i></a>
					'
					)
				);
			}
		}
		echo json_encode($res);
	}

	public function modalAddProgress($id=null)//modal tambah progress
	{
		$data = array(
				'modalTitle' 	=> 'Add Progress ',
				'formAction' 	=> base_url('workscope/saveProgress'),
				'taskID'	=> $id,
				'Req' => ''
			);
		$this->load->view('pages/workscope/formProgress', $data);//load view form progress
	}

	public function saveProgress()//aksi tambah progress
	{
		//ambil task id
		$taskID 	= $this->input->post('Taskid');
		//ambil data task
		$getask = $this->Mod_crud->getData('row','endDate','t_task',null,null,null,array('taskID = "'.$taskID.'"'));
		$endDate = $getask->endDate;//ambil end date
		$date = date('Y-m-d');//tanggal sekarang
		$startDelay = date('Y-m-d', strtotime('+1 day', strtotime($endDate)));//set tanggal delay
		if ($date > $endDate) {//jika tanggal sekarang lebih dari tanggal berakhir
			//update status pd table task
			$edit = $this->Mod_crud->updateData('t_task', array(
					'statusTask'		=> 'delay',
					'startDelay'		=> $startDelay,
					'endDelay'			=> $date,
           			), array('taskID' 	=> $taskID)
           	);
		}

		$save = $this->Mod_crud->insertData('t_task_progress', array(//simpan task id
				'taskID'		=> $taskID,
				'progress'		=> $this->input->post('Progress'),
				'finding'		=> $this->input->post('Finding'),
				'date'			=> $date,
				'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           		'createdTIME'	=> date('Y-m-d H:i:s')
           		)
           	);
		//log tambah progress task
		helper_log('add','Added New Progress Task ('.name_task($taskID).')',$this->session->userdata('userlog')['sess_usrID']);
		if ($save){
			$this->alert->set('bg-success', "Insert success ! ");
   			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
   		}else{
   			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
   		}
	}

	public function modalEditProgress(){//modal edit progress
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Edit Progress',
				'dMaster' => $this->Mod_crud->getData('row', '*', 't_task_progress', null, null, null, array('progressID = "'.$ID[0].'"')),
				'formAction' => base_url('workscope/editProgress'),
				'taskID' => $ID[1],
				'Req' => ''
			);
		$this->load->view('pages/workscope/formProgress', $data);
	}

	public function editProgress()//aksi edit progress
	{
		//simpan perubahan progress
		$update = $this->Mod_crud->updateData('t_task_progress', array(
				'progress'		=> $this->input->post('Progress'),
				'finding'		=> $this->input->post('Finding'),
       			'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
       			'updatedTIME'	=> date('Y-m-d H:i:s')
       			), array('progressID ' => $this->input->post('Progressid'))
       		);
		helper_log('edit','Edit Progress ( '.name_task($this->input->post('Taskid')).' )',$this->session->userdata('userlog')['sess_usrID']);

		if ($update){
			$this->alert->set('bg-success', "Update success !");
   			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
   		}else{
   			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
   		}

	}

		public function logProgress($id=null)//log progress
	{	
		//ambil progress
		$getprogress = $this->Mod_crud->getData('result', '*', 't_task_progress', null, null,null, array('taskID = "'.$id.'"'), null, array('progressID DESC'));
		//ambil task
		$getTask = $this->Mod_crud->getData('row','*','t_task',null,null,null,array('taskID = "'.$id.'"'));
		
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
				)
			),
			'titleWeb' 		=> "Log Progress | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, Log Progress'),
			'taskID' 		=> $id,
			'dtprogress'	=> $getprogress,
			'task'			=> $getTask,
		);
		$this->render('dashboard', 'pages/workscope/logprogress', $data);//load view log progress
	}
	
	public function progressDone($id)//progress done
	{	
		$nameMhs = name_mhs($this->session->userdata('userlog')['sess_usrID']);
		$nameTask = name_task($id);
		//ambil data task
		$getask = $this->Mod_crud->getData('row','endDate, startDelay','t_task',null,null,null,array('taskID = "'.$id.'"'));
		$endDate = $getask->endDate;//ambil end date
		$startDelay = $getask->startDelay;//ambil delay date
		$date = date('Y-m-d');
		if (empty($startDelay)) {//jika delay date kosong
			if ($date > $endDate) {
				$statusTask = 'done';
				$close 		= $date;
			}else{
				$statusTask = 'done';
				$close = $date;
			}
		}else{
			if ($date > $endDate) {//jika date lebih dari end date
				$statusTask = 'done-delay';
				$close = $date;
			}else{
				$statusTask = 'done';
				$close = $date;
			}
		}
		//update task 
		$edit = $this->Mod_crud->updateData('t_task', array(
						'closeDate'		=> $close,
           				'statusTask'	=> $statusTask,
           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('taskID' => $id)
           	);
		//log selesai task
		helper_log('done',$nameMhs.' Menyelesaikan Task ( '.$nameTask.' )',$this->session->userdata('userlog')['sess_usrID']);
		if ($edit){//jika bernilai true
			//set alert
			$this->alert->set('bg-success', "Update success !");
   			redirect('workscope/progress/'.$id);
   		}else{
   			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
   		}
    
	}

}

/* End of file Scope.php */
/* Location: ./application/controllers/Scope.php */
