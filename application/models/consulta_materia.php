<?php
class Consulta_materia extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getTramiteServicioMateria($id){
		$query = $this->db->get_where('v_consulta_materia', array('id_cat_materia' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_cat_materia'	 		=> $row->id_cat_materia,
		    	'materia'					=> $row->materia,
		    	'id_cat_tramite_servicio' 	=> $row->id_cat_tramite_servicio,
		    	'cat_ts' 					=> $row->cat_ts,
		    	'id_tramite_servicio' 		=> $row->id_tramite_servicio,
		    	'descripcion' 				=> $row->descripcion,
		    	'dias'						=> $row->dias,	
		    	);
		}
		return $res;
	}

	
}