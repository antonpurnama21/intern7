<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//contoller utama untuk menggantikan ci_controller
class CommonDash extends CI_Controller {

	public $data = array();
	public $sess = null;

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userlog')['is_login'] == FALSE) : //jika session islogin = false
			redirect(base_url('auth/login')) ; //di alihkan ke controler auth/login
		endif;
		$this->load->model('Mod_crud');//panggil model mod_crud

		$this->sess = $this->session->userdata('userlog');//set session ke dalam $this->sess
		
	}

	public function render($template, $view, $dt)//untuk melakukan pemanggilan view
	{
		$data = array_merge($dt, array(
				'sesi' => $this->sess //set this->sess = 'sesi' untuk pemanggilan di view
				)
		);
		
		$this->template->load($template, $view, $data);//load view yang di panggil
	}
}

/* End of file CommonDash.php */
/* Location: ./application/controllers/CommonDash.php */