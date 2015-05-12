<?php
class Documento extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getDocumentoBeneficio($id){
		$query = $this->db->get_where('v_documento_ts', array('id_tramite_servicio' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_cat_documento' 		=> $row->id_cat_documento,
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'descripcion' 			=> $row->descripcion,
		    	'vigencia' 				=> $row->vigencia,
		    	);
		}
		return $res;
	}
}