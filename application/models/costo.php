<?php
class Costo extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getCosto($id){
		$this->db->where('eliminado', 1);
		$query = $this->db->get_where('concepto_costo_ts', array('id_tramite_servicio' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'concepto' 				=> $row->concepto,
		    	'monto' 				=> $row->monto,
		    	);
		}
		return $res;
	}
}