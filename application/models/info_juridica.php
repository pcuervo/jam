<?php
class Info_juridica extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getInfoJuridica($id){
		$this->db->select('*');
		$this->db->from('cat_ley');
		$this->db->join('ley_ts', 'cat_ley.id_cat_ley  = ley_ts.id_cat_ley ');
		$this->db->where('eliminado', 1);
		$this->db->where('id_tramite_servicio', $id);
		$this->db->order_by('cat_ley');

		$query = $this->db->get();
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'articulos'		 		=> $row->articulos,
			    'descripcion' 			=> $row->descripcion,
		    	);
		}
		return $res;
	}
}// class Info_juridica