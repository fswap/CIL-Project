<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Subarea extends CI_Controller{ 
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
			'header' => "Coal India Limited<br>Subarea",
			'error' => ''
		);

		$this->load->model('pages/model_subarea','', TRUE);
		$this->load->view('templates/header');
	} 

	public function index(){    
		$this->data['subarea']=$this->model_subarea->all_subarea();
		 //print_r($this->data);exit();
		$this->load->view('pages/view_subarea',$this->data);
		$this->load->view('templates/footer');
	}

	public function add_subarea(){
		$this->load->model('pages/model_subsidiary');
		$this->load->model('pages/model_area');
		$subarea_data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Add New Subarea",
			'error'		=>	""
		);
		$subarea_data['subsidiary'] = $this->model_subsidiary->all_subsidiary();
		$subarea_data['area'] = $this->model_area->all_area();
		$this->load->view("pages/view_add_subarea", $subarea_data);
		$this->load->view('templates/footer');
	}

	public function save_subarea(){
		$save_subarea=array(
			'sub_id'  =>  $this->input->post('sub_id'),
			'area_id'  =>  $this->input->post('area_id'),
			'subarea_name'	=>	$this->input->post('subarea_name')
		);

        $this->db->trans_start();
		$this->model_subarea->insert_data($save_subarea, 'subarea');
		$this->db->trans_complete();;
  		redirect(site_url('subarea'));
	}

	public function edit_subarea($subarea_id=""){
		$this->load->model('pages/model_subsidiary');
		$this->load->model('pages/model_area');
		$data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Edit Subarea",
			'error'		=>	""
		);
		//var_dump($cad_id);
		$data['subsidiary'] = $this->model_subsidiary->all_subsidiary();
		$data['area'] = $this->model_area->all_area();
		$data['subarea']=$this->model_subarea->subarea_name($subarea_id);
		$this->load->view('pages/view_edit_subarea', $data);
		
	}

	public function update_subarea(){
		//var_dump($_POST);
		$sub_id=$this->input->post('sub_id');
		$area_id=$this->input->post('area_id');
		$subarea_name=$this->input->post('subarea_name');
		$subarea_id = $this->input->post('subarea_id'); //exit();
		$this->db->trans_start();
		$this->model_subarea->update_subarea($sub_id, $area_id, $subarea_id,$subarea_name);
		$this->db->trans_complete();
  		redirect(site_url('subarea'));
	}

	 public function select_delete_subarea(){
	 	//$this->load->view('templates/header');
	 	$cad_data=array(
			'title'		=>	"Coal India Limited",
	 		'header'	=>	"Delete Subarea",
	 		'error'		=>	""
	 	);
	 	$subarea_data['subarea']=$this->model_subarea->all_subarea();
	 	$this->load->view("Pages/view_select_delete_subarea", $subarea_data);
	 	$this->load->view("templates/footer");
	 }

	 public function delete_subarea($subarea_id=""){
	 	$this->model_subarea->delete_subarea($subarea_id);
	 	redirect(site_url('subarea'));
	 }

} 
?>