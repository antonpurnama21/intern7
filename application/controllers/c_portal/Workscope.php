<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/Container.php");

class Workscope extends Container {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if ($this->session->userdata('login')['sess_role']==22) {
		$deptID = $this->session->userdata('login')['sess_deptID'];
		$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('ps.deptID = "'.$deptID.'"'), null, array('w.workscopeID ASC'));

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
				'webTitle' 			=> 'Workscope',
				'pageTitle' 		=> explode(',', 'Workscope'),
				'breadcrumb' 		=> explode(',', 'Dashboard, Workscope'),
				'dtworkscope'		=> $getworkscope
			);
		$this->render('dashboard' , 'pages/workscope/index',$data);

		}elseif($this->session->userdata('login')['sess_role']==11){

		$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), null, null, array('workscopeID ASC'));

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
				'webTitle' 			=> 'Workscope',
				'pageTitle' 		=> explode(',', 'Workscope'),
				'breadcrumb' 		=> explode(',', 'Dashboard, Workscope'),
				'dtworkscope'		=> $getworkscope
			);
		$this->render('dashboard' , 'pages/workscope/index',$data);

		}elseif($this->session->userdata('login')['sess_role']==33){
		$univID = $this->session->userdata('login')['sess_univID'];
		$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*,m.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID','t_mahasiswa m'=>'w.mahasiswaID = m.mahasiswaID'), array('m.universityID = "'.$univID.'"'), null, array('w.workscopeID ASC'));

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
				'webTitle' 			=> 'Workscope',
				'pageTitle' 		=> explode(',', 'Workscope'),
				'breadcrumb' 		=> explode(',', 'Dashboard, Workscope'),
				'dtworkscope'		=> $getworkscope
			);
		$this->render('dashboard' , 'pages/workscope/index',$data);

		}elseif($this->session->userdata('login')['sess_role']==44){
		$univID = $this->session->userdata('login')['sess_univID'];
		$facID = $this->session->userdata('login')['sess_facID'];
		$getworkscope = $this->Mod_crud->getData('result', 'w.*,ps.*,m.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID','t_mahasiswa m'=>'w.mahasiswaID = m.mahasiswaID'), array('m.universityID = "'.$univID.'"','m.facultyID = "'.$facID.'"'), null, array('w.workscopeID ASC'));

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
				'webTitle' 			=> 'Workscope',
				'pageTitle' 		=> explode(',', 'Workscope'),
				'breadcrumb' 		=> explode(',', 'Dashboard, Workscope'),
				'dtworkscope'		=> $getworkscope
			);
		$this->render('dashboard' , 'pages/workscope/index',$data);
		}
	}

		public function progress($id=null)
	{
		$getprogress = $this->Mod_crud->getData('result', '*', 't_task_progress', null, null,null, array('taskID = "'.$id.'"'), null, array('progressID DESC'));

		$getClose = $this->Mod_crud->getData('row', 'endDate,closeDate', 't_task', null, null,null, array('taskID = "'.$id.'"'));
		
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
				'webTitle' 			=> 'Progress Table',
				'pageTitle' 		=> explode(',', 'Progress'),
				'breadcrumb' 		=> explode(',', 'Dashboard, Workscope, Progress table'),
				'dtprogress'		=> $getprogress,
				'taskID'			=> $id,
				'getClose'			=> $getClose
			);
		$this->render('dashboard' , 'pages/workscope/tableprogress',$data);
	}

	public function task($id=null)
	{
		$getask = $this->Mod_crud->getData('result', 't.*,w.*', 't_task t', null, null,array('t_workscope w'=>'t.workscopeID = w.workscopeID'), array('t.workscopeID = "'.$id.'"'), null, array('t.taskID ASC'));

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
				'webTitle' 			=> 'Manage Task',
				'pageTitle' 		=> explode(',', 'Manage Task'),
				'breadcrumb' 		=> explode(',', 'Dashboard, Workscope, Manage task'),
				'dtask'				=> $getask,
				'workscopeID'		=> $id
			);
		$this->render('dashboard' , 'pages/workscope/tabletask',$data);
	}

	public function addtask($workscopeID=null)
	{

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
				'webTitle' 		=> 'Add Task',
				'pageTitle' 	=> explode(',', 'Add Task'),
				'breadcrumb' 	=> explode(',', 'Dashboard, workscope, Add Task'),
				'workscopeID' 	=> $workscopeID
			);
		$this->render('dashboard' , 'pages/workscope/addtask',$data);
	}

		function detail()
	{
				if ($this->session->userdata('login')['sess_role']==55) {
					$id = $this->session->userdata('login')['sess_usrID'];
					$detail = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('w.mahasiswaID = "'.$id.'"'), null, array('workscopeID ASC'));
					if ($detail) {
						foreach ($detail as $key) {
							$workscopeID = $key->workscopeID;
						}
					}else{
						$workscopeID = '';
					}
					$getask = $this->Mod_crud->getData('result','*','t_task',null,null,null,array('workscopeID = "'.$workscopeID.'"'),null,array('startDate ASC'));

					if (! $detail){
						redirect(base_url(),'refresh');
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
							'webTitle' 		=> "Workscope",
							'pageTitle' 	=> explode(',', 'Workscope, Detail'),
							'breadcrumb' 	=> explode(',', 'Dashboard, Workscope, detail '),
							'dtworkscope'	=> $detail,
							'dtask' 		=> $getask
						);
					$this->render('dashboard' , 'pages/workscope/detail',$data);

				}else{
					$id = $this->uri->segment(3);
					$detail = $this->Mod_crud->getData('result', 'w.*,ps.*', 't_workscope w', null, null,array('t_project_scope ps'=>'w.projectScopeID = ps.projectScopeID'), array('w.workscopeID = "'.$id.'"'), null, array('workscopeID ASC'));

					$getask = $this->Mod_crud->getData('result','*','t_task',null,null,null,array('workscopeID = "'.$id.'"'),array('startDate'));

					if (! $detail){
						redirect(base_url('workscope/index'),'refresh');
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
							'pageTitle' 	=> explode(',', 'Workscope, Detail'),
							'breadcrumb' 	=> explode(',', 'Dashboard, Workscope, detail '),
							'dtworkscope'	=> $detail,
							'dtask' 		=> $getask
						);
					$this->render('dashboard' , 'pages/workscope/detail',$data);
			}		
		}

		function erorr(){
			echo "Anda belum mempunyai projek yang sedang di kerjakan";
		}

