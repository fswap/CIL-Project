<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Subsidiary extends CI_Controller{ 
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
			'header' => "Coal India Limited<br>Subsidiary",
			'error' => ''
		);

		$this->load->model('pages/model_subsidiary','', TRUE);
		$this->load->view('templates/header');
	} 

	public function index(){    
		$this->data['subsidiary']=$this->model_subsidiary->all_subsidiary();
		$this->load->view('pages/view_subsidiary',$this->data);
		$this->load->view('templates/footer');
	}

	public function add_subsidiary(){
		$subsidiary_data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Add New subsidiary",
			'error'		=>	""
		);
		$this->load->view("pages/view_add_subsidiary", $subsidiary_data);
		$this->load->view('templates/footer');
	}

	public function save_subsidiary(){
		$save_subsidiary=array(
			'sub_name'	=>	$this->input->post('sub_name')
		);

        $this->db->trans_start();
		$this->model_subsidiary->insert_data($save_subsidiary, 'subsidiary');
		$this->db->trans_complete();;
  		redirect(site_url('subsidiary'));
	}

	public function edit_subsidiary($sub_id=""){
		$data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Edit Subsidiary",
			'error'		=>	""
		);
		//var_dump($cad_id);
		$data['subsidiary']=$this->model_subsidiary->subsidiary_name($sub_id);
		$this->load->view('pages/view_edit_subsidiary', $data);
		//$this->model_departments->edit_dept($dept_id);
		//redirect(site_url('departments'));
	}

	public function update_subsidiary(){
		//var_dump($_POST);
		$sub_id=$this->input->post('sub_id');
		$sub_name=$this->input->post('sub_name');
		$this->db->trans_start();
		$this->model_subsidiary->update_subsidiary($sub_id, $sub_name);
		$this->db->trans_complete();
  		redirect(site_url('subsidiary'));
	}

	 public function select_delete_sub(){
	 	//$this->load->view('templates/header');
	 	$cad_data=array(
	 		'title'		=>	"Coal India Limited",
	 		'header'	=>	"Delete Subsidiary",
	 		'error'		=>	""
		);
	 	$sub_data['sub']=$this->model_subsidiary->all_subsidiary();
	 	$this->load->view("Pages/view_select_delete_sub", $sub_data);
	 	$this->load->view("templates/footer");
	 }

	 public function delete_sub($sub_id=""){
	 	$this->model_subsidiary->delete_sub($sub_id);
	 	redirect(site_url('subsidiary'));
	 }

} 
?>