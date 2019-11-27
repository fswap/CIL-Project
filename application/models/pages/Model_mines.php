<?php
	class Model_mines extends CI_Model{
		function __construct(){
			parent::__construct();	//call the model contructor
		}

		public function all_mines(){
			//$this->create_designation();
			$result = $this->db->get('minetype')
					 		   ->result_array();
			return $result;
		}

		public function insert_data($table, $data){
			$this->db->insert($table, $data);
		}

		public function get_mine_id($m_data){
			$res=$this->db->where('minecategory', $m_data['minecategory'])
						  ->get('minetype')
						  ->order_by('mcode', 'asc')
						  ->result_array();
			if($res){
				return $res[0]['mine_id'];
			}
		}

		public function submines($mine_id){
			$res=$this->db->where('mine_id', $mine_id)
						->order_by('mcode', 'asc')
						->get('minesubtype')
						->result_array();
			if($res){
				return $res;
			}
		}

		public function get_mine_cat($m_id){
			$mine_cat=$this->db->where('mine_id', $m_id)
							   ->get('minetype')
							   ->result_array();
			if(!empty($mine_cat)){
				return $mine_cat[0]['minecategory'];
			}
		}

		public function mine_id($sm_id){
			$mine_id=$this->db->where('sno', $sm_id)
							  ->get('minesubtype')
							  ->result_array();
			if($mine_id){
				return $mine_id[0]['mine_id'];
			}
		}

		public function get_std_data($submine, $dept){
			$res=$this->db->where('mcode', $submine)
						  ->where('department', $dept)
						  ->get('std_mine_data')
						  ->result_array();
			if($res){
				return $res;
			}
		}

		//To get cadre name from primary key "sno" in the table "cadre"
		public function get_cadre($sno){
			$cadre=$this->db->where('sno', $sno)
							->get('cadre')
							->result_array();
			if($cadre)	return $cadre[0]['cil_cadre'];
		}

		//To get grade name from primary key "sno" in the table "grade"
		public function get_grade($sno){
			$gr=$this->db->where('sno', $sno)
							->get('designation')
							->result_array();
			$ans = $gr[0]['grade'];
			// var_dump($ans);
			// echo '<br>';
			if($gr[0]['discipline'][0]=='M')
				$ans.="(Medical)";
			return $ans;
		}

		//To get norm name from primary key "sno" in the table "norm"
		public function get_norm($sno){
			$norm=$this->db->where('sno', $sno)
							->get('norm')
							->result_array();
			if($norm)	return $norm[0]['norm'];
		}

		//To get minecategory name from the table "minetype" using the primary key "mine_id"
		public function get_minecategory($mine_id){
			$mine=$this->db->where('mine_id', $mine_id)
							->get('minetype')
							->result_array();
			if($mine)	return $mine[0]['minecategory'];
		}

		//To get minesubcategory range from the table "minesubtype" using the primary key "mocde"
		public function get_minesubcategory($mcode){

			
			$submine=$this->db->where('mcode', $mcode)
							->get('minesubtype')
							->result_array();
			if($submine)	return $submine[0];
		}

		//To get department name from the table "department" using the primary key "sno"
		public function get_department($sno){
			$dept=$this->db->where('sno', $sno)
							->get('department')
							->result_array();
			if($dept)	return $dept[0]['department'];
		}

		public function department(){
			$dept=$this->db->get('department')
						   ->result_array();
			return $dept;
		}
		public function cadre(){
			$cadre=$this->db->get('cadre')
						   ->result_array();
			return $cadre;
		}
		public function grade(){
			$grade=$this->db->get('designation')
						   ->result_array();
			return $grade;
		}

		public function norm(){
			$norm=$this->db->get('norm')
						   ->result_array();
			return $norm;
		}

		public function delete_std_data($sno){
			$this->db->where('sno', $sno)
					 ->delete('std_mine_data');
		}

		public function get_mine($mine_id){
			$mine=$this->db->where('mine_id', $mine_id)
							->get('minetype')
							->result_array();
			if($mine)	return $mine[0];
		}

		public function update_submine($data){
			$this->db->set($data)
					 ->where('sno', $data['sno'])
					 ->update('std_mine_data');
		}

		//I think, it is redundant
		public function get_cad_id($cadre){
			//echo "jhdfh".$cadre;
			$r= $this->db->where('cil_cadre', $cadre)
						->get('cadre')
						->result_array()[0]['sno'];
						//dump($this->db->last_query());
		}

		public function get_grade_id($grade){
			return $this->db->where('grade', $grade)
						->get('designation')
						->result_array()[0]['sno'];
		}

		public function std_data_by_mine($mine_id=""){
			$q="SELECT *
				FROM std_mine_data as smd
				WHERE smd.mcode in(
						SELECT mcode
						FROM minesubtype as ms
						WHERE ms.mine_id='$mine_id'
					)
				";
			return $this->db->query($q)->result_array();
		}

		public function std_data_by_submine($mcode=""){
			return $this->db->where('mcode', $mcode)
						  ->order_by('department', 'asc')
						  ->get('std_mine_data')
						  ->result_array();
		}
	};
?>