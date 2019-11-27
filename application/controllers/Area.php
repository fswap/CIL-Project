<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Area extends CI_Controller{ 
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
			'header' => "Coal India Limited<br>Area",
			'error' => ''
		);

		$this->load->model('pages/model_area','', TRUE);
		$this->load->view('templates/header');
	} 

	public function index(){    
		$this->data['area']=$this->model_area->all_area();
		$this->load->view('pages/view_area',$this->data);
		$this->load->view('templates/footer');
	}

	public function add_area(){

		$this->load->model('pages/model_subsidiary');
		$area_data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Add New Area",
			'error'		=>	""
		);

		$area_data['subsidiary'] = $this->model_subsidiary->all_subsidiary();
		//print_r($area_data['subsidiary']); exit();
		$this->load->view("pages/view_add_area", $area_data);
		$this->load->view('templates/footer');
	}

	public function save_area(){

		//echo $this->input->post('sub_id'); exit();
		$save_area=array(
			'sub_id'  =>  $this->input->post('sub_id'),
			'area_name'	=>	$this->input->post('area_name')
		);

        $this->db->trans_start();
		$this->model_area->insert_data($save_area, 'area');
		$this->db->trans_complete();;
  		redirect(site_url('area'));
	}

	public function edit_area($area_id=""){


		$this->load->model('pages/model_subsidiary');
		
		//print_r($data['subsidiary']); exit();
		$data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Edit Area",
			'error'		=>	""
		);
		$data['subsidiary'] = $this->model_subsidiary->all_subsidiary();
		//var_dump($cad_id);
		$data['area']=$this->model_area->area_name($area_id);
		//print_r($data['area']); exit();
		$this->load->view('pages/view_edit_area', $data);
		
	}

	public function update_area(){
		//var_dump($_POST);

		$sub_id=$this->input->post('sub_id');
		$area_name=$this->input->post('area_name');
		$area_id = $this->input->post('area_id'); //exit();
		$this->db->trans_start();
		$this->model_area->update_area($area_id, $area_name, $sub_id);
		$this->db->trans_complete();
  		redirect(site_url('area'));
	}

	 public function select_delete_area(){
	 	//$this->load->view('templates/header');
	 	$area_data=array(
	 		'title'		=>	"Coal India Limited",
	 		'header'	=>	"Delete Area",
	 		'error'		=>	""
	 	);
	 	$area_data['area']=$this->model_area->all_area();
	 	$this->load->view("Pages/view_select_delete_area", $area_data);
	 	$this->load->view("templates/footer");
	 }

	 public function delete_area($area_id=""){
	 	$this->model_area->delete_area($area_id);
	 	redirect(site_url('area'));
	 }

} 
?>