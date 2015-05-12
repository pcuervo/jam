<?php
class Area_atencion extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Descripción: Busca areas de atención por trámite/servicio
	 * @param integer $id_tramite_servicio
	 * @return
	 */
	public function getAreaAtencion($id){
		$query = $this->db->get_where('v_areas_atencion', array('id_tramite_servicio' => $id));
		$res = array();

		$horario = array(
			'1'=>'00:00',
			'2'=>'00:30',
			'3'=>'01:00',
			'4'=>'01:30',
			'5'=>'02:00',
			'6'=>'02:30',
			'7'=>'03:00',
			'8'=>'03:30',
			'9'=>'04:00',
			'10'=>'04:30',
			'11'=>'05:00',
			'12'=>'05:30',
			'13'=>'06:00',
			'14'=>'06:30',
			'15'=>'07:00',
			'16'=>'07:30',
			'17'=>'08:00',
			'18'=>'08:30',
			'19'=>'09:00',
			'20'=>'09:30',
			'21'=>'10:00',
			'22'=>'10:30',
			'23'=>'11:00',
			'24'=>'11:30',
			'25'=>'12:00',
			'26'=>'12:30',
			'27'=>'13:00',
			'28'=>'13:30',
			'29'=>'14:00',
			'30'=>'14:30',
			'31'=>'15:00',
			'32'=>'15:30',
			'33'=>'16:00',
			'34'=>'16:30',
			'35'=>'17:00',
			'36'=>'17:30',
			'37'=>'18:00',
			'38'=>'18:30',
			'39'=>'19:00',
			'40'=>'19:30',
			'41'=>'20:00',
			'42'=>'20:30',
			'43'=>'21:00',
			'44'=>'21:30',
			'45'=>'22:00',
			'46'=>'22:30',
			'47'=>'23:00',
			'48'=>'23:30',
		);

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'id_cat_ente' 			=> $row->id_cat_ente,
		    	'nombre' 				=> $row->nombre,
		    	'calle_numero' 			=> $row->calle_numero,
		    	'delegacion' 			=> $row->delegacion,
		    	'colonia' 				=> $row->colonia,
		    	'cp' 					=> $row->cp,
		    	'telefono_1' 			=> $row->telefono_1,
		    	'ext_1' 				=> $row->ext_1,
		    	'telefono_2' 			=> $row->telefono_2,
		    	'ext_2' 				=> $row->ext_2,
		    	'url_ubicacion'			=> $row->url_ubicacion,
		    	'dias'					=> $row->dias,
		    	'hora_inicio'			=> $horario[$row->hora_inicio],
		    	'hora_fin'				=> $horario[$row->hora_fin]	,
		    	);
		}
		return $res;
	}// getAreaAtencion

	/**
	 * Descripción: Busca delegaciones de areas de atención por trámite/servicio
	 * @param integer $id_tramite_servicio
	 * @return
	 */
	public function getDelegacionAreaAtencion($id){
		$this->db->select('delegacion');
		$this->db->group_by('delegacion');
		$query = $this->db->get_where('v_areas_atencion', array('id_tramite_servicio' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'delegacion' 			=> $row->delegacion,
		    	);
		}
		return $res;
	}// getAreaAtencion

	/**
	 * Descripción: Busca areas de atención por trámite/servicio y delegación
	 * @param integer $id_tramite_servicio, string $delegacion
	 * @return
	 */
	public function getAreaAtencionPorTramiteDelegacion($delegacion, $id){

		$area_atencion_data = array(
			'id_tramite_servicio' 	=> $id,
			'delegacion'			=> $delegacion
			);

		$query = $this->db->get_where('v_areas_atencion', $area_atencion_data);
		$res = array();
		$horario = array(
			'1'=>'00:00',
			'2'=>'00:30',
			'3'=>'01:00',
			'4'=>'01:30',
			'5'=>'02:00',
			'6'=>'02:30',
			'7'=>'03:00',
			'8'=>'03:30',
			'9'=>'04:00',
			'10'=>'04:30',
			'11'=>'05:00',
			'12'=>'05:30',
			'13'=>'06:00',
			'14'=>'06:30',
			'15'=>'07:00',
			'16'=>'07:30',
			'17'=>'08:00',
			'18'=>'08:30',
			'19'=>'09:00',
			'20'=>'09:30',
			'21'=>'10:00',
			'22'=>'10:30',
			'23'=>'11:00',
			'24'=>'11:30',
			'25'=>'12:00',
			'26'=>'12:30',
			'27'=>'13:00',
			'28'=>'13:30',
			'29'=>'14:00',
			'30'=>'14:30',
			'31'=>'15:00',
			'32'=>'15:30',
			'33'=>'16:00',
			'34'=>'16:30',
			'35'=>'17:00',
			'36'=>'17:30',
			'37'=>'18:00',
			'38'=>'18:30',
			'39'=>'19:00',
			'40'=>'19:30',
			'41'=>'20:00',
			'42'=>'20:30',
			'43'=>'21:00',
			'44'=>'21:30',
			'45'=>'22:00',
			'46'=>'22:30',
			'47'=>'23:00',
			'48'=>'23:30',
		);

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'id_area_atencion_ts' 	=> $row->id_area_atencion_ts,
		    	'id_cat_ente' 			=> $row->id_cat_ente,
		    	'nombre' 				=> $row->nombre,
		    	'calle_numero' 			=> $row->calle_numero,
		    	'delegacion' 			=> $row->delegacion,
		    	'colonia' 				=> $row->colonia,
		    	'cp' 					=> $row->cp,
		    	'telefono_1' 			=> $row->telefono_1,
		    	'ext_1' 				=> $row->ext_1,
		    	'telefono_2' 			=> $row->telefono_2,
		    	'ext_2' 				=> $row->ext_2,
		    	'url_ubicacion'			=> $row->url_ubicacion,
		    	);
		}
		return $res;
	}// getAreaAtencionPorTramiteDelegacion

	/**
	 * Descripción: Regresa horarios y días de un área de atención
	 * @param integer $id_area_atencion_ts
	 * @return mixed $horarios
	 */
	public function getHorarioAreaAtencion($id_area_atencion_ts){

		$horario_data = array('id_area_atencion_ts' => $id_area_atencion_ts);
		$this->db->where('eliminado', 1);
		$query = $this->db->get_where('horario_atencion', $horario_data);
		$res = array();
		$horario = array(
			'1'=>'00:00',
			'2'=>'00:30',
			'3'=>'01:00',
			'4'=>'01:30',
			'5'=>'02:00',
			'6'=>'02:30',
			'7'=>'03:00',
			'8'=>'03:30',
			'9'=>'04:00',
			'10'=>'04:30',
			'11'=>'05:00',
			'12'=>'05:30',
			'13'=>'06:00',
			'14'=>'06:30',
			'15'=>'07:00',
			'16'=>'07:30',
			'17'=>'08:00',
			'18'=>'08:30',
			'19'=>'09:00',
			'20'=>'09:30',
			'21'=>'10:00',
			'22'=>'10:30',
			'23'=>'11:00',
			'24'=>'11:30',
			'25'=>'12:00',
			'26'=>'12:30',
			'27'=>'13:00',
			'28'=>'13:30',
			'29'=>'14:00',
			'30'=>'14:30',
			'31'=>'15:00',
			'32'=>'15:30',
			'33'=>'16:00',
			'34'=>'16:30',
			'35'=>'17:00',
			'36'=>'17:30',
			'37'=>'18:00',
			'38'=>'18:30',
			'39'=>'19:00',
			'40'=>'19:30',
			'41'=>'20:00',
			'42'=>'20:30',
			'43'=>'21:00',
			'44'=>'21:30',
			'45'=>'22:00',
			'46'=>'22:30',
			'47'=>'23:00',
			'48'=>'23:30',
		);

		foreach ($query->result() as $key=>$row)
		{

			if ( $row->hora_inicio == '' OR $row->hora_fin == '' ) continue;

			$res[$key] = array(
				'id_area_atencion_ts' 	=> $row->id_area_atencion_ts,
				'dias'					=> $row->dias,
				'hora_inicio'			=> $horario[$row->hora_inicio],
				'hora_fin'				=> $horario[$row->hora_fin],
			);
		}
		return $res;
	}// getHorarioAreaAtencion

	/**
	 * Descripción: Busca areas de atención por trámite/servicio y delegación
	 * @param integer $id_tramite_servicio, string $delegacion
	 * @return
	 */
	public function getAreaAtencionPorDelegacion($delegacion){

		$area_atencion_data = array(
			'delegacion'			=> $delegacion
			);

		$this->db->order_by('nombre');
		$query = $this->db->get_where('v_areas_atencion_dir', $area_atencion_data);
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_cat_ente' 			=> $row->id_cat_ente,
		    	'nombre' 				=> $row->nombre,
		    	'calle_numero' 			=> $row->calle_numero,
		    	'delegacion' 			=> $row->delegacion,
		    	'colonia' 				=> $row->colonia,
		    	'cp' 					=> $row->cp,
		    	'telefono_1' 			=> $row->telefono_1,
		    	'ext_1' 				=> $row->ext_1,
		    	'telefono_2' 			=> $row->telefono_2,
		    	'ext_2' 				=> $row->ext_2,
		    	'url_ubicacion'			=> $row->url_ubicacion,
		    	'id_area_atencion_ts'	=> $row->id_area_atencion_ts,
		    	);
		}
		return $res;
	}// getAreaAtencionPorDelegacion

	/**
	 * Descripción: Busca oficinas por institución
	 * @param integer $id_institucion
	 * @return
	 */
	public function getOficinas($id){
		$query = $this->db->get_where('v_areas_atencion', array('id_cat_ente' => $id));
		$res = array();

		foreach ($query->result() as $key=>$row)
		{
		    $res[$key] = array(
		    	'id_tramite_servicio' 	=> $row->id_tramite_servicio,
		    	'id_cat_ente' 			=> $row->id_cat_ente,
		    	'nombre' 				=> $row->nombre,
		    	'calle_numero' 			=> $row->calle_numero,
		    	'delegacion' 			=> $row->delegacion,
		    	'colonia' 				=> $row->colonia,
		    	'cp' 					=> $row->cp,
		    	'telefono_1' 			=> $row->telefono_1,
		    	'ext_1' 				=> $row->ext_1,
		    	'telefono_2' 			=> $row->telefono_2,
		    	'ext_2' 				=> $row->ext_2,
		    	'url_ubicacion'			=> $row->url_ubicacion,
		    	);
		}
		return $res;
	}
}