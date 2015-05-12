<?php
class Delegacion extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function getDelegaciones(){
		$this->db->order_by('descripcion');
		$query = $this->db->get('cat_delegacion');

		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_cat_delegacion' => $row->id_cat_delegacion,
		    	'delegacion' 		=> $row->descripcion,
		    	);
		}
		return $res;
	}

}// class Delegacion