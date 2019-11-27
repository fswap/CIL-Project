<?php
	class Model_cadre extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}
		public function create_cadre(){

			$q="CREATE TABLE if not exists `cil`.`cadre` ( `sno` INT(11) NOT NULL AUTO_INCREMENT , `cil_cadre` VARCHAR(255) NOT NULL, PRIMARY KEY (`sno`)) ENGINE = InnoDB;";
	        $this->db->query($q);
		}

		//returns the list of all the cadres
		public function all_cadre(){
			$cad=$this->db->order_by('cil_cadre')
							->get('cadre')
							->result_array();
			return $cad;
		}

		public function cad_name($cad_id){
			return $this->db->where('sno', $cad_id)
							->get('cadre')
							->result_array()[0];
		}

		public function insert_data($data, $table){
			$this->db->insert($table, $data);
		}

		public function update_cad($cad_id, $cad_name){
			$this->db->where('sno', $cad_id)
					 ->update('cadre', array('cil_cadre'=> $cad_name));
		}


		 public function delete_cad($cad_id){
		 	$this->db->where('sno', $cad_id)
		 			 ->delete('cadre');
		 }
	};
?>