<?php
class Area_pago extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getAreaPago($id){
		$this->db->select('*');
		$this->db->from('cat_area_pago');
		$this->db->join('area_pago_ts', 'area_pago_ts.id_cat_area_pago = cat_area_pago.id_cat_area_pago');
		$this->db->where('eliminado', 1);
		$this->db->where('id_tramite_servicio', $id);


		$query = $this->db->get();
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'id_cat_area_pago ' 	=> $row->id_cat_area_pago,
		    	'descripcion' 			=> $row->descripcion,
		    	);
		}
		return $res;
	}
}// class Area_pago