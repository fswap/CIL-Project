<?php
	class Model_subarea extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}

		//returns the list of all the cadres
		public function all_subarea(){

			$select_string='subarea.subarea_id,subsidiary.sub_name,area.area_name,subarea.subarea_name';
			$subarea=$this->db->select($select_string)->join('subsidiary','subsidiary.sub_id = subarea.sub_id')->join('area','area.area_id = subarea.area_id')->order_by('subsidiary.sub_name','ASC')->order_by('area.area_name','ASC')->get('subarea')->result_array();
			return $subarea;
		}

		public function subarea_name($subarea_id){
			return $this->db->where('subarea_id', $subarea_id)->join('subsidiary','subsidiary.sub_id = subarea.sub_id')->join('area','area.area_id = subarea.area_id')
							->get('subarea')
							->result_array()[0];
		}

		public function insert_data($data, $table){
			$this->db->insert($table, $data);
		}

		public function update_subarea($sub_id, $area_id, $subarea_id ,$subarea_name){
			$this->db->where('subarea_id', $subarea_id)
					 ->update('subarea', array('subarea_name'=> $subarea_name, 'sub_id' => $sub_id,'area_id' => $area_id));
		}


		 public function delete_subarea($subarea_id){
		 	$this->db->where('subarea_id', $subarea_id)
		 			 ->delete('subarea');
		 	$this->db->where('subarea_id', $subarea_id)
		 			 ->delete('mines');
		 }
	};
?>