//===============================================================
		public function saveprogress()
	{
		$taskID 	= $this->input->post('taskID');
		
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
				'taskID'			=> $taskID,
				'progress'			=> $this->input->post('progress'),
				'finding'			=> $this->input->post('finding'),
				'date'				=> $date,
				'createdBY'			=> $this->session->userdata('login')['sess_usrID'],
           		'createdTIME'		=> date('Y-m-d H:i:s')
           		)
           	);
		    helper_log('add','Added new project progress',$this->session->userdata('login')['sess_usrID']);
           	if ($save){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Progress added !</p>
		            </div>');
           		redirect('workscope/progress/'.$taskID);
           	}else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('workscope/progress/'.$taskID);
           	}    
	}

	public function editprogress()
	{
		$id = $this->input->post('progressID');
		$taskID = $this->input->post('taskID');
		
		$edit = $this->Mod_crud->updateData('t_task_progress', array(
           				'progress'		=> $this->input->post('progress'),
						'finding'		=> $this->input->post('finding'),
           				'updatedBY'		=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'	=> date('Y-m-d H:i:s')
           			), array('progressID' => $id)
           	);
		helper_log('edit','Edited project progress',$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success">
		                <h4>Success</h4>
		                <p>Progress updated !</p>
		            </div>');
           		redirect('workscope/progress/'.$taskID);
        }else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger">
		                <h4>Error</h4>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('workscope/progress/'.$taskID);
        }
    
	}
