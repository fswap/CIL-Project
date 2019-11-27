<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Cadre extends CI_Controller{ 
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
			'header' => "Coal India Limited<br>Cadres",
			'error' => ''
		);

		$this->load->model('pages/model_cadre','', TRUE);
		$this->load->view('templates/header');
	} 

	public function index(){    
		$this->data['cadre']=$this->model_cadre->all_cadre();
		$this->load->view('pages/view_cadre',$this->data);
		$this->load->view('templates/footer');
	}

	public function add_cad(){
		$cad_data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Add New Cadre",
			'error'		=>	""
		);
		$this->load->view("pages/view_add_cad", $cad_data);
		$this->load->view('templates/footer');
	}

	public function save_cad(){
		$save_cad=array(
			'cil_cadre'	=>	$this->input->post('cil_cadre')
		);

        $this->db->trans_start();
		$this->model_cadre->insert_data($save_cad, 'cadre');
		$this->db->trans_complete();;
  		redirect(site_url('cadre'));
	}

	public function edit_cad($cad_id=""){
		$data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Edit Cadre",
			'error'		=>	""
		);
		//var_dump($cad_id);
		$data['cad']=$this->model_cadre->cad_name($cad_id);
		$this->load->view('pages/view_edit_cadre', $data);
		//$this->model_departments->edit_dept($dept_id);
		//redirect(site_url('departments'));
	}

	public function update_cad(){
		//var_dump($_POST);
		$sno=$this->input->post('sno');
		$cad=$this->input->post('cil_cadre');
		$this->db->trans_start();
		$this->model_cadre->update_cad($sno, $cad);
		$this->db->trans_complete();
  		redirect(site_url('cadre'));
	}

	 public function select_delete_cad(){
	 	//$this->load->view('templates/header');
	 	$cad_data=array(
	 		'title'		=>	"Coal India Limited",
	 		'header'	=>	"Delete Cadre",
	 		'error'		=>	""
	 	);
	 	$cad_data['cads']=$this->model_cadre->all_cadre();
	 	$this->load->view("Pages/view_select_delete_cad", $cad_data);
	 	$this->load->view("templates/footer");
	 }

	 public function delete_cad($cad_id=""){
	 	$this->model_cadre->delete_cad($cad_id);
	 	redirect(site_url('cadre'));
	 }

} 
?>