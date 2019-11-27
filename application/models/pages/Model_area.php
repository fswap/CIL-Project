<?php
	class Model_area extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}

		//returns the list of all the cadres
		public function all_area(){

			$select_string='area.area_id,subsidiary.sub_name,area.area_name';
			$area=$this->db->select($select_string)->join('subsidiary','subsidiary.sub_id = area.sub_id')->order_by('subsidiary.sub_name','ASC')->get('area')->result_array();
			return $area;
		}

		public function area_name($area_id){
			return $this->db->where('area_id', $area_id)->join('subsidiary','subsidiary.sub_id = area.sub_id')
							->get('area')
							->result_array()[0];
		}

		public function insert_data($data, $table){
			$this->db->insert($table, $data);
		}

		public function update_area($area_id, $area_name, $sub_id){
			$this->db->where('area_id', $area_id)
					 ->update('area', array('area_name'=> $area_name , 'sub_id' => $sub_id ));
					 //echo $this->db->last_query(); die();
		}


	    public function delete_area($area_id){
		 	$this->db->where('area_id', $area_id)
		 			 ->delete('area');
		 	 $this->db->where('area_id', $area_id)
		 			 ->delete('subarea');
		 			 $this->db->where('area_id', $area_id)
		 			 ->delete('mines');
		 }
	};
?>