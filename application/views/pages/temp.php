<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Mines extends CI_Controller{

	var $data;

	public function __construct(){
		parent :: __construct();
		if($this->session->userdata('isLogged') !== true && $this->session->userdata('userType') !== "0"){
			redirect();
		}
		$this->data=array(
			'title' => "Coal India Limited",
			'header' => "List of Different Mines",
			'error' => ''
		);
		$data = [
			'isLogged'	=>	$this->session->userdata('isLogged'),
			'userType'	=>	$this->session->userdata('userType'),
		];

		$this->load->helper(array('form', 'url', 'date','array', 'file'));    //for and url helpers are loaded
        $this->load->library('form_validation');      //form_validation library is loaded

		$this->load->view('templates/header',$data);
		
		$this->load->model('pages/model_mines','', TRUE);
	} 

	public function index(){    
		$this->data['mines']=$this->model_mines->all_mines();
				$this->load->view('pages/view_mines', $this->data);
		$this->load->view('templates/footer');
	}

	public function add_mine(){
		//echo "khjv";
		$this->data['header']="Add Mine";
//this->load->view('templates/header');
		$this->load->view('pages/view_add_mine', $this->data);
		$this->load->view('templates/footer');
	}

	public function save_mine(){
		$error='';

		$this->form_validation->set_rules('minecategory','Mine CAtegory','trim');
		$this->form_validation->set_rules('munit','Measuring Unit','trim');
		//$this->form_validation->set_rules('mine_id','Email','trim|required|valid_email|strtolower');
		$save_mine=array(
			'minecategory'	=>	$this->input->post('minecategory'),
			'munit'			=>	$this->input->post('munit')
		);

		$n=count($this->input->post('plower_lim'), COUNT_NORMAL);

		if($this->form_validation->run()==false){
            $error.=validation_errors();
            $this->add_mine();
        }
        
        //var_dump($_POST);
       
		else{
			$flag= false;
			for($i=0;$i<$n;$i++){
				$ll=$this->input->post('plower_lim')[$i];
				$ul=$this->input->post('pupper_lim')[$i];
				//echo $ll." ".$ul.'<br>';
				if(!is_numeric($ll) || !is_numeric($ul)){
					$error.="Lower and Upper limit can be numeric only";
					$this->data['error']=$error;
					$flag=true;
					//echo "here";
					break;
				}
			}
			if($flag){
				$this->add_mine();
			}
			else{
				$flag= false;
				for($i=1;$i<$n;$i++){
					$ll=$this->input->post('plower_lim')[$i];
					$ul=$this->input->post('pupper_lim')[$i-1];
					//echo $ll." ".$ul.'<br>';
					if($ll<$ul){
						$error.="Invalid input : overlapping ranges";
						$this->data['error']=$error;
						$flag=true;
						//echo "here";
						break;
					}
				}
				if($flag){
					$this->add_mine();
				}
				else{
					$this->db->trans_start();
					$this->model_mines->insert_data('minetype', $save_mine);

					$m_id=$this->model_mines->get_mine_id($save_mine);

					for($i=0;$i<$n;$i++){
						$s_mine_data=array(
							'mine_id'		=>	$m_id,
							'plower_lim'	=>	$this->input->post('plower_lim')[$i],
							'pupper_lim'	=>	$this->input->post('pupper_lim')[$i]
						);
						$this->model_mines->insert_data('minesubtype', $s_mine_data);
					}
					$this->db->trans_complete();
					redirect(site_url('mines'));
				}

				
			}

			
		}
	}

	// public function submines($mine_id){
	// 	$s_m['res']=$this->model_mines->submines($mine_id);
	// 	$n=count($s_m['res'],COUNT_NORMAL);
	// 	$arr=array();
	// 	$arr[-1]='--Select--';
	// 	for($i=0;$i<$n;$i++){
	// 		$arr[$s_m['res'][$i]['sno']]=''.$s_m['res'][$i]['plower_lim'].' to '.$s_m['res'][$i]['pupper_lim'];
	// 	}

	// 	$mine_cat=$this->model_mines->get_mine_cat($mine_id);

	// 	$s_m['header']='Submine Selection<br>'.$mine_cat;
	// 	$s_m['arr']=$arr;
	// 			$this->load->view('pages/view_select_submine', $s_m);
	// 	$this->load->view('templates/footer');
	// }

	public function submines_list($mine_id){
		//dump($mine_id);
		$s_m['mine_id']=$mine_id;

		//list of all submines of given mine id
		$s_m['res']=$this->model_mines->submines($mine_id);

		//dump($s_m['res']);
		$n=count($s_m['res'],COUNT_NORMAL);
		//dump($n);
		//all submines for the given mine_id
		$arr_submine['']='-Select-';

		
		for($i=0;$i<$n;$i++){
			$arr_submine[$s_m['res'][$i]['mcode']]=''.$s_m['res'][$i]['plower_lim'].' to '.$s_m['res'][$i]['pupper_lim'];
			//echo $i.'<br>';
		}
		//dump($arr_submine);
		$s_m['arr_submine']=$arr_submine;

		//all departments from department table
		$dept=$this->model_mines->department();
		$n=count($dept,COUNT_NORMAL);
		$arr_dept=array();
		$arr_dept['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_dept[$dept[$i]['sno']]=$dept[$i]['department'];
		}
		$s_m['arr_dept']=$arr_dept;

		//minecategory and mine_id from minetype table 
		$mine=$this->model_mines->get_mine_cat($mine_id);

		$s_m['header']='View Submines<br>'.$mine;
		$s_m['mine']=$mine;


		//$this->load->view('templates/header');
		//var_dump($s_m);
		$this->load->view('pages/view_submine_list', $s_m);
		$this->load->view('templates/footer');
	}

	public function add_submine($mine_id=""){
		$data=array(
			'title' => "Coal India Limited",
			'error' => $this->data['error']
		);
		$data['mine_info']=$this->model_mines->get_mine($mine_id);
		//print_r($data['mine_info']);

		$data['header']=$data['mine_info']['minecategory']. "<br>Add Submine";
		//$this->load->view('templates/header');
		$this->load->view('pages/view_add_submine', $data);
		$this->load->view('templates/footer');
	}

	// public function submine_data(){
	// 	$submine_id=$this->input->post('submine');
	// 	$mine_id=$this->model_mines->mine_id($submine_id);

	// 	$std_data=array(
	// 					'title'		=>	'Coal India Limited',
	// 					'header'	=>	'Basis of provision of statutory and key executives',

	// 					);
	// 	$std_data['data']=$this->model_mines->get_std_data($submine_id);
	// }

	public function save_submine(){
		$m_id=$this->input->post('mine_id');

		$n=count($this->input->post('plower_lim'), COUNT_NORMAL);
		$error='';
		$flag= false;
		for($i=0;$i<$n;$i++){
			$ll=$this->input->post('plower_lim')[$i];
			$ul=$this->input->post('pupper_lim')[$i];
			//echo $ll." ".$ul.'<br>';
			if(!is_numeric($ll) || !is_numeric($ul)){
				$error.="Lower and Upper limit can be numeric only";
				$this->data['error']=$error;
				$flag=true;
				//echo "here";
				break;
			}
		}
		if($flag){
			$this->add_submine($m_id);
		}
		else{
			$this->db->trans_start();

			for($i=0;$i<$n;$i++){
				$s_mine_data=array(
					'mine_id'		=>	$m_id,
					'plower_lim'	=>	$this->input->post('plower_lim')[$i],
					'pupper_lim'	=>	$this->input->post('pupper_lim')[$i]
				);
				$this->model_mines->insert_data('minesubtype', $s_mine_data);
			}
			$this->db->trans_complete();
			redirect(site_url('mines/edit_mine/'.$m_id));
		}
	}

	public function show_submineNdept(){
		$data=array(
			'title' 		=>	"Coal India Limited",
			'error' 		=>	'',
			'header'		=>	'Standard Data',
			'mine_id' 		=>	$this->input->post('mine_id'),
			'mcode'			=>	$this->input->post('submine'),
			'dept_id'		=>	$this->input->post('department')

		);
		//var_dump($_POST);

		$std_data=$this->model_mines->get_std_data($data['mcode'], $data['dept_id']);
		$n=count($std_data,COUNT_NORMAL);

		//retrieving minecategory from minetype table
		$data['minecategory']=$this->model_mines->get_minecategory($data['mine_id']);

		//retrieving submine category from minesubtype table
		$range=$this->model_mines->get_minesubcategory($data['mcode']);
		$data['submine']=$range['plower_lim'] . " to ". $range['pupper_lim'];

		//retrieving department name from department table
		$data['department']=$this->model_mines->get_department($data['dept_id']);

		//Scope of work
		$data['scopeofwork']=$std_data[0]['scopeofwork'];

		$temp=array();

		for($i=0;$i<$n;$i++){
			$temp[$i]['cadre']=$this->model_mines->get_cadre($std_data[$i]['cadre']);
			$temp[$i]['grade']=$this->model_mines->get_grade($std_data[$i]['grade']);
			$temp[$i]['no_of_emp']=$std_data[$i]['no_of_emp'];
			$temp[$i]['info']=$std_data[$i]['info'];
			$temp[$i]['norm']=$this->model_mines->get_norm($std_data[$i]['norm']);
		}
		$data['std_data']=$temp;

		//$this->load->view('templates/header');
		$this->load->view('pages/view_std_data', $data);
		$this->load->view('templates/footer');

	}

	public function add_std_data($mine_id="", $mcode="", $department_id="", $scopeofwork=""){
		// $s_m['res']=$this->model_mines->submines($mine_id);
		// $n=count($s_m['res'],COUNT_NORMAL);
		// $arr_submine=array();

		// //all submines for the given mine_id
		// $arr_submine[-1]='-Select-';
		// for($i=0;$i<$n;$i++){
		// 	$arr_submine[$s_m['res'][$i]['mcode']]=''.$s_m['res'][$i]['plower_lim'].' to '.$s_m['res'][$i]['pupper_lim'];
		// }
		// $s_m['arr_submine']=$arr_submine;

		//all departments from department table
		// $dept=$this->model_mines->department();
		// $n=count($dept,COUNT_NORMAL);
		// $arr_dept=array();
		// $arr_dept['']='-Select-';
		// for($i=0;$i<$n;$i++){
		// 	$arr_dept[$dept[$i]['sno']]=$dept[$i]['department'];
		// }
		// $s_m['arr_dept']=$arr_dept;
		//var_dump($_POST);
		$s_m=array();
		if($mine_id==''){
			$s_m['mine_id']=$this->input->post('mine_id');
			$s_m['mcode']=$this->input->post('mcode');
			$s_m['department_id']=$this->input->post('department_id');
			$s_m['scopeofwork']=$this->input->post('scopeofwork');
		}
		else{
			$s_m['mine_id']=$mine_id;
			$s_m['mcode']=$mcode;
			$s_m['department_id']=$department_id;
			$s_m['scopeofwork']=$scopeofwork;
		}
		//var_dump($s_m);
		//echo $department_id;
		$s_m['minecategory']=$this->model_mines->get_minecategory($s_m['mine_id']);
		//retrieving submine category from minesubtype table
		$range=$this->model_mines->get_minesubcategory($s_m['mcode']);
		$s_m['submine']=$range['plower_lim'] . " to ". $range['pupper_lim'];

		$s_m['department']=$this->model_mines->get_department($s_m['department_id']);
		//echo"here";
		//var_dump($s_m['department']);

		//all cadre from cadre table
		$cadre=$this->model_mines->cadre();
		$n=count($cadre, COUNT_NORMAL);
		$arr_cadre=array();
		$arr_cadre['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_cadre[$cadre[$i]['sno']]=$cadre[$i]['cil_cadre'];
		}
		$s_m['arr_cadre']=$arr_cadre;

		//all grades from designation table table
		$grade=$this->model_mines->grade();
		$n=count($grade, COUNT_NORMAL);
		$arr_grade=array();
		$arr_grade['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_grade[$grade[$i]['sno']]=$grade[$i]['grade'];
			if($grade[$i]['discipline']=='m')
				$arr_grade[$grade[$i]['sno']].="(Medical)";
		}
		$s_m['arr_grade']=$arr_grade;

		//all norms from norm table
		$norm=$this->model_mines->norm();
		$n=count($norm, COUNT_NORMAL);
		$arr_norm=array();
		$arr_norm['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_norm[$norm[$i]['sno']]=$norm[$i]['norm'];
		}
		$s_m['arr_norm']=$arr_norm;

		$s_m['header']='Add Standard Data<br>'.$s_m['minecategory'].' Mine';

		//Loading the view
		///$this->load->view('templates/header');
		$this->load->view('pages/view_add_std_data', $s_m);
		$this->load->view('templates/footer');
	}

	public function save_std_data(){
		$data=array();
		$data['mcode']=$this->input->post('mcode');
		$data['department']=$this->input->post('department_id');
		$data['scopeofwork']=$this->input->post('scopeofwork');
		$data['designation']='';
		//echo $this->input->post('mcode')."  ".$data['department']."  ".$this->input->post('department_id')."  ".$this->input->post('department');

		$n=count($this->input->post('cadre'), COUNT_NORMAL);

		$this->db->trans_start();

		for($i=0;$i<$n;$i++){
			$data['cadre']=$this->input->post('cadre')[$i];
			$data['grade']=$this->input->post('grade')[$i];
			$data['no_of_emp']=$this->input->post('no_of_emp')[$i];
			$data['info']=$this->input->post('info')[$i];
			$data['norm']=$this->input->post('norm')[$i];

			$this->model_mines->insert_data('std_mine_data', $data);
		}

		$this->db->trans_complete();

		redirect(site_url('mines'));

		// $std_data=array(
		// 				'title'		=>	'Coal India Limited',
		// 				'header'	=>	'Basis of provision of statutory and key executives',

		// 				);
		// $std_data['data']=$this->model_mines->get_std_data($submine_id);
	}

	//
	//
	//Edit mines section starts here
	//
	//

	public function edit_mine($mine_id){

		$data=array(
			'title'		=>	'Coal India Limited',
			'mine_id'	=>	$mine_id,
		);
		$header=$this->model_mines->get_minecategory($mine_id);
		$data['header']=$header . ' Mine';
		$data['submines']=$this->model_mines->submines($mine_id);

		//$this->load->view('templates/header');
		$this->load->view('pages/view_edit_submines', $data);
		$this->load->view('templates/footer');
	}

	//Editing a particular submine. It means that the user will be able to select a department from the dropdown and then edit its values.
	public function edit_submine($mcode=""){
		$data=array(
			'title'		=>	'Coal India Limited',
			'mcode'		=>	$mcode,
		);
		$data['mine_id']=$this->model_mines->mine_id($mcode);
		$data['minecategory']=$this->model_mines->get_minecategory($data['mine_id']);

		//all departments from department table
		$dept=$this->model_mines->department();
		$n=count($dept,COUNT_NORMAL);
		$arr_dept=array();
		$arr_dept['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_dept[$dept[$i]['sno']]=$dept[$i]['department'];
		}
		$data['arr_dept']=$arr_dept;


		$data['header']='Edit ' . $data['minecategory'] . ' Mine';

		//retrieving submine category from minesubtype table
		$range=$this->model_mines->get_minesubcategory($data['mcode']);
		$data['submine']=$range['plower_lim'] . " to ". $range['pupper_lim'];

		//$this->load->view('templates/header');
		$this->load->view('pages/view_edit_submine_dept', $data);
		$this->load->view('templates/footer');
	}

	public function edit_submine2($mine_id="", $mcode="", $department_id=""){
		//var_dump($_POST);
		$data=array();
		if($mcode==""){
			$data=array(
				'mine_id'	=>	$this->input->post('mine_id'),
				'mcode'		=>	$this->input->post('mcode'),
				'department_id'	=>	$this->input->post('department'),
			);
		}
		else{
			$data=array(
				'mine_id'	=>	$mine_id,
				'mcode'		=>	$mcode,
				'department_id'	=>	$department_id
			);
		}
		$data['title']='Coal India Limited';

		

		//retrieving minecategory from minetype table
		$data['minecategory']=$this->model_mines->get_minecategory($data['mine_id']);

		//retrieving submine category from minesubtype table
		$range=$this->model_mines->get_minesubcategory($data['mcode']);
		$data['submine']=$range['plower_lim'] . " to ". $range['pupper_lim'];

		//retriieving department to be edited
		$data['department']=$this->model_mines->get_department($data['department_id']);

		//all departments from department table
		$dept=$this->model_mines->department();
		$n=count($dept,COUNT_NORMAL);
		$arr_dept=array();
		$arr_dept['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_dept[$dept[$i]['sno']]=$dept[$i]['department'];
		}
		$data['arr_dept']=$arr_dept;

		$data['header']='Edit ' . $data['minecategory'] . ' Mine';



		$std_data=$this->model_mines->get_std_data($data['mcode'], $data['department_id']);
		$n=count($std_data,COUNT_NORMAL);
		$data['n']=$n;

		//Scope of work
		$data['scopeofwork']=$std_data[0]['scopeofwork'];
		//echo $data['scopeofwork'] . "ihjbkfjlwekh";

		$temp=array();

		for($i=0;$i<$n;$i++){
			$temp[$i]['cadre']=$this->model_mines->get_cadre($std_data[$i]['cadre']);
			$temp[$i]['grade']=$this->model_mines->get_grade($std_data[$i]['grade']);
			$temp[$i]['no_of_emp']=$std_data[$i]['no_of_emp'];
			$temp[$i]['info']=$std_data[$i]['info'];
			$temp[$i]['norm']=$this->model_mines->get_norm($std_data[$i]['norm']);
			$temp[$i]['cadre_id']=$std_data[$i]['cadre'];
			$temp[$i]['grade_id']=$std_data[$i]['grade'];
			$temp[$i]['norm_id']=$std_data[$i]['norm'];
			$temp[$i]['sno']=$std_data[$i]['sno'];
		}
		$data['std_data']=$temp;

		//all cadre from cadre table
		$cadre=$this->model_mines->cadre();
		$n=count($cadre, COUNT_NORMAL);
		$arr_cadre=array();
		$arr_cadre['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_cadre[$cadre[$i]['sno']]=$cadre[$i]['cil_cadre'];
		}
		$data['arr_cadre']=$arr_cadre;

		//all grades from grade table
		$grade=$this->model_mines->grade();
		$n=count($grade, COUNT_NORMAL);
		$arr_grade=array();
		$arr_grade['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_grade[$grade[$i]['sno']]=$grade[$i]['grade'];
			//var_dump($grade[$i]['discipline']);
			if($grade[$i]['discipline'][0]=='m')
				$arr_grade[$grade[$i]['sno']].="(Medical)";
		}
		$data['arr_grade']=$arr_grade;

		//all norms from norm table
		$norm=$this->model_mines->norm();
		$n=count($norm, COUNT_NORMAL);
		$arr_norm=array();
		$arr_norm['']='-Select-';
		for($i=0;$i<$n;$i++){
			$arr_norm[$norm[$i]['sno']]=$norm[$i]['norm'];
		}
		$data['arr_norm']=$arr_norm;
		//var_dump($data);

		//$this->load->view('templates/header');
		$this->load->view('pages/view_edit_submine_dept2', $data);
		$this->load->view('templates/footer');

	}

	public function update_submines(){
		$n=count($this->input->post('cadre'), COUNT_NORMAL);
		//var_dump($_POST);
		for($i=0;$i<$n;$i++){
			$data['sno']=$this->input->post('std_data_id')[$i];
			$data['mcode']=$this->input->post('mcode');
			$data['department']=$this->input->post('department');
			$data['scopeofwork']=$this->input->post('scopeofwork');
			$data['cadre']=$this->input->post('cadre')[$i];
			$data['grade']=$this->input->post('grade')[$i];
			$data['no_of_emp']=$this->input->post('no_of_emp')[$i];
			$data['info']=$this->input->post('info')[$i];
			$data['norm']=$this->input->post('norm')[$i];
			$this->model_mines->update_submine($data);
			redirect(site_url('mines/edit_submine/'.$data['mcode']));
		}
	}


	public function all_submines($mine_id=""){
		$data=array(
			'title' 		=>	"Coal India Limited",
			'error' 		=>	'',
			'header'		=>	'Standard Data',
			'mine_id' 		=>	$mine_id

		);
		$data['minecategory']=$this->model_mines->get_minecategory($mine_id);
		$data['submines']=$this->model_mines->submines($mine_id);
		//var_dump($data['submines']);
		$n=count($data['submines'], COUNT_NORMAL);
		//$data['smd']=$this->model_mines->std_data_by_mine($mine_id);
		//var_dump($data['smd']);

		for($i=0;$i<$n;$i++){
			$range=$this->model_mines->get_minesubcategory($data['submines'][$i]['mcode']);
			$data['submine']=$range['plower_lim']." to ". $range['pupper_lim'];
			// var_dump($data['submine']);
			// echo '<br>';
			$std_data_raw=$this->model_mines->std_data_by_submine($data['submines'][$i]['mcode']);
			// var_dump($data['std_data']);
			// echo '<br>';
			$j=0;
			$data['sm']=array();
			foreach ($std_data_raw as $sd) {
				$std_data['department']=$this->model_mines->get_department($sd['department']);
				$std_data['scopeofwork']=$sd['scopeofwork'];
				$std_data['cil_cadre']=$this->model_mines->get_cadre($sd['cadre']);
				//echo $sd['grade'];
				$std_data['grade']=$this->model_mines->get_grade($sd['grade']);
				$std_data['no_of_emp']=$sd['no_of_emp'];
				$std_data['info']=$sd['info'];
				$std_data['norm']=$this->model_mines->get_norm($sd['norm']);
				$data['sm'][$j]=$std_data;
				// var_dump($data['sm'][$j]);

				// echo '<br><br><br>';
				$j++;
			}
			$data['i']=$i;
			
			$this->load->view('pages/view_complete_data', $data);
			$this->load->view('templates/footer');
		}
	}
}
?>
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