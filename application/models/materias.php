<?php
class Materias extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getMaterias(){
		$this->db->order_by('materia');
		$query = $this->db->get('v_materias_publicadas');
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_cat_materia' 	=> $row->id_cat_materia,
		    	'materia' 			=> $row->materia,
		    	);
		}
		return $res;
	}
}// class Materias