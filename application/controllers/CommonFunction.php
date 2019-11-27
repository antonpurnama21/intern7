<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH."controllers/CommonDash.php");

class CommonFunction extends CommonDash {

	public function __construct()
	{
		parent::__construct();
	}


		//menampilkan_role
	public function getRole()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'roleID, roleName', 't_role',2);
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->roleID;
				$mk['text'] = $key->roleName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	//menampilkan_department
	public function getDept()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'deptID, deptName', 't_department');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->deptID;
				$mk['text'] = $key->deptName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getUniv()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'universityID, universityName', 't_university',null,null,null,array('mou = "YES"'));
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->universityID;
				$mk['text'] = $key->universityName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getFaculty()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'facultyID, facultyName', 't_faculty');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->facultyID;
				$mk['text'] = $key->facultyName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getResidence()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'residenceID, residenceName', 't_residence');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->residenceID;
				$mk['text'] = $key->residenceName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getCategory()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'categoryID, categoryName', 't_category');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->categoryID;
				$mk['text'] = $key->categoryName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

	public function getProject()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'projectID, deptID, projectName', 't_project');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->projectID;
				$mk['text'] = $key->projectName.' ( '.name_dept($key->deptID).' )';
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}

		public function getAdmin()
	{
		$resp = array();
		$data = $this->Mod_crud->getData('result', 'adminID, fullName', 't_admin');
		if (!empty($data)) {
			foreach ($data as $key) {
				$mk['id'] = $key->adminID;
				$mk['text'] = $key->fullName;
				array_push($resp, $mk);
			}
		}
		echo json_encode($resp);
	}


}

/* End of file faculty.php */
/* Location: ./application/controllers/faculty.php */
