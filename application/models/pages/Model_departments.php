<?php
	class Model_departments extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}
		public function create_department(){

			$q="CREATE TABLE if not exists `cil`.`department` ( `sno` INT(11) NOT NULL AUTO_INCREMENT , `department` VARCHAR(255) NOT NULL, PRIMARY KEY (`sno`)) ENGINE = InnoDB;";
	        $this->db->query($q);
		}

		//returns the list of all the departments
		public function departments(){
			$dept=$this->db->order_by('department')
							->get('department')
						   ->result_array();
			return $dept;
		}
		
		public function dept_name($dept_id){
			return $this->db->where('sno', $dept_id)
							->get('department')
							->result_array()[0];
		}

		public function insert_data($data, $table){
			$this->db->insert($table, $data);
		}

		public function update_dept($dept_id, $dept_name){
			$this->db->where('sno', $dept_id)
					 ->update('department', array('department'=> $dept_name));
		}


		 public function delete_dept($dept_id){
		 	$this->db->where('sno', $dept_id)
		 			 ->delete('department');
		 }
	};
?>