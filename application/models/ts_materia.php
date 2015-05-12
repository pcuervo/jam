<?php
class Ts_materia extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getTemaTS($id){
		$query = $this->db->get_where('v_ts_materia', array('id_cat_materia' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'id_cat_materia' 		=> $row->id_cat_materia,
		    	'tramite_servicio' 		=> $row->tramite_servicio,
		    	'materia' 				=> $row->materia,
		    	);
		}
		return $res;
	}
}// class Materias