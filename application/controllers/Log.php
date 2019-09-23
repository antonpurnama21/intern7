<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Log extends CommonDash {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_crud');
	}

	public function index()
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
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/Log-index-script.js",
				)
			),
			'titleWeb' => "Log Activities | CBN Internship",
			'breadcrumb' => explode(',', 'Log Activity, Log List'),
		);
		$this->render('dashboard', 'pages/log/index', $data);
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function delete(){
		$query 		= $this->Mod_crud->deleteData('t_log_activity', array('logID' => $this->input->post('id')));
		if ($query){
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

	public function getList()
	{
		$res = array();
		$Log = $this->Mod_crud->getData('result','*', 't_log_activity',null,null,null,null,null,array('logID DESC'));
		if (!empty($Log)) {
			$no = 0;
			foreach ($Log as $key) {
				$no++;
				$waktu = timestep($key->logTime);
				array_push($res, array(
							'',
							$no,
							"<div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Email user :</div>
								<div class='col-md-8 text-semibold text-success'>".email($key->logUsrID)."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Log time :</div>
								<div class='col-md-8'>".$waktu."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Browser access :</div>
								<div class='col-md-8'>".$key->logBrowser."</div>
							 </div>
							 <br/>
							 <div class='row nomargin' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Ip address :</div>
								<div class='col-md-8'>".$key->logIP."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Platform :</div>
								<div class='col-md-8'>".$key->logPlatform."</div>
							 </div>
							 <br/>",
							 ucwords(logtype($key->logTypeID)),
							 $key->logDesc
							)
				);
			}
		}
		echo json_encode($res);
	}

	public function getListByid()
	{
		$res = array();
		$id = $this->session->userdata('userlog')['sess_usrID'];
		$Log = $this->Mod_crud->getData('result','*', 't_log_activity',null,null,null,array('logUsrID = "'.$id.'"'),null,array('logID DESC'));
		if (!empty($Log)) {
			$no = 0;
			foreach ($Log as $key) {
				$no++;
				$waktu = timestep($key->logTime);
                $email1 = email($key->logUsrID);
                if ($email1 == $this->session->userdata('userlog')['sess_email']) {
                    $email = 'you';
                }else{
                    $email = $email1;
                }
				array_push($res, array(
							'',
							$no,
							"<div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Email user :</div>
								<div class='col-md-8 text-semibold text-success'>".$email."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Log time :</div>
								<div class='col-md-8'>".$waktu."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Browser access :</div>
								<div class='col-md-8'>".$key->logBrowser."</div>
							 </div>
							 <br/>
							 <div class='row nomargin' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Ip address :</div>
								<div class='col-md-8'>".$key->logIP."</div>
							 </div>
							 <br/>
							 <div class='row' style='height:5px'>
								<div class='col-md-4 text-right text-bold'>Platform :</div>
								<div class='col-md-8'>".$key->logPlatform."</div>
							 </div>
							 <br/>",
							 ucwords(logtype($key->logTypeID)),
							 $key->logDesc
							)
				);
			}
		}
		echo json_encode($res);
	}

}

/* End of file Log.php */
/* Location: ./application/controllers/Log.php */