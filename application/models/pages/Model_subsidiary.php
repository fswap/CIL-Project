<?php
	class Model_subsidiary extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}

		//returns the list of all the cadres
		public function all_subsidiary(){
			$subsidiary=$this->db->order_by('sub_name','ASC')->get('subsidiary')
						   ->result_array();
			return $subsidiary;
		}

		public function subsidiary_name($sub_id){
			return $this->db->where('sub_id', $sub_id)
							->get('subsidiary')
							->result_array()[0];
		}

		public function insert_data($data, $table){
			$this->db->insert($table, $data);
		}

		public function update_subsidiary($sub_id, $sub_name){
			$this->db->where('sub_id', $sub_id)
					 ->update('subsidiary', array('sub_name'=> $sub_name));
		}


		 public function delete_sub($sub_id){
		 	$this->db->where('sub_id', $sub_id)
		 			 ->delete('subsidiary');
		 	$this->db->where('sub_id', $sub_id)
		 			 ->delete('area');
		 	$this->db->where('sub_id', $sub_id)
		 			 ->delete('subarea');
		 	$this->db->where('sub_id', $sub_id)
		 			 ->delete('mines');		 
		 }
	};
?>