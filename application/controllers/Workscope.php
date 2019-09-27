<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Workscope extends CommonDash {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_crud');
	}

	public function index()
	{
		if ($this->session->userdata('userlog')['sess_role']==11) {
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), null, null, array('workscopeID ASC'));
		
		}elseif ($this->session->userdata('userlog')['sess_role']==22) {
			$deptID = $this->session->userdata('userlog')['sess_deptID'];
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('ps.deptID = "'.$deptID.'"'), null, array('w.workscopeID ASC'));
		
		}elseif ($this->session->userdata('userlog')['sess_role']==33) {
			$univID = $this->session->userdata('userlog')['sess_univID'];
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*,m.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID','t_mahasiswa m'=>'w.mahasiswaID = m.mahasiswaID'), array('m.universityID = "'.$univID.'"'), null, array('w.workscopeID ASC'));
		
		}elseif ($this->session->userdata('userlog')['sess_role']==44) {
			$univID = $this->session->userdata('userlog')['sess_univID'];
			$facID = $this->session->userdata('userlog')['sess_facID'];
			$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*,m.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID','t_mahasiswa m'=>'w.mahasiswaID = m.mahasiswaID'), array('m.universityID = "'.$univID.'"','m.facultyID = "'.$facID.'"'), null, array('w.workscopeID ASC'));
		
		}
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
			'titleWeb' 	=> "Workscope | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, Workscope List'),
			'dtworkscope'	=> $getworkscope
		);
		$this->render('dashboard', 'pages/workscope/index', $data);
	}

