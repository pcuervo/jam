<?php
class Procedimiento extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getProcedimiento($id){
		$this->db->where('eliminado', 1);
		$this->db->where('id_tramite_servicio', $id);
		$this->db->order_by('paso');
		$query = $this->db->get('procedimiento_ts');
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'paso' 					=> $row->paso,
		    	'accion' 				=> $row->accion,
		    	'actor' 				=> $row->id_actor
		    	);
		}
		return $res;
	}
}