//===============================================================
	function savetask()
		{	
			$wsid		 = $this->input->post('wsid');
			$workscopeID = $this->input->post('workscopeID');
			$taskName	 = $this->input->post('taskName');
			$taskDesc 	 = $this->input->post('taskDesc');
			$startDate	 = $this->input->post('startDate');
			$endDate 	 = $this->input->post('endDate');

			$data = array();

			$index = 0;
			foreach ($taskName as $key) {
				array_push($data, array(
						'workscopeID'	=> $workscopeID[$index],
						'taskName' 		=> $taskName[$index],
						'taskDesc' 		=> $taskDesc[$index],
						'startDate'		=> $startDate[$index],
						'endDate' 		=> $endDate[$index],
						'statusTask'	=> 'pending',
						'createdBY'		=> $this->session->userdata('login')['sess_usrID'],
						'createdTIME'	=> date('Y-m-d h:i:s')
					));
				$index++;			
			}
			$insertBatch = $this->Mod_crud->insertBatch('t_task',$data);
			helper_log('add','Added new project task, '.$taskName,$this->session->userdata('login')['sess_usrID']);
	           	if ($insertBatch){
	           		$this->session->set_flashdata('msg', 
			            '<div class="alert alert-success">
			                <h4>Success</h4>
			                <p>Task Has been Added !</p>
			            </div>');
	           		redirect('workscope/task/'.$wsid);
	           	}else{
	           		$this->session->set_flashdata('msg', 
			            '<div class="alert alert-danger">
			                <h4>Error</h4>
			                <p>an error occurred while saving data !</p>
			            </div>');
	           		redirect('workscope/task/'.$wsid);
	           	}
		}

	public function editask()
	{
		$id = $this->input->post('taskID');
		$workscopeID = $this->input->post('workscopeID');

		$edit = $this->Mod_crud->updateData('t_task', array(
           				'taskName'			=> $this->input->post('taskName'),
           				'taskDesc'			=> $this->input->post('taskDesc'),
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('taskID' => $id)
           	);
		helper_log('edit','Edited task project',$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success fade show">
		             <span class="close" data-dismiss="alert">×</span>
		                <strong>Success</strong>
		                <p>Task updated !</p>
		            </div>');
           		redirect('workscope/task/'.$workscopeID);
        }else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger fade show">
		             <span class="close" data-dismiss="alert">×</span>
		                <strong>Error</strong>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('workscope/task/'.$workscopeID);
        }
    
	}

	public function btndone($id)
	{	
		$nameMhs = name_mhs($this->session->userdata('login')['sess_usrID']);
		$nameTask = name_task($id);

		$getask = $this->Mod_crud->getData('row','endDate','t_task',null,null,null,array('taskID = "'.$taskID.'"'));
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
						'closeDate'			=> $close,
           				'statusTask'		=> $statusTask,
           				'updatedBY'			=> $this->session->userdata('login')['sess_usrID'],
           				'updatedTIME'		=> date('Y-m-d H:i:s')
           			), array('taskID' => $id)
           	);

		helper_log('done',$nameMhs.' menyelesaikan task '.$nameTask,$this->session->userdata('login')['sess_usrID']);
		if ($edit){
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-success fade show">
		             <span class="close" data-dismiss="alert">×</span>
		                <strong>Success</strong>
		                <p>Task Done !</p>
		            </div>');
           		redirect('workscope/progress/'.$id);
        }else{
           		$this->session->set_flashdata('msg', 
		            '<div class="alert alert-danger fade show">
		             <span class="close" data-dismiss="alert">×</span>
		                <strong>Error</strong>
		                <p>an error occurred while saving data !</p>
		            </div>');
           		redirect('workscope/progress/'.$id);
        }
    
	}





	function delete(){
		$id = $this->input->post('id');
		$taskID = $this->input->post('taskID');
		$delete = $this->Mod_crud->deleteData('t_task_progress',array('progressID'=>$id));
		helper_log('delete','Deleted Project Progress',$this->session->userdata('login')['sess_usrID']);
		redirect('workscope/progress/'.$taskID);
	}

	function deletetask(){
		$id = $this->input->post('id');
		$workscopeID = $this->input->post('workscopeID');
		$delete = $this->Mod_crud->deleteData('t_task',array('taskID'=>$id));
		helper_log('delete','Deleted Project Task',$this->session->userdata('login')['sess_usrID']);
		redirect('workscope/task/'.$workscopeID);
	}

}

/* End of file scope.php */
/* Location: ./application/controllers/scope.php */