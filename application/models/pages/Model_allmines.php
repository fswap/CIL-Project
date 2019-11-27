<?php
	class Model_allmines extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}

		//returns the list of all the cadres
		public function all_allmines(){

			$select_string='mines.mine_id,subsidiary.sub_name,area.area_name,subarea.subarea_name,mines.mine_name,minetype.minecategory,year.year_name,mines.SR,mines.coal,mines.OBR,mines.tot_excavation,mines.production,mines.tot_production';
			$allmines=$this->db->select($select_string)->join('subsidiary','subsidiary.sub_id = mines.sub_id')->join('area','area.area_id = mines.area_id')->join('subarea','subarea.subarea_id = mines.subarea_id')->join('minetype','minetype.mine_id=mines.mine_type')->join('year','year.year_id=mines.year_id')->order_by('subsidiary.sub_id','ASC')->order_by('area.area_name','ASC')->order_by('subarea.subarea_name','ASC')->get('mines')->result_array();
			return $allmines;
		}

		public function mine_name($mine_id){
			return $this->db->where('mine_id', $mine_id)
							->get('mines')
							->result_array()[0];
		}

		public function insert_data($data, $table){
			$this->db->insert($table, $data);
		}

		public function update_subsidiary($sub_id, $sub_name){
			$this->db->where('sub_id', $sub_id)
					 ->update('subsidiary', array('sub_name'=> $sub_name));
		}


		 public function delete_allmine($mine_id){
		 	$this->db->where('mine_id', $mine_id)
		 			 ->delete('mines');
		 }
	};
?>