// DETAIL
	public function detail($id=null)
	{	
		$detail = $this->Mod_crud->getData('row', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('w.workscopeID = "'.$id.'"'), null, array('workscopeID ASC'));
		
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
		$this->render('dashboard', 'pages/workscope/detil', $data);
	}

		public function getTimeline()
	{
		$id = $this->session->userdata('userlog')['sess_usrID'];
		$wsID = $this->Mod_crud->getData('row','workscopeID','t_workscope',null,null,null,array('mahasiswaID = "'.$id.'"'));
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'taskID, taskDesc, taskName, startDate, endDate, statusTask', 't_task', null,null,null,array('workscopeID = "'.$wsID->workscopeID.'"'));
		if (!empty($data)) {
			foreach ($data as $key) {
				$base = base_url('workscope/progress/'.$key->taskID);
					
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
			}
		}
		echo json_encode($resp);
	}

		public function TimelineByid($id=null)
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'taskID, taskDesc, taskName, startDate, endDate, statusTask', 't_task', null,null,null,array('workscopeID = "'.$id.'"'));
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
			}
		}
		echo json_encode($resp);
	}

	public function myworkscope()
	{	

		$id = $this->session->userdata('userlog')['sess_usrID'];
		$mywork = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('w.mahasiswaID = "'.$id.'"'), null, array('workscopeID ASC'));
		
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
			'titleWeb' 	=> "My Workscope | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, My Workscope'),
			'dtworkscope'	=> $mywork
		);
		$this->render('dashboard', 'pages/workscope/mywork', $data);
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function manageTask($id=null)
	{	
		$getask = $this->Mod_crud->getData('result', 't.*,w.*', 't_task t', null, null,array('t_workscope w'=>'t.workscopeID = w.workscopeID'), array('t.workscopeID = "'.$id.'"'), null, array('t.taskID ASC'));
		
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
		$this->render('dashboard', 'pages/workscope/indextask', $data);
	}

		public function addTask($id=null)
	{
		$data = array(
			'_JS' => generate_js(array(
					"dashboards/js/plugins/ui/moment/moment.min.js",
					"dashboards/js/plugins/tables/datatables/datatables.min.js",
					"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
		    'titleWeb' => "Add Task Timeline | CBN Internship",
		    //'tabTitle' => explode(',', 'Pengaduan,Input Permohonan Perkara'),
		    'breadcrumb' => explode(',', 'Workscope,Add Task Timeline'),
		    'actionForm' => base_url('workscope/saveTask'),
		    'buttonForm' => 'Simpan',
		    'workscopeID' => $id,
		    'Req'	=> ''
		);

		$this->render('dashboard', 'pages/workscope/addTask', $data);
	}

		public function saveTask()
	{
			$wsid		 = $this->input->post('Wsid');
			$workscopeID = $this->input->post('Workscopeid');
			$taskName	 = $this->input->post('Taskname');
			$taskDesc 	 = $this->input->post('Taskdesc');
			$startDate	 = $this->input->post('Startdate');
			$endDate 	 = $this->input->post('Enddate');

			$data = array();

			$index = 0;
			foreach ($taskName as $key) {
				array_push($data, array(
						'workscopeID'	=> $workscopeID[$index],
						'taskName' 	=> $taskName[$index],
						'taskDesc' 	=> $taskDesc[$index],
						'startDate'	=> $startDate[$index],
						'endDate' 	=> $endDate[$index],
						'statusTask'	=> 'pending',
						'createdBY'	=> $this->session->userdata('userlog')['sess_usrID'],
						'createdTIME'	=> date('Y-m-d h:i:s')
					));
				helper_log('add','Add New Task ( '.$taskName[$index].' )',$this->session->userdata('userlog')['sess_usrID']);
				$index++;			
			}
			$insertBatch = $this->Mod_crud->insertBatch('t_task',$data);

			if ($insertBatch){
				$this->alert->set('bg-success', "Insert success !");
       			echo json_encode(array('code' => 200, 'message' => 'Insert success !', 'aksi' => "window.location.href='".base_url('workscope/manageTask/').$wsid."';"));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}
	}

	public function modalEditTask()
	{
		$ID = explode('~',$this->input->post('id'));
		$data = array(
				'modalTitle' => 'Edit Task '.$ID[1],
				'dMaster' => $this->Mod_crud->getData('row','*','t_task', null, null,null, array('taskID = "'.$ID[0].'"')),
				'formAction' => base_url('workscope/editTask'),
				'Req' => ''
			);
		$this->load->view('pages/workscope/modalTask', $data);
	}

		public function editTask()
	{
			$edit = $this->Mod_crud->updateData('t_task', array(
           			'taskName' 	=> $this->input->post('Taskname'),
           			'taskDesc'	=> $this->input->post('Taskdesc'),
           			'updatedBY'	=> $this->session->userdata('userlog')['sess_usrID'],
           			'updatedTIME'	=> date('Y-m-d H:i:s')
           		), array('taskID' => $this->input->post('Taskid'))
           	);

			helper_log('edit','Edit Task ( '.$this->input->post('Taskname').' )',$this->session->userdata('userlog')['sess_usrID']);

			if ($edit){
				$this->alert->set('bg-success', "Update success !");
       			echo json_encode(array('code' => 200, 'message' => 'Update success !'));
       		}else{
       			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
       		}

	}

		public function modalReviewTask()
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
		public function progress($id=null)
	{	
		$getClose = $this->Mod_crud->getData('row', 'endDate,closeDate', 't_task', null, null,null, array('taskID = "'.$id.'"'));
		
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
			'titleWeb' 	=> "Progress Task | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, Progress Task'),
			'taskID' 	=> $id,
			'getClose'	=> $getClose
		);
		$this->render('dashboard', 'pages/workscope/indexprogress', $data);
	}

	public function getListProgress($id=null)
	{
		$res = array();
		$getprogress = $this->Mod_crud->getData('result', '*', 't_task_progress', null, null,null, array('taskID = "'.$id.'"'), null, array('progressID DESC'));

		if (!empty($getprogress)) {
			$no = 0;
			foreach ($getprogress as $key) {
				$no++;
				array_push($res, array(
					'',
					$no,
					$key->progress,
					$key->finding,
					date_format(date_create($key->date), 'd F Y'),
					'
					<a style="margin-bottom: 5px" class="btn btn-primary" onclick="showModal(`'.base_url("workscope/modalEditProgress").'`, `'.$key->progressID.'~'.$id.'`, `edit`);"><i class="icon-quill4"></i> Edit</a>
					'
					)
				);
			}
		}
		echo json_encode($res);
	}

	public function modalAddProgress($id=null)
	{
		$data = array(
				'modalTitle' 	=> 'Add Progress ',
				'formAction' 	=> base_url('workscope/saveProgress'),
				'taskID'	=> $id,
				'Req' => ''
			);
		$this->load->view('pages/workscope/formProgress', $data);
	}

	public function saveProgress()
	{

		$taskID 	= $this->input->post('Taskid');
	
		$getask = $this->Mod_crud->getData('row','endDate','t_task',null,null,null,array('taskID = "'.$taskID.'"'));
		$endDate = $getask->endDate;
		$date = date('Y-m-d');
		if ($date > $endDate) {
			$edit = $this->Mod_crud->updateData('t_task', array(
					'statusTask'	=> 'delay'
           			), array('taskID' 	=> $taskID)
           	);
		}

		$save = $this->Mod_crud->insertData('t_task_progress', array(
				'taskID'		=> $taskID,
				'progress'		=> $this->input->post('Progress'),
				'finding'		=> $this->input->post('Finding'),
				'date'			=> $date,
				'createdBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           			'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
		helper_log('add','Added New Progress Task ('.name_task($taskID).')',$this->session->userdata('userlog')['sess_usrID']);
		if ($save){
			$this->alert->set('bg-success', "Insert success ! ");
   			echo json_encode(array('code' => 200, 'message' => 'Insert success !'));
   		}else{
   			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
   		}
	}

	public function modalEditProgress(){
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

	public function editProgress()
	{

		$update = $this->Mod_crud->updateData('t_task_progress', array(
				'progress'	=> $this->input->post('Progress'),
				'finding'	=> $this->input->post('Finding'),
       				'updatedBY'	=> $this->session->userdata('userlog')['sess_usrID'],
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

		public function logProgress($id=null)
	{	
		$getprogress = $this->Mod_crud->getData('result', '*', 't_task_progress', null, null,null, array('taskID = "'.$id.'"'), null, array('progressID DESC'));
		
		$data = array(
			'_JS' => generate_js(array(
						"dashboards/js/plugins/ui/moment/moment.min.js",
						"dashboards/js/plugins/tables/datatables/datatables.min.js",
						"dashboards/js/plugins/tables/datatables/extensions/responsive.min.js",
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
			'titleWeb' 	=> "Log Progress | CBN Internship",
			'breadcrumb' 	=> explode(',', 'Workscope, Log Progress'),
			'taskID' 	=> $id,
			'dtprogress'	=> $getprogress
		);
		$this->render('dashboard', 'pages/workscope/logprogress', $data);
	}
	
		public function progressDone($id)
	{	
		$nameMhs = name_mhs($this->session->userdata('userlog')['sess_usrID']);
		$nameTask = name_task($id);

		$getask = $this->Mod_crud->getData('row','endDate','t_task',null,null,null,array('taskID = "'.$id.'"'));
		$endDate = $getask->endDate;
		$date = date('Y-m-d');
		if ($date > $endDate) {
			$statusTask = 'done-delay';
			$close = $date;
		}else{
			$statusTask = 'done';
			$close = $date;
		}

		$edit = $this->Mod_crud->updateData('t_task', array(
					'closeDate'		=> $close,
           				'statusTask'		=> $statusTask,
           				'updatedBY'		=> $this->session->userdata('userlog')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('taskID' => $id)
           	);

		helper_log('done',$nameMhs.' Menyelesaikan Task ( '.$nameTask.' )',$this->session->userdata('userlog')['sess_usrID']);
		if ($edit){
			$this->alert->set('bg-success', "Update success !");
   			redirect('workscope/progressDone/'.$id);
   		}else{
   			echo json_encode(array('code' => 500, 'message' => 'An error occurred while saving data !'));
   		}
    
	}

}

/* End of file Scope.php */
/* Location: ./application/controllers/Scope.php */
