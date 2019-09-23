<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_crud extends CI_Model {

	function getData($type = null, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		$command = "SELECT $select FROM $table";
	 	if ($joins != null)
			{	
				foreach($joins as $key => $values)
				{
					$command .= " LEFT JOIN $key ON $values ";
				}
			}
			
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}

		if ($group != null)
			{	
				$command .= ' GROUP BY '.implode(', ',$group);
			}

		if ($order != null)
			{	
				$command .= ' ORDER BY '.implode(', ',$order);
			}
		if ($limit != null)
			{
				if ($offset != null)
					{
						$command .= " LIMIT $offset, $limit";
					}else{
						$command .= " LIMIT $limit";
					}	
			}
		$data = $this->db->query($command);
		if ($data->num_rows() > 0)
		{
			return  ($type == 'result') ? $data->result() : $data->row();
		}else{
			return false;
		}
	}

	function qry($type = null, $command)
	{
		$data = $this->db->query($command);
		if ($type != null)
		{
			if ($type == 'bool') {
				return $data;
			}else{
				return ($type == 'result') ? $data->result() : $data->row();
			}
		}else{
			if ($data->num_rows() > 0)
			{
				return true;
			}else{
				return false;
			}
		}
	}

	function checkData($row, $table, $where)
	{
		$command = "SELECT $row FROM $table";
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}
		//return $command;
		$data = $this->db->query($command);
		if ($data->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}

	}

	function insertData($table,$data)
	{
		$data = $this->db->insert($table,$data);
		return $data;
	}

	function insertBatch($table, $data)
	{
		return $this->db->insert_batch($table, $data);
	}

	function updateData($table,$data,$where)
	{
		foreach ($where as $key => $values) {
			$this->db->where($key, $values);
		}
		$data = $this->db->update($table,$data);
		return $data;
	}

	function deleteData($table,$where)
	{
		foreach ($where as $key => $values) {
			$this->db->where($key, $values);
		}
		$data = $this->db->delete($table);
		return $data;
	}

	function delete_all($table)
	{
		$delete = $this->db->truncate($table);
		if ($delete) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function autoNumber($field, $table, $format, $digit)
	{
		$qry = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS KodeAkhir FROM $table WHERE $field LIKE '$format%'");
		if ($qry->num_rows() > 0){
			$nextCode = $qry->row('KodeAkhir') + 1;
		}else{
			$nextcode = 1;
		}
		$kode = $format.sprintf("%0".$digit."s", $nextCode);
		return $kode;
	}

	function countData($type = null, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		$command = "SELECT $select FROM $table";
	 	if ($joins != null)
			{	
				foreach($joins as $key => $values)
				{
					$command .= " LEFT JOIN $key ON $values ";
				}
			}
			
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}

		if ($group != null)
			{	
				$command .= ' GROUP BY '.implode(', ',$group);
			}

		if ($order != null)
			{	
				$command .= ' ORDER BY '.implode(', ',$order);
			}
		if ($limit != null)
			{
				if ($offset != null)
					{
						$command .= " LIMIT $offset, $limit";
					}else{
						$command .= " LIMIT $limit";
					}	
			}
		$data = $this->db->query($command);
		return $data->num_rows();
	}
	

}

/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_crud.php */