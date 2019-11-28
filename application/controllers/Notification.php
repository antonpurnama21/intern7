<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class Notification extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
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
						"dashboards/js/plugins/pickers/pickadate/picker.js",
						"dashboards/js/plugins/pickers/pickadate/picker.date.js",
						"dashboards/js/plugins/forms/validation/validate.min.js",
						"dashboards/js/pages/faculty-index-script.js",
				)
			),
			'titleWeb' => "Faculty | CBN Internship",
			'breadcrumb' => explode(',', 'Data,Faculty'),
			'dMaster' => $this->Mod_crud->getData('result','*', 't_faculty'),
		);
		$this->render('dashboard', 'pages/faculty/index', $data);
	}

	public function get_notif()
	{
		$view = $this->input->post('view');

		if ($view != '') {
			$update = $this->Mod_crud->qry_ori('UPDATE t_notification SET notifStatus = 1 WHERE notifStatus = 0');
		}
		$output = '';
		$get = $this->Mod_crud->getData('result','*','t_notification',10,null,null,null,null,array('notifID DESC'));
		if (!empty($get)) {
			foreach ($get as $key) {
				$output .= '
					<li class="media">
						<div class="media-body">
							<span class="badge badge-success">'.$key->notifType.'</span>
							'.$key->notifTitle.' <a href="'.base_url($key->notifUrl).'">'.$key->notification.'</a>
							<div class="font-size-sm text-muted mt-1">'.timestep($key->create_at).'</div>
						</div>
					</li>';
			}
		}else{
			$output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
		}

		$count = $this->Mod_crud->countData('result','*','t_notification',null,null,null,array('notifStatus = 0'));
		$data = array(
			'notification' => $output,
			'unseen_notification' => $count,
		);

		echo json_encode($data);
	}

}

/* End of file faculty.php */
/* Location: ./application/controllers/faculty.php */