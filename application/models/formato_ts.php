<?php
class Formato_ts extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getFormato($id){
		$this->db->where('eliminado', '1');
		$this->db->where('id_tramite_servicio', $id);
		$query = $this->db->get('formato_ts');
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_formato' 			=> $row->id_formato,
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'nombre' 				=> $row->nombre,
		    	'url' 					=> $row->url,
		    	);
		}
		return $res;
	}
}