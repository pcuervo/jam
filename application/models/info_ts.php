<?php
class Info_ts extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	} // constructor

	/**
	 * Descripción: Regresa información de trámite/servicio
	 * @param integer $id
	 * @return mixed array $res
	 */
	public function getInfoTramite($id){
		$query = $this->db->get_where('v_info_ts', array('id_tramite_servicio' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res = array(
		    	'id_cat_tramite_servicio' 	=> $row->id_cat_tramite_servicio,
		    	'nombre_tramite' 			=> $row->nombre_tramite,
		    	'descripcion' 				=> $row->descripcion_ts,
		    	'id_tramite_servicio' 		=> $row->id_tramite_servicio,
		    	'ente'	 					=> $row->ente,
		    	'ente_padre'	 			=> $row->ente_padre,
		    	'tiempo_respuesta'	 		=> $row->tiempo_respuesta,
		    	'beneficiario'	 			=> $row->beneficiario,
		    	'id_materia'				=> $row->id_cat_materia,
		    	'materia'					=> $row->materia,
		    	'tramite_servicio'    		=> $row->tramite_servicio, 
		    	'is_tramite'				=> $row->is_tramite,
		    	'url_nvl_automatizacion' 	=> $row->url_nvl_automatizacion,
		    	'nvl_automatizacion' 		=> $row->nvl_automatizacion,
		    	'formasolicitud' 			=> $row->formasolicitud,
		    	'tel_presentacion' 			=> $row->tel_presentacion,
		    	'ext_presentacion'	 		=> $row->ext_presentacion,
		    	'observaciones' 			=> $row->observaciones,
		    	'beneficiario'	 			=> $row->beneficiario,	
		    	'negativa_ficta'	 		=> $row->negativa_ficta,	
		    	'afirmativa_ficta'	 		=> $row->afirmativa_ficta,
		    	
		    	);
		}
		return $res;
	} // getInfoTramites

	/**
	 * Descripción: Regresa nombres de trámite y servicios
	 * @param 
	 * @return mixed array $res
	 */
	public function getNombreTS(){
		$query = $this->db->get('v_nombre_ts');
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 		=> $row->id_tramite_servicio,
		    	'nombre_ts' 				=> $row->nombre_tramite,
		    	);
		}
		return $res;
	}// getNombreTS

	/**
	 * Descripción: Regresa información de trámite/servicio mas comunes
	 * @param integer $id_ts
	 * @return mixed array $res
	 */
	public function getNombreTSComunes($id_ts){
		$this->db->where_in('id_tramite_servicio', $id_ts);
		$query = $this->db->get('v_nombre_ts');
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 		=> $row->id_tramite_servicio,
		    	'nombre_ts' 				=> $row->nombre_tramite,
		    	);
		}
		return $res;
	}// getNombreTSComunes

	/**
	 * Descripción: Regresa requisitos de un trámite/servicio
	 * @param integer $id
	 * @return mixed array $res
	 */
	public function getRequisitos($id){
		$this->db->order_by('documento_oficial', 'desc');
		$this->db->order_by('id_requisito_ts');		
		$query = $this->db->get_where('v_requisito_ts', array('id_tramite_servicio' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_requisito_ts'	 		=> $row->id_requisito_ts,
		    	'id_cat_requisito' 			=> $row->id_cat_requisito,
		    	'id_tramite_servicio'	 	=> $row->id_tramite_servicio,
		    	'documento_oficial' 		=> $row->documento_oficial,
		    	'documento_acreditacion' 	=> $row->documento_acreditacion,
		    	'conjuncion'	 			=> $row->conjuncion,
		    	'num_copias'				=> $row->num_copias,
		    	'original_copia'			=> $row->original_copia
		    	);
		}
		return $res;
	}// getRequisitos

	/**
	 * Descripción: Regresa requisitos específicos de un trámite/servicio
	 * @param integer $id
	 * @return mixed array $res
	 */
	public function getRequisitosEsp($id){
		$this->db->order_by('id_requisito_especifico_ts');	
		$query = $this->db->get_where('v_requisito_esp_ts', array('id_tramite_servicio' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_requisito_especifico_ts'	=> $row->id_requisito_especifico_ts,
		    	'requisito_especifico' 			=> $row->requisito_especifico,
		    	'id_tramite_servicio'	 		=> $row->id_tramite_servicio,
		    	);
		}
		return $res;
	}// getRequisitosEsp

	/**
	 * Descripción: Regresa los trámites/servicios que se pueden realizar en línea.
	 * @param 
	 * @return mixed array $res
	 */
	public function getTSEnLinea(){
		$this->db->where("nvl_automatizacion <> '1'");
		$this->db->where('url_nvl_automatizacion IS NOT NULL');
		$this->db->order_by('nombre_tramite');
		$query = $this->db->get('v_info_ts');
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'nombre_tramite' 			=> $row->nombre_tramite,
		    	'id_tramite_servicio' 		=> $row->id_tramite_servicio
		    	);
		}
		return $res;
	}// getTSEnLinea

	/**
	 * Descripción: Busca una palabra dentro de un trámite/servicio y regresa las ocurrencias. 
	 * @param 
	 * @return mixed array $res
	 */
	public function busquedaTS($palabras){

		$palabras_acentos = $this->reemplazarLetrasEspecialesPorAcentos($palabras);
		$palabras_arr = explode(' ', $palabras_acentos);
		//var_dump($palabras_arr);
		$query = $this->db->query('set client_encoding=UTF8');

		$query = "
			SELECT id_tramite_servicio, nombre_tramite 
			FROM v_info_ts 
			WHERE (";

		foreach ($palabras_arr as $key => $palabra) {
			if( $key > 0 ) $query .= " AND ";
			$query .= " LOWER(nombre_tramite) LIKE '%".$palabra."%'";
		}
		$query .= ') OR (';
		foreach ($palabras_arr as $key => $palabra) {
			if( $key > 0 ) $query .= " AND ";
			$query .= " LOWER(descripcion_ts) LIKE '%".$palabra."%'";
		}
		$query .= ') OR (';
		foreach ($palabras_arr as $key => $palabra) {
			if( $key > 0 ) $query .= " OR ";
			$query .= " LOWER(palabra_clave) LIKE '%".$palabra."%'";
		}
		$query .= ')';
		//echo $query;

		$exec_query = $this->db->query( $query );
		$res = array();
		foreach ($exec_query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'nombre_tramite' 			=> $row->nombre_tramite,
		    	'id_tramite_servicio' 		=> $row->id_tramite_servicio
		    	);
		}
		return $res;
	}// busquedaTS

	/**
	 * Descripción: Reemplaza palabras claves (_a_) por (á) 
	 * @param string $str
	 * @return string
	 */
	private function reemplazarLetrasEspecialesPorAcentos($str) {
		$str = trim($str);

		$a = array('_A_','_E_','_I_','_O_','_U_','_a_','_e_','_i_','_o_','_u_');
		$b = array('Á','É','Í','Ó','Ú','á','é','í','ó','ú');
	  	
	  	$str = str_replace($a,$b,$str);
	  	$str = str_replace('~','/',$str);
	  	$str = str_replace('000', '(', $str);
	  	$str = str_replace('_', ')', $str);
	  	return str_replace('---', ' ', $str);
	}// formateaMateria
}