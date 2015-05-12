<?php
class Ts_ente extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getEnteTS($id){
		$query = $this->db->get_where('v_ts_ente', array('id_cat_ente_norma' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'tramite_servicio' 		=> $row->tramite_servicio,
		    	'id_cat_ente_norma' 	=> $row->id_cat_ente_norma,
		    	'institucion' 			=> $row->ente,
		    	);
		}
		return $res;
	}

	public function getEnte($id){
		$query = $this->db->get_where('cat_ente', array('id_cat_ente' => $id));
		$res = array();

		foreach ($query->result() as $row)
		{
		    $res = array(
		    	'id_cat_ente' => $row->id_cat_ente,
		    	'institucion' => $row->descripcion,
		    	);
		}
		return $res;
	}
}// class Materias