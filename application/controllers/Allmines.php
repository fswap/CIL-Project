<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Allmines extends CI_Controller{ 
	var $data;

	public function __construct(){
		parent :: __construct();

		if($this->session->userdata('isLogged') !== true){
			redirect();
		}
		// else{
		// 	echo "Logged in ; id : ".$this->session->userdata('id');
		// }
		$data = [
			'isLogged'	=>	$this->session->userdata('isLogged'),
			'userType'	=>	$this->session->userdata('userType'),
		];

		$this->data=array(
			'title' => "Coal India Limited",
			'header' => "Coal India Limited<br>Mines",
			'error' => ''
		);

		$this->load->model('pages/model_allmines','', TRUE);
		$this->load->view('templates/header');
	} 

	public function index(){    
		$this->data['allmines']=$this->model_allmines->all_allmines();
		$this->load->view('pages/view_allmines',$this->data);
		$this->load->view('templates/footer');
	}

	public function add_allmine(){
		$this->load->model('pages/model_subsidiary');
		$this->load->model('pages/model_area');
		$this->load->model('pages/model_subarea');
		$this->load->model('pages/model_designation');
		$allmine_data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Add New mine",
			'error'		=>	""
		);
		$allmine_data['subsidiary'] = $this->model_subsidiary->all_subsidiary();
		$allmine_data['area'] = $this->model_area->all_area();
		$allmine_data['subarea'] = $this->model_subarea->all_subarea();
		$allmine_data['mine_type'] = $this->model_designation->all_minetype();
		$allmine_data['year'] = $this->model_designation->all_year();
		$this->load->view("pages/view_add_allmine", $allmine_data);
		$this->load->view('templates/footer');
	}

	public function save_allmine(){
		$save_allmine=array(
			'sub_id'     => $this->input->post('sub_id'),
			'area_id'    => $this->input->post('area_id'),
			'subarea_id' =>	$this->input->post('subarea_id'),
			'mine_name'	 =>	$this->input->post('mine_name'),
			'mine_type'  => $this->input->post('mine_id'),
			'year_id'    => $this->input->post('year_id'),
			'SR'         => $this->input->post('SR'),
			'coal'       => $this->input->post('coal'),
			'OBR'        => $this->input->post('OBR'),
			'tot_excavation'    => $this->input->post('tot_excavation'),
			'production' =>$this->input->post('production'),
			'tot_production' => $this->input->post('tot_production')
		);

        $this->db->trans_start();
		$this->model_allmines->insert_data($save_allmine, 'mines');
		$this->db->trans_complete();;
  		redirect(site_url('allmines'));
	}

	public function edit_allmine($mine_id=""){
		$this->load->model('pages/model_subsidiary');
		$this->load->model('pages/model_area');
		$this->load->model('pages/model_subarea');
		$this->load->model('pages/model_designation');
		$this->load->model('pages/model_allmines');
		$data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Edit Subsidiary",
			'error'		=>	""
		);
		//var_dump($cad_id);
		$data['subsidiary'] = $this->model_subsidiary->all_subsidiary();
		$data['area'] = $this->model_area->all_area();
		$data['subarea'] = $this->model_subarea->all_subarea();
		$data['mine_type'] = $this->model_designation->all_minetype();
		$data['year'] = $this->model_designation->all_year();
		$data['mine']=$this->model_allmines->mine_name($mine_id);
		$this->load->view('pages/view_edit_allmine', $data);
		//$this->model_departments->edit_dept($dept_id);
		//redirect(site_url('departments'));
	}

	public function update_allmine(){
		//var_dump($_POST);
		$sub_id=$this->input->post('sub_id');
		$sub_name=$this->input->post('sub_name');
		$this->db->trans_start();
		$this->model_subsidiary->update_subsidiary($sub_id, $sub_name);
		$this->db->trans_complete();
  		redirect(site_url('subsidiary'));
	}

	 public function select_delete_allmine(){
	 	//$this->load->view('templates/header');
	 	$allmine_data=array(
	 		'title'		=>	"Coal India Limited",
	 		'header'	=>	"Delete Mines",
	 		'error'		=>	""
	 	);
	 	$allmine_data['allmine']=$this->model_allmines->all_allmines();
	 	$this->load->view("Pages/view_select_delete_allmine", $allmine_data);
	 	$this->load->view("templates/footer");
	 }

	 public function delete_allmine($mine_id=""){
	 	$this->model_allmines->delete_allmine($mine_id);
	 	redirect(site_url('allmines'));
	 }

} 
?>